<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="google-site-verification" content="1WdVsgK6zvbUzlnduZ_ajBdnKxk3fWDHW-HlV-JPE3g" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Drama Dubbed Khmer</title>
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

<body class="bg-gray-900 text-gray-100">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZ349ZZZ"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php include "navbar.php"; ?>
    <div class="max-w-5xl mx-auto px-6 py-12 pt-[120px]">
        <h1 class="text-4xl font-bold mb-6 text-center text-indigo-500">Contact Us</h1>

        <p class="mb-6 text-lg leading-relaxed">
            Have questions, suggestions, or want to report content? We’d love to hear from you! Please fill out the form below or email us directly at
            <a href="mailto:dramadubbedkhmer" class="text-indigo-400 underline">dramadubbedkhmer</a>.
        </p>

        <form action="#" method="POST" class="bg-gray-800 p-8 rounded-lg shadow-md">
            <div class="mb-4">
                <label class="block text-lg font-semibold mb-2" for="name">Your Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name"
                    class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-100">
            </div>

            <div class="mb-4">
                <label class="block text-lg font-semibold mb-2" for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email"
                    class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-100">
            </div>

            <div class="mb-4">
                <label class="block text-lg font-semibold mb-2" for="message">Message</label>
                <textarea id="message" name="message" rows="6" placeholder="Write your message..."
                    class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-100"></textarea>
            </div>

            <button type="submit"
                class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-200">
                Send Message
            </button>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>