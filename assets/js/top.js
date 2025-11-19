gsap.registerPlugin(ScrollTrigger);

let fadeInScrollTriggers = [];

const fadeIn = () => {
    // 既存のScrollTriggerインスタンスをクリーンアップ
    fadeInScrollTriggers.forEach(trigger => {
        if (trigger) {
            trigger.kill();
        }
    });
    fadeInScrollTriggers = [];

    const fadeInItems = document.querySelectorAll(".bl_fadeIn");

    fadeInItems.forEach(item => {
        const itemTxtItemList = item.querySelectorAll(".bl_fadeIn_item");
        
        // 初期状態を明示的に設定
        gsap.set(itemTxtItemList, {
            opacity: 0,
            y: 45,
        });

        const animation = gsap.to(itemTxtItemList, {
            opacity: 1,
            y: 0,
            duration: 1.2,
            ease: "power1.out",
            stagger: 0.3,
            scrollTrigger: {
                trigger: item,
                start: 'top 60%', // アニメーションの開始位置の指定
                once: true, // アニメーションを1回だけ実行
            },
        });

        // ScrollTriggerインスタンスを保存
        if (animation.scrollTrigger) {
            fadeInScrollTriggers.push(animation.scrollTrigger);
        }
    });
};

document.addEventListener('DOMContentLoaded', function () {
    fadeIn();
});

