const menuBtn = document.getElementById("menu-btn");
const menuIcon = document.getElementById("menu-icon");
const closeIcon = document.getElementById("close-icon");
const overlay = document.getElementById("overlay");
const mobileMenu = document.getElementById("mobile-menu");

function openMenu() {
  menuIcon.classList.add("hidden");
  closeIcon.classList.remove("hidden");

  overlay.classList.remove("pointer-events-none", "opacity-0");
  overlay.classList.add("opacity-100");

  mobileMenu.classList.remove("-translate-x-full", "opacity-0");
  mobileMenu.classList.add("translate-x-0", "opacity-100");
}

function closeMenu() {
  menuIcon.classList.remove("hidden");
  closeIcon.classList.add("hidden");

  overlay.classList.add("opacity-0");
  overlay.classList.remove("opacity-100");

  // Ensure overlay is not clickable
  setTimeout(() => {
    overlay.classList.add("pointer-events-none");
  }, 300); // wait for transition to finish

  mobileMenu.classList.add("-translate-x-full", "opacity-0");
  mobileMenu.classList.remove("translate-x-0", "opacity-50");
}

menuBtn.addEventListener("click", () => {
  const isOpen = !mobileMenu.classList.contains("-translate-x-full");
  isOpen ? closeMenu() : openMenu();
});

overlay.addEventListener("click", closeMenu);

// ===== Search Modal =====
const searchIconDesktop = document.getElementById("search-icon");
const searchIconMobile = document.getElementById("search-icon-mobile");
const searchModal = document.getElementById("searchModal");
const searchBox = document.getElementById("search-box");
const searchResults = document.getElementById("search-results");
const searchLoading = document.getElementById("search-loading");

function openSearchModal() {
  searchModal.classList.remove("hidden");
  searchBox.focus();
}

function closeSearchModal() {
  searchModal.classList.add("hidden");
  searchBox.value = "";
  searchResults.innerHTML =
    '<div class="text-white col-span-full">Type to search...</div>';
}

[searchIconDesktop, searchIconMobile].forEach((icon) =>
  icon.addEventListener("click", openSearchModal)
);

window.addEventListener("click", (e) => {
  if (e.target === searchModal) closeSearchModal();
});

// ===== Search Function =====
function debounce(func, delay) {
  let timeout;
  return function () {
    clearTimeout(timeout);
    timeout = setTimeout(() => func.apply(this, arguments), delay);
  };
}
searchBox.addEventListener(
  "input",
  debounce(function () {
    const query = this.value.trim();
    searchResults.innerHTML = "";
    if (!query) {
      searchResults.innerHTML =
        '<div class="text-white col-span-full">Type to search...</div>';
      searchLoading.classList.add("hidden");
      return;
    }

    searchLoading.classList.remove("hidden");
    fetch(`/search?q=${encodeURIComponent(query)}`)
      .then((res) => res.json())
      .then((data) => {
        searchLoading.classList.add("hidden");
        searchResults.innerHTML = "";
        if (data.length === 0) {
          searchResults.innerHTML =
            '<div class="text-white col-span-full">No results found</div>';
        } else {
          data.forEach((item) => {
            const a = document.createElement("a");
            a.href = `/pages/view-drama?title=${item.slug}`;
            a.className = `
        flex items-center gap-3 bg-gray-800 text-white p-3 rounded-lg 
        hover:bg-gray-700 transition duration-200 shadow-md hover:shadow-lg
    `;

            // Image (if available)
            const img = document.createElement("img");
            img.src = item.featured_img
              ? `/${item.featured_img}`
              : "/assets/no-image.jpg";
            img.alt = item.title;
            img.className = "w-30 h-20 rounded-md flex-shrink-0";

            // Text Container
            const textDiv = document.createElement("div");
            const title = document.createElement("h3");
            title.textContent = item.title;
            title.className = "font-semibold text-sm";
            textDiv.appendChild(title);

            // Assemble card
            a.appendChild(img);
            a.appendChild(textDiv);

            searchResults.appendChild(a);
          });
        }
      })
      .catch((err) => {
        searchLoading.classList.add("hidden");
        console.error(err);
      });
  }, 300)
);
