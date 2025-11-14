gsap.registerPlugin(ScrollTrigger);


const fadeIn = () => {

    const fadeInItems = document.querySelectorAll(".bl_fadeIn");

    fadeInItems.forEach(item => {
        const itemTtl = item.querySelector(".bl_commonSectionTtl");
        const itemTxtItemList = item.querySelectorAll(".bl_fadeIn_item");

        gsap.fromTo(itemTxtItemList, {
            opacity: 0,
            y: "80",
        },{
            opacity: 5,
            y: 0,
            duration:2,
            ease: "power1.out",
            stagger: 0.67,
            scrollTrigger: {
                trigger: item,
                start: 'top 60%', // アニメーションの開始位置の指定
            },
        });
    });
};

document.addEventListener('DOMContentLoaded', function () {
    fadeIn();
});

document.addEventListener('resize', function () {
    fadeIn();
});