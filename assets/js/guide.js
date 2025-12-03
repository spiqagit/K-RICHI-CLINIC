document.addEventListener('DOMContentLoaded', function () {
    

    const guideAboutSectionImgSlider = document.querySelector('.bl_guideAboutSection_imgSlider');
    if (guideAboutSectionImgSlider) {
        const guideAboutSectionImgSliderSwiper = new Swiper(guideAboutSectionImgSlider, {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.bl_guideAboutSection_imgSlider_pagination',
                clickable: true,
            },
        });
    }

    // Flow List Slider - 768px以下でのみ有効
    const breakPoint = 768;
    const guideFlowListSlider = document.querySelector('.bl_guideFlowListSlider');
    let guideFlowListSliderSwiper = null;
    let guideFlowListSliderBool = false;
    let resizeTimer;

    const createGuideFlowListSlider = () => {
        if (guideFlowListSlider) {
            if (guideFlowListSliderSwiper) {
                guideFlowListSliderSwiper.destroy(true, true);
            }
            guideFlowListSliderSwiper = new Swiper(guideFlowListSlider, {
                slidesPerView: 'auto',
                spaceBetween: 40,
                autoWidth: true,
            });
        }
    };

    const destroyGuideFlowListSlider = () => {
        if (guideFlowListSliderSwiper) {
            guideFlowListSliderSwiper.destroy(false, true);
            guideFlowListSliderSwiper = null;
        }
    };

    const initGuideFlowListSlider = () => {
        if (breakPoint >= window.innerWidth) {
            if (!guideFlowListSliderBool) {
                createGuideFlowListSlider();
                guideFlowListSliderBool = true;
            }
        } else {
            if (guideFlowListSliderBool) {
                destroyGuideFlowListSlider();
                guideFlowListSliderBool = false;
            }
        }
    };

    // 初回実行
    initGuideFlowListSlider();

    // リサイズ時の処理
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            initGuideFlowListSlider();
        }, 250);
    });
});
