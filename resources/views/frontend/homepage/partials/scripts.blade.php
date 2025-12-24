<script>
    $(document).ready(function() {
        $('#popup').removeClass('hidden').addClass('flex');

        const swiper = new Swiper(".popup-swiper", {
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
        });
    });

    gsap.registerPlugin(ScrollTrigger);

    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        const topBar = document.getElementById('topbar');
        if (!navbar || !topBar) return;
        const topBarHeight = topBar.offsetHeight;
        if (window.scrollY > topBarHeight) {
            navbar.style.top = '0px';
        } else {
            navbar.style.top = topBarHeight + 'px';
        }
    });

    const carousel = document.querySelector(".slides-wrapper");
    const wrapperFirst = document.querySelector("#wrapper-first");
    const wrapperSecond = document.querySelector("#wrapper-second");
    const slideItem = carousel.querySelectorAll("#slideItem")[0];

    let isDragStart = false,
        prevPagex, prevscrollLeft;
    let firstImage = slideItem.clientWidth + 14;

    const dragStart = (e) => {
        isDragStart = true;
        prevPagex = e.pageX;
        prevscrollLeft = carousel.scrollLeft;
    }

    wrapperFirst.addEventListener("click", () => {
        if (carousel.scrollLeft <= 0) {
            carousel.scrollTo({
                left: carousel.scrollWidth,
                behavior: "smooth"
            });
        } else {
            carousel.scrollTo({
                left: carousel.scrollLeft - firstImage,
                behavior: "smooth"
            });
        }
    });

    wrapperSecond.addEventListener("click", () => {
        if (carousel.scrollLeft + carousel.clientWidth >= carousel.scrollWidth) {
            carousel.scrollTo({
                left: 0,
                behavior: "smooth"
            });
        } else {
            carousel.scrollTo({
                left: carousel.scrollLeft + firstImage,
                behavior: "smooth"
            });
        }
    });

    const dragging = (e) => {
        if (!isDragStart) return;
        e.preventDefault();
        carousel.classList.add("dragging");
        let postionDIff = e.pageX - prevPagex;
        carousel.scrollLeft = prevscrollLeft - postionDIff;
    }

    const dragStop = () => {
        isDragStart = false;
        carousel.classList.remove("dragging");
    }

    carousel.addEventListener("mousedown", dragStart);
    carousel.addEventListener("mousemove", dragging);
    carousel.addEventListener("mouseup", dragStop);
    carousel.addEventListener("mouseleave", dragStop);
</script>
