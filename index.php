<?php require_once './config/baseURL.php'; ?>
<!DOCTYPE html>
<html lang="en" class="main">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="1WdVsgK6zvbUzlnduZ_ajBdnKxk3fWDHW-HlV-JPE3g" />
    <title>Merl Rerng - Watch Movies Online Free</title>

    <meta name="description"
        content="Merl Rerng - Watch Movies Online Free | AI Movies, Chinese Drama, Korean Drama, Thai Drama, Khmer dramas. Enjoy full episodes with Khmer voice dub and daily updates.">
    <meta name="keywords"
        content="Merl Rerng, AI, Chinese drama speak khmer, Korean drama speak khmer, Khmer drama, Asian drama, Chinese drama dubbed Khmer, Korean drama dubbed Khmer, Thai drama dubbed Khmer, Khmer series, Khmer voice dub, Cambodia drama site">

    <meta name="author" content="Drama Dubbed Khmer">
    <meta name="robots" content="index, follow">
    <meta name="language" content="en">

    <!-- Open Graph (Facebook, Telegram, etc.) -->
    <meta property="og:title" content="Merl Rerng - Watch Movies Online Free">
    <meta property="og:description"
        content="Watch Chinese, Korean, Thai, and Khmer dramas dubbed in Khmer language. Updated daily with HD episodes.">
    <meta property="og:image" content="<?= $baseUrl ?>/assets/icons/favicon.svg">
    <meta property="og:url" content="<?= $baseUrl ?>/">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Merl Rerng - Watch Movies Online Free">
    <meta name="twitter:description" content="Watch your favorite movies drama">
    <meta name="twitter:image" content="<?= $baseUrl ?>/images/khmer-drama-cover.jpg">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?= $baseUrl ?>">
    <link rel="stylesheet" href="../src/output.css?v=<?= time() ?>">
    <link rel="stylesheet" href="../src/style.css">
    <?php $faviconVersion = '2.0'; ?>
    <link rel="icon" type="image/png" href="/assets/icons/favicon-96x96.png?v=<?= $faviconVersion ?>" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/assets/icons/favicon.svg?v=<?= $faviconVersion ?>" />
    <link rel="shortcut icon" href="/assets/icons/favicon.ico?v=<?= $faviconVersion ?>" />

    <link rel="apple-touch-icon" sizes="180x180" href="/assets/icons/apple-touch-icon.png?v=<?= $faviconVersion ?>" />
    <link rel="apple-touch-icon" sizes="192x192"
        href="/assets/icons/web-app-manifest-192x192.png?v=<?= $faviconVersion ?>" />
    <link rel="apple-touch-icon" sizes="512x512"
        href="/assets/icons/web-app-manifest-512x512.png?v=<?= $faviconVersion ?>" />

    <meta name="apple-mobile-web-app-title" content="Merl Rerng" />
    <link rel="manifest" href="/assets/icons/site.webmanifest?v=<?= $faviconVersion ?>" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php include "./config/google-tag.php"?>
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

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Drama Dubbed Khmer",
        "url": "<?= $baseUrl ?>/",
        "logo": "<?= $baseUrl ?>/assets/icons/favicon.svg"
    }
    </script>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Drama Dubbed Khmer",
        "url": "<?= $baseUrl ?>/",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "<?= $baseUrl ?>/search?query={search_term_string}",
            "query-input": "required name=search_term_string"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Drama Dubbed Khmer",
            "logo": {
                "@type": "ImageObject",
                "url": "<?= $baseUrl ?>/assets/icons/favicon.svg"
            }
        },
        "description": "Watch movies dramas Chinese, Korean, AI Movies."
    }
    </script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9457393184068455"
        crossorigin="anonymous"></script>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZ349ZZZ" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <header>
        <?php
        include "./pages/navbar.php"
        ?>
    </header>
    <main class="main">
        <?php include "loading.php" ?>

        <?php
    include './pages/latest-section.php'
    ?>
        <?php
    include './pages/ai-movies-section.php'
    ?>
        <?php
    include './pages/china-section.php'
    ?>
        <?php
    include './pages/korean-section.php'
    ?>
        <?php
    include './pages/khmer-section.php'
    ?>
        <?php
    include './pages/thai-section.php'
    ?>
    </main>
    <?php
    include './pages/footer.php'
    ?>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9457393184068455"
        crossorigin="anonymous"></script>
    <!-- ads -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-9457393184068455" data-ad-slot="2575395744"
        data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <!-- grid ads -->
    <ins class="adsbygoogle" style="display:block" data-ad-format="autorelaxed" data-ad-client="ca-pub-9457393184068455"
        data-ad-slot="8834529793">
    </ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</body>

</html>