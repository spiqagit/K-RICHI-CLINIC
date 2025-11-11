gsap.registerPlugin(ScrollTrigger);
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
                slideHeight: 'auto',
                spaceBetween: 20,
            });
        }

        if (newsSwiper) {
            if (newsSlide) {
                newsSlide.destroy(true, true);
            }
            newsSlide = new Swiper(newsSwiper, {
                slidesPerView: 'auto',
            });
        }

        if (featuerSwiper) {
            if (featuerSlide) {
                featuerSlide.destroy(true, true);
            }
            featuerSlide = new Swiper(featuerSwiper, {
                slidesPerView: 'auto',
                spaceBetween: 30,
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

    const initHeaderHover = () => {
        // PC版のみ動作（SP版ではCSSで常に表示されるため）
        if (window.innerWidth <= 767) return;

        const hoverContainers = document.querySelectorAll(".bl_header_navWrapper_hoverContainer");
        
        hoverContainers.forEach((container) => {
            const linkContainer = container.querySelector(".bl_header_navWrapper_hoverContainer_linkContainer");
            if (!linkContainer) return;

            // ホバーで表示
            container.addEventListener("mouseenter", () => {
                linkContainer.style.opacity = "1";
                linkContainer.style.visibility = "visible";
            });

            // ホバー解除で非表示
            container.addEventListener("mouseleave", () => {
                linkContainer.style.opacity = "0";
                linkContainer.style.visibility = "hidden";
            });
        });
    };

    initAll();
    initMobileNav();
    initHeaderHover();

    window.addEventListener("load", initAll, false);


    const caseSlider = document.querySelector(".bl_caseSliderWrapper_slider");
    if (caseSlider) {
        const caseSplide = new Splide(caseSlider, {
            type: "loop",
            arrows: false,
            pagination: false,
            gap: 20,
            perPage: "auto",
            perMove: 1, // 追加
            focus: 0, // 追加
            clones: 5,
            breakpoints: {
                500: {
                    perPage: 1,
                },
            },
            autoScroll: {
                speed: 0.5,
                pauseOnHover: true,
                rewind: false,
            },
        });
        caseSplide.mount(window.splide.Extensions);
    }

    setUpAccordion();


    //絞り込みナビ
    const filterNaviList = document.querySelectorAll(".bl_commonSelectNaviWrapper");

    if (breakPoint <= window.innerWidth) {
        filterNaviList.forEach((filterNavi) => {
            const parentElement = filterNavi.closest(".ly_commonTwoColumnWrapper_inner");
            if (parentElement) {
                ScrollTrigger.create({
                    pin: true, //トリガー要素を固定する
                    trigger: filterNavi,
                    startTrigger: parentElement,
                    start: "top-=120px top",
                    endTrigger: parentElement,
                    end: "bottom-=300px top", //親要素の下部ピッタリで終了
                    pinSpacing: false, //余白を追加しない（position: stickyのような動作）
                });
            }
        });
    }



    /*--------------------------------
    About Mission Section Slider
    ---------------------------------*/
    const aboutMissionSectionSlideItem = document.querySelector(".bl_aboutMissionSection_slider");
    if (aboutMissionSectionSlideItem) {
        const aboutMissionSectionSlide = new Splide(aboutMissionSectionSlideItem, {
            type: "loop",
            arrows: false,
            pagination: false,
            drag: false,
            gap: 20,
            clones: 3,
            perPage: "auto",
            autoScroll: {
                speed: 0.5,
                pauseOnHover: false,
            },
        });
        aboutMissionSectionSlide.mount(window.splide.Extensions);
    }

    /*--------------------------------
    About Information Section Slider
    ---------------------------------*/
    const aboutInformationSectionSlideItem = document.querySelector(".bl_aboutInformationSection_slider");
    if (aboutInformationSectionSlideItem) {
        const aboutInformationSectionSlide = new Splide(aboutInformationSectionSlideItem, {
            type: "loop",
            arrows: false,
            pagination: false,
            drag: false,
            gap: 20,
            clones: 5,
            perPage: 1,
            autoScroll: {
                speed: 0.5,
                pauseOnHover: false,
                autoStart: true, // 追加
                rewind: true, // 追加
            },
        });
        aboutInformationSectionSlide.mount(window.splide.Extensions);
    }

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


