<?php
// view-drama.php
include '../admin/lib/drama_lib.php';
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
    <meta name="google-site-verification" content="1WdVsgK6zvbUzlnduZ_ajBdnKxk3fWDHW-HlV-JPE3g" />
    <!-- Dynamic Title -->
    <title><?= htmlspecialchars($drama['title'] ?? 'Drama') ?> - Watch Full Episodes Dubbed in Khmer</title>

    <!-- Dynamic Meta Description -->
    <meta name="description" content="<?= htmlspecialchars($drama['title'] . ' Watch full episodes of Khmer and Asian dramas, including Chinese, Korean, Thai & Khmer series, dubbed in Khmer.') ?>">

    <!-- Keywords (optional, dynamic if needed) -->
    <meta name="keywords" content="Khmer drama, Asian drama, Chinese drama, Korean drama, Thai drama, dramas dubbed in Khmer">

    <!-- Author -->
    <meta name="author" content="Khmer Drama Team">

    <!-- Robots -->
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Social Sharing -->
    <meta property="og:title" content="<?= htmlspecialchars($drama['title'] ?? 'Drama') ?> - Watch Full Episodes Dubbed in Khmer">
    <meta property="og:description" content="<?= htmlspecialchars($drama['title'] . ' Watch full episodes of Khmer and Asian dramas, including Chinese, Korean, Thai & Khmer series, dubbed in Khmer.') ?>">
    <meta property="og:image" content="https://khmer-drama.org/<?= htmlspecialchars($drama['featured_img'] ?? 'https://yourdomain.com/images/default-drama.jpg') ?>">
    <meta property="og:url" content="<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
    <meta property="og:type" content="video.movie">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($drama['title'] ?? 'Drama') ?> - Watch Full Episodes Dubbed in Khmer">
    <meta name="twitter:description" content="<?= htmlspecialchars($drama['title'] . ' Watch full episodes of Khmer and Asian dramas, including Chinese, Korean, Thai & Khmer series, dubbed in Khmer.') ?>">
    <meta name="twitter:image" content="https://khmer-drama.org/<?= htmlspecialchars($drama['featured_img'] ?? 'https://yourdomain.com/images/default-drama.jpg') ?>">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">

    <!-- Favicon -->
    <link rel="icon" href="https://khmer-drama.org/<?= htmlspecialchars($drama['featured_img'] ?? 'https://khmer-drama.org/images/logo.png') ?>" type="image/png">

    <!-- TailwindCSS -->
    <link rel="stylesheet" href="../src/output.css">

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
    <!-- Schema Markup (JSON-LD for Video/Drama) -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "VideoObject",
            "name": "<?= htmlspecialchars($drama['title'] ?? 'Drama') ?>",
            "description": "<?= htmlspecialchars($drama['description'] ?? 'Watch full episodes of Khmer and Asian dramas dubbed in Khmer.') ?>",
            "thumbnailUrl": "https://khmer-drama.org/<?= htmlspecialchars($drama['featured_img'] ?? 'https://yourdomain.com/images/default-drama.jpg') ?>",
            "contentUrl": "<?= htmlspecialchars($drama['video_url'] ?? 'https://yourdomain.com/videos/default.mp4') ?>",
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
<style>
    /* Custom scrollbar for episode list */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        /* Scrollbar width */
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #1f2937;
        /* Tailwind gray-800 */
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #16b24dff;
        /* Tailwind blue-600 */
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: #16b24dff;
        /* Tailwind blue-500 */
    }

    /* For Firefox */
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #16b24dff #1f2937;
    }

    /* HTML: <div class="loader"></div> */
    .loader {
        width: 50px;
        aspect-ratio: 1;
        display: grid;
        -webkit-mask: conic-gradient(from 15deg, #0000, #000);
        animation: l26 1s infinite steps(12);
    }

    .loader,
    .loader:before,
    .loader:after {
        background:
            radial-gradient(closest-side at 50% 12.5%,
                #f03355 96%, #0000) 50% 0/20% 80% repeat-y,
            radial-gradient(closest-side at 12.5% 50%,
                #f03355 96%, #0000) 0 50%/80% 20% repeat-x;
    }

    .loader:before,
    .loader:after {
        content: "";
        grid-area: 1/1;
        transform: rotate(30deg);
    }

    .loader:after {
        transform: rotate(60deg);
    }

    @keyframes l26 {
        100% {
            transform: rotate(1turn)
        }
    }
</style>

<body class="bg-gray-900 text-white">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZ349ZZZ"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
    include './navbar.php'
    ?>
    <main class="w-full max-w-5xl mx-auto pt-20 px-3 pb-4">
        <!-- Main Title -->
        <h1 class="lg:text-3xl text-xl font-bold mb-4 mt-4 text-center lg:text-left">
            <?= htmlspecialchars($drama['title']) ?>
        </h1>

        <?php if ($drama): ?>
            <!-- Main Video Player -->
            <div class="aspect-video mb-4 relative">
                <?php if (!empty($episodes)): ?>
                    <!-- Loading Spinner -->
                    <div id="iframe-loader" class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-lg z-10">
                        <div class="loader"></div>
                    </div>

                    <!-- Video iframe -->
                    <iframe
                        id="main-player"
                        src="<?= htmlspecialchars($episodes[0]['video_url']) ?>"
                        frameborder="0"
                        allowfullscreen
                        class="w-full h-[250px] md:h-[420px] lg:h-[520px] rounded-lg shadow-lg">
                    </iframe>

                <?php else: ?>
                    <div class="flex items-center justify-center w-full h-[250px] md:h-[420px] lg:h-[520px] bg-gray-800 rounded-lg text-gray-400">
                        No episodes available for this drama.
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($episodes)): ?>
                <!-- Episode Buttons -->
                <div class="max-h-64 overflow-y-auto border-2 border-gray-800 rounded-lg p-3 mb-6 custom-scrollbar">
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($episodes as $index => $ep): ?>
                            <button
                                class="ep-btn px-3 py-2 rounded text-sm font-semibold transition-colors duration-200
                                   <?= $index === 0 ? 'bg-green-500 text-white' : 'bg-indigo-500 hover:bg-indigo-800 text-white' ?>"
                                data-video="<?= htmlspecialchars($ep['video_url']) ?>">
                                EP <?= htmlspecialchars($ep['ep_number']) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <p class="text-red-500">Drama not found.</p>
        <?php endif; ?>

        <!-- Note Section -->
        <section class="bg-gray-800 p-4 rounded-lg mb-8 shadow-md">
            <h2 class="text-xl font-semibold text-indigo-500 mb-2">Note</h2>
            <p class="text-gray-300 leading-relaxed">
                All videos are linked from external sources. We do not host or own any content on our servers.
                If you believe any material violates the law or your copyright, please contact us, and
                we will remove it promptly.
            </p>

        </section>
        <section class="bg-gray-800 p-4 rounded-lg mb-8 shadow-md">

            <div class="mt-3 text-gray-400 text-sm">
                <div class="mt-3 text-gray-400 text-sm">
                    <strong>Tags:</strong>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">Khmer Drama</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">China Drama</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">Korean Drama</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">Korean Movie</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">Khmer Movie</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">Thai Drama</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">Dubbed Drama</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">Asian Series</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">Watch Online</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">រឿងខ្មែរ</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">រឿងកូរ៉េនិយាយខ្មែរ</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">រឿងចិននិយាយខ្មែរ</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">រឿងថៃនិយាយខ្មែរ</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">រឿងភាគចិន</span>
                    <span class="inline-block bg-gray-700 text-gray-200 px-2 py-1 rounded mr-2 mt-1">រឿងភាគកូរ៉េ</span>
                </div>

            </div>
        </section>
        <?php if ($drama): ?>
            <!-- Related Dramas -->
            <h2 class="text-2xl font-bold mb-4">Related Dramas</h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                <?php foreach ($relatedDramas as $rDrama): ?>
                    <a href="/pages/view-drama?title=<?= htmlspecialchars($rDrama['slug']) ?>"
                        class="block bg-gray-700 rounded-lg overflow-hidden hover:bg-gray-600 transition">
                        <?php if (!empty($rDrama['featured_img'])): ?>
                            <img src="/<?= htmlspecialchars($rDrama['featured_img']) ?>"
                                alt="<?= htmlspecialchars($rDrama['title']) ?>"
                                class="w-full h-48" loading="lazy">
                        <?php endif; ?>
                        <div class="p-2">
                            <h3 class="text-white font-semibold text-sm line-clamp-2">
                                <?= htmlspecialchars($rDrama['title']) ?>
                            </h3>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="flex justify-center gap-2 mb-6">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?title=<?= urlencode($slug) ?>&page=<?= $i ?>"
                            class="px-3 py-1 rounded <?= $i === $page ? 'bg-indigo-500' : 'bg-gray-700 hover:bg-gray-600' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </main>

    <?php
    include './footer.php'
    ?>
</body>

<?php
$js = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/js/ep.js');
$encoded = base64_encode($js);
echo '<script src="data:text/javascript;base64,' . $encoded . '" defer></script>';
?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const iframe = document.getElementById('main-player');
        const loader = document.getElementById('iframe-loader');

        iframe.addEventListener('load', () => {
            if (loader) loader.style.display = 'none';
        });
    });
</script>
</html>