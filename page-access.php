<?php

/**
 * Template Name: アクセス
 */
?>

<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="bl_commonLowPagebg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWrapper">
        <div class="bl_commonLowPageWrapper_ttlContainer">
            <hgroup class="bl_commonLowPageWrapper_ttl">
                <h1 class="el_commonLowPageWrapper_ttl_en">Access</h1>
                <p class="el_commonLowPageWrapper_ttl_ja"><span>アクセス</span></p>
            </hgroup>
        </div>
        <div class="bl_commonLowPageWrapper_contentsOuter">
            <div class="bl_commonLowPageWrapper_contents">
                <div class="bl_commonLowPageWrapper_contents_inner ">

                    <div class="bl_accessContents">
                        <?php if (get_field('access-ttl')): ?>
                            <h2 class="el_accessContents_ttl"><?php echo get_field('access-ttl'); ?></h2>
                        <?php endif; ?>


                        <?php if (have_rows('access-list')): ?>
                            <div class="bl_accessContents_list">
                                <?php while (have_rows('access-list')): the_row(); ?>
                                    <div class="bl_accessContents_list_item">

                                        <?php if (get_sub_field('access-list-img')): ?>
                                            <img class="bl_accessContents_list_item_img" src="<?php echo get_sub_field('access-list-img'); ?>" alt="<?php echo get_sub_field('access-list-txt'); ?>">
                                        <?php else: ?>
                                            <img class="bl_accessContents_list_item_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage.jpg" alt="<?php echo get_sub_field('access-list-txt'); ?>">
                                        <?php endif; ?>

                                        <p class="el_accessContents_list_item_txt"><?php echo get_sub_field('access-list-txt'); ?></p>
                                        
                                    </div>
                                <?php endwhile; ?>
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