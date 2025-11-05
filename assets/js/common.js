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
    if (columnSlider) {
        new Swiper(columnSlider, {
            type: 'loop',
            slidesPerView: 'auto',
            spaceBetween: 20,
            navigation: {
                prevEl: '.el_topColumnSection_sliderNaviWrapper_btnPrev',
                nextEl: '.el_topColumnSection_sliderNaviWrapper_btnNext',
            },
        });
    }

    /*Splide*/
    const caseSlider = document.querySelector(".bl_caseSliderWrapper_slider");
    const options = {
        type: "loop", 
        arrows: false, 
        pagination: false, 
        drag:false, 
        gap: 20, 
        perPage: 4, 
        breakpoints: {
            500: {
                perPage: 1,  
            },
        },
        autoScroll: {
            speed: 0.5, 
            pauseOnHover: true, 
        },
    };

    if (caseSlider) {
        const splide = new Splide(caseSlider, options);
        splide.mount(window.splide.Extensions);
    }

    // アコーディオンアニメーション設定
    setUpAccordion();

});

/**
 * アニメーションライブラリ(GSAP)を使ってアコーディオンのアニメーションを制御します
 */
const setUpAccordion = () => {
    const detailsList = document.querySelectorAll(".bl_caseItem_details");
    const IS_OPENED_CLASS = "is-opened"; // アイコン操作用のクラス名

    detailsList.forEach((details) => {
        const summary = details.querySelector(".bl_caseItem_details_summary");
        const content = details.querySelector(".bl_caseItem_details_content");

        if (!summary || !content) return;

        summary.addEventListener("click", (event) => {
            // デフォルトの挙動を無効化
            event.preventDefault();

            // is-openedクラスの有無で判定（detailsのopen属性の判定だと、アニメーション完了を待つ必要がありタイミング的に不安定になるため）
            if (details.classList.contains(IS_OPENED_CLASS)) {
                // アコーディオンを閉じるときの処理
                // アイコン操作用クラスを切り替える(クラスを取り除く)
                details.classList.toggle(IS_OPENED_CLASS);
                // アニメーション実行
                closingAnim(content, details).restart();
            } else {
                // アコーディオンを開くときの処理
                // アイコン操作用クラスを切り替える(クラスを付与)
                details.classList.toggle(IS_OPENED_CLASS);
                // open属性を付与
                details.setAttribute("open", "true");
                // アニメーション実行
                openingAnim(content).restart();
            }
        });
    });
}

/**
 * アコーディオンを閉じる時のアニメーション
 * @param content {HTMLElement}
 * @param element {HTMLDetailsElement}
 */
const closingAnim = (content, element) => gsap.to(content, {
    height: 0,
    opacity: 0,
    duration: 0.4,
    ease: "power3.out",
    overwrite: true,
    onComplete: () => {
        // アニメーションの完了後にopen属性を取り除く
        element.removeAttribute("open");
    },
});

/**
 * アコーディオンを開く時のアニメーション
 * @param content {HTMLElement}
 */
const openingAnim = (content) => gsap.fromTo(
    content,
    {
        height: 0,
        opacity: 0,
    },
    {
        height: "auto",
        opacity: 1,
        duration: 0.4,
        ease: "power3.out",
        overwrite: true,
    });