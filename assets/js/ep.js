document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".ep-btn");
  const player = document.getElementById("main-player");

  buttons.forEach((button) => {
    button.addEventListener("click", function () {
      const videoUrl = this.getAttribute("data-video");
      if (player && videoUrl) {
        player.src = videoUrl;

        // Reset active button style
        buttons.forEach((btn) => btn.classList.remove("bg-green-500"));
        buttons.forEach((btn) => btn.classList.add("bg-indigo-500"));
        buttons.forEach((btn) => btn.classList.remove("hover:bg-indigo-800"));

        // Highlight the active episode
        this.classList.remove("bg-indigo-500");
        this.classList.add("bg-green-500");
      }
    });
  });
});
