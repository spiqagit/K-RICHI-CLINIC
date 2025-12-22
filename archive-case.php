<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="bl_commonLowPagebg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWrapper">
        <div class="bl_commonLowPageWrapper_ttlContainer">
            <hgroup class="bl_commonLowPageWrapper_ttl">
                <h1 class="el_commonLowPageWrapper_ttl_en">Case</h1>
                <p class="el_commonLowPageWrapper_ttl_ja"><span>症例</span></p>
            </hgroup>
        </div>
        <div class="bl_commonLowPageWrapper_contentsOuter">
            <div class="bl_commonLowPageWrapper_contents">
                <div class="bl_commonLowPageWrapper_contents_inner ly_caseColumnWrapper_inner">
                    <?php if (have_posts()): ?>
                        <div class="ly_commonTwoColumnWrapper">
                            <section class="ly_commonTwoColumnWrapper_inner">
                                <div class="ly_commonTwoColumnWrapper_left">
                                    <?php
                                    $menuCatList = get_terms(
                                        'department-cat',
                                        array(
                                            'parent' => 0,
                                            'hide_empty' => true,
                                            'orderby' => 'menu_order',
                                            'order' => 'ASC',
                                        )
                                    );

                                    $case_SelectList = array();
                                    $case_query = new WP_Query(array(
                                        'post_type' => 'case',
                                        'posts_per_page' => -1,
                                        'post_status' => 'publish',
                                    ));
                                    if ($case_query->have_posts()) {
                                        while ($case_query->have_posts()) {
                                            $case_query->the_post();
                                            $menu_select = get_field('menu_select');
                                            if (!empty($menu_select)) {
                                                foreach ($menu_select as $menu_id) {
                                                    $menu_id = is_object($menu_id) ? $menu_id->ID : $menu_id;
                                                    if (!in_array($menu_id, $case_SelectList)) {
                                                        $case_SelectList[] = $menu_id;
                                                    }
                                                }
                                            }
                                        }
                                        wp_reset_postdata();
                                    }
                                    ?>
                                    <?php if (!empty($menuCatList)) : ?>
                                        <nav class="bl_commonSelectNaviWrapper">
                                            <?php foreach ($menuCatList as $menuCat) : ?>
                                                <?php if (!empty($menuCat)): ?>
                                                    <?php
                                                    $menuPosts = get_posts(array(
                                                        'post_type' => 'menu',
                                                        'posts_per_page' => -1,
                                                        'tax_query' => array(
                                                            array(
                                                                'taxonomy' => 'department-cat',
                                                                'field' => 'term_id',
                                                                'terms' => $menuCat->term_id,
                                                            ),
                                                        ),
                                                        'post__in'  => $case_SelectList,
                                                    ));
                                                    ?>
                                                    <?php if (!empty($menuPosts)): ?>
                                                        <div class="bl_commonSelectNaviWrapper_item">
                                                            <label for="<?php echo $menuCat->slug; ?>Select" class="bl_commonSelectNaviWrapper_item_label"><?php echo $menuCat->name; ?></label>
                                                            <div class="bl_commonSelectNaviWrapper_selectWrapper">
                                                                <select name="<?php echo $menuCat->slug; ?>" id="<?php echo $menuCat->slug; ?>Select" class="bl_commonSelectNaviWrapper_item_select" onchange="if(this.value) window.location.href = '<?php echo home_url('/search-case/'); ?>?s=' + this.value;">
                                                                    <option value="">施術を選ぶ</option>
                                                                    <?php foreach ($menuPosts as $menuPost): ?>
                                                                        <option value="<?php echo $menuPost->ID; ?>"><?php echo get_the_title($menuPost->ID); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </nav>
                                    <?php endif; ?>
                                </div>
                                <div class="ly_commonTwoColumnWrapper_right">
                                    <div class="bl_casePostList">

                                        <?php while (have_posts()): the_post(); ?>
                                            <div class="bl_caseItem">
                                                <a href="<?php the_permalink(); ?>" class="bl_caseItem_linkWrapper">
                                                    <div class="bl_caseItem_imgWrapper">
                                                        <?php if (have_rows('slide')): ?>
                                                            <?php while (have_rows('slide')): the_row(); ?>
                                                                <img src="<?php the_sub_field('img'); ?>" alt="<?php the_title(); ?>">
                                                                <?php continue; ?>
                                                            <?php endwhile; ?>
                                                        <?php else: ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/news-no-post.jpg" alt="<?php the_title(); ?>">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="bl_caseItem_txtWrapper">
                                                        <div class="bl_caseItem_treatmentsWrapper">
                                                            <?php $treatments = get_field('menu_select'); ?>
                                                            <?php if (!empty($treatments)): ?>
                                                                <?php foreach ($treatments as $treatment): ?>
                                                                    <p class="bl_caseItem_treatmentsWrapper_txt">
                                                                        <?php echo get_the_title($treatment); ?>
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
                                        <?php endwhile; ?>
                                    </div>
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
                            </section>
                        </div>
                    <?php else: ?>
                        <div class="bl_commonNoPostWrapper">
                            <p class="bl_commonNoPostWrapper_txt">Coming soon...</p>
                            <p class="bl_commonNoPostWrapper_txtJa">ただいま公開準備中です。</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>