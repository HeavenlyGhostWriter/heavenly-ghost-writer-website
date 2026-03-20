<?php
// Set fallbacks just in case a page forgets to declare its own SEO variables
$seoTitle = isset($pageTitle) ? $pageTitle : "Heavenly Ghost Writer | The Timeless Web";
$seoDesc = isset($pageDesc) ? $pageDesc : "A timeless, resilient personal archive of essays, photography, and audio built with pure HTML and CSS.";

// Dynamically grab the current URL for canonical and sharing tags
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'heavenlyghostwriter.xyz';
$seoUrl = $protocol . "://" . $domain . $_SERVER['REQUEST_URI'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title><?php echo $seoTitle; ?></title>

    <meta name="description" content="<?php echo $seoDesc; ?>" />
    <meta name="author" content="Mr. Heavenly Ghost Writer" />
    <meta name="robots" content="index, follow, max-image-preview:large" />
    <link rel="canonical" href="<?php echo $seoUrl; ?>" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo $seoUrl; ?>" />
    <meta property="og:title" content="<?php echo $seoTitle; ?>" />
    <meta property="og:description" content="<?php echo $seoDesc; ?>" />
    <meta property="og:image" content="https://your-domain.com/assets/images/og-image.jpg" />
    <meta property="og:site_name" content="Heavenly Ghost Writer" />
    <meta property="og:locale" content="en_PH" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:url" content="<?php echo $seoUrl; ?>" />
    <meta name="twitter:title" content="<?php echo $seoTitle; ?>" />
    <meta name="twitter:description" content="<?php echo $seoDesc; ?>" />
    <meta name="twitter:image" content="https://your-domain.com/assets/images/twitter-image.jpg" />

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/main.css" />
</head>
<body>
    <input type="checkbox" id="mobile-menu-toggle" class="toggle-checkbox" aria-hidden="true" />

    <div class="site-wrapper">
        <header class="site-header">
            <div class="header-content">
                <h1 class="site-title">
                    <a href="/index.php"><i class="ri-compass-3-line"></i> Heavenly Ghost Writer</a>
                </h1>
                <label for="mobile-menu-toggle" class="toggle-label" aria-label="Toggle menu">
                    <i class="ri-menu-4-line"></i>
                </label>
            </div>
        </header>

        <div class="layout-container">
            
            <aside class="sidebar">
                <label for="mobile-menu-toggle" class="close-sidebar" aria-label="Close menu">
                    <i class="ri-close-line"></i>
                </label>

                <div class="sidebar-profile">
                    <i class="ri-user-smile-line profile-icon"></i>
                    <h2>Welcome</h2>
                    <p>I am Mr. Heavenly Ghost Writer, finding and creating my way to live an above-average life.</p>
                </div>

                <nav class="sidebar-nav">
                    <h2><i class="ri-dashboard-line"></i> Hub</h2>
                    <ul>
                        <li><a href="/index.php" class="active"><i class="ri-layout-grid-line"></i> Dashboard</a></li>
                        <li><a href="/about.php"><i class="ri-information-line"></i> About</a></li>
                    </ul>
                </nav>

                <nav class="sidebar-nav">
                    <h2><i class="ri-price-tag-3-line"></i> Explore</h2>
                    <ul>
                        <li><a href="/blog-index.php"><i class="ri-quill-pen-line"></i> Written Essays</a></li>
                        <li><a href="/stories.php"><i class="ri-book-3-line"></i> Fiction Library</a></li>
                        <li><a href="/gallery-index.php"><i class="ri-camera-lens-line"></i> Photography</a></li>
                        <li><a href="/audio-index.php"><i class="ri-mic-2-line"></i> Audio & Podcasts</a></li>
                        <li><a href="/videos-index.php"><i class="ri-film-line"></i> Short Films</a></li>
                    </ul>
                </nav>

                <nav class="sidebar-nav">
                    <h2><i class="ri-folder-open-line"></i> Docs & Archives</h2>
                    <ul>
                        <li><a href="/archives.php"><i class="ri-archive-drawer-fill"></i> File Repository</a></li>
                    </ul>
                </nav>

                <nav class="sidebar-nav">
                    <h2><i class="ri-history-line"></i> Updates</h2>
                    <ul>
                        <li><a href="/updates.php"><i class="ri-article-line"></i> Site Log</a></li>
                    </ul>
                </nav>

                <nav class="sidebar-nav">
                    <h2><i class="ri-shield-check-line"></i> Legal & Policies</h2>
                    <ul>
                        <li><a href="/pages/site-policy/terms.php"><i class="ri-article-line"></i> Terms & Conditions</a></li>
                        <li><a href="/pages/site-policy/privacy-policy.php"><i class="ri-shield-keyhole-line"></i> Privacy Policy</a></li>
                        <li><a href="/pages/site-policy/disclaimer.php"><i class="ri-error-warning-line"></i> Disclaimer</a></li>
                        <li><a href="/pages/site-policy/cookie-policy.php"><i class="ri-check-double-line"></i> Cookie Policy</a></li>
                    </ul>
                </nav>
            </aside>