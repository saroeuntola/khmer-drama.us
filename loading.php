<style>
  .loader {
    width: 50px;
    aspect-ratio: 1;
    --c: no-repeat radial-gradient(farthest-side, #514b82 92%, #0000);
    background:
      var(--c) 50% 0,
      var(--c) 50% 100%,
      var(--c) 100% 50%,
      var(--c) 0 50%;
    background-size: 10px 10px;
    animation: l18 1s infinite linear;
    position: relative;
  }

  .loader::before {
    content: "";
    position: absolute;
    inset: 0;
    margin: 3px;
    background: repeating-conic-gradient(#0000 0 35deg, #514b82 0 90deg);
    -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 3px), #000 0);
    border-radius: 50%;
  }

  @keyframes l18 {
    100% {
      transform: rotate(.5turn)
    }
  }

  /* Centering fix */
  #pageLoader {
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>

<main class="bg-gray-900 text-white">
  <!-- Loader -->
  <div id="pageLoader"
    class="fixed inset-0 z-[9999] bg-gray-900 flex items-center justify-center transition-opacity duration-1000"
    aria-live="polite">
    <div class="relative h-20 w-20 flex items-center justify-center">
      <div class="loader"></div>
      <!-- <img src="./images/logo.png" alt="Logo"
        class="absolute right-5 h-8 w-8 object-contain pointer-events-none" /> -->
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