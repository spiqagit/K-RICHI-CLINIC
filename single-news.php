<?php get_header('meta'); ?>
<?php wp_head(); ?>
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
</head>


<body class="bl_commonLowPageWhiteBg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWhiteMain">

        <div class="bl_commonLowPageWhiteMain_ttlWrapper">
            <p class="el_commonLowPageWhiteMain_ttl_date"><?php the_time('Y.m.d'); ?></p>
            <h1 class="el_commonLowPageWhiteMain_ttl"><?php the_title(); ?></h1>
        </div>


        <div class="bl_newsArticleWrapper_container">
            <article class="bl_newsArticleWrapper">
                <div class="bl_newsArticleWrapper_inner bl_commonArticleSection">
                    <?
                    $thumbnail = get_the_post_thumbnail_url();
                    if ($thumbnail) : ?>
                        <div class="bl_newsArticleWrapper_thumbnail">
                            <img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>">
                        </div>
                    <?php endif; ?>
                    <?php the_content(); ?>
                </div>
            </article>

            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            ?>
            <nav class="bl_singlArrowNav">

                <?php if ($prev_post) : ?>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="bl_singlArrowNav_btn bl_singlArrowNav_prev">
                        <img class="el_singlArrowNav_btn_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/prev-arrow.svg" alt="">
                        <p class="el_singlArrowNav_btn_txt">前の記事へ</p>
                    </a>
                <?php endif; ?>

                <a href="<?php echo home_url('/news/'); ?>" class="bl_singlArrowNav_allViewBtn">一覧へ戻る</a>

                <?php if ($next_post) : ?>
                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="bl_singlArrowNav_btn bl_singlArrowNav_next">
                        <p class="el_singlArrowNav_btn_txt">次の記事へ</p>
                        <img class="el_singlArrowNav_btn_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/next-arrow.svg" alt="">
                    </a>
                <?php endif; ?>
            </nav>
        </div>

        <div>
            <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
        </div>
    </main>

    <?php get_footer(); ?>

</body>

</html>