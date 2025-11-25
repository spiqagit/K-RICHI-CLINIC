<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="bl_commonLowPageWhiteBg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWhiteMain">
        <div class="bl_commonLowPageWhiteMain_inner bl_concernContents">
            <div class="bl_concernUpper">
                <div class="bl_concernUpper_ttlWrapper">
                    <h1 class="bl_concernUpper_ttlWrapper_ttl">
                        <span class="el_concernUpper_ttlWrapper_ttl_main"><?php the_title(); ?></span>
                        <span class="el_concernUpper_ttlWrapper_ttl_sub">でお悩みの方へ</span>
                    </h1>
                    <?php if (get_the_post_thumbnail()) : ?>
                        <div class="bl_concernUpper_ttlWrapper_imgWrapper">
                            <img class="el_concernUpper_ttlWrapper_imgWrapper_img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (get_field('concern-txt')) : ?>
                    <div class="bl_concernTxtWrapper">
                        <p class="el_concernTxtWrapper_txt"><?php the_field('concern-txt'); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (get_field('menu_select')) : ?>
                <div class="bl_concernLower">
                    <div class="bl_concernLower_inner">
                        <?php foreach (get_field('menu_select') as $menu) : ?>
                            <a href="<?php echo get_permalink($menu); ?>" class="bl_menuCard">
                                <div class="bl_menuCard_inner">
                                    <?php if (get_the_post_thumbnail($menu)): ?>
                                        <img class="el_menuCard_inner_img" src="<?php echo get_the_post_thumbnail_url($menu->ID); ?>" alt="<?php echo get_the_title($menu->ID); ?>">
                                    <?php else: ?>
                                        <img class="el_menuCard_inner_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/concern/concern-noimg.jpg" alt="<?php echo get_the_title($menu->ID); ?>">
                                    <?php endif; ?>
                                    <div class="bl_menuCard_txtWrapper">
                                        <p class="el_menuCard_txtWrapper_ttl"><?php echo get_the_title($menu); ?></p>
                                        <?php if (get_field('menu-archive-txt', $menu)): ?>
                                            <p class="el_menuCard_txtWrapper_txt"><?php echo get_field('menu-archive-txt', $menu); ?></p>
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
            <?php endif; ?>
        </div>
        <div>
            <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>