<?php get_header('meta'); ?>

<?php
// Article構造化データを生成（著者/監修者情報含む）
$article_structured_data = array(
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => get_the_title(),
    'datePublished' => get_the_date('c'),
    'dateModified' => get_the_modified_date('c'),
    'mainEntityOfPage' => array(
        '@type' => 'WebPage',
        '@id' => get_permalink()
    )
);

// サムネイル画像
$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
if ($thumbnail_url) {
    $article_structured_data['image'] = $thumbnail_url;
}

// 監修者情報を取得
$supervisors_for_schema = get_terms(array(
    'taxonomy' => 'supervisor',
    'field' => 'slug',
    'hide_empty' => true,
));

if (!empty($supervisors_for_schema) && !is_wp_error($supervisors_for_schema)) {
    $authors = array();
    foreach ($supervisors_for_schema as $supervisor_schema) {
        $author_data = array(
            '@type' => 'Person',
            'name' => $supervisor_schema->name
        );

        // 役職
        $job_title = get_field('supervisor-job', 'supervisor_' . $supervisor_schema->term_id);
        if ($job_title) {
            $author_data['jobTitle'] = wp_strip_all_tags($job_title);
        }

        // プロフィール画像
        $author_image = get_field('supervisor-icon', 'supervisor_' . $supervisor_schema->term_id);
        if ($author_image) {
            $author_data['image'] = $author_image;
        }

        // プロフィール説明
        $author_description = get_field('supervisor-txt', 'supervisor_' . $supervisor_schema->term_id);
        if ($author_description) {
            $author_data['description'] = wp_strip_all_tags($author_description);
        }

        $authors[] = $author_data;
    }

    // 著者が1人の場合は配列ではなくオブジェクトとして設定
    if (count($authors) === 1) {
        $article_structured_data['author'] = $authors[0];
    } else {
        $article_structured_data['author'] = $authors;
    }
}

// 発行者情報（クリニック情報）
$article_structured_data['publisher'] = array(
    '@type' => 'Organization',
    'name' => get_bloginfo('name'),
    'logo' => array(
        '@type' => 'ImageObject',
        'url' => get_template_directory_uri() . '/assets/img/common/logo.svg'
    )
);
?>

