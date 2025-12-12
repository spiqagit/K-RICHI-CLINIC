<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="bl_commonLowPagebg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWrapper">
        <div class="bl_commonLowPageWrapper_ttlContainer">
            <hgroup class="bl_commonLowPageWrapper_ttl">
                <h1 class="el_commonLowPageWrapper_ttl_en">Treatment</h1>
                <p class="el_commonLowPageWrapper_ttl_ja"><span>施術メニュー</span></p>
            </hgroup>
        </div>
        <div class="bl_commonLowPageWrapper_contentsOuter">
            <div class="bl_commonLowPageWrapper_contents">
                <div class="bl_commonLowPageWrapper_contents_inner">

                    <section class="bl_menuArchive">
                        <div class="bl_menuArchive_inner">
                            <?php
                            $departmentCatList = get_terms(
                                'menu-cat',
                                array(
                                    'parent' => 0,
                                    'hide_empty' => true,
                                    'orderby' => 'menu_order',
                                    'order' => 'ASC',
                                )
                            );
                            ?>
                            <?php if (!empty($departmentCatList)) : ?>
                                <?php foreach ($departmentCatList as $departmentCat) : ?>
                                    <div class="bl_menuArchive_item" id="<?php echo esc_attr($departmentCat->slug); ?>">
                                        <div class="bl_menuArchive_item_upper">
                                            <div class="bl_bl_menuArchive_item_upper_txtWrapper" style="background-image: url('<?php echo get_field('menu-cat-banner', 'menu-cat_' . $departmentCat->term_id); ?>');">
                                                <div class="bl_bl_menuArchive_item_upper_txtWrapper_inner">
                                                    <h2 class="el_bl_menuArchive_item_upper_txtWrapper_inner_ttl"><?php echo $departmentCat->slug; ?></h2>
                                                    <p class="el_bl_menuArchive_item_upper_txtWrapper_inner_txt"><?php echo get_field('menu-cat-txt', 'menu-cat_' . $departmentCat->term_id); ?></p>
                                                </div>
                                            </div>
                                            <button type="button" class="bl_menuArchive_item_upper_btn">
                                                <span class="bl_menuArchive_item_upper_btn_txt">メニューを見る</span>
                                                <span class="bl_menuArchive_item_upper_btn_icon"></span>
                                            </button>
                                        </div>
                                        <div class="bl_menuArchive_item_lower">
                                            <?php
                                            $menuPosts = get_posts(array(
                                                'post_type' => 'menu',
                                                'posts_per_page' => -1,
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'menu-cat',
                                                        'field' => 'term_id',
                                                        'terms' => $departmentCat->term_id,
                                                    ),
                                                ),
                                            ));

                                            ?>
                                            <div class="bl_menuArchive_item_lower_inner">
                                                <ul class="bl_menuArchive_item_lower_list">
                                                    <?php foreach ($menuPosts as $menuPost): ?>
                                                        <li class="bl_menuArchive_item_lower_list_item">

                                                            <a href="<?php echo get_the_permalink($menuPost->ID); ?>" class="bl_menuArchive_item_lower_list_item_link">
                                                                <p class="el_menuArchive_item_lower_list_item_link_txt"><?php echo get_the_title($menuPost->ID); ?></p>
                                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-icon.svg" alt="">
                                                            </a>
                                                            
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </section>
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