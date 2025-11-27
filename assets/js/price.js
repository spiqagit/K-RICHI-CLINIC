document.addEventListener('DOMContentLoaded', function() {
    // URLのハッシュを取得
    const hash = window.location.hash;
    
    if (hash) {
        const targetId = hash.substring(1);
        
        // ページ読み込み完了後にスクロール
        setTimeout(() => {
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                // ヘッダーの高さを考慮したオフセット（必要に応じて調整）
                const headerOffset = 130; // ヘッダーの高さに合わせて調整
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                const startPosition = window.pageYOffset;
                
                // GSAPを使用したゆっくりとしたスムーズスクロール
                const scrollObj = { y: startPosition };
                gsap.to(scrollObj, {
                    y: offsetPosition,
                    duration: 0.5, // スクロールの速度（秒数）を調整可能（長いほどゆっくり）
                    ease: "power2.out",
                    onUpdate: function() {
                        window.scrollTo(0, scrollObj.y);
                    }
                });
            }
        }, 100);
    }
});

