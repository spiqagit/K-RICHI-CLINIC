document.addEventListener('DOMContentLoaded', function () {

    const breakPoint = 500; // ブレークポイントを設定
    const newsSwiper = document.querySelector(".bl_newsSlider");
    const topConcernSwiper = document.querySelector(".bl_topConcernSwiper");
    let topConcernSlide = null;
    let newsSlide = null;
    let swiperBool = false;

    const createSwiper = () => {
        if (topConcernSwiper) {
            topConcernSlide = new Swiper(topConcernSwiper, {
                type: 'loop',
                slidesPerView: 'auto',
                spaceBetween: 20,
            });
        }

        if (newsSwiper) {
            newsSlide = new Swiper(newsSwiper, {
                type: 'loop',
                slidesPerView: 'auto',
                spaceBetween: 20,
            });
        }
    };

    const destroySwiper = () => {
        if (topConcernSlide) {
            topConcernSlide.destroy(false, true);
            topConcernSlide = null;
        }
        if (newsSlide) {
            newsSlide.destroy(false, true);
            newsSlide = null;
        }
    };

    window.addEventListener(
        "load",
        () => {
            if (breakPoint < window.innerWidth) {
                swiperBool = false;
            } else {
                createSwiper();
                swiperBool = true;
            }
        },
        false
    );

    window.addEventListener(
        "resize",
        () => {
            if (breakPoint < window.innerWidth && swiperBool) {
                destroySwiper();
                swiperBool = false;
            } else if (breakPoint >= window.innerWidth && !swiperBool) {
                createSwiper();
                swiperBool = true;
            }
        },
        false
    );


    const columnSlider = document.querySelector(".bl_topColumnSection_slider");
    if(columnSlider){
        new Swiper(columnSlider, {
            type: 'loop',
            slidesPerView: 'auto',
            spaceBetween: 20,
        });
    }


});