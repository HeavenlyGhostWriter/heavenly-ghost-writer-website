import ftplib
import os
import json
import argparse
import fnmatch
import time
import sys

# --- COLORS & UTILS ---
class Colors:
    HEADER = '\033[95m'
    BLUE = '\033[94m'
    GREEN = '\033[92m'
    WARNING = '\033[93m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'
    BOLD = '\033[1m'

def log(msg, type="info"):
    if type == "info": print(f"{Colors.BLUE}[INFO]{Colors.ENDC} {msg}")
    elif type == "success": print(f"{Colors.GREEN}[OK]{Colors.ENDC} {msg}")
    elif type == "warn": print(f"{Colors.WARNING}[WARN]{Colors.ENDC} {msg}")
    elif type == "error": print(f"{Colors.FAIL}[ERR]{Colors.ENDC} {msg}")
    elif type == "header": print(f"\n{Colors.HEADER}{Colors.BOLD}--- {msg} ---{Colors.ENDC}")

# --- CONFIGURATION LOADER ---
def load_env():
    """Simple parser for .env files to avoid external dependencies"""
    config = {}
    if os.path.exists(".env"):
        with open(".env", "r") as f:
            for line in f:
                if "=" in line and not line.strip().startswith("#"):
                    key, value = line.strip().split("=", 1)
                    config[key] = value
    return config

# --- IGNORE SYSTEM ---
def load_ignore_patterns():
    patterns = []
    if os.path.exists(".deployignore"):
        with open(".deployignore", "r") as f:
            patterns = [line.strip() for line in f if line.strip() and not line.startswith("#")]
    return patterns

def should_ignore(path, patterns):
    for pattern in patterns:
        if fnmatch.fnmatch(path, pattern) or fnmatch.fnmatch(os.path.basename(path), pattern):
            return True
    return False

# --- MAIN DEPLOYER CLASS ---
class VibeDeployer:
    def __init__(self, dry_run=False, force=False):
        self.config = load_env()
        self.dry_run = dry_run
        self.force = force
        self.tracker_file = "deploy_tracker.json"
        self.ignore_patterns = load_ignore_patterns()
        self.ftp = None
        
        # Validation
        if not self.config.get("FTP_HOST"):
            log("Missing .env file or FTP_HOST variable.", "error")
            sys.exit(1)

    def connect(self):
        if self.dry_run:
            log("Dry Run: Skipping connection.", "warn")
            return
        
        try:
            host = self.config["FTP_HOST"]
            log(f"Connecting to {host}...")
            # Try TLS first, fallback to standard
            try:
                self.ftp = ftplib.FTP_TLS(host)
            except:
                self.ftp = ftplib.FTP(host)
            
            self.ftp.login(self.config["FTP_USER"], self.config["FTP_PASS"])
            try: self.ftp.prot_p() 
            except: pass
            
            self.ftp.cwd(self.config["REMOTE_DIR"])
            log("Connected successfully.", "success")
        except Exception as e:
            log(f"Connection failed: {e}", "error")
            sys.exit(1)

    def load_tracker(self):
        if os.path.exists(self.tracker_file) and not self.force:
            try:
                with open(self.tracker_file, "r") as f:
                    return json.load(f)
            except:
                return {}
        return {}

    def save_tracker(self, data):
        if not self.dry_run:
            with open(self.tracker_file, "w") as f:
                json.dump(data, f, indent=4)

    def ensure_remote_dir(self, remote_path):
        """Recursively create directories on server"""
        if self.dry_run: return
        
        folder = os.path.dirname(remote_path)
        if not folder or folder == ".": return

        # Split path and check one by one
        path_parts = folder.split("/")
        current = ""
        for part in path_parts:
            current = f"{current}/{part}" if current else part
            try:
                self.ftp.mkd(current)
            except:
                pass # Already exists

    def upload_file(self, local, remote):
        if self.dry_run:
            print(f"{Colors.GREEN}DRY RUN: Upload > {remote}{Colors.ENDC}")
            return True

        retries = 3
        while retries > 0:
            try:
                self.ensure_remote_dir(remote)
                with open(local, "rb") as f:
                    self.ftp.storbinary(f"STOR {remote}", f)
                print(f"{Colors.GREEN}UPLOADED: {remote}{Colors.ENDC}")
                return True
            except Exception as e:
                print(f"{Colors.WARNING}Retry ({retries}): {e}{Colors.ENDC}")
                retries -= 1
                time.sleep(1)
        
        log(f"Failed to upload {remote}", "error")
        return False

    def delete_remote_file(self, remote):
        if self.dry_run:
            print(f"{Colors.FAIL}DRY RUN: Delete > {remote}{Colors.ENDC}")
            return True

        try:
            self.ftp.delete(remote)
            print(f"{Colors.FAIL}DELETED: {remote}{Colors.ENDC}")
            return True
        except:
            # Maybe it's already gone, or it's a folder? Ignored for safety.
            return False

    def run(self):
        log("Starting Deployment Scan...", "header")
        
        tracker = self.load_tracker()
        new_tracker = {}
        
        to_upload = []
        to_delete = []

        # 1. SCAN LOCAL FILES
        for root, dirs, files in os.walk("."):
            # Ignore folders in place to skip recursion
            dirs[:] = [d for d in dirs if not should_ignore(d, self.ignore_patterns)]
            
            for filename in files:
                if should_ignore(filename, self.ignore_patterns):
                    continue

                local_path = os.path.join(root, filename)
                relative_path = os.path.relpath(local_path, ".").replace("\\", "/")
                
                mtime = os.path.getmtime(local_path)
                new_tracker[relative_path] = mtime

                # Check if changed
                if self.force or relative_path not in tracker or tracker[relative_path] < mtime:
                    to_upload.append((local_path, relative_path))

        # 2. CHECK FOR DELETIONS
        for old_file in tracker:
            if old_file not in new_tracker:
                to_delete.append(old_file)

        # 3. REPORT PLAN
        if not to_upload and not to_delete:
            log("No changes detected. Site is up to date.", "success")
            return

        log(f"Plan: {len(to_upload)} to upload, {len(to_delete)} to delete.")
        
        # 4. EXECUTE
        self.connect()
        
        success_count = 0
        
        # Deletions first
        for item in to_delete:
            self.delete_remote_file(item)

        # Uploads second
        for local, remote in to_upload:
            if self.upload_file(local, remote):
                success_count += 1

        # 5. FINISH
        if not self.dry_run:
            self.save_tracker(new_tracker)
            if self.ftp:
                try: self.ftp.quit()
                except: self.ftp.close()
            log(f"Deployment finished. {success_count} files updated.", "success")
        else:
            log("Dry run finished. No files were changed.", "warn")

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="Vibe Coder FTP Deployer")
    parser.add_argument("--dry-run", action="store_true", help="Simulate without uploading")
    parser.add_argument("--force", action="store_true", help="Upload ALL files ignoring history")
    
    args = parser.parse_args()
    
    deployer = VibeDeployer(dry_run=args.dry_run, force=args.force)
    deployer.run()