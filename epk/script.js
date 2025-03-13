document.addEventListener("DOMContentLoaded", function () {
    const videoContainer = document.querySelector(".video-container");

    videoContainer.addEventListener("click", function () {
        this.classList.add("active"); // Aktiviert Video-Klicks
    });

    document.addEventListener("scroll", function () {
        videoContainer.classList.remove("active"); // Deaktiviert Video beim Scrollen
    });
});
