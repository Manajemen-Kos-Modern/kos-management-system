document.addEventListener("DOMContentLoaded", function () {
    const dots = document.querySelectorAll(".carousel-dots .dot");
    const roomCards = document.getElementById("roomCards");
    const cardWidth = document.querySelector(".room-card")?.offsetWidth || 320;
    const gap = 24; // adjust if you use gap in CSS
    const perSlide = 5;

    dots.forEach((dot) => {
        dot.addEventListener("click", function () {
            dots.forEach((d) => d.classList.remove("active"));
            this.classList.add("active");
            const index = parseInt(this.getAttribute("data-index"));
            const scrollTo = index * (cardWidth + gap) * perSlide;
            roomCards.scrollTo({ left: scrollTo, behavior: "smooth" });
        });
    });

    // Optional: update active dot on scroll
    roomCards?.addEventListener("scroll", function () {
        const scrollLeft = roomCards.scrollLeft;
        const slide = Math.round(scrollLeft / ((cardWidth + gap) * perSlide));
        dots.forEach((d, i) => d.classList.toggle("active", i === slide));
    });
});
