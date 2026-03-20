<?php 
// 1. Set your SEO variables for the main dashboard
$pageTitle = "Dashboard | Heavenly Ghost Writer";
$pageDesc = "A timeless, resilient personal archive of essays, photography, and audio built with pure HTML and CSS.";

// 2. Load the Header and Sidebar
include 'includes/header.php'; 
?>

        <main class="main-content">
          <section class="dashboard-hero">
            <h2>Explore the Archive</h2>
            <p>
              Select a discipline to dive into my dedicated collections of
              writing, visual art, and audio recordings.
            </p>
          </section>

          <section class="portal-grid">
            <a href="blog-index.html" class="portal-card">
              <div class="portal-icon"><i class="ri-quill-pen-line"></i></div>
              <div class="portal-info">
                <h3>Written Essays</h3>
                <p>Deep dives into philosophy, tech, and life.</p>
              </div>
              <i class="ri-arrow-right-line portal-arrow"></i>
            </a>

            <a href="gallery-index.html" class="portal-card">
              <div class="portal-icon"><i class="ri-camera-lens-line"></i></div>
              <div class="portal-info">
                <h3>Photography</h3>
                <p>Visual stories and high-res photo galleries.</p>
              </div>
              <i class="ri-arrow-right-line portal-arrow"></i>
            </a>

            <a href="audio-index.html" class="portal-card">
              <div class="portal-icon"><i class="ri-mic-2-line"></i></div>
              <div class="portal-info">
                <h3>Audio & Podcasts</h3>
                <p>Spoken word, interviews, and sonic sketches.</p>
              </div>
              <i class="ri-arrow-right-line portal-arrow"></i>
            </a>

            <a href="videos-index.html" class="portal-card">
              <div class="portal-icon"><i class="ri-film-line"></i></div>
              <div class="portal-info">
                <h3>Short Films</h3>
                <p>Cinematic captures and video essays.</p>
              </div>
              <i class="ri-arrow-right-line portal-arrow"></i>
            </a>
          </section>

          <section class="recent-activity">
            <h3 class="section-heading">
              <i class="ri-history-line"></i> Latest Additions
            </h3>

            <ul class="activity-list">
              <li class="activity-item">
                <div class="activity-meta">
                  <span class="badge badge-text"
                    ><i class="ri-quill-pen-fill"></i> Essay</span
                  >
                  <time>[Date]</time>
                </div>
                <a href="post-text.html" class="activity-title"
                  >[Title] </a
                >
              </li>

              <li class="activity-item">
                <div class="activity-meta">
                  <span class="badge badge-photo"
                    ><i class="ri-camera-lens-fill"></i> Photo</span
                  >
                  <time>[Date]</time>
                </div>
                <a href="post-photo.html" class="activity-title"
                  >[Title]</a
                >
              </li>

              <li class="activity-item">
                <div class="activity-meta">
                  <span class="badge badge-audio"
                    ><i class="ri-mic-2-fill"></i> Audio</span
                  >
                  <time>[Date] </time>
                </div>
                <a href="post-audio.html" class="activity-title"
                  >[Title] </a
                >
              </li>
            </ul>
          </section>
        </main>
      </div>

      <footer class="site-footer">
        <p>&copy; 2026 Heavenly Ghost Writer. Built forever with native HTML & CSS.</p>
      </footer>
    </div>
  </body>
</html>
