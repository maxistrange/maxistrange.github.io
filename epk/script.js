document.addEventListener("DOMContentLoaded", function () {
    // YouTube Scroll Fix
    const videoContainer = document.querySelector(".video-container");

    videoContainer.addEventListener("click", function () {
        this.classList.add("active");
    });

    document.addEventListener("scroll", function () {
        videoContainer.classList.remove("active");
    });

    // Slideshow
    let currentSlide = 0;
    const slides = document.querySelectorAll(".slide");
    const dots = document.querySelectorAll(".dot");

    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove("active"));
        dots.forEach(dot => dot.classList.remove("active"));

        slides[index].classList.add("active");
        dots[index].classList.add("active");
    }

    function changeSlide(step) {
        currentSlide = (currentSlide + step + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    function setSlide(index) {
        currentSlide = index;
        showSlide(index);
    }

    setInterval(() => changeSlide(1), 3000);
});
