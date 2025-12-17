<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="bl_commonLowPagebg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWrapper">
        <div class="bl_commonLowPageWrapper_ttlContainer">
            <hgroup class="bl_commonLowPageWrapper_ttl">
                <h1 class="el_commonLowPageWrapper_ttl_en">Column</h1>
                <p class="el_commonLowPageWrapper_ttl_ja"><span>コラム</span></p>
            </hgroup>
        </div>
        <div class="bl_commonLowPageWrapper_contentsOuter">
            <div class="bl_commonLowPageWrapper_contents">
                <div class="bl_commonLowPageWrapper_contents_inner">

                    <div class="ly_commonTwoColumnWrapper">

                        <section class="ly_commonTwoColumnWrapper_inner bl_newsArchiveWrapper">
                            <div class="ly_commonTwoColumnWrapper_left">

                                <nav class="bl_commonCatNavi bl_twoColumnNavi">
                                    <div class="bl_commonCatNavi_item">
                                        <h2 class="bl_commonCatNavi_item_ttl">Category</h2>
                                        <button class="bl_commonCatNavi_item_btn" type="button">
                                            <span>Category</span>
                                            <img class="bl_commonCatNavi_item_btn_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/pulldown-arrow.svg" alt="">
                                        </button>
                                        <div class="bl_commonCatNaviListWrapper">
                                            <ul class="bl_commonCatNaviList">
                                                <?php
                                                $column_cats = get_terms('column-cat', array('parent' => 0, 'hide_empty' => true));
                                                $current_term = get_queried_object();

                                                if ($column_cats) : ?>
                                                    <li class="bl_commonCatNaviItem">
                                                        <a href="<?php echo home_url('/column/'); ?>" class="bl_commonCatNaviItem_link">
                                                            全て
                                                        </a>
                                                    </li>
                                                    <?php foreach ($column_cats as $column_cat) : ?>
                                                        <li class="bl_commonCatNaviItem">
                                                            <?php if ($current_term && $current_term->term_id === $column_cat->term_id) : ?>
                                                                <p class="bl_commonCatNaviItem_link_current">
                                                                    <?php echo esc_html($column_cat->name); ?>
                                                                </p>
                                                            <?php else : ?>
                                                                <a href="<?php echo home_url(); ?>/column-cat/<?php echo $column_cat->slug; ?>" class="bl_commonCatNaviItem_link">
                                                                    <?php echo esc_html($column_cat->name); ?>
                                                                </a>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bl_commonCatNavi_item">
                                        <h2 class="bl_commonCatNavi_item_ttl">Timeline</h2>
                                        <button class="bl_commonCatNavi_item_btn" type="button">
                                            <span>Timeline</span>
                                            <img class="bl_commonCatNavi_item_btn_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/pulldown-arrow.svg" alt="">
                                        </button>
                                        <div class="bl_commonCatNaviListWrapper">
                                            <ul class="bl_commonCatNaviList">
                                                <?php
                                                global $wpdb;
                                                // カスタム投稿タイプを指定
                                                $post_type = 'column';

                                                // 年月の一覧を取得（過去12ヶ月分）
                                                $months = $wpdb->get_results($wpdb->prepare("
                                            SELECT DISTINCT 
                                                YEAR(post_date) AS year,
                                                MONTH(post_date) AS month,
                                                COUNT(*) AS post_count
                                            FROM {$wpdb->posts}
                                            WHERE post_type = %s
                                            AND post_status = 'publish'
                                            GROUP BY YEAR(post_date), MONTH(post_date)
                                            ORDER BY year DESC, month DESC
                                            LIMIT 12", $post_type));

                                                if ($months) : ?>
                                                    <li class="bl_commonCatNaviItem">
                                                        <a href="<?php echo home_url("/{$post_type}/"); ?>" class="bl_commonCatNaviItem_link">
                                                            全て
                                                        </a>
                                                    </li>
                                                    <?php foreach ($months as $month) : ?>
                                                        <?php
                                                        $year = $month->year;
                                                        $month_num = zeroise($month->month, 2); // 01, 02 形式
                                                        $url = home_url("/{$post_type}/{$year}/{$month_num}/");
                                                        ?>
                                                        <li class="bl_commonCatNaviItem">
                                                            <a href="<?php echo esc_url($url); ?>" class="bl_commonCatNaviItem_link">
                                                                <?php echo esc_html($year); ?>年<?php echo esc_html($month_num); ?>月
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>

                            <div class="ly_commonTwoColumnWrapper_right">
                                <div class="bl_columnArchiveOuter">
                                    <?php if (have_posts()) : ?>
                                        <ul class="bl_columnArchiveList">
                                            <?php while (have_posts()) : the_post(); ?>
                                                <li class="bl_columnArchiveItem">
                                                    <a href="<?php the_permalink(); ?>" class="bl_columnBtnItem">
                                                        <div class="bl_columnBtnItem_inner">
                                                            <div class="bl_columnBtnItem_imgWrapper">
                                                                <?php if (has_post_thumbnail()) : ?>
                                                                    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                                                                <?php else : ?>
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/column-nospot-img.jpg" alt="<?php the_title(); ?>">
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="bl_columnBtnItem_txtWrapper">
                                                                <div class="bl_columnBtnItem_txtWrapper_upper">
                                                                    <div class="bl_columnBtnItem_postInfoWrapper">
                                                                        <p class="el_columnBtnItem_postInfoWrapper_date"><?php echo get_the_date('Y.m.d'); ?></p>

                                                                        <?php
                                                                        $column_cats = get_the_terms(get_the_ID(), 'column-cat');
                                                                        ?>
                                                                        <?php if (!empty($column_cats)) : ?>
                                                                            <div class="bl_columnBtnItem_postInfoWrapper_cats">
                                                                                <?php foreach ($column_cats as $column_cat) : ?>
                                                                                    <p class="el_columnBtnItem_postInfoWrapper_cats_cat"><?php echo $column_cat->name; ?></p>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <p class="el_columnBtnItem_txtWrapper_ttl"><?php the_title(); ?></p>
                                                                </div>

                                                                <div class="bl_columnBtnItem_txtWrapper_arrow">
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/clomun-arrow.svg" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php endwhile; ?>
                                        </ul>
                                        <?php
                                        /**
                                         * ページネーション: 「123...10」形式
                                         * HTMLタグやクラス名を自由に編集できます
                                         */
                                        global $wp_query, $wp_rewrite;

                                        $total = $wp_query->max_num_pages;
                                        if ($total > 1) :
                                            $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
                                            $pagenum_link = html_entity_decode(get_pagenum_link());
                                            $url_parts = explode('?', $pagenum_link);

                                            // ベースURLとクエリ文字列を分離
                                            $base = trailingslashit($url_parts[0]) . '%_%';
                                            $format = $wp_rewrite->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

                                            // クエリ文字列がある場合は追加
                                            if (isset($url_parts[1])) {
                                                $format .= '&' . $url_parts[1];
                                            }

                                            // 前へボタンのURL
                                            $prev_url = ($paged > 1) ? str_replace(array('%_%', '%#%'), array($format, $paged - 1), $base) : '';

                                            // 次へボタンのURL
                                            $next_url = ($paged < $total) ? str_replace(array('%_%', '%#%'), array($format, $paged + 1), $base) : '';

                                            // 最初に表示するページ数（例: 3で「123」）
                                            $first_pages = 3;
                                            // 最後に表示するページ数（例: 1で「10」）
                                            $last_pages = 1;
                                        ?>
                                            <nav class="bl_pagination">
                                                <?php if ($paged > 1) : ?>
                                                    <a href="<?php echo esc_url($prev_url); ?>" class="bl_pagination_Btn bl_pagination_Btn_prev">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="12" viewBox="0 0 21 12" fill="none">
                                                            <path d="M7 0C7 0.636 6.35863 1.58571 5.70938 2.38286C4.87463 3.41143 3.87713 4.30886 2.7335 4.99371C1.876 5.50714 0.8365 6 0 6M0 6C0.8365 6 1.87688 6.49286 2.7335 7.00629C3.87713 7.692 4.87463 8.58943 5.70938 9.61629C6.35863 10.4143 7 11.3657 7 12M0 6H21" stroke="#1A0F04" />
                                                        </svg>
                                                    </a>
                                                <?php endif; ?>

                                                <ol class="bl_pagination_list">
                                                    <?php
                                                    // 最初のページ（1, 2, 3など）
                                                    for ($i = 1; $i <= min($first_pages, $total); $i++) {
                                                        $page_url = str_replace(array('%_%', '%#%'), array($format, $i), $base);
                                                        $is_current = ($i == $paged);
                                                    ?>
                                                        <li class="bl_pagination_item">
                                                            <?php if ($is_current) : ?>
                                                                <span class="bl_pagination_link bl_pagination_link_current"><?php echo $i; ?></span>
                                                            <?php else : ?>
                                                                <a href="<?php echo esc_url($page_url); ?>" class="bl_pagination_link"><?php echo $i; ?></a>
                                                            <?php endif; ?>
                                                        </li>
                                                        <?php
                                                    }

                                                    // 省略記号と最後のページ
                                                    if ($total > $first_pages + $last_pages) {
                                                        // 現在のページが最初のページ範囲内にある場合
                                                        if ($paged <= $first_pages) {
                                                            // 省略記号
                                                            if ($total > $first_pages + $last_pages + 1) {
                                                        ?>
                                                                <li class="bl_pagination_item">
                                                                    <span class="bl_pagination_link">…</span>
                                                                </li>
                                                            <?php
                                                            }
                                                            // 最後のページ
                                                            for ($i = $total - $last_pages + 1; $i <= $total; $i++) {
                                                                $page_url = str_replace(array('%_%', '%#%'), array($format, $i), $base);
                                                            ?>
                                                                <li class="bl_pagination_item">
                                                                    <a href="<?php echo esc_url($page_url); ?>" class="bl_pagination_link"><?php echo $i; ?></a>
                                                                </li>
                                                            <?php
                                                            }
                                                        }
                                                        // 現在のページが最後のページ範囲内にある場合
                                                        elseif ($paged >= $total - $last_pages + 1) {
                                                            // 省略記号
                                                            if ($total > $first_pages + $last_pages + 1) {
                                                            ?>
                                                                <li class="bl_pagination_item">
                                                                    <span class="bl_pagination_link">…</span>
                                                                </li>
                                                            <?php
                                                            }
                                                            // 最後のページ（現在のページも含む）
                                                            for ($i = $total - $last_pages + 1; $i <= $total; $i++) {
                                                                $page_url = str_replace(array('%_%', '%#%'), array($format, $i), $base);
                                                                $is_current = ($i == $paged);
                                                            ?>
                                                                <li class="bl_pagination_item">
                                                                    <?php if ($is_current) : ?>
                                                                        <span class="bl_pagination_link bl_pagination_link_current"><?php echo $i; ?></span>
                                                                    <?php else : ?>
                                                                        <a href="<?php echo esc_url($page_url); ?>" class="bl_pagination_link"><?php echo $i; ?></a>
                                                                    <?php endif; ?>
                                                                </li>
                                                            <?php
                                                            }
                                                        }
                                                        // 現在のページが中間にある場合
                                                        else {
                                                            // 最初の省略記号
                                                            if ($paged > $first_pages + 1) {
                                                            ?>
                                                                <li class="bl_pagination_item">
                                                                    <span class="bl_pagination_link">…</span>
                                                                </li>
                                                            <?php
                                                            }
                                                            // 現在のページ
                                                            $page_url = str_replace(array('%_%', '%#%'), array($format, $paged), $base);
                                                            ?>
                                                            <li class="bl_pagination_item">
                                                                <span class="bl_pagination_link bl_pagination_link_current"><?php echo $paged; ?></span>
                                                            </li>
                                                            <?php
                                                            // 最後の省略記号
                                                            if ($paged < $total - $last_pages) {
                                                            ?>
                                                                <li class="bl_pagination_item">
                                                                    <span class="bl_pagination_link">…</span>
                                                                </li>
                                                            <?php
                                                            }
                                                            // 最後のページ
                                                            for ($i = $total - $last_pages + 1; $i <= $total; $i++) {
                                                                $page_url = str_replace(array('%_%', '%#%'), array($format, $i), $base);
                                                            ?>
                                                                <li class="bl_pagination_item">
                                                                    <a href="<?php echo esc_url($page_url); ?>" class="bl_pagination_link"><?php echo $i; ?></a>
                                                                </li>
                                                            <?php
                                                            }
                                                        }
                                                    } else {
                                                        // 全ページを表示（省略記号不要）
                                                        for ($i = $first_pages + 1; $i <= $total; $i++) {
                                                            $page_url = str_replace(array('%_%', '%#%'), array($format, $i), $base);
                                                            $is_current = ($i == $paged);
                                                            ?>
                                                            <li class="bl_pagination_item">
                                                                <?php if ($is_current) : ?>
                                                                    <span class="bl_pagination_link bl_pagination_link_current"><?php echo $i; ?></span>
                                                                <?php else : ?>
                                                                    <a href="<?php echo esc_url($page_url); ?>" class="bl_pagination_link"><?php echo $i; ?></a>
                                                                <?php endif; ?>
                                                            </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </ol>

                                                <?php if ($paged < $total) : ?>
                                                    <a href="<?php echo esc_url($next_url); ?>" class="bl_pagination_Btn bl_pagination_Btn_next">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="12" viewBox="0 0 21 12" fill="none">
                                                            <path d="M14 0C14 0.636 14.6414 1.58571 15.2906 2.38286C16.1254 3.41143 17.1229 4.30886 18.2665 4.99371C19.124 5.50714 20.1635 6 21 6M21 6C20.1635 6 19.1231 6.49286 18.2665 7.00629C17.1229 7.692 16.1254 8.58943 15.2906 9.61629C14.6414 10.4143 14 11.3657 14 12M21 6H0" stroke="#1A0F04" />
                                                        </svg>
                                                    </a>
                                                <?php endif; ?>
                                            </nav>
                                        <?php endif; ?>
                                </div>
                            <?php else : ?>
                                <p class="bl_newsNoPost">該当する記事がありません。</p>
                            <?php endif; ?>
                            </div>
                        </section>

                    </div>
                    <div>
                        <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>

