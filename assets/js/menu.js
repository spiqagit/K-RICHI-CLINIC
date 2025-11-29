document.addEventListener('DOMContentLoaded', function () {
    const caseSlider = document.querySelector(".bl_meneCaseSlider");
    if (caseSlider) {
        var isOverflow = false;

        const caseSplide = new Splide(caseSlider, {});

        caseSplide.on('overflow', function (isOverflow) {
            // スライダーの位置をリセット
            caseSplide.go(0);

            caseSplide.options = {
                arrows: false,
                pagination: false,
                gap: 20,
                drag: isOverflow,
            }
        });


        caseSplide.mount();
    }
});