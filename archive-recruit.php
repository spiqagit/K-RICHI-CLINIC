<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="bl_commonLowPagebg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWrapper">
        <div class="bl_commonLowPageWrapper_ttlContainer">
            <hgroup class="bl_commonLowPageWrapper_ttl">
                <h1 class="el_commonLowPageWrapper_ttl_en">Recruit</h1>
                <p class="el_commonLowPageWrapper_ttl_ja"><span>採用情報</span></p>
            </hgroup>
        </div>


        <div class="bl_commonLowPageWrapper_contentsOuter bl_recruitContentsOuter">
            <div class="bl_commonLowPageWrapper_contents">
                <div class="bl_commonLowPageWrapper_contents_inner">
                    <section class="bl_recruitMessageSection">
                        <div class="bl_recruitMessageSection_inner">
                            <?php
                            $staffDirectorList = get_terms(
                                array(
                                    'taxonomy' => 'staff-cat',
                                    'hide_empty' => true,
                                    'posts_per_page' => 1,
                                    'orderby' => 'staff_order',
                                    'order' => 'ASC',
                                    'slug' => 'director',
                                )
                            );
                            ?>
                            <?php if ($staffDirectorList): ?>
                                <?php foreach ($staffDirectorList as $staffDirector) : ?>
                                    <?php
                                    $staffDirectorPosts = get_posts(
                                        array(
                                            'post_type' => 'staff',
                                            'posts_per_page' => 1,
                                            'orderby' => 'staff_order',
                                            'order' => 'ASC',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'staff-cat',
                                                    'field' => 'slug',
                                                    'terms' => $staffDirector->slug,
                                                ),
                                            ),
                                        )
                                    );
                                    ?>
                                    <?php if ($staffDirectorPosts): ?>
                                        <?php foreach ($staffDirectorPosts as $staffDirectorPost) : ?>
                                            <div class="bl_recruitMessageSection_imgWrapper">
                                                <img class="bl_recruitMessageSection_imgWrapper_img" src="<?php echo get_the_post_thumbnail_url($staffDirectorPost->ID); ?>" alt="<?php echo $staffDirectorPost->name; ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="bl_recruitMessageSection_txtWrapper">
                                <hgroup class="bl_recruitMessageSection_txtWrapper_ttl">
                                    <h2 class="el_recruitMessageSection_txtWrapper_ttl_en">Message</h2>
                                    <p class="el_recruitMessageSection_txtWrapper_ttl_ja">メッセージ</p>
                                </hgroup>
                                <p class="el_recruitMessageSection_copyWrapper">
                                    "From Fukuoka to the world<br>
                                    <span class="el_recruitMessageSection_copyWrapper_span">— Creating Global Standard of Beauty."</span>
                                </p>
                                <div class="bl_recruitMessageSection_messageTxtWrapper">
                                    <div class="bl_recruitMessageSection_messageTxtWrapper_txtContainer">
                                        <p class="el_recruitMessageSection_messageTxtWrapper_txtContainer_txt">K-RICH CLINICは、韓国の先進美容医療と日本の高品質な医療を融合し、
                                            ｢再生医療 × アンチエイジング × 美肌治療」を通じて、
                                            人々が“自分らしく、美しく、生きる”ことを支えます。
                                        </p>
                                        <p class="el_recruitMessageSection_messageTxtWrapper_txtContainer_txt">韓国と日本の美容医療を基盤に、アジアをはじめ、世界中の人々から
                                            信頼されるクリニックを目指しています。
                                        </p>
                                        <p class="el_recruitMessageSection_messageTxtWrapper_txtContainer_txt">
                                            このビジョンに共感し、共に成長できるスタッフを募集しています。
                                        </p>
                                    </div>
                                    <div class="bl_recruitMessageSection_messageTxtWrapper_directorWrapper">
                                        <p class="el_recruitMessageSection_messageTxtWrapper_directorWrapper_job">院長</p>
                                        <p class="el_recruitMessageSection_messageTxtWrapper_directorWrapper_name">金 玟圭</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <section class="bl_recruitConditionsSection">
            <div class="bl_recruitConditionsSection_inner">
                <hgroup class="bl_recruitConditionsSection_ttl">
                    <h2 class="el_recruitConditionsSection_ttl_en">Conditions</h2>
                    <p class="el_recruitConditionsSection_ttl_ja">K-RICHクリニックで働く魅力</p>
                </hgroup>
                <ul class="bl_recruitConditionsSection_list">
                    <li class="bl_recruitConditionsSection_list_item">
                        <div class="bl_recruitConditionsSection_list_item_imgWrapper">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/recruit/conditions-3.jpg" alt="韓国現地の最新美容医療を学べる">
                        </div>
                        <div class="bl_recruitConditionsSection_list_item_txtWrapper">
                            <h3 class="el_recruitConditionsSection_list_item_txtWrapper_ttl">韓国現地の最新美容医療を学べる</h3>
                            <p class="el_recruitConditionsSection_list_item_txtWrapper_txt">当院では、韓国の提携クリニックや研修制度を通じて、現地で最先端の美容医療技術やトレンドを直接学ぶことができます。常にアップデートされる韓国美容の知識を取り入れ、日本にいながらハイレベルなスキルを身につけられる環境です。</p>
                        </div>
                    </li>
                    <li class="bl_recruitConditionsSection_list_item">
                        <div class="bl_recruitConditionsSection_list_item_imgWrapper">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/recruit/conditions-1.jpg" alt="医師・看護師・カウンセラー・広報が連携するチームワーク">
                        </div>
                        <div class="bl_recruitConditionsSection_list_item_txtWrapper">
                            <h3 class="el_recruitConditionsSection_list_item_txtWrapper_ttl">医師・看護師・カウンセラー・広報が連携するチームワーク</h3>
                            <p class="el_recruitConditionsSection_list_item_txtWrapper_txt">当院では、職種の枠を越えたチーム連携を大切にしています。医師・看護師・カウンセラー・広報が互いを尊重し、それぞれの専門性を活かしながら、患者様一人ひとりに最適な提案を行います。</p>
                        </div>
                    </li>
                    <li class="bl_recruitConditionsSection_list_item">
                        <div class="bl_recruitConditionsSection_list_item_imgWrapper">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/recruit/conditions-2.jpg" alt="成長と安心を両立できる環境">
                        </div>
                        <div class="bl_recruitConditionsSection_list_item_txtWrapper">
                            <h3 class="el_recruitConditionsSection_list_item_txtWrapper_ttl">成長と安心を両立できる環境</h3>
                            <p class="el_recruitConditionsSection_list_item_txtWrapper_txt">当院では、スタッフ一人ひとりが長く安心して働けるよう、福利厚生が充実した環境づくりを大切にしています。休日制度や有給取得率も高く、プライベートとの両立が可能です。また、スタッフが前向きに働けるよう、モチベーションを大切にした制度も整えています。</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <section class="bl_jobCategorySection">
            <div class="bl_jobCategorySection_inner">
                <hgroup class="bl_jobCategorySection_ttl">
                    <h2 class="el_jobCategorySection_ttl_en">Job Category</h2>
                    <p class="el_jobCategorySection_ttl_ja">求人カテゴリー</p>
                </hgroup>

                <div class="bl_jobCategorySection_list">
                    <?php if (have_posts()): ?>

                        <?php while (have_posts()):
                            the_post(); ?>

                            <details class="bl_jobCategorySection_list_item">
                                <summary class="bl_jobCategorySection_list_item_summary">
                                    <span class="bl_jobCategorySection_list_item_summary_txtContainer">
                                        <?php if (get_field('job-en-name')): ?>
                                            <span class="el_jobCategorySection_list_item_summary_txtContainer_txtEn"><?php the_field('job-en-name'); ?></span>
                                        <?php endif; ?>
                                        <span class="el_jobCategorySection_list_item_summary_txtContainer_txtJa"><?php the_title(); ?></span>
                                    </span>
                                    <img class="bl_jobCategorySection_list_item_summary_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/faq-arrow.svg" alt="">
                                </summary>
                                <div class="bl_jobCategorySection_list_item_content">
                                    <div class="bl_jobCategorySection_list_item_content_inner">
                                        <?php if (have_rows('guidelines-list')): ?>

                                            <ul class="bl_jobContentList">
                                                <?php while (have_rows('guidelines-list')):
                                                    the_row(); ?>
                                                    <li class="bl_jobContentList_item">
                                                        <?php if (get_sub_field('guidelines-list-ttl')): ?>
                                                            <p class="el_jobContentList_item_ttl"><?php the_sub_field('guidelines-list-ttl'); ?></p>
                                                        <?php endif; ?>
                                                        <?php if (get_sub_field('guidelines-list-contents')): ?>
                                                            <div class="bl_jobContentList_item_content">
                                                                <?php the_sub_field('guidelines-list-contents'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endwhile; ?>
                                            </ul>
                                            <a href="<?php echo home_url();?>/entry/&postid=<?php the_ID(); ?>" class="bl_jobCategorySection_entryBtn">エントリー</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </details>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <p class="bl_jobCategorySection_noPosts">現在募集中の求人はありません。</p>
                    
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
            </div>
        </section>
    </main>

    <?php get_footer(); ?>
</body>

</html>