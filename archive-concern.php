<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="bl_commonLowPagebg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWrapper">
        <div class="bl_commonLowPageWrapper_ttlContainer">
            <hgroup class="bl_commonLowPageWrapper_ttl">
                <h1 class="el_commonLowPageWrapper_ttl_en">Concern</h1>
                <p class="el_commonLowPageWrapper_ttl_ja"><span>お悩み一覧</span></p>
            </hgroup>
        </div>
        <div class="bl_commonLowPageWrapper_contentsOuter">
            <div class="bl_commonLowPageWrapper_contents">
                <div class="bl_commonLowPageWrapper_contents_inner">
                    <div class="bl_commonSingleColumnContainer bl_concernArchiveContents">
                        <?php
                        $concern_cats = get_terms([
                            'taxonomy' => 'concern-cat',
                            'post_type' => 'concern',
                            'orderby' => 'concern_order',
                            'order' => 'ASC',
                            'hide_empty' => true,
                        ]);
                        ?>
                        <?php if (!empty($concern_cats)) : ?>

                            <?php foreach ($concern_cats as $concern_cat) : ?>
                                <div class="bl_concernItem bl_fadeIn_item">
                                    <div class="bl_concernItem_upper">
                                        <div class="bl_concernItem_upper_imgWrapper">
                                            <img src="<?php echo get_field('concern-icon', 'concern-cat_' . $concern_cat->term_id); ?>" alt="<?php echo esc_html($concern_cat->name); ?>">
                                        </div>
                                        <div class="bl_concernItem_upper_txtWrapper">
                                            <p class="el_concernItem_upper_txtWrapper_txtEn"><?php echo get_field('concern-txt-en', 'concern-cat_' . $concern_cat->term_id); ?></p>
                                            <p class="el_concernItem_upper_txtWrapper_txtJa"><?php echo esc_html($concern_cat->name); ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    $concern_posts = get_posts([
                                        'post_type' => 'concern',
                                        'posts_per_page' => -1,
                                        'orderby' => 'concern_order',
                                        'order' => 'ASC',
                                        'tax_query' => [
                                            [
                                                'taxonomy' => 'concern-cat',
                                                'field' => 'term_id',
                                                'terms' => $concern_cat->term_id,
                                            ],
                                        ],
                                    ]);
                                    ?>
                                    <?php if (!empty($concern_posts)) : ?>
                                        <div class="bl_concernItem_lower">
                                            <ul class="bl_concernItem_postList">
                                                <?php foreach ($concern_posts as $concern_post) : ?>
                                                    <li class="bl_concernItem_postList_item">
                                                        <a class="bl_concernItem_postList_item_btn" href="<?php echo get_the_permalink($concern_post); ?>">
                                                            <p class="el_concernItem_postList_item_btn_txt"><?php echo get_the_title($concern_post); ?></p>
                                                            <img class="el_concernItem_postList_item_btn_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/open-arrow.svg" alt="">
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php else : ?>
                            <div class="">
                                <div class="bl_topNoPostContainer bl_fadeIn_item">
                                    <p class="bl_topNoPostContainer_txtEn">Coming soon...</p>
                                    <p class="bl_topNoPostContainer_txtJa">ただいま公開準備中です。</p>
                                </div>
                            </div>
                        <?php endif; ?>
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