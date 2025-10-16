<?php
include '../admin/lib/drama_lib.php';
$dramaObj = new Drama();

// Define the category slugs in the order you want
$orderedSlugs = [
    'chinese-drama',
    'korean-drama',
    'khmer-drama',
    'thai-drama'
];

// Fetch categories
$categoriesRaw = $dramaObj->db->query("SELECT id, name, slug FROM categories")->fetchAll(PDO::FETCH_ASSOC);

// Reorder according to $orderedSlugs
$categories = [];
foreach ($orderedSlugs as $slug) {
    foreach ($categoriesRaw as $cat) {
        if ($cat['slug'] === $slug) {
            $categories[] = $cat;
            break;
        }
    }
}

// Default category and page
$categorySlug = $_GET['cat'] ?? 'all';
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 9;
$offset = ($page - 1) * $limit;

// Fetch dramas
if ($categorySlug === 'all') {
    // Only count dramas where status = 0
    $total = $dramaObj->db->query("SELECT COUNT(*) FROM dramas WHERE status = 0")->fetchColumn();

    $stmt = $dramaObj->db->prepare("
        SELECT * FROM dramas 
        WHERE status = 0 
        ORDER BY created_at DESC 
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    $dramas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Fetch category-specific dramas (only active ones)
    $stmt = $dramaObj->db->prepare("
        SELECT d.* FROM dramas d 
        INNER JOIN categories c ON d.category_id = c.id 
        WHERE c.slug = :slug AND d.status = 0
        ORDER BY d.created_at DESC 
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':slug', $categorySlug, PDO::PARAM_STR);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    $dramas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count only active dramas in that category
    $countStmt = $dramaObj->db->prepare("
        SELECT COUNT(*) FROM dramas d 
        INNER JOIN categories c ON d.category_id = c.id 
        WHERE c.slug = :slug AND d.status = 0
    ");
    $countStmt->bindValue(':slug', $categorySlug, PDO::PARAM_STR);
    $countStmt->execute();
    $total = $countStmt->fetchColumn();
}

// Total pages
$totalPages = ceil($total / $limit);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="1WdVsgK6zvbUzlnduZ_ajBdnKxk3fWDHW-HlV-JPE3g" />
    <title>Asian Drama Dubbed in Khmer | Chinese, Korean, Thai & Khmer Series </title>

    <meta name="description" content="Watch the best Asian dramas dubbed in Khmer — including Chinese, Korean, Thai, and Khmer dramas. Enjoy full episodes with Khmer voice dub and daily updates.">
    <meta name="keywords" content="china drama speak khmer, Khmer drama, Asian drama, Chinese drama dubbed Khmer, Korean drama dubbed Khmer, Thai drama dubbed Khmer, Khmer series, Khmer voice dub, Cambodia drama site">

    <meta name="author" content="Drama Dubbed Khmer">
    <meta name="robots" content="index, follow">

    <!-- Open Graph (Facebook, Telegram, etc.) -->
    <meta property="og:title" content="Khmer Drama - Asian Drama Dubbed in Khmer">
    <meta property="og:description" content="Watch Chinese, Korean, Thai, and Khmer dramas dubbed in Khmer language. Updated daily with HD episodes.">
    <meta property="og:image" content="https://khmer-drama.org/images/logo.png">
    <meta property="og:url" content="https://khmer-drama.org/pages/drama">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Khmer Drama - Asian Drama Dubbed in Khmer">
    <meta name="twitter:description" content="Watch your favorite Asian dramas dubbed in Khmer — Chinese, Korean, Thai & more.">
    <meta name="twitter:image" content="https://khmer-drama.org/images/khmer-drama-cover.jpg">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://khmer-drama.org/pages/drama">
    <link rel="stylesheet" href="../src/output.css">
 
    <!-- Favicon -->
    <link rel="icon" href="../images/logo.png" type="image/png">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2DNHSGCJ65"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-2DNHSGCJ65');
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WZ349ZZZ');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Schema Markup (SEO JSON-LD) -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "hmer Drama - Asian Drama Dubbed in Khmer",
            "url": "https://khmer-drama.org/pages/drama",
            "description": "Watch Asian dramas dubbed in Khmer: Chinese, Korean, Thai & Khmer dramas with HD episodes and Khmer voice.",
            "publisher": {
                "@type": "Organization",
                "name": "Drama Dubbed Khmer",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://khmer-drama.org/images/logo.png"
                }
            }
        }
    </script>
</head>

