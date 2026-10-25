<?php 
require_once '../config/baseURL.php'; 
$faviconVersion = '2.0';
?>
<!DOCTYPE html>
<html lang="en" class="main">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="1WdVsgK6zvbUzlnduZ_ajBdnKxk3fWDHW-HlV-JPE3g" />
    <!-- Title for SEO -->
    <title>Privacy Policy - Merl Rerng | How We Protect Your Data</title>

    <!-- Meta Description -->
    <meta name="description"
        content="Read the Privacy Policy of Merl Rerng to learn how we collect, use, and protect your personal data. Your privacy is our priority.">

    <!-- Keywords (optional) -->
    <meta name="keywords"
        content="Privacy Policy, Merl Rerng, data protection, personal information, user privacy, GDPR, cookies">

    <!-- Author -->
    <meta name="author" content="Merl Rerng">

    <!-- Robots -->
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Social Sharing -->
    <meta property="og:title" content="Privacy Policy - Merl Rerng">
    <meta property="og:description"
        content="Learn how Merl Rerng protects your personal data and ensures your privacy online.">
    <meta property="og:image" content="<?= $baseUrl ?>/assets/icons/favicon.svg">
    <meta property="og:url" content="<?= $baseUrl ?>/pages/privacy-policy">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Privacy Policy - Merl Rerng">
    <meta name="twitter:description"
        content="Learn how Merl Rerng protects your personal data and ensures your privacy online.">
    <meta name="twitter:image" content="<?= $baseUrl ?>/assets/icons/favicon.svg">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?= $baseUrl ?>/pages/privacy-policy">
    <link rel="stylesheet" href="../src/style.css">
    <link rel="stylesheet" href="../src/output.css?v=<?= time() ?>">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= $baseUrl ?>/assets/icons/favicon-96x96.png?v=<?= $faviconVersion ?>"
        sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="<?= $baseUrl ?>/assets/icons/favicon.svg?v=<?= $faviconVersion ?>" />
    <link rel="shortcut icon" href="<?= $baseUrl ?>/assets/icons/favicon.ico?v=<?= $faviconVersion ?>" />

    <link rel="apple-touch-icon" sizes="180x180"
        href="<?= $baseUrl ?>/assets/icons/apple-touch-icon.png?<?= $faviconVersion ?>" />
    <link rel="apple-touch-icon" sizes="192x192"
        href="<?= $baseUrl ?>/assets/icons/web-app-manifest-192x192.png?v=<?= $faviconVersion ?>" />
    <link rel="apple-touch-icon" sizes="512x512"
        href="<?= $baseUrl ?>/assets/icons/web-app-manifest-512x512.png?v=<?= $faviconVersion ?>" />
    <meta name="apple-mobile-web-app-title" content="Asain Drama" />
    <link rel="manifest" href="<?= $baseUrl ?>/assets/icons/site.webmanifest" />

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Merl Rerng",
        "url": "<?= $baseUrl ?>",
        "logo": "<?= $baseUrl ?>/assets/icons/favicon.svg"
    }
    </script>

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


</head>


<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZ349ZZZ" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php include "navbar.php"; ?>
    <div class="max-w-5xl mx-auto px-6 py-12 pt-[120px]">
        <h1 class="text-4xl font-bold mb-6 text-center text-indigo-500">Privacy Policy</h1>

        <p class="mb-4 text-lg leading-relaxed">
            At <span class="font-semibold">Merl Rerng</span>, we respect your privacy and are committed to
            protecting your personal information.
        </p>

        <h2 class="text-2xl font-semibold mb-3 mt-6 text-indigo-400">Information We Collect</h2>
        <ul class="list-disc list-inside mb-4 text-lg leading-relaxed">
            <li>Non-personal data such as browser type, IP address, device information, and pages visited.</li>
            <li>Cookies used by Google AdSense and other partners to deliver personalized ads.</li>
        </ul>

        <h2 class="text-2xl font-semibold mb-3 mt-6 text-indigo-400">How We Use Information</h2>
        <p class="mb-4 text-lg leading-relaxed">
            We use the collected information to improve website performance, enhance user experience, and serve relevant
            ads through Google and other ad networks.
        </p>

        <h2 class="text-2xl font-semibold mb-3 mt-6 text-indigo-400">Legal Disclaimer & Third-Party Content</h2>
        <p class="mb-4 text-lg leading-relaxed">
            Episodes or videos are <span class="font-semibold">not hosted on this site or its servers</span>. <span
                class="font-semibold">Merl Rerng</span> only links to videos hosted on external websites, such
            as YouTube or other streaming platforms. All content is the property of its respective owners, and we do not
            claim any copyright.
        </p>
        <p class="mb-4 text-lg leading-relaxed">
            If you believe any content on our site infringes your copyright, please <a href="mailto:info@merlrerng.org"
                class="text-indigo-400 underline">contact us:
                info@merlrerng.org</a>, and we will promptly remove the content.
        </p>
        <!-- <p class="mb-4 text-lg leading-relaxed">
            For the latest content or updates, please refresh your browser or visit the original video source. Third-party trademarks are used solely to describe the content indexed herein. No license, endorsement, or affiliation with the trademark owners is implied.
        </p> -->

        <h2 class="text-2xl font-semibold mb-3 mt-6 text-indigo-400">Your Choices</h2>
        <p class="mb-4 text-lg leading-relaxed">
            You can disable cookies in your browser or manage preferences for personalized ads via <a
                href="https://adssettings.google.com/" class="text-indigo-400 underline">Google Ads Settings</a>.
        </p>

        <h2 class="text-2xl font-semibold mb-3 mt-6 text-indigo-400">Contact Us</h2>
        <p class="mb-4 text-lg leading-relaxed">
            For questions about this Privacy Policy or to request content removal, contact us at <a
                href="mailto:info@merlrerng.org" class="text-indigo-400 underline">info@merlrerng.org</a>.
        </p>

    </div>

    <?php include "footer.php" ?>
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