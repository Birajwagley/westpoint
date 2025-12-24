<style>
    .carousel .dragging {
        cursor: grab;
        scroll-behavior: auto;
    }

    .carousel .dragging img {
        pointer-events: none;
    }

    .swiper {
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .swiper-slide {
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        filter: blur(0px);
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        justify-content: end;
        align-items: self-start;
        width: 18rem;
        /* 72px, adjust as needed */
    }

    .swiper-pagination-bullet,
    .swiper-pagination-bullet-active {
        background: #fff;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #044335;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        color: #FFF32F;
    }

    .achiveactive {
        display: flex;
    }

    .achivehidden {
        display: none;
    }

    #gallary-section .swiper {
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    #gallary-section #modal-gallary {
        display: none;
    }

    #gallary-section .swiper-slide {
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        filter: blur(0px);
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        justify-content: end;
        align-items: self-start;
    }

    #gallary-section .swiper-slide-active {
        filter: blur(0px);
    }

    #gallary-section .swiper-pagination-bullet,
    #gallary-section .swiper-pagination-bullet-active {
        background: #fff;
    }

    #award-section .swiper {
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    #award-section .swiper-slide {
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        filter: blur(0px);
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        justify-content: end;
        align-items: self-start;
        width: 18rem;
        /* 72px, adjust as needed */
    }

    #award-section .swiper-pagination-bullet,
    #award-section .swiper-pagination-bullet-active {
        background: #fff;
    }

    #award-section .swiper-button-next,
    #award-section .swiper-button-prev {
        color: #044335;
    }

    #award-section .achiveactive {
        display: flex;
    }

    #award-section .achivehidden {
        display: none;
    }

    #Testimonials-cards .swiper-pagination-bullet,
    #Testimonials-cards .swiper-pagination-bullet-active {
        background: #fff;
    }

    #Testimonials-cards .swiper-button-next,
    #Testimonials-cards .swiper-button-prev {
        color: #044335;
    }
</style>
