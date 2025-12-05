gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', function () {
    const breakPoint = 1024;
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

    // Swiper初期化
    const createSwiper = () => {
        if (topConcernSwiper) {
            if (topConcernSlide) topConcernSlide.destroy(true, true);
            topConcernSlide = new Swiper(topConcernSwiper, {
                slidesPerView: 'auto',
                slideHeight: 'auto',
                spaceBetween: 20,
            });
        }
        if (newsSwiper) {
            if (newsSlide) newsSlide.destroy(true, true);
            newsSlide = new Swiper(newsSwiper, {
                slidesPerView: 'auto',
            });
        }
        if (featuerSwiper) {
            if (featuerSlide) featuerSlide.destroy(true, true);
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

    // モバイルナビゲーション
    const initMobileNav = () => {
        if (!navBtn || !nav) return;

        if (window.innerWidth <= 1024) {
            gsap.set(nav, {
                opacity: 0,
                display: "none",
            });

            navBtn.addEventListener("click", () => {
                if (navBtn.dataset.animate === "animate") return;

                if (navBtn.classList.contains("is-active")) {
                    navBtn.dataset.animate = "animate";
                    navBtn.classList.remove("is-active");
                    document.documentElement.style.overflow = "auto";

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
                    navBtn.dataset.animate = "animate";
                    nav.style.display = "block";
                    navBtn.classList.add("is-active");
                    document.documentElement.style.overflow = "hidden";

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
        } else {
            nav.style.display = "";
            nav.style.opacity = "";
            navBtn.classList.remove("is-active");
        }
    };

    // ヘッダーホバー
    const initHeaderHover = () => {
        if (window.innerWidth <= 767) return;

        const hoverContainers = document.querySelectorAll(".bl_header_navWrapper_hoverContainer");
        hoverContainers.forEach((container) => {
            const linkContainer = container.querySelector(".bl_header_navWrapper_hoverContainer_linkContainer");
            if (!linkContainer) return;

            container.addEventListener("mouseenter", () => {
                linkContainer.style.opacity = "1";
                linkContainer.style.visibility = "visible";
            });

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

    // ケーススライダー
    const caseSlider = document.querySelector(".bl_caseSliderWrapper_slider");
    if (caseSlider) {
        const caseSplide = new Splide(caseSlider, {
            type: "loop",
            arrows: false,
            pagination: false,
            gap: 20,
            perPage: "auto",
            perMove: 1,
            focus: 0,
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

    // 絞り込みナビ
    const filterNaviList = document.querySelectorAll(".bl_commonSelectNaviWrapper");
    if (breakPoint <= window.innerWidth) {
        filterNaviList.forEach((filterNavi) => {
            const parentElement = filterNavi.closest(".ly_commonTwoColumnWrapper_inner");
            if (parentElement) {
                ScrollTrigger.create({
                    pin: true,
                    trigger: filterNavi,
                    startTrigger: parentElement,
                    start: "top-=120px top",
                    endTrigger: parentElement,
                    end: "bottom-=300px top",
                    pinSpacing: false,
                });
            }
        });
    }

    // About Mission Section Slider
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

    // About Information Section Slider
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
                autoStart: true,
                rewind: true,
            },
        });
        aboutInformationSectionSlide.mount(window.splide.Extensions);
    }
});

// アコーディオンクラス
class Accordion {
    constructor(options) {
        this.containerSelector = options.containerSelector;
        this.summarySelector = options.summarySelector;
        this.contentSelector = options.contentSelector;
        this.iconSelector = options.iconSelector || null;
        this.iconRotation = options.iconRotation || 180;
        this.iconDuration = options.iconDuration || 0.4;
        this.openedClass = options.openedClass || "is-opened";
        this.containers = [];
        this.init();
    }

    init() {
        const containerList = document.querySelectorAll(this.containerSelector);
        containerList.forEach((container) => {
            const accordionItem = this.createAccordionItem(container);
            if (accordionItem) {
                this.containers.push(accordionItem);
            }
        });
    }

    createAccordionItem(container) {
        const summary = container.querySelector(this.summarySelector);
        const content = container.querySelector(this.contentSelector);
        const icon = this.iconSelector ? container.querySelector(this.iconSelector) : null;

        if (!summary || !content) return null;

        if (icon) {
            gsap.set(icon, { rotation: 0 });
        }

        const accordionItem = {
            container: container,
            summary: summary,
            content: content,
            icon: icon,
            isOpen: false,
        };

        summary.addEventListener("click", (event) => {
            event.preventDefault();
            this.handleClick(accordionItem);
        });

        return accordionItem;
    }

    handleClick(item) {
        if (item.isOpen) {
            this.close(item);
        } else {
            this.open(item);
        }
    }

    open(item) {
        item.container.classList.add(this.openedClass);
        item.container.setAttribute("open", "true");
        item.isOpen = true;
        openingAnim(item.content).restart();

        if (item.icon) {
            gsap.to(item.icon, {
                rotation: this.iconRotation,
                duration: this.iconDuration,
                ease: "power3.out",
            });
        }
    }

    close(item) {
        item.container.classList.remove(this.openedClass);
        item.isOpen = false;
        closingAnim(item.content, item.container).restart();

        if (item.icon) {
            gsap.to(item.icon, {
                rotation: 0,
                duration: this.iconDuration,
                ease: "power3.out",
            });
        }
    }

    openAll() {
        this.containers.forEach((item) => {
            if (!item.isOpen) {
                this.open(item);
            }
        });
    }

    closeAll() {
        this.containers.forEach((item) => {
            if (item.isOpen) {
                this.close(item);
            }
        });
    }
}

const setUpAccordion = () => {
    new Accordion({
        containerSelector: ".bl_caseItem_details",
        summarySelector: ".bl_caseItem_details_summary",
        contentSelector: ".bl_caseItem_details_content",
    });

    new Accordion({
        containerSelector: ".bl_faqList_item_details",
        summarySelector: ".bl_faqList_item_details_summary",
        contentSelector: ".bl_faqList_details_content",
        iconSelector: ".el_faqList_item_details_summary_icon",
        iconRotation: 180,
        iconDuration: 0.4,
    });

    new Accordion({
        containerSelector: ".bl_jobCategorySection_list_item",
        summarySelector: ".bl_jobCategorySection_list_item_summary",
        contentSelector: ".bl_jobCategorySection_list_item_content",
        iconSelector: ".bl_jobCategorySection_list_item_summary_icon",
        iconRotation: 180,
        iconDuration: 0.4,
    });
};

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
    }
);
