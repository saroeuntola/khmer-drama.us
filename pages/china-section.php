<?php
include_once './admin/lib/drama_lib.php';
$dramaObj = new Drama();

// Fetch latest 9 dramas in the "china-drama" category
$chinaDramas = $dramaObj->getByCategorySlug('chinese-drama');
$chinaDramas = array_slice($chinaDramas, 0, 9);
?>
<section class="w-full main text-white">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex items-center gap-2 sm:gap-3 mb-4 text-white">

            <!-- Accent Line -->
            <div class="w-1 h-6 sm:h-7 bg-gradient-to-b from-purple-400 to-indigo-600 rounded-full shrink-0"></div>

            <!-- SEO-friendly Section Heading -->
            <h2 class="text-lg sm:text-xl lg:text-2xl font-bold leading-tight tracking-tight whitespace-nowrap">
                China Drama
            </h2>

            <!-- Divider -->
            <div class="flex-1 h-px bg-gradient-to-r from-indigo-500/60 to-transparent"></div>

            <!-- See All -->
            <a href="/pages/drama?cat=korean-drama"
                class="group inline-flex items-center gap-1 text-xs sm:text-sm font-medium text-gray-300 hover:text-purple-400 transition-colors duration-200 whitespace-nowrap">
                See All
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 transition-transform duration-200 group-hover:translate-x-1"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                </svg>
            </a>

        </div>


        <!-- Mobile/Tablet Scrollable Section -->
        <div class="flex md:hidden space-x-3 overflow-x-auto scrollbar-hide pb-3">
            <?php foreach ($chinaDramas as $drama): ?>
            <div class="flex-none w-[150px] bg-gray-700 rounded-lg shadow hover:shadow-lg transition">
                <a href="/pages/view-drama?title=<?= htmlspecialchars($drama['slug']) ?>">
                    <img src="/<?= htmlspecialchars($drama['featured_img'] ?? 'no-image.jpg') ?>"
                        alt="<?= htmlspecialchars($drama['title']) ?>" class="w-full h-40 rounded-lg" loading="lazy">
                    <h3 class="text-sm font-semibold text-white p-2">
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
                        alt="<?= htmlspecialchars($drama['title']) ?>" class="w-full h-48 rounded-lg" loading="lazy">
                    <h3 class=" font-semibold text-white p-2">
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