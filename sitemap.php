<?php
ob_start();
header('Content-Type: application/xml; charset=utf-8');

// Base URL
$baseUrl = "https://khmer-drama.org";

// Include your database and drama class
require_once __DIR__ . '/admin/lib/db.php';
require_once __DIR__ . '/admin/lib/drama_lib.php';

$dramaObj = new Drama();
$dramas = [];
try {
    $dramas = $dramaObj->getAll();
} catch (Exception $e) {
    $dramas = [];
}

// Static pages
$pages = [
    ['slug' => '', 'priority' => 1.0],
    ['slug' => '/pages/drama', 'priority' => 1.0],
    ['slug' => '/pages/about-us', 'priority' => 0.8],
    ['slug' => '/pages/privacy-policy', 'priority' => 0.8],
    ['slug' => '/pages/contact', 'priority' => 0.8],
];

ob_end_clean();

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php
    $today = date('Y-m-d');

    // Add static pages
    foreach ($pages as $page):
    ?>
        <url>
            <loc><?= htmlspecialchars(rtrim($baseUrl, '/') . '/' . ltrim($page['slug'], '/')) ?></loc>
            <lastmod><?= $today ?></lastmod>
            <changefreq>weekly</changefreq>
            <priority><?= $page['priority'] ?></priority>
        </url>
    <?php endforeach; ?>

    <?php
    // Add dramas
    foreach ($dramas as $drama):
        $slug = urlencode($drama['slug'] ?? $drama['title'] ?? '');
        $lastmod = !empty($drama['updated_at']) ? date('Y-m-d', strtotime($drama['updated_at'])) : $today;
    ?>
        <url>
            <loc><?= htmlspecialchars("$baseUrl/pages/view-drama?title=$slug") ?></loc>
            <lastmod><?= $lastmod ?></lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    <?php endforeach; ?>
</urlset>
<?php ob_end_flush(); ?>