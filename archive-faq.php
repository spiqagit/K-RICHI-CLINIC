<?php get_header('meta'); ?>

<?php
// FAQリッチリザルト用の構造化データを生成
$faq_structured_data = array(
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array()
);

$faq_catParentList_for_schema = get_terms('faq-cat', array('parent' => 0, 'hide_empty' => true));

if (!empty($faq_catParentList_for_schema)) {
    foreach ($faq_catParentList_for_schema as $faq_catParent_schema) {
        $faq_catChildList_for_schema = get_terms('faq-cat', array(
            'parent' => $faq_catParent_schema->term_id,
            'hide_empty' => true
        ));

        if (!empty($faq_catChildList_for_schema)) {
            foreach ($faq_catChildList_for_schema as $faq_catChild_schema) {
                $faq_posts_for_schema = get_posts(array(
                    'post_type' => 'faq',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'faq-cat',
                            'field' => 'term_id',
                            'terms' => $faq_catChild_schema->term_id,
                        ),
                    ),
                ));

                if (!empty($faq_posts_for_schema)) {
                    foreach ($faq_posts_for_schema as $faq_post_schema) {
                        $question = get_the_title($faq_post_schema);
                        $answer = get_field('faqarchive-txt', $faq_post_schema->ID);

                        if (!empty($question) && !empty($answer)) {
                            $faq_structured_data['mainEntity'][] = array(
                                '@type' => 'Question',
                                'name' => wp_strip_all_tags($question),
                                'acceptedAnswer' => array(
                                    '@type' => 'Answer',
                                    'text' => wp_strip_all_tags($answer)
                                )
                            );
                        }
                    }
                }
            }
        }
    }
    wp_reset_postdata();
}
?>

<?php if (!empty($faq_structured_data['mainEntity'])) : ?>
<script type="application/ld+json">
<?php echo json_encode($faq_structured_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body class="bl_commonLowPagebg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWrapper">
        <div class="bl_commonLowPageWrapper_ttlContainer">
            <hgroup class="bl_commonLowPageWrapper_ttl">
                <h1 class="el_commonLowPageWrapper_ttl_en">FAQ</h1>
                <p class="el_commonLowPageWrapper_ttl_ja"><span>よくある質問</span></p>
            </hgroup>
        </div>

        <div class="bl_commonLowPageWrapper_contentsOuter">
            <div class="bl_commonLowPageWrapper_contents">
                <div class="bl_commonLowPageWrapper_contents_inner">

                    <div class="ly_commonTwoColumnWrapper ly_priceColumnWrapper">

                        <section class="ly_commonTwoColumnWrapper_inner ly_priceColumnWrapper_inner">
                            <div class="ly_commonTwoColumnWrapper_left">
                                <?php
                                $parent_catList = get_terms('faq-cat', array('parent' => 0, 'hide_empty' => true));
                                ?>
                                <?php if (!empty($parent_catList)) : ?>
                                    <nav class="bl_commonSelectNaviWrapper">
                                        <?php foreach ($parent_catList as $parent_cat) : ?>

                                            <div class="bl_commonSelectNaviWrapper_item">
                                                <label for="<?php echo $parent_cat->slug; ?>Select" class="bl_commonSelectNaviWrapper_item_label"><?php echo $parent_cat->name; ?></label>
                                                <div class="bl_commonSelectNaviWrapper_selectWrapper">
                                                    <select name="<?php echo $parent_cat->slug; ?>" id="<?php echo $parent_cat->slug; ?>Select" class="bl_commonSelectNaviWrapper_item_select">
                                                        <option value="">施術を選ぶ</option>
                                                        <?php
                                                        $price_SelectList = get_posts(array(
                                                            'post_type' => 'faq',
                                                            'posts_per_page' => -1,
                                                            'tax_query' => array(
                                                                array(
                                                                    'taxonomy' => 'faq-cat',
                                                                    'field' => 'term_id',
                                                                    'terms' => $parent_cat->term_id,
                                                                ),
                                                            ),
                                                        ));
                                                        ?>
                                                        <?php if (!empty($price_SelectList)) : ?>
                                                            <?php foreach ($price_SelectList as $price_Select) : ?>
                                                                <option value="#post<?php echo $price_Select->ID; ?>"><?php echo get_the_title($price_Select); ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        <?php wp_reset_postdata(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </nav>
                                <?php endif; ?>
                            </div>

                            <div class="ly_commonTwoColumnWrapper_right bl_faqContentsWrapper_container">

                                <?php
                                $faq_catParentList = get_terms(
                                    'faq-cat',
                                    array(
                                        'parent' => 0,
                                        'hide_empty' => true
                                    )
                                );
                                ?>

                                <?php if (!empty($faq_catParentList)) : ?>
                                    <?php foreach ($faq_catParentList as $faq_catParent) : ?>
                                        <div class="bl_faqContentsWrapper">
                                            <h2 class="el_faqContentsWrapper_ttl"><?php echo $faq_catParent->name; ?></h2>

                                            <?php
                                            $faq_catChildList = get_terms(
                                                'faq-cat',
                                                array(
                                                    'parent' => $faq_catParent->term_id,
                                                    'hide_empty' => true
                                                )
                                            );
                                            ?>
                                            <?php if (!empty($faq_catChildList)) : ?>
                                                <?php foreach ($faq_catChildList as $faq_catChild) : ?>
                                                    <div class="bl_faqContentsWrapper_item">
                                                        <h3 class="el_faqContentsWrapper_item_ttl"><?php echo $faq_catChild->name; ?></h3>

                                                        <?php
                                                        $faq_catChildList = get_posts(array(
                                                            'post_type' => 'faq',
                                                            'posts_per_page' => -1,
                                                            'tax_query' => array(
                                                                array(
                                                                    'taxonomy' => 'faq-cat',
                                                                    'field' => 'term_id',
                                                                    'terms' => $faq_catChild->term_id,
                                                                ),
                                                            ),
                                                        ));
                                                        ?>
                                                        <?php if (!empty($faq_catChildList)) : ?>
                                                            <ul>
                                                                <?php foreach ($faq_catChildList as $faq_catChild) : ?>
                                                                    <li>
                                                                        <details class="bl_faqList_item_details" id="post<?php echo $faq_catChild->ID; ?>">
                                                                            <summary class="bl_faqList_item_details_summary">
                                                                                <span class="el_faqList_item_details_summary_txt_q">Q.</span>
                                                                                <span class="el_faqList_item_details_summary_txt"><?php echo get_the_title($faq_catChild); ?></span>
                                                                                <img class="el_faqList_item_details_summary_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/faq-arrow.svg" alt="">
                                                                            </summary>
                                                                            <div class="bl_faqList_details_content">
                                                                                <div class="bl_faqList_details_content_inner">
                                                                                    <p class="el_faqList_details_content_ttl">A.</p>
                                                                                    <p class="el_faqList_details_content_txt"><?php echo get_field("faqarchive-txt"); ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </details>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </section>

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