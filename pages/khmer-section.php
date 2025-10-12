<?php
include_once './lib/drama_lib.php';
$dramaObj = new Drama();

// Fetch latest 9 dramas in the "china-drama" category
$chinaDramas = $dramaObj->getByCategorySlug('khmer-drama');
$chinaDramas = array_slice($chinaDramas, 0, 9);
?>

<section class="w-full bg-gray-100 py-6">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex justify-between item-center mb-3 text-white">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                Section 2
            </h2>
            <a href="http://drama:8080/pages/drama?cat=khmer-drama" class="px-2 py-1 bg-green-600 rounded text-sm">
                See All
            </a>
        </div>

        <!-- Mobile/Tablet Scrollable Section -->
        <div class="flex md:hidden space-x-3 overflow-x-auto scrollbar-hide pb-3">
            <?php foreach ($chinaDramas as $drama): ?>
                <div class="flex-none w-[150px] bg-white rounded-lg shadow hover:shadow-lg transition p-2">
                    <a href="/pages/view-drama?title=<?= htmlspecialchars($drama['slug']) ?>">
                        <img src="/<?= htmlspecialchars($drama['featured_img'] ?? 'no-image.jpg') ?>"
                            alt="<?= htmlspecialchars($drama['title']) ?>"
                            class="w-full h-40 object-cover rounded-lg mb-2">
                        <h3 class="text-sm font-semibold truncate text-gray-800">
                            <?= htmlspecialchars($drama['title']) ?>
                        </h3>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Desktop Grid -->
        <div class="hidden md:grid grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($chinaDramas as $drama): ?>
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-2">
                    <a href="/pages/view-drama?title=<?= htmlspecialchars($drama['slug']) ?>">
                        <img src="/<?= htmlspecialchars($drama['featured_img'] ?? 'no-image.jpg') ?>"
                            alt="<?= htmlspecialchars($drama['title']) ?>"
                            class="w-full h-48 object-cover rounded-lg mb-2">
                        <h3 class="text-base font-semibold truncate text-gray-800">
                            <?= htmlspecialchars($drama['title']) ?>
                        </h3>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Hide scrollbar for mobile -->
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>