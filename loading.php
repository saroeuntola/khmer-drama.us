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

<main class="bg-gray-900 text-white">
  <!-- Loader -->
  <div id="pageLoader"
    class="fixed inset-0 z-[9999] bg-gray-900 flex items-center justify-center transition-opacity duration-1000"
    aria-live="polite">
    <div class="relative h-20 w-20 flex items-center justify-center">
      <div class="loader"></div>
    </div>
  </div>

  <!-- Loader Script -->
  <script>
    $(window).on("load", function() {
      const $loader = $("#pageLoader");
      $loader.removeClass("opacity-0").css("opacity", "1");
      $loader.addClass("opacity-0");
      setTimeout(function() {
        $loader.css("display", "none").attr("aria-hidden", "true");
      }, 1000);
    });
  </script>
</main>