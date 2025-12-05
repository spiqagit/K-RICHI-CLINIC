<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body>

    <?php get_header(); ?>

    <main class="bl_menuArticleMain">
        <article class="bl_menuArticle">

            <div class="bl_menuArticle_ttlContainer">
                <div class="bl_menuArticle_ttlContainer_inner">
                    <hgroup class="bl_menuArticle_ttl">
                        <p class="el_menuArticle_ttl_en"><?php the_field('menu-en-txt'); ?></p>
                        <h1 class="el_menuArticle_ttl_ttl"><?php the_title(); ?></h1>
                    </hgroup>

                    <div class="bl_menuArticle_thumbnail">
                        <?php if (has_post_thumbnail()): ?>
                            <img class="el_menuArticle_thumbnail_img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        <?php else: ?>
                            <img class="el_menuArticle_thumbnail_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/concern/concern-noimg.jpg" alt="">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="bl_menuArticle_contents">
                <div class="bl_menuArticle_contents_inner">

                    <div class="bl_menuArticle_contents_navContainer">
                        <div class="bl_menuArticle_contents_navWrapper">
                            <p class="el_menuArticle_contents_navWrapper_ttl">Index</p>
                            <nav class="bl_menuArticle_navListWrapper">
                                <ul class="bl_menuArticle_navList">
                                    <li class="bl_menuArticle_navListItem">
                                        <a class="el_menuArticle_navListItem_link" href="">
                                            <span class="el_menuArticle_navListItem_link_txt">施術メニュー</span>
                                        </a>
                                    </li>
                                    <li class="bl_menuArticle_contents_navListItem">
                                        <a class="el_menuArticle_navListItem_link" href=""><span class="el_menuArticle_navListItem_link_txt">こんな方におすすめ</span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="bl_menuArticleSection">
                        <div class="bl_commonArticleSection">
                            <?php the_content(); ?>
                        </div>
                        <div class="bl_menuArticleInfoSection">
                            <?php
                            $current_menu_id = get_the_ID();
                            $priceList = get_posts(array(
                                'post_type' => 'price',
                                'posts_per_page' => -1,
                                'meta_query' => array(
                                    array(
                                        'key' => 'menu_select',
                                        'value' => '"' . $current_menu_id . '"',
                                        'compare' => 'LIKE'
                                    )
                                )
                            ));
                            ?>
                            <?php if (!empty($priceList)) : ?>
                                <?php foreach ($priceList as $price) : ?>
                                    <?php $price_id = $price->ID; ?>
                                    <section class="bl_menuArticleInfoSection_item">
                                        <h2 class="el_menuArticleInfoSection_item_ttl">料金表</h2>

                                        <div class="bl_priceChildList_postList">
                                            <div class="bl_priceChildList_postList_item">
                                                <h3 class="el_priceChildList_postList_item_ttl" id="post<?php echo $price_id; ?>">
                                                    <?php echo get_the_title($price_id); ?>
                                                </h3>

                                                <?php if (have_rows('price_wrap', $price_id)): ?>
                                                    <ul class="bl_priceWrapList">
                                                        <?php while (have_rows('price_wrap', $price_id)): the_row(); ?>
                                                            <li class="bl_priceWrapList_item">
                                                                <?php if (get_sub_field('price_wrap-ttl')): ?>
                                                                    <p class="el_priceWrapList_item_ttl"><?php the_sub_field('price_wrap-ttl'); ?></p>
                                                                <?php endif; ?>

                                                                <?php if (have_rows('price_table', $price_id)): ?>
                                                                    <ul class="bl_priceTableList">
                                                                        <?php while (have_rows('price_table', $price_id)): the_row(); ?>
                                                                            <li class="bl_priceTableList_item">
                                                                                <?php if (get_sub_field('price_table-ttl')): ?>
                                                                                    <p class="el_priceTableList_item_ttl_txt"><?php the_sub_field('price_table-ttl'); ?></p>
                                                                                <?php endif; ?>

                                                                                <?php if (have_rows('amount-table', $price_id)): ?>
                                                                                    <ul class="bl_amountTableList">
                                                                                        <?php while (have_rows('amount-table', $price_id)): the_row(); ?>
                                                                                            <li class="bl_amountTableList_item">
                                                                                                <?php
                                                                                                $amountTxt = get_sub_field('amount-table_txt');
                                                                                                if (!empty($amountTxt)) :
                                                                                                ?>
                                                                                                    <p class="el_amountTableList_item_txt"><?php echo esc_html($amountTxt); ?></p>
                                                                                                <?php endif; ?>

                                                                                                <?php
                                                                                                $amountView = get_sub_field('amount-table_view');
                                                                                                if (!empty($amountView)) :
                                                                                                ?>
                                                                                                    <p class="el_amountTableList_item_view"><?php echo esc_html($amountView); ?></p>
                                                                                                <?php endif; ?>

                                                                                                <?php
                                                                                                $amountNum = get_sub_field('amount-table_num');
                                                                                                if (!empty($amountNum)) :
                                                                                                ?>
                                                                                                    <p class="el_amountTableList_item_num"><?php echo esc_html($amountNum); ?></p>
                                                                                                <?php endif; ?>
                                                                                            </li>
                                                                                        <?php endwhile; ?>
                                                                                    </ul>
                                                                                <?php endif; ?>
                                                                            </li>
                                                                        <?php endwhile; ?>
                                                                    </ul>
                                                                <?php endif; ?>

                                                                <?php if (get_sub_field('price-caption')): ?>
                                                                    <div class="el_priceWrapList_item_caption"><?php the_sub_field('price-caption'); ?></div>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endwhile; ?>
                                                    </ul>
                                                <?php endif; ?>
                                                <p class="el_priceWrapList_item_caution">表記は全て税込価格です。</p>
                                            </div>
                                        </div>
                                    </section>
                                <?php endforeach; ?>
                            <?php endif; ?>


                            <?php
                            $caseList = get_posts(array(
                                'post_type' => 'case',
                                'posts_per_page' => -1,
                                'meta_query' => array(
                                    array(
                                        'key' => 'menu_select',
                                        'value' => '"' . $current_menu_id . '"',
                                        'compare' => 'LIKE'
                                    )
                                )
                            ));
                            ?>
                            <?php if (!empty($caseList)) : ?>
                                <section class="bl_menuArticleInfoSection_item">
                                    <h2 class="el_menuArticleInfoSection_item_ttl">症例写真</h2>
                                    <div class="bl_caseSliderWrapper">
                                        <div class="splide bl_meneCaseSlider">
                                            <div class="splide__track bl_fadeIn_item">
                                                <div class="splide__list">
                                                    <?php foreach ($caseList as $case_post) : ?>
                                                        <?php setup_postdata($case_post); ?>
                                                        <div class="splide__slide">
                                                            <div class="bl_caseItem">
                                                                <a href="<?php echo get_permalink($case_post->ID); ?>" class="bl_caseItem_linkWrapper">
                                                                    <div class="bl_caseItem_imgWrapper">
                                                                        <?php
                                                                        $slide_img = '';
                                                                        if (have_rows('slide', $case_post->ID)):
                                                                            while (have_rows('slide', $case_post->ID)): the_row();
                                                                                $slide_img = get_sub_field('img');
                                                                                break;
                                                                            endwhile;
                                                                        endif;
                                                                        ?>
                                                                        <?php if ($slide_img): ?>
                                                                            <img src="<?php echo esc_url($slide_img); ?>" alt="<?php echo esc_attr(get_the_title($case_post->ID)); ?>">
                                                                        <?php else: ?>
                                                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/news-no-post.jpg" alt="<?php echo esc_attr(get_the_title($case_post->ID)); ?>">
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="bl_caseItem_txtWrapper">
                                                                        <div class="bl_caseItem_treatmentsWrapper">
                                                                            <?php
                                                                            $treatments = get_field('menu_select', $case_post->ID);
                                                                            if (!empty($treatments)):
                                                                                foreach ($treatments as $treatment):
                                                                                    $treatment_id = is_object($treatment) ? $treatment->ID : $treatment;
                                                                            ?>
                                                                                    <p class="bl_caseItem_treatmentsWrapper_txt">
                                                                                        <?php echo esc_html(get_the_title($treatment_id)); ?>
                                                                                    </p>
                                                                            <?php
                                                                                endforeach;
                                                                            endif;
                                                                            ?>
                                                                        </div>
                                                                        <p class="el_caseItem_ttl"><?php echo esc_html(get_the_title($case_post->ID)); ?></p>
                                                                    </div>
                                                                </a>
                                                                <?php
                                                                $case_treatment = get_field('case-treatment', $case_post->ID);
                                                                $case_time = get_field('case-time', $case_post->ID);
                                                                $case_downtime = get_field('case-downtime', $case_post->ID);
                                                                $case_makeup = get_field('case-makeup', $case_post->ID);
                                                                $case_risk = get_field('case-risk', $case_post->ID);
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
                                                                                        <dd class="bl_caseItem_details_content_item_dd"><?php echo esc_html($case_treatment); ?></dd>
                                                                                    </dl>
                                                                                <?php endif; ?>
                                                                                <?php if (!empty($case_time)): ?>
                                                                                    <dl class="bl_caseItem_details_content_item">
                                                                                        <dt class="bl_caseItem_details_content_item_dt">施術時間</dt>
                                                                                        <dd class="bl_caseItem_details_content_item_dd"><?php echo esc_html($case_time); ?></dd>
                                                                                    </dl>
                                                                                <?php endif; ?>
                                                                                <?php if (!empty($case_downtime)): ?>
                                                                                    <dl class="bl_caseItem_details_content_item">
                                                                                        <dt class="bl_caseItem_details_content_item_dt">ダウンタイム</dt>
                                                                                        <dd class="bl_caseItem_details_content_item_dd"><?php echo esc_html($case_downtime); ?></dd>
                                                                                    </dl>
                                                                                <?php endif; ?>
                                                                                <?php if (!empty($case_makeup)): ?>
                                                                                    <dl class="bl_caseItem_details_content_item">
                                                                                        <dt class="bl_caseItem_details_content_item_dt">メイク</dt>
                                                                                        <dd class="bl_caseItem_details_content_item_dd"><?php echo esc_html($case_makeup); ?></dd>
                                                                                    </dl>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </details>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <?php wp_reset_postdata(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bl_commonAllviewBtnWrapper">
                                        <a href="<?php echo home_url(); ?>/case/" class="bl_commonAllviewBtn">
                                            <p class="el_commonAllviewBtn_txt">View more</p>
                                            <div class="el_commonAllviewBtn_arrow">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/white-arrow.svg" alt="">
                                            </div>
                                        </a>
                                    </div>
                                </section>
                            <?php endif; ?>

                            <?php if (have_rows('menu-faq-list')): ?>
                                <section class="bl_menuArticleInfoSection_item">
                                    <h2 class="el_menuArticleInfoSection_item_ttl">よくある質問</h2>
                                    <ul class="bl_faqList">
                                        <?php while (have_rows('menu-faq-list')):
                                            the_row(); ?>
                                            <li class="bl_faqList_item">
                                                <details class="bl_faqList_item_details">
                                                    <summary class="bl_faqList_item_details_summary">
                                                        <span class="el_faqList_item_details_summary_txt_q">Q.</span>
                                                        <span class="el_faqList_item_details_summary_txt"><?php the_sub_field('menu-faq-list-q'); ?></span>
                                                        <img class="el_faqList_item_details_summary_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/faq-arrow.svg" alt="">
                                                    </summary>
                                                    <div class="bl_faqList_details_content">
                                                        <div class="bl_faqList_details_content_inner">
                                                            <p class="el_faqList_details_content_ttl">A.</p>
                                                            <p class="el_faqList_details_content_txt"><?php the_sub_field('menu-faq-list-a'); ?></p>
                                                        </div>
                                                    </div>
                                                </details>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </section>
                            <?php endif; ?>


                            <?php if (have_rows('menu-faq-list')): ?>
                                <section class="bl_menuArticleInfoSection_item">
                                    <h2 class="el_menuArticleInfoSection_item_ttl">基本情報</h2>
                                    <table class="bl_menuInfoTable">
                                        <?php while (have_rows('menu-info-table')): the_row(); ?>
                                            <tr class="bl_menuInfoTable_tr">
                                                <th class="el_menuInfoTable_th"><?php the_sub_field('menu-info-table-th'); ?></th>
                                                <td class="el_menuInfoTable_td"><?php the_sub_field('menu-info-table-td'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </table>
                                </section>
                            <?php endif; ?>

                            <?php if (get_field('menu-related-post')): ?>
                                <section class="bl_menuArticleInfoSection_item">
                                    <h2 class="el_menuArticleInfoSection_item_ttl">組み合わせ施術</h2>

                                    <div class="bl_menuRelatedPostList">
                                        <?php
                                        $related_menu_ids = get_field('menu-related-post');
                                        if (!empty($related_menu_ids)) {
                                            // ACFのrelationshipフィールドからID配列を取得
                                            $ids = array();
                                            foreach ($related_menu_ids as $related_menu) {
                                                $ids[] = is_object($related_menu) ? $related_menu->ID : $related_menu;
                                            }
                                            $related_menu_list = get_posts(array(
                                                'post_type' => 'menu',
                                                'posts_per_page' => -1,
                                                'post__in' => $ids,
                                                'orderby' => 'post__in'
                                            ));
                                        } else {
                                            $related_menu_list = array();
                                        }
                                        ?>
                                        <div class="bl_menuRelatedPostList_inner">
                                            <?php foreach ($related_menu_list as $menu) : ?>
                                                <a href="<?php echo get_permalink($menu->ID); ?>" class="bl_menuCard">
                                                    <div class="bl_menuCard_inner">
                                                        <?php if (has_post_thumbnail($menu->ID)): ?>
                                                            <img class="el_menuCard_inner_img" src="<?php echo get_the_post_thumbnail_url($menu->ID); ?>" alt="<?php echo esc_attr(get_the_title($menu->ID)); ?>">
                                                        <?php else: ?>
                                                            <img class="el_menuCard_inner_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/concern/concern-noimg.jpg" alt="<?php echo esc_attr(get_the_title($menu->ID)); ?>">
                                                        <?php endif; ?>
                                                        <div class="bl_menuCard_txtWrapper">
                                                            <p class="el_menuCard_txtWrapper_ttl"><?php echo esc_html(get_the_title($menu->ID)); ?></p>
                                                            <?php if (get_field('menu-archive-txt', $menu->ID)): ?>
                                                                <p class="el_menuCard_txtWrapper_txt"><?php echo esc_html(get_field('menu-archive-txt', $menu->ID)); ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="bl_menuCard_arrowWrapper">
                                                        <img class="el_menuCard_arrowWrapper_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/black-arrow.svg" alt="">
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                </section>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo home_url(); ?>/treatment/" class="bl_menuArticle_backAllbtn">一覧へ戻る</a>
                    </div>
                </div>
            </div>
            <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
        </article>

    </main>

    <?php get_footer(); ?>
</body>

</html>