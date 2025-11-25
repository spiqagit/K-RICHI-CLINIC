<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="bl_commonLowPagebg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWrapper">

        <div class="bl_commonLowPageWrapper_ttlContainer">
            <hgroup class="bl_commonLowPageWrapper_ttl">
                <h1 class="el_commonLowPageWrapper_ttl_en">Staff</h1>
                <p class="el_commonLowPageWrapper_ttl_ja"><span>スタッフ</span></p>
            </hgroup>
        </div>


        <div class="bl_commonLowPageWrapper_contentsOuter bl_staffContentsOuter">

            <?php
            $staff_cats = get_terms([
                'taxonomy' => 'staff-cat',
                'orderby' => 'staff_order',
                'order' => 'ASC',
                'hide_empty' => true,
                'parent' => 0,
            ]);

            $staff_cat_count = count($staff_cats);
            $i = 1;
            ?>
            <?php if (!empty($staff_cats)) : ?>

                <?php foreach ($staff_cats as $staff_cat) : ?>

                    <div class="bl_commonLowPageWrapper_contents bl_staffContents">
                        <div class="bl_commonLowPageWrapper_contents_inner">

                            <hgroup class="bl_staffContents_ttl">
                                <h2 class="el_staffContents_ttl_en"><?php echo $staff_cat->slug; ?></h2>
                                <p class="el_staffContents_ttl_ja"><?php echo $staff_cat->name; ?></p>
                            </hgroup>

                            <?php
                            $staff_posts = get_posts([
                                'post_type' => 'staff',
                                'posts_per_page' => -1,
                                'orderby' => 'staff_order',
                                'order' => 'ASC',
                                'tax_query' => [
                                    [
                                        'taxonomy' => 'staff-cat',
                                        'field' => 'slug',
                                        'terms' => $staff_cat->slug,
                                    ],
                                ],
                            ]);
                            ?>

                            <?php if (!empty($staff_posts)) : ?>
                                <div class="bl_staffContents_postList">
                                    <?php foreach ($staff_posts as $staff_post) : ?>
                                        <div class="bl_doctorContentsWrapper">
                                            <div class="bl_doctorContentsWrapper_imgWrapper">
                                                <?php if (has_post_thumbnail($staff_post->ID)) : ?>
                                                    <img src="<?php echo get_the_post_thumbnail_url($staff_post->ID); ?>" alt="<?php echo get_the_title($staff_post); ?>">
                                                <?php else : ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/staff/staff-noimg.jpg" alt="<?php echo get_the_title($staff_post); ?>">
                                                <?php endif; ?>

                                            </div>
                                            <div class="bl_doctorContentsWrapper_txtWrapper">
                                                <div class="bl_doctorContentsWrapper_nameWrapper">
                                                    <p class="el_doctorContentsWrapper_nameWrapper_job">
                                                        <?php $terms = get_terms(
                                                            'staff-cat',
                                                            array(
                                                                'parent' => $staff_cat->term_id,
                                                                'hide_empty' => true,
                                                                'orderby' => 'staff_order',
                                                                'order' => 'ASC',
                                                            )
                                                        ); ?>
                                                        <?php foreach ($terms as $term) : ?>
                                                            <?php echo $term->name; ?>
                                                        <?php endforeach; ?>
                                                    </p>
                                                    <div class="bl_doctorContentsWrapper_nameWrapper_name">
                                                        <p class="el_doctorContentsWrapper_nameWrapper_name_first"><?php echo get_the_title($staff_post->ID); ?></p>
                                                        <p class="el_doctorContentsWrapper_nameWrapper_name_last"><?php echo get_field('staff-rubi', $staff_post->ID); ?></p>
                                                    </div>
                                                </div>

                                                <?php if (get_field('director-txt', $staff_post->ID)) : //医師紹介
                                                ?>
                                                    <div class="bl_doctorContentsWrapper_txtWrapper_txt">
                                                        <?php echo get_field('director-txt', $staff_post->ID); ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (have_rows('career-list', $staff_post->ID)) : //経歴
                                                ?>
                                                    <div class="bl_doctorContentsWrapper_careerWrapper">
                                                        <p class="bl_doctorContentsWrapper_careerWrapper_ttl">経歴</p>
                                                        <ul class="bl_doctorContentsWrapper_careerWrapper_list">
                                                            <?php while (have_rows('career-list', $staff_post->ID)) : the_row(); ?>
                                                                <li class="bl_doctorContentsWrapper_careerWrapper_list_item">
                                                                    <?php if (get_sub_field('career-list-year')) : ?>
                                                                        <p class="bl_doctorContentsWrapper_careerWrapper_list_item_ttl"><?php the_sub_field('career-list-year'); ?></p>
                                                                    <?php endif; ?>
                                                                    <?php if (get_sub_field('career-list-txt')) : ?>
                                                                        <p class="bl_doctorContentsWrapper_careerWrapper_list_item_txt"><?php the_sub_field('career-list-txt'); ?></p>
                                                                    <?php endif; ?>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>


                                                <?php if (have_rows('license-list', $staff_post->ID)) : //資格
                                                ?>
                                                    <div class="bl_doctorContentsWrapper_careerWrapper">
                                                        <p class="bl_doctorContentsWrapper_careerWrapper_ttl">資格</p>
                                                        <ul class="bl_doctorContentsWrapper_careerWrapper_list">
                                                            <?php while (have_rows('license-list', $staff_post->ID)) : the_row(); ?>
                                                                <li class="bl_doctorContentsWrapper_careerWrapper_list_item">
                                                                    <?php if (get_sub_field('license-list-txt')) : ?>
                                                                        <p class="bl_doctorContentsWrapper_careerWrapper_list_item_txt"><?php the_sub_field('license-list-txt'); ?></p>
                                                                    <?php endif; ?>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (get_field('nursse-txt', $staff_post->ID)) : //看護師紹介
                                                ?>
                                                    <div class="bl_nurseContentsWrapper">
                                                        <p class="el_nurseContentsWrapper_txt"> <?php echo get_field('nursse-txt', $staff_post->ID); ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php wp_reset_postdata(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if ($i == $staff_cat_count) : ?>
                            <div>
                                <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php $i++;
                endforeach; ?>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>