let preloaderStartTime;

function showPreloader() {
    preloaderStartTime = new Date().getTime();
    const preloader = document.getElementById("preloader");
    if (preloader) {
        preloader.style.display = "flex";
    }
}

function hidePreloader() {
    const now = new Date().getTime();
    const elapsed = now - preloaderStartTime;

    const delay = Math.max(0, 1000 - elapsed);

    setTimeout(() => {
        const preloader = document.getElementById("preloader");
        if (preloader) {
            preloader.style.display = "none";
        }
    }, delay);
}

window.onload = function () {
    showPreloader();
    setTimeout(function () {
        hidePreloader();
    }, 100);
};

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    showCloseButton: true,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

function inpNum(e) {
    e = e || window.event;
    var charCode = typeof e.which == "undefined" ? e.keyCode : e.which;
    var charStr = String.fromCharCode(charCode);
    if (!charStr.match(/^[0-9]+$/)) e.preventDefault();
}

window.onload = function () {
    const preloader = document.getElementById("preloader");
    const content = document.getElementById("content");

    preloader.style.display = "none"; // Hide preloader
    content.classList.remove("hidden"); // Show content
};

// Get the button
let goToTopBtn = document.getElementById("goToTopBtn");

// When the user scrolls down 100px from the top of the document, show the button
window.onscroll = function () {
    scrollFunction();
};

function scrollFunction() {
    if (
        document.body.scrollTop > 100 ||
        document.documentElement.scrollTop > 100
    ) {
        goToTopBtn.classList.remove("hidden");
    } else {
        goToTopBtn.classList.add("hidden");
    }
}

// When the user clicks on the button, scroll to the top of the document
goToTopBtn.onclick = function () {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
};

gsap.registerPlugin(ScrollTrigger);

//Introduction
gsap.from("#introduction-head", {
    y: -200,

    duration: 1,
    ease: "power3.linear",
});
gsap.from("#step22", {
    y: 200,

    duration: 1,
    ease: "power3.linear",
});
gsap.from("#step11", {
    y: -200,

    duration: 1,
    ease: "power3.linear",
});
gsap.from("#introduction-left-box", {
    x: -400,

    duration: 1,

    ease: "power3.linear",
});
gsap.from("#introduction-right-box", {
    x: 400,

    duration: 1,

    ease: "power3.linear",
});

//   Why Choose Us
// Animate title and description
gsap.from("#para343-title", {
    y: -100,
    opacity: 0,
    duration: 1,
    ease: "power3.linear",
});

gsap.from("#para343-desc", {
    y: -100,
    opacity: 0,
    duration: 1,
    ease: "power3.linear",
});

gsap.from("#all323-box", {
    x: -100,
    opacity: 0,
    duration: 1,

    ease: "power3.linear",
});
// Box animations with specific directions
gsap.from("#para323-box1", {
    x: -400,
    opacity: 0,
    duration: 1,

    ease: "power3.linear",
});

gsap.from("#para323-box2", {
    y: -100,
    opacity: 0,
    duration: 1,
    ease: "power3.linear",
});

gsap.from("#para323-box3", {
    x: 400,
    opacity: 0,
    duration: 1,

    ease: "power3.linear",
});

gsap.from("#para323-box4", {
    x: -400,
    opacity: 0,
    duration: 1,

    ease: "power3.linear",
});

gsap.from("#para323-box5", {
    y: 100,
    opacity: 0,
    duration: 1,
    ease: "power3.linear",
});

gsap.from("#para323-box6", {
    x: 400,

    opacity: 0,
    duration: 1,
    ease: "power3.linear",
});

const boxes = document.querySelectorAll(".para232box");

boxes.forEach((box) => {
    const svg = box.querySelector("button");

    box.addEventListener("mouseenter", () => {
        gsap.to(svg, {
            scale: 1.4,
            duration: 0.1,
            ease: "power2.out",
        });
    });

    box.addEventListener("mouseleave", () => {
        gsap.to(svg, {
            scale: 1,
            duration: 0.1,
            ease: "power2.inOut",
        });
    });
});

//Upcoming events

// Animate title and description
gsap.from("#upcoming-head1", {
    y: -200,
    opacity: 0,
    duration: 1,
    ease: "power3.linear",
});

gsap.from("#upcoming-head2", {
    x: -200,
    opacity: 0,
    duration: 1,
    ease: "power3.linear",
});
gsap.from("#upcoming-head3", {
    x: 200,
    opacity: 0,
    duration: 1,
    ease: "power3.linear",
});

//Achievements
gsap.from("#achivement-buton", {
    y: -200,

    duration: 1,
    ease: "power3.linear",
});
gsap.from("#achivement-title", {
    y: -200,

    duration: 1,
    ease: "power3.linear",
});

gsap.from("#achivement-desc", {
    y: -200,

    duration: 1,
    ease: "power3.linear",
});
gsap.from("#galary-button", {
    y: 10,
    opacity: 0,
    duration: 1,
    ease: "power3.linear",
});
gsap.from(".swiper-slide:nth-child(1)", {
    x: -400,
    duration: 1,
    ease: "power3.linear",
});

