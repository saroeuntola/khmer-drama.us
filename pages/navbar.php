<nav id="header" class="shadow-md w-full fixed top-0 left-0 z-50">
    <div class="max-w-5xl mx-auto px-2">
        <div class="flex justify-between h-16 items-center">

            <!-- Mobile Navbar -->
            <div class="grid grid-cols-3 items-center w-full lg:hidden">
                <!-- Left: Menu Button -->
                <div class="flex items-center justify-start">
                    <button id="menu-btn" class="lg:hidden p-2 text-white cursor-pointer" aria-label="Toggle menu">
                        <svg id="menu-icon" class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="close-icon" class="w-8 h-8 hidden" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Center: Logo -->
                <div class="flex items-center justify-center">
                    <a href="/" class="flex items-center justify-center hover:opacity-70 transition-all">
                        <img src="/assets/img/merlrerng.png" class="w-[130px] max-w-none" alt="Merl Rerng" />
                    </a>
                </div>

                <!-- Right: Search Icon -->
                <div class="flex items-center justify-end mr-2">
                    <button id="search-icon-mobile"
                        class="text-white focus:outline-none flex justify-center items-center" aria-label="Search">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Desktop Navbar -->
            <div class="hidden lg:flex justify-between items-center w-full">
                <a href="/" class="text-xl font-bold text-white hover:opacity-70 transition-all">
                    <img src="/assets/img/merlrerng.png" class="logo" alt="Merl Rerng" />
                </a>

                <div class="flex space-x-6 items-center text-white font-semibold">
                    <a href="/">Home</a>
                    <a href="/pages/drama">Drama</a>
                    <a href="/pages/about-us">About</a>
                    <a href="/pages/privacy-policy">Privacy Policy</a>
                    <a href="/pages/contact">Contact Us</a>

                    <button id="search-icon" class="flex items-center space-x-1 cursor-pointer" aria-label="Search">
                        <span>Search</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div id="overlay"
            class="lg:hidden fixed inset-0 mt-16 bg-black/70 opacity-0 pointer-events-none transition-opacity duration-500 z-20">
        </div>

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

<!-- Search Modal -->
<div id="searchModal" class="hidden fixed inset-0 z-[100] bg-black/80 p-3 sm:p-6 overflow-y-auto">

    <div class="max-w-2xl w-full min-h-[70vh] max-h-[90vh] mx-auto mt-[5vh]
                bg-gray-900 rounded-xl shadow-xl flex flex-col overflow-hidden">

        <!-- Search Header -->
        <div class="flex items-center gap-3 p-4 border-b border-gray-700">
            <input id="search-box" type="search" placeholder="Search dramas..." autocomplete="off" class="w-full min-w-0 rounded-lg bg-gray-800 text-white
                       border border-gray-700 p-3 focus:outline-none
                       focus:ring-2 focus:ring-indigo-500" />

            <button id="close-search" type="button" class="text-white text-3xl px-2 hover:text-red-400"
                aria-label="Close search">
                &times;
            </button>
        </div>

        <!-- Loading -->
        <div id="search-loading" class="hidden text-white text-center py-4">
            Searching...
        </div>

        <!-- Results: scroll independently -->
        <div id="search-results" class="grid grid-cols-1 gap-3 p-4 overflow-y-auto flex-1 min-h-[40vh]">
            <div class="text-white col-span-full">
                Type to search...
            </div>
        </div>

    </div>
</div>


<?php
$jsPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/js/navbar.js';

if (file_exists($jsPath)) {
    echo '<script src="/assets/js/navbar.js?v=' . filemtime($jsPath) . '" defer></script>';
}
?>