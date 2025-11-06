document.addEventListener('DOMContentLoaded', function () {

    var breakPoint = 767; // ブレークポイントを設定（underSPと一致）
    const newsSwiper = document.querySelector(".bl_newsSlider");
    const topConcernSwiper = document.querySelector(".bl_topConcernSwiper");
    const columnSlider = document.querySelector(".bl_topColumnSection_slider");
    const featuerSwiper = document.querySelector(".bl_featuerSection_list");
    let topConcernSlide = null;
    let newsSlide = null;
    let columnSlide = null;
    let featuerSlide = null;
    let swiperBool = false;
    let columnSwiperBool = false;

    const createSwiper = () => {
        if (topConcernSwiper) {
            if (topConcernSlide) {
                topConcernSlide.destroy(true, true);
            }
            topConcernSlide = new Swiper(topConcernSwiper, {
                slidesPerView: 'auto',
                spaceBetween: 20,
                freeMode: {
                    enabled: true,
                    sticky: false,
                },
            });
        }

        if (newsSwiper) {
            if (newsSlide) {
                newsSlide.destroy(true, true);
            }
            newsSlide = new Swiper(newsSwiper, {
                slidesPerView: 'auto',
                freeMode: {
                    enabled: true,
                    sticky: false,
                },

            });
        }

        if (featuerSwiper) {
            if (featuerSlide) {
                featuerSlide.destroy(true, true);
            }
            featuerSlide = new Swiper(featuerSwiper, {
                slidesPerView: 'auto',
                spaceBetween: 30,
                freeMode: {
                    enabled: true,
                    sticky: false,
                },
                resistance: true,
                resistanceRatio: 0,
            });
        }
    };

    const createColumnSwiper = () => {
        if (columnSlider) {
            columnSlide = new Swiper(columnSlider, {
                slidesPerView: 'auto',
                spaceBetween: 20,
                navigation: {
                    prevEl: '.el_topColumnSection_sliderNaviWrapper_btnPrev',
                    nextEl: '.el_topColumnSection_sliderNaviWrapper_btnNext',
                },
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
        if (featuerSlide) {
            featuerSlide.destroy(false, true);
            featuerSlide = null;
        }
    };

    const destroyColumnSwiper = () => {
        if (columnSlide) {
            columnSlide.destroy(false, true);
            columnSlide = null;
        }
    };

    const initSwiper = () => {
        if (breakPoint >= window.innerWidth) {
            // SP版（767px以下）: スライダーを初期化
            if (!swiperBool) {
                createSwiper();
                swiperBool = true;
            }
        } else {
            // PC版（768px以上）: スライダーを破棄
            if (swiperBool) {
                destroySwiper();
                swiperBool = false;
            }
        }
    };

    const initColumnSwiper = () => {
        if (!columnSwiperBool) {
            createColumnSwiper();
            columnSwiperBool = true;
        }
    };

    window.addEventListener(
        "load",
        () => {
            initSwiper();
            initColumnSwiper();
        },
        false
    );

    let resizeTimer;
    window.addEventListener(
        "resize",
        () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                // リサイズ時に状態をリセットして再初期化
                const wasSwiperActive = swiperBool;
                if (wasSwiperActive) {
                    destroySwiper();
                    swiperBool = false;
                }
                initSwiper();
            }, 100);
        },
        false
    );

    // DOMContentLoaded時にも初期化を試みる
    initSwiper();
    initColumnSwiper();

    /*Splide*/
    const caseSlider = document.querySelector(".bl_caseSliderWrapper_slider");
    const options = {
        type: "loop",
        arrows: false,
        pagination: false,
        drag: false,
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




/*モバイルナビゲーション開閉アニメーション
----------------------------------------------*/
const navBtn = document.querySelector(".bl_headerSpNavBtnWrapper_btn");
const nav = document.querySelector(".bl_header_navWrapper_nav");

if (window.innerWidth <= 767) {

    gsap.set(nav, {
        opacity: 0,
        display: "none",
    });

    navBtn.addEventListener("click", () => {
        // アニメーション中は処理をスキップ
        if (navBtn.dataset.animate === "animate") {
            return;
        }

        if (navBtn.classList.contains("is-active")) {
            // 閉じるアニメーション
            navBtn.dataset.animate = "animate";

            gsap.to(nav, {
                opacity: 0,
                duration: 0.3,
                ease: "power2.out",
                onComplete: () => {

                    setTimeout(() => {
                        navBtn.classList.remove("is-active");
                        nav.style.display = "none";
                        navBtn.dataset.animate = "end";
                    }, 150);
                },
                });
        } else {
            // 開くアニメーション
            navBtn.dataset.animate = "animate";
            nav.style.display = "block";

            gsap.to(nav, {
                opacity: 1,
                duration: 0.3,
                ease: "power2.out",
                onComplete: () => {
                    navBtn.classList.add("is-active");
                    navBtn.dataset.animate = "end";
                },
            });
        }
    });
}