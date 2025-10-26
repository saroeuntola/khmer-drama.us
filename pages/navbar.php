<?php ?>
<style>
    #logo {
        width: 100px;
    }

    @media (min-width: 1024px) {
        .logo {
            width: 250px;
        }
    }
</style>

<nav id="header" class="bg-indigo-500 shadow-md w-full fixed top-0 left-0 z-50">
    <div class="max-w-5xl mx-auto px-2">
        <div class="flex justify-between h-16 items-center">
            <!-- Mobile: Hamburger + Logo -->
            <div class="flex items-center lg:hidden">
                <!-- Toggle Button -->
                <button id="menu-btn" class="lg:hidden p-2 text-white cursor-pointer">
                    <!-- Hamburger Icon -->
                    <svg id="menu-icon" class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Close Icon -->
                    <svg id="close-icon" class="w-8 h-8 hidden" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Logo -->
                <a href="/" class=" text-xl font-bold text-white hover:opacity-70 transition-all">
                    <img src="/assets/img/logo.png" class="w-[110px]" alt="drama dubbed khmer logo" />
                </a>
            </div>
            <!-- Desktop: Logo + Menu -->
            <div class="hidden lg:flex justify-between items-center w-full">
                <!-- Logo -->
                <a href="/" class="text-xl font-bold text-white hover:opacity-70 transition-all">
                    <img src="/assets/img/logo.png" class="logo" alt="drama dubbed khmer logo" />
                </a>

                <!-- Menu Items -->
                <div class="flex space-x-6 items-center text-white font-semibold">
                    <a href="/">Home</a>
                    <a href="/pages/drama">Drama</a>
                    <a href="/pages/about-us">About</a>
                    <a href="/pages/privacy-policy">Privacy Policy</a>
                    <a href="/pages/contact">Contact Us</a>

                    <!-- Search Icon -->
                    <button id="search-icon" class="flex items-center space-x-1 cursor-pointer">
                        <span>Search</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile: Search Icon -->
            <div class="flex items-center lg:hidden space-x-2 mr-2">
                <button id="search-icon-mobile" class="text-white focus:outline-none flex justify-center items-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Overlay -->
        <div id="overlay"
            class="lg:hidden fixed inset-0 mt-16 bg-black/70 opacity-0 pointer-events-none transition-opacity duration-500 z-20"></div>
        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="lg:hidden fixed left-0 h-full w-64 bg-indigo-500 -translate-x-full opacity-0 transition-all duration-500 z-30">
            <div class="flex flex-col px-5 py-4 space-y-4 text-white font-semibold">
                <a href="/">Home</a>
                <a href="/pages/drama">Drama</a>
                <a href="/pages/about-us">About</a>
                <a href="/pages/privacy-policy">Privacy Policy</a>
                <a href="/pages/contact">Contact Us</a>
            </div>
        </div>
    </div>
</nav>
<!-- Search Modal -->
<div id="searchModal" class="fixed inset-0 bg-black/70 hidden z-50 flex items-center justify-center">
    <div class="bg-gray-800 w-full h-full max-w-4xl overflow-y-auto relative p-4">
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 border-gray-600">
            <h2 class="text-xl text-white font-bold">Search</h2>
            <button onclick="closeSearchModal()" class="text-white text-3xl font-bold">&times;</button>
        </div>
        <!-- Search Input -->
        <div class="mt-4">
            <input type="text" id="search-box" placeholder="Type to search..."
                class="w-full px-4 py-3 rounded-md border border-gray-600 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <!-- Loading Indicator -->
        <div id="search-loading" class="hidden mt-3 text-white">Loading...</div>

        <!-- Search Results -->
        <div id="search-results" class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
            <div class="text-white col-span-full">Type to search...</div>
        </div>
    </div>
</div>

<?php
$js = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/js/navbar.js');
$encoded = base64_encode($js);
echo '<script src="data:text/javascript;base64,' . $encoded . '" defer></script>';
?>