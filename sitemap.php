<?php
header("Content-Type: application/xml; charset=UTF-8");

$staticPages = [
    [
        'loc' => 'https://khmer-drama.org',
        'changefreq' => 'weekly',
        'priority' => '1.0'
    ],
    [
        'loc' => 'https://khmer-drama.org/pages/about-us',
        'changefreq' => 'weekly',
        'priority' => '1.0'
    ],
    [
        'loc' => 'https://khmer-drama.org/pages/contact-us',
        'changefreq' => 'weekly',
        'priority' => '1.0'
    ],
    [
        'loc' => 'https://khmer-drama.org/assets/icons/favicon-96x96.png',
        'changefreq' => 'weekly',
        'priority' => '1'
    ],
    [
        'loc' => 'https://khmer-drama.org/assets/icons/favicon.svg',
        'changefreq' => 'weekly',
        'priority' => '1'
    ],
    [
        'loc' => 'https://khmer-drama.org/assets/icons/favicon.ico',
        'changefreq' => 'weekly',
        'priority' => '1'
    ],
    [
        'loc' => 'https://khmer-drama.org/assets/icons/apple-touch-icon.png',
        'changefreq' => 'weekly',
        'priority' => '1'
    ],
    [
    
        'loc' => 'https://khmer-drama.org/pages/privacy-policy',
        'changefreq' => 'weekly',
        'priority' => '0.8'
    ],
   
];

$games = [
    [
        'loc' => 'https://khmer-drama.org/pages/view-drama?title=mream-5-achariyeak'
    ],
    [
        'loc' => 'https://khmer-drama.org/pages/view-drama?title=nisai-snae-moyura'
    ],
    [
        'loc' => 'https://khmer-drama.org/pages/view-drama?title=sdach-mode'
    ],
    [
        'loc' => 'https://khmer-drama.org/pages/view-drama?title=nak-krob-krerng-jork-veasna'
    ],
    [
        'loc' => 'https://khmer-drama.org/pages/view-drama?title=tlak-knong-anlong-snae-oun'
    ],
    [
        'loc' => 'https://khmer-drama.org/pages/view-drama?title=apea-pipea-knong-plerng-kumnum'
    ],
];

// Merge all pages
$allPages = array_merge($staticPages, $games);
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($allPages as $page): ?>
        <url>
            <loc><?= htmlspecialchars($page['loc']) ?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
            <changefreq><?= $page['changefreq'] ?? 'weekly' ?></changefreq>
            <priority><?= $page['priority'] ?? '0.8' ?></priority>
        </url>
    <?php endforeach; ?>
</urlset>