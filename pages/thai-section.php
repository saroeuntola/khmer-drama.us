<?php
include_once './admin/lib/drama_lib.php';
$dramaObj = new Drama();

// Fetch latest 9 dramas in the "china-drama" category
$chinaDramas = $dramaObj->getByCategorySlug('thai-drama');
$chinaDramas = array_slice($chinaDramas, 0, 9);
?>

<section class="w-full py-6 text-white">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex justify-between item-center mb-3 text-white">
            <h2 class="text-xl lg:text-2xl font-bold text-white">
                Thai Drama
            </h2>
            <a href="/pages/drama?cat=thai-drama" class="px-2 lg:px-4 py-1 lg:py-2 bg-indigo-500 rounded text-sm">
                See All
            </a>
        </div>

        <?php if (!empty($chinaDramas)): ?>
            <!-- Mobile/Tablet Scrollable Section -->
            <div class="flex md:hidden space-x-3 overflow-x-auto scrollbar-hide pb-3">
                <?php foreach ($chinaDramas as $drama): ?>
                    <div class="flex-none w-[150px] bg-gray-700 rounded-lg shadow hover:shadow-lg transition">
                        <a href="/pages/view-drama?title=<?= htmlspecialchars($drama['slug']) ?>">
                            <img src="/<?= htmlspecialchars($drama['featured_img'] ?? 'no-image.jpg') ?>"
                                alt="<?= htmlspecialchars($drama['title']) ?>"
                                class="w-full h-40 rounded-lg">
                            <h3 class="text-sm font-semibold p-2 text-white">
                                <?= htmlspecialchars($drama['title']) ?>
                            </h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Desktop Grid -->
            <div class="hidden md:grid grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($chinaDramas as $drama): ?>
                    <div class="bg-gray-700 rounded-lg shadow hover:shadow-lg transition">
                        <a href="/pages/view-drama?title=<?= htmlspecialchars($drama['slug']) ?>">
                            <img src="/<?= htmlspecialchars($drama['featured_img'] ?? 'no-image.jpg') ?>"
                                alt="<?= htmlspecialchars($drama['title']) ?>"
                                class="w-full h-48 rounded-lg">
                            <h3 class="font-semibold text-white p-2">
                                <?= htmlspecialchars($drama['title']) ?>
                            </h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center text-gray-500 py-6">
                No dramas found.
            </div>
        <?php endif; ?>
    </div>
</section>