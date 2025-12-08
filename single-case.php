<?php get_header('meta'); ?>
<?php wp_head(); ?>
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
</head>


<body class="bl_commonLowPageWhiteBg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWhiteMain">

        <div class="bl_commonLowPageWhiteMain_ttlWrapper">
            <h1 class="el_commonLowPageWhiteMain_ttl"><?php the_title(); ?></h1>
        </div>

        <div class="bl_caseMainSection">
            <div class="bl_caseMainSection_inner">

                <article class="bl_caseArticleWrapper">
                    <div class="bl_caseLeftWrapper">
                        <div class="bl_caseImgSlieWrapper">
                            <div class="bl_caseMaiSlidenWrapper">
                                <button class="el_caseImgSlideNaviWrapper_btnPrev el_caseImgSlideNaviWrapper_btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="12" viewBox="0 0 21 12" fill="none">
                                        <path d="M7 0C7 0.636 6.35863 1.58571 5.70938 2.38286C4.87463 3.41143 3.87713 4.30886 2.7335 4.99371C1.876 5.50714 0.8365 6 0 6M0 6C0.8365 6 1.87688 6.49286 2.7335 7.00629C3.87713 7.692 4.87463 8.58943 5.70938 9.61629C6.35863 10.4143 7 11.3657 7 12M0 6H21" stroke="#1A0F04" />
                                    </svg>
                                </button>
                                <div class="splide bl_caseImgSlide" aria-label="症例画像スライダー">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            <?php if (have_rows('slide')): ?>
                                                <?php while (have_rows('slide')): the_row(); ?>
                                                    <li class="splide__slide">
                                                        <figure class="bl_caseImgSlide_item">
                                                            <img src="<?php the_sub_field('img'); ?>" alt="<?php the_title(); ?>">
                                                            <?php if (get_sub_field('caption')): ?>
                                                                <figcaption class="el_caseImgSlide_item_caption"><?php the_sub_field('caption'); ?></figcaption>
                                                            <?php endif; ?>
                                                        </figure>
                                                    </li>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <button class="el_caseImgSlideNaviWrapper_btnNext el_caseImgSlideNaviWrapper_btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="12" viewBox="0 0 21 12" fill="none">
                                        <path d="M14 0C14 0.636 14.6414 1.58571 15.2906 2.38286C16.1254 3.41143 17.1229 4.30886 18.2665 4.99371C19.124 5.50714 20.1635 6 21 6M21 6C20.1635 6 19.1231 6.49286 18.2665 7.00629C17.1229 7.692 16.1254 8.58943 15.2906 9.61629C14.6414 10.4143 14 11.3657 14 12M21 6H0" stroke="#1A0F04" />
                                    </svg>
                                </button>
                            </div>
                            <div class="splide bl_caseThumbnailSlide" aria-label="症例サムネイルスライダー">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        <?php if (have_rows('slide')): ?>
                                            <?php while (have_rows('slide')): the_row(); ?>
                                                <li class="splide__slide">
                                                    <img class="bl_caseThumbnailSlide_item" src="<?php the_sub_field('img'); ?>" alt="<?php the_title(); ?>">
                                                </li>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bl_commonArticleSection bl_caseRightWrapper">
                        <?php the_content(); ?>
                    </div>
                </article>


                <?php
                // 現在の投稿のmenu_select値を取得
                $current_menus = get_field('menu_select');
                $relatedPosts = array();

                if (!empty($current_menus)) {
                    // menu_selectが配列の場合、各メニューIDでOR検索
                    $meta_query = array('relation' => 'OR');
                    foreach ($current_menus as $menu) {
                        $menu_id = is_object($menu) ? $menu->ID : $menu;
                        $meta_query[] = array(
                            'key'     => 'menu_select',
                            'value'   => '"' . $menu_id . '"',
                            'compare' => 'LIKE'
                        );
                    }

                    $relatedPosts = get_posts(array(
                        'post_type'      => 'case',
                        'posts_per_page' => 4,
                        'post__not_in'   => array(get_the_ID()),
                        'meta_query'     => $meta_query
                    ));
                }
                ?>

                <?php if ($relatedPosts): ?>
                    <section class="bl_relatedCaseSection">
                        <div class="bl_relatedCaseSection_inner">
                            <h2 class="el_relatedCaseSection_ttl">関連症例</h2>
                            <div class="bl_relatedCaseSection_list">
                                <?php foreach ($relatedPosts as $post): setup_postdata($post); ?>
                                    <div class="bl_caseItem">
                                        <a href="<?php the_permalink(); ?>" class="bl_caseItem_linkWrapper">
                                            <div class="bl_caseItem_imgWrapper">
                                                <?php if (have_rows('slide')): ?>
                                                    <?php while (have_rows('slide')): the_row(); ?>
                                                        <img src="<?php the_sub_field('img'); ?>" alt="<?php the_title(); ?>">
                                                        <?php break; ?>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/news-nospot-img.jpg" alt="<?php the_title(); ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="bl_caseItem_txtWrapper">
                                                <div class="bl_caseItem_treatmentsWrapper">
                                                    <?php $treatments = get_field('menu_select'); ?>
                                                    <?php if (!empty($treatments)): ?>
                                                        <?php foreach ($treatments as $treatment): ?>
                                                            <p class="bl_caseItem_treatmentsWrapper_txt">
                                                                <?php echo is_object($treatment) ? $treatment->post_title : get_the_title($treatment); ?>
                                                            </p>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <p class="el_caseItem_ttl"><?php the_title(); ?></p>
                                            </div>
                                        </a>
                                        <?php
                                        $case_treatment = get_field('case-treatment');
                                        $case_time = get_field('case-time');
                                        $case_downtime = get_field('case-downtime');
                                        $case_makeup = get_field('case-makeup');
                                        $case_risk = get_field('case-risk');
                                        ?>
                                        <?php if (!empty($case_treatment) || !empty($case_time) || !empty($case_downtime) || !empty($case_makeup) || !empty($case_risk)): ?>
                                            <details class="bl_caseItem_details">
                                                <summary class="bl_caseItem_details_summary">
                                                    <span class="bl_caseItem_details_summary_txt">詳細を見る</span>
                                                    <span class="bl_caseItem_details_summary_icon"></span>
                                                </summary>
                                                <div class="bl_caseItem_details_content">
                                                    <div class="bl_caseItem_details_content_inner">
                                                        <?php if (!empty($case_treatment)): ?>
                                                            <dl class="bl_caseItem_details_content_item">
                                                                <dt class="bl_caseItem_details_content_item_dt">施術名</dt>
                                                                <dd class="bl_caseItem_details_content_item_dd">
                                                                    <?php echo $case_treatment; ?>
                                                                </dd>
                                                            </dl>
                                                        <?php endif; ?>

                                                        <?php if (!empty($case_time)): ?>
                                                            <dl class="bl_caseItem_details_content_item">
                                                                <dt class="bl_caseItem_details_content_item_dt">施術時間</dt>
                                                                <dd class="bl_caseItem_details_content_item_dd">
                                                                    <?php echo $case_time; ?>
                                                                </dd>
                                                            </dl>
                                                        <?php endif; ?>

                                                        <?php if (!empty($case_downtime)): ?>
                                                            <dl class="bl_caseItem_details_content_item">
                                                                <dt class="bl_caseItem_details_content_item_dt">ダウンタイム</dt>
                                                                <dd class="bl_caseItem_details_content_item_dd">
                                                                    <?php echo $case_downtime; ?>
                                                                </dd>
                                                            </dl>
                                                        <?php endif; ?>

                                                        <?php if (!empty($case_makeup)): ?>
                                                            <dl class="bl_caseItem_details_content_item">
                                                                <dt class="bl_caseItem_details_content_item_dt">メイク</dt>
                                                                <dd class="bl_caseItem_details_content_item_dd">
                                                                    <?php echo $case_makeup; ?>
                                                                </dd>
                                                            </dl>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </details>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
            </div>
        </div>

        <div>
            <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
        </div>
    </main>

    <?php get_footer(); ?>

</body>

</html>