<?php
include '../lib/drama_lib.php';
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
    $total = $dramaObj->db->query("SELECT COUNT(*) FROM dramas")->fetchColumn();
    $stmt = $dramaObj->db->prepare("SELECT * FROM dramas ORDER BY id ASC LIMIT $limit OFFSET $offset");
    $stmt->execute();
    $dramas = $stmt->fetchAll();
} else {
    $stmt = $dramaObj->db->prepare("
        SELECT d.* FROM dramas d 
        INNER JOIN categories c ON d.category_id = c.id 
        WHERE c.slug = ? 
        ORDER BY d.id ASC LIMIT $limit OFFSET $offset
    ");
    $stmt->execute([$categorySlug]);
    $dramas = $stmt->fetchAll();

    $countStmt = $dramaObj->db->prepare("
        SELECT COUNT(*) FROM dramas d 
        INNER JOIN categories c ON d.category_id = c.id 
        WHERE c.slug = ?
    ");
    $countStmt->execute([$categorySlug]);
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
    <title>All Drama</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">🎭All</h1>

        <!-- Category Filter Tabs -->
        <div id="category-tabs" class="flex overflow-x-auto space-x-3 mb-6 pb-2 scrollbar-hide">
            <a href="?cat=all"
                class="filter-btn px-4 py-2 rounded-full text-sm whitespace-nowrap <?= $categorySlug === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-blue-100' ?>">All</a>
            <?php foreach ($categories as $cat): ?>
                <a href="?cat=<?= htmlspecialchars($cat['slug']) ?>"
                    class="filter-btn px-4 py-2 rounded-full text-sm whitespace-nowrap <?= $categorySlug === $cat['slug'] ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-blue-100' ?>">
                    <?= htmlspecialchars($cat['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>


        <!-- Dramas Grid -->
        <div id="drama-grid" class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <?php if (empty($dramas)): ?>
                <div class="col-span-full text-center text-gray-500 py-6">No dramas found.</div>
            <?php else: ?>
                <?php foreach ($dramas as $drama): ?>
                    <div class="drama-card bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                        <a href="/pages/view-drama?title=<?= htmlspecialchars($drama['slug']) ?>">
                            <img src="/<?= htmlspecialchars($drama['featured_img'] ?? 'no-image.jpg') ?>"
                                alt="<?= htmlspecialchars($drama['title']) ?>" class="w-full h-44 object-cover">
                            <div class="p-3">
                                <h3 class="text-base font-semibold text-gray-800 truncate"><?= htmlspecialchars($drama['title']) ?></h3>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div class="flex justify-center items-center mt-8 space-x-2">
                <?php if ($page > 1): ?>
                    <a href="?cat=<?= htmlspecialchars($categorySlug) ?>&page=<?= $page - 1 ?>"
                        class="px-3 py-2 bg-gray-200 text-gray-700 rounded hover:bg-blue-100">« Prev</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?cat=<?= htmlspecialchars($categorySlug) ?>&page=<?= $i ?>"
                        class="px-3 py-2 rounded <?= $i == $page ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-blue-100' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?cat=<?= htmlspecialchars($categorySlug) ?>&page=<?= $page + 1 ?>"
                        class="px-3 py-2 bg-gray-200 text-gray-700 rounded hover:bg-blue-100">Next »</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
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