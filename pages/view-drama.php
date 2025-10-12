<?php
// view-drama.php
include '../lib/drama_lib.php';
$dramaObj = new Drama();

$slug = $_GET['title'] ?? '';
$drama = null;
$episodes = [];
$relatedDramas = [];
$perPage = 6; // items per page
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

if ($slug) {
    $drama = $dramaObj->getBySlug($slug);
    if ($drama) {
        $episodes = $dramaObj->getEpisodes($drama['id']);

        // Fetch related dramas (exclude current drama)
        $allRelated = $dramaObj->getRelated($drama['id']); // returns array of dramas
        $totalItems = count($allRelated);
        $totalPages = ceil($totalItems / $perPage);

        $offset = ($page - 1) * $perPage;
        $relatedDramas = array_slice($allRelated, $offset, $perPage);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($drama['name'] ?? 'Drama') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white p-4">
<div>

</div>
    <!-- Main Video Player -->
    <?php if ($drama): ?>
        <div class="aspect-video w-full max-w-3xl mx-auto mb-4">
            <iframe
                id="main-player"
                src="<?= htmlspecialchars($episodes[0]['video_url']) ?>"
                frameborder="0"
                allowfullscreen
                class="w-full h-full rounded-lg">
            </iframe>
        </div>

        <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($drama['title']) ?></h1>
        <?php if (!empty($drama['image'])): ?>
            <img src="/admin/page/post/<?= htmlspecialchars($drama['featured_img']) ?>" alt="<?= htmlspecialchars($drama['title']) ?>" class="w-full max-w-md mb-4 rounded-lg">
        <?php endif; ?>

        <?php if (!empty($episodes)): ?>
            <!-- Episode Buttons -->
            <div class="flex flex-wrap gap-2 mb-4 bg-gray-700 p-4 rounded">
                <?php foreach ($episodes as $index => $ep): ?>
                    <button
                        class="ep-btn bg-green-600 hover:bg-green-800 px-3 py-2 rounded text-sm font-semibold"
                        data-video="<?= htmlspecialchars($ep['video_url']) ?>"
                        <?= $index === 0 ? 'id="active-ep"' : '' ?>>
                        EP <?= htmlspecialchars($ep['ep_number']) ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <script>
                const buttons = document.querySelectorAll('.ep-btn');
                const player = document.getElementById('main-player');

                buttons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        player.src = btn.dataset.video;
                        document.querySelectorAll('.ep-btn').forEach(b => b.classList.remove('bg-blue-800'));
                        btn.classList.add('bg-blue-800');
                    });
                });
            </script>
        <?php endif; ?>
    <?php else: ?>
        <p class="text-red-500">Drama not found.</p>
    <?php endif; ?>



    <?php if ($drama): ?>
        <!-- Related Dramas -->
        <h2 class="text-2xl font-bold mb-4">Related Dramas</h2>
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
            <?php foreach ($relatedDramas as $rDrama): ?>
                <a href="/pages/view-drama?title=<?= htmlspecialchars($rDrama['slug']) ?>" class="block bg-gray-700 rounded-lg overflow-hidden hover:bg-gray-600 transition">
                    <?php if (!empty($rDrama['featured_img'])): ?>
                        <img src="/images<?= htmlspecialchars($rDrama['featured_img']) ?>" alt="<?= htmlspecialchars($rDrama['title']) ?>" class="w-full h-40 object-cover">
                    <?php endif; ?>
                    <div class="p-2">
                        <h3 class="text-white font-semibold text-sm line-clamp-2"><?= htmlspecialchars($rDrama['title']) ?></h3>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div class="flex justify-center gap-2 mb-6">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?title=<?= urlencode($slug) ?>&page=<?= $i ?>" class="px-3 py-1 rounded <?= $i === $page ? 'bg-blue-600' : 'bg-gray-700 hover:bg-gray-600' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>

</body>

</html>