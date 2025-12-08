document.addEventListener('DOMContentLoaded', function () {
    var thumbnails = new Splide('.bl_caseThumbnailSlide', {
        fixedWidth: 100,
        gap: 10,
        rewind: true,
        pagination: false,
        arrows: false,
        isNavigation: true,
    });

    var main = new Splide('.bl_caseImgSlide', {
        type: 'loop',
        perPage: 1,
        pagination: false,
        arrows: false,
    });

    main.sync(thumbnails);
    main.mount();
    thumbnails.mount();

    // カスタム矢印ボタンのイベントバインド
    var prevBtn = document.querySelector('.el_caseImgSlideNaviWrapper_btnPrev');
    var nextBtn = document.querySelector('.el_caseImgSlideNaviWrapper_btnNext');

    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            main.go('<');
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            main.go('>');
        });
    }
});