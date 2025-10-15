<?php
include './admin/lib/drama_lib.php';
$dramaObj = new Drama();

$slug = $_GET['slug'] ?? 'all';

// Only allowed slugs
$allowedSlugs = ['chinese-drama', 'korean-drama', 'khmer-drama', 'thai-drama'];

if ($slug === 'all') {
    $dramas = $dramaObj->getAll();
} elseif (in_array($slug, $allowedSlugs)) {
    $dramas = $dramaObj->getByCategorySlug($slug);
} else {
    $dramas = [];
}

if (!$dramas) {
    echo "<div class='col-span-full text-center text-gray-500 py-6'>No dramas found.</div>";
    exit;
}

foreach ($dramas as $drama): ?>
    <div class="drama-card bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <a href="/drama/<?= htmlspecialchars($drama['slug']) ?>">
            <img src="/<?= htmlspecialchars($drama['featured_img'] ?? 'no-image.jpg') ?>"
                alt="<?= htmlspecialchars($drama['title']) ?>" class="w-full h-44 object-cover">
            <div class="p-3">
                <h3 class="text-base font-semibold text-gray-800 truncate"><?= htmlspecialchars($drama['title']) ?></h3>
            </div>
        </a>
    </div>
<?php endforeach; ?>