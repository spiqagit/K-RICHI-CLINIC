<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="bl_commonLowPagebg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWrapper">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="bl_commonLowPageWrapper_ttlContainer">
            <hgroup class="bl_commonLowPageWrapper_ttl">
                <h1 class="el_commonLowPageWrapper_ttl_en">Price</h1>
                <p class="el_commonLowPageWrapper_ttl_ja"><span>料金表</span></p>
            </hgroup>
        </div>
        <div class="bl_commonLowPageWrapper_contentsOuter">
            <div class="bl_commonLowPageWrapper_contents">
                <div class="bl_commonLowPageWrapper_contents_inner">

                    <div class="ly_commonTwoColumnWrapper ly_priceColumnWrapper">

                        <section class="ly_commonTwoColumnWrapper_inner ly_priceColumnWrapper_inner">
                            <div class="ly_commonTwoColumnWrapper_left">
                                <?php
                                $parent_catList = get_terms('price-cat', array('parent' => 0, 'hide_empty' => true));
                                $current_post_id = get_the_ID();
                                ?>
                                <?php if (!empty($parent_catList)) : ?>
                                    <nav class="bl_commonSelectNaviWrapper">
                                    <?php foreach ($parent_catList as $parent_cat) : ?>
                                        
                                            <div class="bl_commonSelectNaviWrapper_item">
                                                <label for="<?php echo $parent_cat->slug; ?>Select" class="bl_commonSelectNaviWrapper_item_label"><?php echo $parent_cat->name; ?></label>
                                                <div class="bl_commonSelectNaviWrapper_selectWrapper">
                                                    <select name="<?php echo $parent_cat->slug; ?>" id="<?php echo $parent_cat->slug; ?>Select" class="bl_commonSelectNaviWrapper_item_select" onchange="<?php echo esc_js('if(this.value) window.location.href = this.value;'); ?>">
                                                        <option value="">施術を選ぶ</option>
                                                        <?php
                                                        $price_SelectList = get_posts(array(
                                                            'post_type' => 'price',
                                                            'tax_query' => array(
                                                                array(
                                                                    'taxonomy' => 'price-cat',
                                                                    'field' => 'term_id',
                                                                    'terms' => $parent_cat->term_id,
                                                                ),
                                                            ),
                                                        ));
                                                        ?>
                                                        <?php if (!empty($price_SelectList)) : ?>
                                                            <?php foreach ($price_SelectList as $price_Select) : ?>
                                                                <option value="<?php echo esc_url(get_permalink($price_Select->ID)); ?>" <?php selected($price_Select->ID, $current_post_id); ?>><?php echo get_the_title($price_Select); ?></option>
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

                            <div class="ly_commonTwoColumnWrapper_right ly_priceContentsWrapper">
                                <?php
                                // 現在の投稿が属するカテゴリーを取得
                                $current_post_terms = get_the_terms(get_the_ID(), 'price-cat');
                                $current_post_id = get_the_ID();
                                
                                if (!empty($current_post_terms) && !is_wp_error($current_post_terms)) {
                                    // 最初のカテゴリーを使用（複数ある場合は最初のもの）
                                    $current_term = $current_post_terms[0];
                                    
                                    // 親カテゴリーを取得
                                    $parent_term_id = $current_term->parent;
                                    if ($parent_term_id == 0) {
                                        // 親カテゴリーがない場合（親カテゴリー自体）
                                        $parent_term = $current_term;
                                    } else {
                                        // 親カテゴリーがある場合
                                        $parent_term = get_term($parent_term_id, 'price-cat');
                                    }
                                    
                                    if ($parent_term && !is_wp_error($parent_term)) :
                                ?>
                                        <div class="bl_priceContentsWrapper_item">
                                            <h2 class="el_priceContentsWrapper_item_ttl">
                                                <?php echo $parent_term->name; ?>
                                            </h2>

                                            <?php
                                            // 現在の投稿が属する子カテゴリーを取得
                                            $child_term = null;
                                            foreach ($current_post_terms as $term) {
                                                if ($term->parent == $parent_term->term_id) {
                                                    $child_term = $term;
                                                    break;
                                                }
                                            }
                                            ?>
                                            <?php if ($child_term) : ?>
                                                <div class="bl_priceChildList">
                                                    <h3 class="el_priceChildList_ttl"><?php echo $child_term->name; ?></h3>

                                                    <div class="bl_priceChildList_postList">
                                                        <div class="bl_priceChildList_postList_item">
                                                            <h4 class="el_priceChildList_postList_item_ttl">
                                                                <?php the_title(); ?>
                                                            </h4>

                                                            <?php if (have_rows('price_wrap')): ?>
                                                                <ul class="bl_priceWrapList">
                                                                    <?php while (have_rows('price_wrap')): the_row(); ?>

                                                                        <li class="bl_priceWrapList_item">
                                                                            <?php if (get_sub_field('price_wrap-ttl')): ?>
                                                                            <p class="el_priceWrapList_item_ttl"><?php the_sub_field('price_wrap-ttl'); ?></p>
                                                                            <?php endif; ?>

                                                                            <?php if (have_rows('price_table')): ?>

                                                                                <ul class="bl_priceTableList">
                                                                                    <?php while (have_rows('price_table')): the_row(); ?>

                                                                                        <li class="bl_priceTableList_item">

                                                                                            <?php if (get_sub_field('price_table-ttl')): ?>
                                                                                                <p class="el_priceTableList_item_ttl_txt"><?php the_sub_field('price_table-ttl'); ?></p>
                                                                                            <?php endif; ?>

                                                                                            <?php if (have_rows('amount-table')): ?>
                                                                                                <ul class="bl_amountTableList">
                                                                                                    <?php while (have_rows('amount-table')): the_row(); ?>
                                                                                                        <li class="bl_amountTableList_item">
                                                                                                            <?php
                                                                                                            $amountTxt = get_sub_field('amount-table_txt');
                                                                                                            ?>
                                                                                                            <?php if (!empty($amountTxt)) : ?>
                                                                                                                <p class="el_amountTableList_item_txt"><?php echo $amountTxt; ?></p>
                                                                                                            <?php endif; ?>

                                                                                                            <?php
                                                                                                            $amountView = get_sub_field('amount-table_view', get_the_ID());
                                                                                                            ?>
                                                                                                            <?php if (!empty($amountView)) : ?>
                                                                                                                <p class="el_amountTableList_item_view"><?php echo $amountView; ?></p>
                                                                                                            <?php endif; ?>

                                                                                                            <?php
                                                                                                            $amountNum = get_sub_field('amount-table_num', get_the_ID());
                                                                                                            ?>
                                                                                                            <?php if (!empty($amountNum)) : ?>
                                                                                                                <p class="el_amountTableList_item_num"><?php echo $amountNum; ?></p>
                                                                                                            <?php endif; ?>

                                                                                                        </li>
                                                                                                    <?php endwhile; ?>
                                                                                                </ul>
                                                                                            <?php endif; ?>
                                                                                        </li>

                                                                                    <?php endwhile; ?>
                                                                                </ul>

                                                                            <?php endif; ?>
                                                                            <?php if (get_sub_field('price-caption')): ?>
                                                                                <p class="el_priceWrapList_item_caption"><?php the_sub_field('price-caption'); ?></p>
                                                                            <?php endif; ?>
                                                                        </li>

                                                                    <?php endwhile; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                            <p class="el_priceWrapList_item_caution">表記は全て税込価格です。</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <div class="bl_priceChildList">
                                                    <div class="bl_priceChildList_postList">
                                                        <div class="bl_priceChildList_postList_item">
                                                            <h4 class="el_priceChildList_postList_item_ttl">
                                                                <?php the_title(); ?>
                                                            </h4>

                                                            <?php if (have_rows('price_wrap')): ?>
                                                                <ul class="bl_priceWrapList">
                                                                    <?php while (have_rows('price_wrap')): the_row(); ?>

                                                                        <li class="bl_priceWrapList_item">
                                                                            <p class="el_priceWrapList_item_ttl"><?php the_sub_field('price_wrap-ttl'); ?></p>

                                                                            <?php if (have_rows('price_table')): ?>

                                                                                <ul class="bl_priceTableList">
                                                                                    <?php while (have_rows('price_table')): the_row(); ?>

                                                                                        <li class="bl_priceTableList_item">

                                                                                            <?php if (get_sub_field('price_table-ttl')): ?>
                                                                                                <p class="el_priceTableList_item_ttl_txt"><?php the_sub_field('price_table-ttl'); ?></p>
                                                                                            <?php endif; ?>

                                                                                            <?php if (have_rows('amount-table')): ?>
                                                                                                <ul class="bl_amountTableList">
                                                                                                    <?php while (have_rows('amount-table')): the_row(); ?>
                                                                                                        <li class="bl_amountTableList_item">
                                                                                                            <?php
                                                                                                            $amountTxt = get_sub_field('amount-table_txt');
                                                                                                            ?>
                                                                                                            <?php if (!empty($amountTxt)) : ?>
                                                                                                                <p class="el_amountTableList_item_txt"><?php echo $amountTxt; ?></p>
                                                                                                            <?php endif; ?>

                                                                                                            <?php
                                                                                                            $amountView = get_sub_field('amount-table_view', get_the_ID());
                                                                                                            ?>
                                                                                                            <?php if (!empty($amountView)) : ?>
                                                                                                                <p class="el_amountTableList_item_view"><?php echo $amountView; ?></p>
                                                                                                            <?php endif; ?>

                                                                                                            <?php
                                                                                                            $amountNum = get_sub_field('amount-table_num', get_the_ID());
                                                                                                            ?>
                                                                                                            <?php if (!empty($amountNum)) : ?>
                                                                                                                <p class="el_amountTableList_item_num"><?php echo $amountNum; ?></p>
                                                                                                            <?php endif; ?>

                                                                                                        </li>
                                                                                                    <?php endwhile; ?>
                                                                                                </ul>
                                                                                            <?php endif; ?>
                                                                                        </li>

                                                                                    <?php endwhile; ?>
                                                                                </ul>

                                                                            <?php endif; ?>
                                                                            <?php if (get_sub_field('price-caption')): ?>
                                                                                <p class="el_priceWrapList_item_caption"><?php the_sub_field('price-caption'); ?></p>
                                                                            <?php endif; ?>
                                                                        </li>

                                                                    <?php endwhile; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                            <p class="el_priceWrapList_item_caution">表記は全て税込価格です。</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                <?php
                                    endif;
                                }
                                ?>
                            </div>
                        </section>

                    </div>
                    <div>
                        <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; endif; ?>
    </main>

    <?php get_footer(); ?>
</body>

</html>