gsap.from(".swiper-slide:nth-child(2)", {
    x: -400,
    duration: 1,
    ease: "power3.linear",
});

gsap.from(".swiper-slide:nth-child(3)", {
    x: 400,
    duration: 1,
    ease: "power3.linear",
});

gsap.from(".swiper-slide:nth-child(4)", {
    x: 400,
    duration: 1,
    ease: "power3.linear",
});

// toggle function (safe: removes both states then activates the chosen one)
function toggleSection(section) {
    const achievementSection = document.getElementById("achivement-section");
    const awardSection = document.getElementById("award-section");
    const achievementBtn = document.getElementById("achievements-btn");
    const awardBtn = document.getElementById("awards-btn");
    const achievementHover = document.getElementById("hover-achievement");
    const awardHover = document.getElementById("hover-award");

    // Defensive checks
    if (!achievementSection || !awardSection) return;

    // Reset both sections / buttons / hovers
    [achievementSection, awardSection].forEach((el) => {
        el.classList.remove("achiveactive");
        el.classList.add("achivehidden");
    });
    [achievementBtn, awardBtn].forEach((btn) => {
        if (btn) btn.classList.remove("font-semibold");
    });
    [achievementHover, awardHover].forEach((h) => {
        if (h) {
            h.classList.remove("achiveactive");
            h.classList.add("achivehidden");
        }
    });

    // Activate selected
    if (section === "achievements") {
        achievementSection.classList.remove("achivehidden");
        achievementSection.classList.add("achiveactive");
        achievementBtn.classList.add("font-semibold");
        if (achievementHover) {
            achievementHover.classList.remove("achivehidden");
            achievementHover.classList.add("achiveactive");
        }

        // If you stored a Swiper instance in window.achievementsSwiper, update it
        if (
            window.achievementsSwiper &&
            typeof window.achievementsSwiper.update === "function"
        ) {
            window.achievementsSwiper.update();
        }
    } else {
        awardSection.classList.remove("achivehidden");
        awardSection.classList.add("achiveactive");
        awardBtn.classList.add("font-semibold");
        if (awardHover) {
            awardHover.classList.remove("achivehidden");
            awardHover.classList.add("achiveactive");
        }

        if (
            window.awardsSwiper &&
            typeof window.awardsSwiper.update === "function"
        ) {
            window.awardsSwiper.update();
        }
    }
}

// Wait for DOM ready (safer than window.onload)
document.addEventListener("DOMContentLoaded", function () {
    toggleSection("achievements"); // default to Achievements
});

// Achievements Swiper
var achievementsSwiper = new Swiper(".achievements-swiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop: false,
    pagination: {
        el: ".swiper-pagination-achievements",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next-achievements",
        prevEl: ".swiper-button-prev-achievements",
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
    },
});

// Awards Swiper
var awardsSwiper = new Swiper(".awards-swiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop: false,
    pagination: {
        el: ".swiper-pagination-awards",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next-awards",
        prevEl: ".swiper-button-prev-awards",
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
    },
});

var swiper = new Swiper(".swiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop: false,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next-custom",
        prevEl: ".swiper-button-prev-custom",
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },

        768: {
            slidesPerView: 3,
            spaceBetween: 20,
        },

        1024: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
    },
});

const carousel  = document.querySelector(".slides-wrapper")
const wrapperFirst  = document.querySelector("#wrapper-first")
const wrapperSecond  = document.querySelector("#wrapper-second")
const slideItem  = carousel.querySelectorAll("#slideItem")[0]


let isDragStart = false, prevPagex,prevscrollLeft;
let firstImage = slideItem.clientWidth +14;
const dragStart=(e)=>{
  isDragStart= true;
  prevPagex=e.pageX;
  prevscrollLeft= carousel.scrollLeft;
}

//{% comment %} wrapperFirst.addEventListener("click",()=>{
  //carousel.scrollLeft -= firstImage


//})
//wrapperSecond.addEventListener("click",()=>{
 // carousel.scrollLeft += firstImage
//})

wrapperFirst.addEventListener("click",()=>{
  if (carousel.scrollLeft <= 0) {

    carousel.scrollTo({ left: carousel.scrollWidth, behavior: "smooth" });
  } else {
    carousel.scrollTo({ left: carousel.scrollLeft - firstImage, behavior: "smooth" });
  }
})
wrapperSecond.addEventListener("click",()=>{
  if (carousel.scrollLeft + carousel.clientWidth >= carousel.scrollWidth) {

    carousel.scrollTo({ left: 0, behavior: "smooth" });
  } else {
    carousel.scrollTo({ left: carousel.scrollLeft + firstImage, behavior: "smooth" });
  }
})
const dragging=(e)=>{

  if(!isDragStart) return;
  e.preventDefault();
  carousel.classList.add("dragging");
  let postionDIff = e.pageX - prevPagex;
  carousel.scrollLeft = prevscrollLeft - postionDIff;
}
const dragStop=()=>{
  isDragStart= false;
  carousel.classList.remove("dragging");
}

carousel.addEventListener("mousedown",dragStart)
carousel.addEventListener("mousemove",dragging)
carousel.addEventListener("mouseup",dragStop)
carousel.addEventListener("mouseleave",dragStop)