<body class="bg-gray-900 text-white">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZ349ZZZ"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
    include 'navbar.php'
    ?>
    <main class="max-w-5xl mx-auto px-4 py-5 pt-28">

        <!-- Category Filter Tabs -->
        <div id="category-tabs" class="flex overflow-x-auto space-x-3 mb-6 pb-2 scrollbar-hide">
            <a href="?cat=all"
                class="filter-btn px-4 py-2 rounded-full text-sm whitespace-nowrap <?= $categorySlug === 'all' ? 'bg-green-600 text-white' : 'bg-indigo-500 text-white hover:bg-indigo-800' ?>">All</a>
            <?php foreach ($categories as $cat): ?>
                <a href="?cat=<?= htmlspecialchars($cat['slug']) ?>"
                    class="filter-btn px-4 py-2 rounded-full text-sm whitespace-nowrap <?= $categorySlug === $cat['slug'] ? 'bg-green-600 text-white' : 'bg-indigo-500 text-white hover:bg-indigo-800' ?>">
                    <?= htmlspecialchars($cat['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>


        <!-- Dramas Grid -->
        <div id="drama-grid" class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <?php if (empty($dramas)): ?>
                <div class="col-span-full text-center text-white py-6">No dramas found.</div>
            <?php else: ?>
                <?php foreach ($dramas as $drama): ?>
                    <div class="drama-card bg-gray-700 rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                        <a href="/pages/view-drama?title=<?= htmlspecialchars($drama['slug']) ?>">
                            <img src="/<?= htmlspecialchars($drama['featured_img'] ?? 'no-image.jpg') ?>"
                                alt="<?= htmlspecialchars($drama['title']) ?>" class="w-full h-48">
                            <div class="p-3">
                                <h3 class=" font-semibold text-white"><?= htmlspecialchars($drama['title']) ?></h3>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div class="flex flex-wrap justify-center items-center mt-8 sm:text-base gap-2">
                <!-- Prev Button -->
                <?php if ($page > 1): ?>
                    <a href="?cat=<?= htmlspecialchars($categorySlug) ?>&page=<?= $page - 1 ?>"
                        class="lg:px-3 lg:py-1 px-4 py-2 bg-green-600 text-white rounded hover:bg-indigo-500">
                        « Prev
                    </a>
                <?php endif; ?>

                <?php
                $visibleRange = 2; // show this many pages around current
                $ellipsisShownLeft = false;
                $ellipsisShownRight = false;

                for ($i = 1; $i <= $totalPages; $i++):
                    // Always show first, last, and nearby pages
                    if (
                        $i == 1 ||
                        $i == $totalPages ||
                        ($i >= $page - $visibleRange && $i <= $page + $visibleRange)
                    ):
                ?>
                        <a href="?cat=<?= htmlspecialchars($categorySlug) ?>&page=<?= $i ?>"
                            class="lg:px-3 lg:py-1 px-4 py-2 rounded <?= $i == $page ? 'bg-indigo-500 text-white' : 'bg-green-600 text-white hover:bg-indigo-500' ?>">
                            <?= $i ?>
                        </a>
                <?php
                    // Add ellipsis before skipped pages (left)
                    elseif ($i < $page && !$ellipsisShownLeft):
                        echo '<span class="px-2 text-gray-500">...</span>';
                        $ellipsisShownLeft = true;

                    // Add ellipsis after skipped pages (right)
                    elseif ($i > $page && !$ellipsisShownRight):
                        echo '<span class="px-2 text-gray-500">...</span>';
                        $ellipsisShownRight = true;
                    endif;
                endfor;
                ?>

                <!-- Next Button -->
                <?php if ($page < $totalPages): ?>
                    <a href="?cat=<?= htmlspecialchars($categorySlug) ?>&page=<?= $page + 1 ?>"
                        class="lg:px-3 lg:py-1 px-4 py-2 bg-green-600 text-white rounded hover:bg-indigo-500">
                        Next »
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>


    </main>
    <?php
    include 'footer.php'
    ?>
    <script>
        const tabs = document.getElementById('category-tabs');
        const savedScroll = localStorage.getItem('tabsScroll');
        if (savedScroll) {
            tabs.scrollLeft = savedScroll;
        }
        tabs.addEventListener('scroll', () => {
            localStorage.setItem('tabsScroll', tabs.scrollLeft);
        });
        window.addEventListener('beforeunload', () => {
            localStorage.setItem('tabsScroll', tabs.scrollLeft);
        });
    </script>
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</body>

</html>