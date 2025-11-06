document.addEventListener('DOMContentLoaded', function () {

    const breakPoint = 767;
    const newsSwiper = document.querySelector(".bl_newsSlider");
    const topConcernSwiper = document.querySelector(".bl_topConcernSwiper");
    const columnSlider = document.querySelector(".bl_topColumnSection_slider");
    const featuerSwiper = document.querySelector(".bl_featuerSection_list");
    const navBtn = document.querySelector(".bl_headerSpNavBtnWrapper_btn");
    const nav = document.querySelector(".bl_header_navWrapper_nav");
    
    let topConcernSlide = null;
    let newsSlide = null;
    let columnSlide = null;
    let featuerSlide = null;
    let swiperBool = false;
    let columnSwiperBool = false;
    let resizeTimer;

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
            if (!swiperBool) {
                createSwiper();
                swiperBool = true;
            }
        } else {
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

    const initAll = () => {
        initSwiper();
        initColumnSwiper();
    };

    const initMobileNav = () => {
        if (!navBtn || !nav) return;

        if (window.innerWidth <= 767) {
            gsap.set(nav, {
                opacity: 0,
                display: "none",
            });

            navBtn.addEventListener("click", () => {
                if (navBtn.dataset.animate === "animate") {
                    return;
                }

                if (navBtn.classList.contains("is-active")) {
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
        } else {
            nav.style.display = "";
            nav.style.opacity = "";
            navBtn.classList.remove("is-active");
        }
    };

    initAll();
    initMobileNav();

    window.addEventListener("load", initAll, false);

    window.addEventListener("resize", () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            const wasSwiperActive = swiperBool;
            if (wasSwiperActive) {
                destroySwiper();
                swiperBool = false;
            }
            initAll();
            initMobileNav();
        }, 100);
    }, false);

    const caseSlider = document.querySelector(".bl_caseSliderWrapper_slider");
    if (caseSlider) {
        const splide = new Splide(caseSlider, {
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
        });
        splide.mount(window.splide.Extensions);
    }

    setUpAccordion();

});

const setUpAccordion = () => {
    const detailsList = document.querySelectorAll(".bl_caseItem_details");
    const IS_OPENED_CLASS = "is-opened";

    detailsList.forEach((details) => {
        const summary = details.querySelector(".bl_caseItem_details_summary");
        const content = details.querySelector(".bl_caseItem_details_content");

        if (!summary || !content) return;

        summary.addEventListener("click", (event) => {
            event.preventDefault();

            if (details.classList.contains(IS_OPENED_CLASS)) {
                details.classList.toggle(IS_OPENED_CLASS);
                closingAnim(content, details).restart();
            } else {
                details.classList.toggle(IS_OPENED_CLASS);
                details.setAttribute("open", "true");
                openingAnim(content).restart();
            }
        });
    });
}

const closingAnim = (content, element) => gsap.to(content, {
    height: 0,
    opacity: 0,
    duration: 0.4,
    ease: "power3.out",
    overwrite: true,
    onComplete: () => {
        element.removeAttribute("open");
    },
});

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
            navBtn.classList.remove("is-active");

            gsap.to(nav, {
                opacity: 0,
                duration: 0.3,
                ease: "power2.out",
                onComplete: () => {

                    setTimeout(() => {
                        nav.style.display = "none";
                        navBtn.dataset.animate = "end";
                    }, 150);
                },
                });
        } else {
            // 開くアニメーション
            navBtn.dataset.animate = "animate";
            nav.style.display = "block";
            navBtn.classList.add("is-active");

            gsap.to(nav, {
                opacity: 1,
                duration: 0.3,
                ease: "power2.out",
                onComplete: () => {
                    navBtn.dataset.animate = "end";
                },
            });
        }
    });
}