document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".ep-btn");
  const player = document.getElementById("main-player");

  function toEmbedURL(url) {
    if (!url) return "";

    if (url.includes("youtube.com/embed/")) return url;

    if (url.includes("youtu.be/")) {
      return url.replace("youtu.be/", "www.youtube.com/embed/");
    }

    if (url.includes("watch?v=")) {
      return url.replace("watch?v=", "embed/");
    }
    return url;
  }

  if (player && player.src) {
    player.src = toEmbedURL(player.src);
  }

  buttons.forEach((button) => {
    button.addEventListener("click", function () {
      const videoUrl = this.getAttribute("data-video");
      if (player && videoUrl) {
        const embedUrl = toEmbedURL(videoUrl);
        player.src = embedUrl;

        buttons.forEach((btn) => {
          btn.classList.remove("bg-green-500");
          btn.classList.add("bg-indigo-500");
          btn.classList.remove("hover:bg-indigo-800");
        });

        this.classList.remove("bg-indigo-500");
        this.classList.add("bg-green-500");
      }
    });
  });
});
