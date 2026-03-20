<?php 
// 1. Set your SEO variables for this specific page
$pageTitle = "Written Essays | Heavenly Ghost Writer";
$pageDesc = "Long-form thoughts, tutorials, and philosophical explorations. No pop-ups, no paywalls, just text.";

// 2. Load the Header and Sidebar
include 'includes/header.php'; 
?>

<main class="main-content">
    
    <header class="page-header">
        <h2>Written Essays</h2>
        <p>Long-form thoughts, tutorials, and philosophical explorations. No pop-ups, no paywalls, just text.</p>
    </header>

    <article class="post-card featured-post">
        <span class="badge badge-text" style="display: inline-flex; margin-bottom: 1rem;">
            <i class="ri-star-fill"></i> Latest
        </span>
        <h2 class="post-title">
            <a href="post-text.php">[Title of Your Best Recent Essay Here]</a>
        </h2>
        <p class="post-meta">
            <i class="ri-calendar-line"></i> [Month DD, YYYY] &bull;
            <i class="ri-time-line"></i> [X] min read
        </p>
        <p class="post-excerpt" style="font-size: 1.15rem">
            [Provide a compelling 2-3 sentence hook. Why should the reader invest 5 minutes of their life reading this essay? What is the core argument?]
        </p>
        <a href="post-text.php" class="read-more">Read Essay <i class="ri-arrow-right-line"></i></a>
    </article>
    <hr class="section-divider" />

    <div class="archive-list">
        
        <article class="post-card compact-card">
            <h2 class="post-title"><a href="post-text.php">[Older Essay Title Here]</a></h2>
            <p class="post-meta">
                <i class="ri-calendar-line"></i> [Month DD, YYYY] &bull;
                <i class="ri-folder-2-line"></i> [Category Name]
            </p>
            <p class="post-excerpt">
                [A short, one-sentence summary of this older post. Keep it punchy.]
            </p>
            <a href="post-text.php" class="read-more">Read <i class="ri-arrow-right-line"></i></a>
        </article>
        <article class="post-card compact-card">
            <h2 class="post-title"><a href="post-text.php">[Another Essay Title]</a></h2>
            <p class="post-meta">
                <i class="ri-calendar-line"></i> [Month DD, YYYY] &bull;
                <i class="ri-folder-2-line"></i> [Category Name]
            </p>
            <p class="post-excerpt">
                [Short description for the second placeholder essay goes here.]
            </p>
            <a href="post-text.php" class="read-more">Read <i class="ri-arrow-right-line"></i></a>
        </article>

        <article class="post-card compact-card">
            <h2 class="post-title"><a href="post-text.php">[Third Essay Title]</a></h2>
            <p class="post-meta">
                <i class="ri-calendar-line"></i> [Month DD, YYYY] &bull;
                <i class="ri-folder-2-line"></i> [Category Name]
            </p>
            <p class="post-excerpt">
                [Short description for the third placeholder essay goes here.]
            </p>
            <a href="post-text.php" class="read-more">Read <i class="ri-arrow-right-line"></i></a>
        </article>

    </div>

    <nav class="pagination" aria-label="Pagination">
        <a href="#" class="page-link disabled"><i class="ri-arrow-left-s-line"></i> Newer</a>
        <div class="page-numbers">
            <a href="blog-index.php" class="page-num active">1</a>
            </div>
        <a href="blog-index-page2.php" class="page-link">Older <i class="ri-arrow-right-s-line"></i></a>
    </nav>

</main>
<?php 
// 4. Load the Footer (Closes wrappers and adds HTML footer)
include 'includes/footer.php'; 
?>