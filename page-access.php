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

            <?php if (get_field('access-routetxt')  || have_rows('access-list')): ?>
                <div class="bl_commonLowPageWrapper_contents bl_accessContents_listContainer">
                    <div class="bl_commonLowPageWrapper_contents_inner">
                        <div class="bl_accessContents">
                            <?php if (get_field('access-routetxt')): ?>
                                <h2 class="el_accessContents_ttl"><?php echo get_field('access-routetxt'); ?></h2>
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
                    </div>
                </div>
            <?php endif; ?>


            <?php

            $mapClass = '';
            if (get_field('access-routetxt')  || have_rows('access-list')) {
                $mapClass = 'bl_accessContents_mapContainer';
            }else{
                $mapClass = 'bl_accessContents_mapContainer_noList';
            }

            ?>

            <div class="bl_commonLowPageWrapper_contents <?php echo $mapClass; ?>">
                <div class="bl_commonLowPageWrapper_contents_inner">
                    <div class="bl_footerClinicInfoContainer">
                        <div class="bl_footerClinicInfoWrapper">
                            <div class="bl_footerClinicInfoWrapper_logoContainer">
                                <div class="bl_footerClinicInfoWrapper_logo">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/logo.svg" alt="K-RICH Clinic">
                                </div>
                            </div>
                            <div class="bl_footerClinicInfoWrapper_addressContainer">
                                <div class="bl_footerClinicInfoWrapper_addressWrapper">
                                    <?php if (get_field('post-code', 'option')): ?>
                                        <p class="el_footerClinicInfoWrapper_numberTxt"><?php echo get_field('post-code', 'option'); ?></p>
                                    <?php endif; ?>
                                    <?php if (get_field('address', 'option')): ?>
                                        <p class="el_footerClinicInfoWrapper_addressTxt"><?php echo get_field('address', 'option'); ?></p>
                                    <?php endif; ?>
                                </div>

                                <?php if (get_field('google_map_link', 'option')): ?>
                                    <a href="<?php echo get_field('google_map_link', 'option'); ?>" class="bl_commonGoogleMapLink" target="_blank">
                                        <p class="el_commonGoogleMapLink_txt">Google Maps</p>
                                        <img class="el_commonGoogleMapLink_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/out-arrow.svg" alt="">
                                    </a>
                                <?php endif; ?>

                                <?php if (get_field('access-routetxt')): ?>
                                    <div class="bl_accessContents_routeContainer">
                                        <img class="el_accessContents_routeIcon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/train.svg" alt="">
                                        <p class="el_accessContents_routeTxt"><?php echo get_field('access-routetxt'); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="bl_footerClinicInfoWrapper_mapContainer">
                            <?php if (get_field('googlemap-code', 'option')): ?>
                                <?php echo get_field('googlemap-code', 'option'); ?>
                            <?php endif; ?>
                        </div>
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