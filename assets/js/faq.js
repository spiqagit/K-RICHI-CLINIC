document.addEventListener('DOMContentLoaded', function() {
    // スムーズスクロール関数
    function smoothScrollToElement(targetId, callback) {
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
                y: offsetPosition - 150,
                duration: 0.5,
                ease: "power2.out",
                onUpdate: function() {
                    window.scrollTo(0, scrollObj.y);
                },
                onComplete: function() {
                    if (callback) {
                        callback(targetElement);
                    }
                }
            });
        }
    }


    // select要素の変更を監視
    const selectElements = document.querySelectorAll('.bl_commonSelectNaviWrapper_item_select');
    
    selectElements.forEach(function(select) {
        select.addEventListener('change', function() {
            const selectedValue = this.value;
            
            if (selectedValue && selectedValue.startsWith('#')) {
                const targetId = selectedValue.substring(1);
                
                // URLのハッシュを更新
                window.history.pushState(null, null, selectedValue);
                
                // スムーズスクロールして、完了後にdetailsを開く
                smoothScrollToElement(targetId);
            }
        });
    });
});