<script type="application/ld+json">
<?php echo json_encode($article_structured_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

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


        <div class="bl_columnArticleWrapper_container">
            <article class="bl_newsArticleWrapper">
                <div class="bl_newsArticleWrapper_inner bl_commonArticleSection">
                    <?
                    $thumbnail = get_the_post_thumbnail_url();
                    if ($thumbnail) : ?>
                        <div class="bl_columnArticleWrapper_thumbnail">
                            <img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>">
                        </div>
                    <?php endif; ?>
                    <?php the_content(); ?>
                </div>
            </article>


            <?php
            $supervisors = get_terms(array(
                'taxonomy' => 'supervisor',
                'field' => 'slug',
                'hide_empty' => true,
            ));
            ?>
            <div class="bl_columnArticleInfoContainer">

                <?php if ($supervisors) : ?>
                    <div class="bl_columnArticleSpecialityWrapper">
                        <?php foreach ($supervisors as $supervisor) : ?>
                            <div class="bl_columnArticleSpecialityItem">
                                <div class="bl_columnArticleSpecialityWrapper_upper">
                                    <div class="bl_columnArticleSpecialityWrapper_upper_imgWrapper">
                                        <img class="el_columnArticleSpecialityWrapper_upper_imgWrapper_img" src="<?php echo get_field('supervisor-icon', 'supervisor_' . $supervisor->term_id); ?>" alt="<?php echo $supervisor->name; ?>">
                                    </div>
                                    <div class="bl_columnArticleSpecialityWrapper_upper_txtWrapper">
                                        <p class="el_columnArticleSpecialityWrapper_upper_txtWrapper_ttl">この記事の監修者</p>
                                        <p class="bl_columnArticleSpecialityWrapper_upper_txtWrapper_txt">
                                            <?php if (get_field('supervisor-job', 'supervisor_' . $supervisor->term_id)) : ?>
                                                <span class="el_columnArticleSpecialityWrapper_upper_txtWrapper_txt_job" s><?php echo get_field('supervisor-job', 'supervisor_' . $supervisor->term_id); ?></span>
                                            <?php endif; ?>
                                            <span class="el_columnArticleSpecialityWrapper_upper_txtWrapper_txt_name"><?php echo $supervisor->name; ?></span>
                                        </p>
                                    </div>
                                </div>
                                <?php if (get_field('supervisor-txt', 'supervisor_' . $supervisor->term_id)) : ?>
                                    <div class="bl_columnArticleSpecialityWrapper_lower">
                                        <p class="el_columnArticleSpecialityWrapper_lower_txt"><?php echo get_field('supervisor-txt', 'supervisor_' . $supervisor->term_id); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="bl_commonShareBtnWrapper">
                    <p class="el_commonShareBtnWrapper_ttl">記事をシェアする</p>

                    <div class="bl_commonShareBtnWrapper_btnWrapper">
                        <button type="button" class="bl_commonShareBtnWrapper_copyBtn js_copyLinkBtn" data-url="<?php echo esc_url(get_permalink()); ?>">リンクをコピー</button>
                        <div class="bl_copyToast js_copyToast">コピー完了</div>
                        <div class="bl_commonSnsIconContainer">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" class="bl_commonSnsIconContainer_btn" target="_blank" rel="noopener noreferrer">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/icon-facebook.svg" alt="Facebookでシェア">
                            </a>
                            <a href="https://social-plugins.line.me/lineit/share?url=<?php echo urlencode(get_permalink()); ?>" class="bl_commonSnsIconContainer_btn" target="_blank" rel="noopener noreferrer">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/line.svg" alt="LINEでシェア">
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" class="bl_commonSnsIconContainer_btn" target="_blank" rel="noopener noreferrer">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/x-icon.svg" alt="Xでシェア">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            ?>
            <nav class="bl_singlArrowNav">

                <?php if ($prev_post) : ?>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="bl_singlArrowNav_btn bl_singlArrowNav_prev">
                        <img class="el_singlArrowNav_btn_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/prev-arrow.svg" alt="">
                        <p class="el_singlArrowNav_btn_txt">前の記事</p>
                    </a>
                <?php endif; ?>

                <a href="<?php echo home_url('/column/'); ?>" class="bl_singlArrowNav_allViewBtn">一覧へ戻る</a>

                <?php if ($next_post) : ?>
                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="bl_singlArrowNav_btn bl_singlArrowNav_next">
                        <p class="el_singlArrowNav_btn_txt">次の記事へ</p>
                        <img class="el_singlArrowNav_btn_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/next-arrow.svg" alt="">
                    </a>
                <?php endif; ?>
            </nav>

            <?php
            $related_columns = get_posts(array(
                'post_type' => 'column',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'column-cat',
                        'field' => 'slug',
                        'terms' => get_the_terms(get_the_ID(), 'column-cat')[0]->slug,
                    ),
                ),
            ));
            ?>
            <?php if ($related_columns) : ?>
                <div class="bl_relatedColumnSection">
                    <h2 class="el_relatedColumnSection_ttl">関連コラム</h2>

                    <div class="bl_relatedColumnSection_list">

                        <?php foreach ($related_columns as $column) :
                            $column_id = $column->ID;
                            $column_title = get_the_title($column_id);
                            $column_thumbnail = get_the_post_thumbnail_url($column_id, 'full');
                            $column_date = get_the_date('Y.m.d', $column_id);
                            $column_cats = get_the_terms($column_id, 'column-cat');
                        ?>
                            <a href="<?php echo get_permalink($column_id); ?>" class="bl_columnBtnItem">
                                <div class="bl_columnBtnItem_inner">
                                    <div class="bl_columnBtnItem_imgWrapper">
                                        <?php if ($column_thumbnail) : ?>
                                            <img src="<?php echo esc_url($column_thumbnail); ?>" alt="<?php echo esc_attr($column_title); ?>">
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/column-nospot-img.jpg" alt="<?php echo esc_attr($column_title); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="bl_columnBtnItem_txtWrapper">
                                        <div class="bl_columnBtnItem_txtWrapper_upper">
                                            <div class="bl_columnBtnItem_postInfoWrapper">
                                                <p class="el_columnBtnItem_postInfoWrapper_date"><?php echo esc_html($column_date); ?></p>
                                                <?php if (!empty($column_cats) && !is_wp_error($column_cats)) : ?>
                                                    <div class="bl_columnBtnItem_postInfoWrapper_cats">
                                                        <?php foreach ($column_cats as $column_cat) : ?>
                                                            <p class="el_columnBtnItem_postInfoWrapper_cats_cat"><?php echo esc_html($column_cat->name); ?></p>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <p class="el_columnBtnItem_txtWrapper_ttl"><?php echo esc_html($column_title); ?></p>
                                        </div>
                                        <div class="bl_columnBtnItem_txtWrapper_arrow">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/clomun-arrow.svg" alt="">
                                        </div>
                                    </div>
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