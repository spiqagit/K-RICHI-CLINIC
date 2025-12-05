document.addEventListener('DOMContentLoaded', function () {
    const HEADER_OFFSET = 150;
    const menuArticleSection = document.querySelector('.bl_menuArticleSection');
    const navList = document.querySelector('.bl_menuArticle_navList');

    if (!menuArticleSection || !navList) return;

    const h2Elements = menuArticleSection.querySelectorAll('h2');
    if (h2Elements.length === 0) return;

    const sectionMap = new Map();
    navList.innerHTML = '';

    // ID生成関数
    const generateId = (index) => {
        return `ttl-${String(index).padStart(2, '0')}`;
    };

    // 目次項目生成関数
    const createNavItem = (text, id) => {
        const listItem = document.createElement('li');
        listItem.className = 'bl_menuArticle_contents_navListItem';

        const link = document.createElement('a');
        link.className = 'el_menuArticle_navListItem_link';
        link.href = `#${id}`;

        const linkText = document.createElement('span');
        linkText.className = 'el_menuArticle_navListItem_link_txt';
        linkText.textContent = text;

        link.appendChild(linkText);
        listItem.appendChild(link);
        return { listItem, link };
    };

    // スムーススクロール関数
    const smoothScrollTo = (element) => {
        const targetPosition = element.getBoundingClientRect().top + window.pageYOffset - HEADER_OFFSET;
        window.scrollTo({ top: targetPosition, behavior: 'smooth' });
    };

    // 目次生成
    h2Elements.forEach((h2, index) => {
        const h2Text = h2.textContent.trim();
        const id = generateId(index);
        h2.id = id;

        const { listItem, link } = createNavItem(h2Text, id);
        navList.appendChild(listItem);
        sectionMap.set(h2, link);

        link.addEventListener('click', (e) => {
            e.preventDefault();
            smoothScrollTo(h2);
        });
    });

    // Intersection Observerでアクティブセクションを監視
    const updateActiveSection = () => {
        const viewportCenter = window.innerHeight / 2 + HEADER_OFFSET;
        let activeSection = null;
        let minDistance = Infinity;

        // 画面中央付近にあるすべてのh2要素をチェック
        h2Elements.forEach((h2) => {
            const rect = h2.getBoundingClientRect();
            const elementTop = rect.top;

            // 画面中央より上にある要素で、かつ画面内に表示されているもの
            if (elementTop <= viewportCenter && elementTop >= -HEADER_OFFSET) {
                const distance = Math.abs(elementTop - (viewportCenter - HEADER_OFFSET));
                if (distance < minDistance) {
                    minDistance = distance;
                    activeSection = h2;
                }
            }
        });

        // アクティブセクションが見つからない場合、画面中央より下にある最初の要素を選択
        if (!activeSection) {
            h2Elements.forEach((h2) => {
                const rect = h2.getBoundingClientRect();
                if (rect.top > viewportCenter && rect.top < window.innerHeight) {
                    if (!activeSection || rect.top < activeSection.getBoundingClientRect().top) {
                        activeSection = h2;
                    }
                }
            });
        }

        sectionMap.forEach((link) => link.classList.remove('is-active'));
        if (activeSection) sectionMap.get(activeSection)?.classList.add('is-active');
    };

    const observer = new IntersectionObserver(updateActiveSection, {
        root: null,
        rootMargin: `-${HEADER_OFFSET}px 0px -50% 0px`,
        threshold: [0, 0.1, 0.5, 1]
    });

    h2Elements.forEach((h2) => observer.observe(h2));

    // スクロールイベントでも更新（Intersection Observerの補完として）
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                updateActiveSection();
                ticking = false;
            });
            ticking = true;
        }
    });

    // 症例スライダー
    const caseSlider = document.querySelector(".bl_meneCaseSlider");
    if (caseSlider) {
        const caseSplide = new Splide(caseSlider, {
            arrows: false,
            pagination: false,
            gap: 40
        });
        caseSplide.on('overflow', (isOverflow) => {
            caseSplide.go(0);
            caseSplide.options({ drag: isOverflow });
        });
        caseSplide.mount();
    }

    // 関連メニュースライダー
    const relatedPostSlider = document.querySelector(".bl_menuRelatedPostSlider");
    if (relatedPostSlider) {
        new Splide(relatedPostSlider, {
            type: "loop",
            arrows: false,
            pagination: false,
            autoWidth: true,
            perPage:  "auto",
            perMove: "auto",
            clones: 0,
            breakpoints: { 768: { destroy: false } }
        }).mount();
    }
});