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


        <div class="bl_commonLowPageWrapper_contentsOuter">

            <?php
            $staff_cats = get_terms([
                'taxonomy' => 'staff-cat',
                'orderby' => 'staff_order',
                'order' => 'ASC',
                'hide_empty' => true,
            ]);
            ?>

            <?php if (!empty($staff_cats)) :
                foreach ($staff_cats as $staff_cat) : ?>

                    <?php
                    $staff_posts = get_posts([
                        'post_type' => 'staff',
                        'posts_per_page' => -1,
                        'orderby' => 'staff_order',
                        'order' => 'ASC',
                        'tax_query' => [
                            [
                                'taxonomy' => 'staff-cat',
                                'field' => 'term_id',
                                'terms' => $staff_cat->term_id,
                            ],
                        ],
                    ]);
                    ?>

                    <?php if (!empty($staff_posts)) : ?>
                        <?php foreach ($staff_posts as $staff_post) : ?>
                            <div class="bl_commonLowPageWrapper_contents">
                                <div class="bl_commonLowPageWrapper_contents_inner">
                                    <div class="bl_doctorContentsWrapper">
                                        <div class="bl_doctorContentsWrapper_imgWrapper">
                                            <img src="<?php echo get_the_post_thumbnail_url($staff_post->ID); ?>" alt="<?php echo get_the_title($staff_post); ?>">
                                        </div>
                                        <div class="bl_doctorContentsWrapper_txtWrapper">
                                            <div class="bl_doctorContentsWrapper_nameWrapper">
                                                <p class="el_doctorContentsWrapper_nameWrapper_job"><?php echo $staff_cat->name; ?></p>
                                                <div class="bl_doctorContentsWrapper_nameWrapper_name">
                                                    <p class="el_doctorContentsWrapper_nameWrapper_name_first"><?php echo get_the_title($staff_post->ID); ?></p>
                                                    <p class="el_doctorContentsWrapper_nameWrapper_name_last"><?php echo get_field('staff-rubi', $staff_post->ID); ?></p>
                                                </div>
                                            </div>
                                            <div class="bl_doctorContentsWrapper_txtWrapper_txt">
                                                <?php echo get_field('director-txt', $staff_post->ID); ?>
                                            </div>

                                            <?php if (have_rows('career-list', $staff_post->ID)) : ?>
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
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
            <?php endforeach;
            endif; ?>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>