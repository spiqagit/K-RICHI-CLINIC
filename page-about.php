<?php

/**
 * Template Name: About
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
                <h1 class="el_commonLowPageWrapper_ttl_en">About</h1>
                <p class="el_commonLowPageWrapper_ttl_ja"><span>クリニックについて</span></p>
            </hgroup>
        </div>
        <div class="bl_commonLowPageWrapper_contentsOuter">
            <div class="bl_commonLowPageWrapper_contents">
                <div class="bl_commonLowPageWrapper_contents_inner">

                    <div class="bl_aboutContentsWrapper">
                        <section class="bl_aboutMissionSection">
                            <div class="bl_aboutMissionSection_inner">
                                <h2 class="el_aboutMissionSection_ttl">Mission</h2>
                                <div class="bl_aboutMissionSection_txtContainer">
                                    <p class="el_aboutMissionSection_txtContainer_copy">美と健康を両立させ、<br>国内外の患者様に<br class="el_aboutMissionSection_txtContainer_copy_br">選ばれるクリニック</p>
                                    <div class="bl_aboutMissionSection_txtContainer_txt">
                                        <p class="el_aboutMissionSection_txtContainer_txt_item">私たちの使命は、単なる美容医療の提供にとどまらず、患者様の人生の質を高め、自信と活力を取り戻していただくことです。</p>
                                        <p class="el_aboutMissionSection_txtContainer_txt_item">日本と韓国双方で医師免許を取得した経験を活かし、福岡から｢安心できる最新美容」を発信します。</p>
                                        <p class="el_aboutMissionSection_txtContainer_txt_item">最新の韓国美容と、上質な時間を提供できるクリニックを目指します。</p>
                                    </div>
                                </div>
                            </div>
                            <div class="splide bl_aboutMissionSection_slider">
                                <div class="splide__track">
                                    <div class="splide__list">
                                        <?php for ($i = 0; $i < 3; $i++): ?>
                                            <div class="splide__slide">
                                                <p class="el_aboutMissionSection_slider_item">Balancing beauty and health. </p>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="bl_conceptSection bl_aboutConceptSection">
                            <div class="bl_conceptSection_inner">
                                <div class="bl_conceptSection_txtWrapper">
                                    <div class="blcommonSectionTtlWrapper">
                                        <hgroup class="bl_commonSectionTtl">
                                            <h2 class="el_commonSectionTtl_ttl_en">Concept</h2>
                                            <p class="el_commonSectionTtl_ttl_ja">コンセプト</p>
                                        </hgroup>
                                    </div>
                                    <div class="bl_conceptSection_txtContainer">
                                        <div class="bl_conceptSection_copyWrapper">
                                            <p class="el_conceptSection_copyWrapper_main">｢韓国美容 × 日本品質｣</p>
                                            <p class="el_conceptSection_copyWrapper_sub"><span class="el_conceptSection_copyWrapper_sub_dash">—</span> その融合が生み出す、<br class="el_conceptSection_copyWrapper_sub_br">新しい美のスタンダード</p>
                                        </div>
                                        <div class="bl_conceptSection_txtContainer">
                                            <p class="el_conceptSection_txt_txt">K-RICH CLINICは、韓国の最先端美容医療に、日本美容ならではの繊細さと洗練された感性を融合させた、“結果”と“安心”を両立するプレミアム美容クリニックです。</p>
                                            <p class="el_conceptSection_txt_txt">私たちは、一時的な美しさを追求するのではなく、再生医療を通じて自然に美しさが育まれる医療を目指しています。</p>
                                            <p class="el_conceptSection_txt_txt">さらに、お一人おひとりの肌質や骨格、ライフスタイルを丁寧に見極め、最も適したオーダーメイド治療をご提案いたします。</p>
                                            <p class="el_conceptSection_txt_txt">最新の医療機器と確かな技術、そして誠実な医療を通じて、「自分らしく輝く人生」へと導くことが、K-RICH CLINICの理念です。</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bl_conceptSection_imgWrapper">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/top-concept-img.png" alt="モデルの女性の画像">
                                </div>
                            </div>
                        </section>

                        <section class="bl_featuerSection">
                            <div class="bl_featuerSection_inner">
                                <div class="bl_featuerSection_ttlWrapper">
                                    <h3 class="bl_featuerSection_ttl">K-RICH CLINICの特徴</h3>
                                </div>

                                <div class="bl_featuerSection_listWrapper">
                                    <div class="swiper bl_featuerSection_list">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="bl_featuerSection_list_item">
                                                    <div class="bl_featuerSection_list_item_imgWrapper">
                                                        <p class="el_featuerSection_list_item_imgWrapper_num">01</p>
                                                        <img class="bl_featuerSection_list_item_imgWrapper_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/featuer-01.jpg" alt="韓国美容と日本品質の融合">
                                                    </div>
                                                    <div class="bl_featuerSection_list_item_txtWrapper">
                                                        <p class="el_featuerSection_list_item_ttl">韓国美容と日本品質の融合</p>
                                                        <p class="el_featuerSection_list_item_txt">韓国の先端美容医療と日本の繊細な技術を融合し、一人ひとりに合わせたオーダーメイド治療で理想の美しさを叶えます。</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="swiper-slide">
                                                <div class="bl_featuerSection_list_item">
                                                    <div class="bl_featuerSection_list_item_imgWrapper">
                                                        <p class="el_featuerSection_list_item_imgWrapper_num">02</p>
                                                        <img class="bl_featuerSection_list_item_imgWrapper_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/featuer-02.jpg" alt="再生医療とエイジングケアの専門性">
                                                    </div>
                                                    <div class="bl_featuerSection_list_item_txtWrapper">
                                                        <p class="el_featuerSection_list_item_ttl">再生医療とエイジングケアの専門性</p>
                                                        <p class="el_featuerSection_list_item_txt">PRPや幹細胞治療などの再生医療を通じて肌の機能を整え、内側から自然で上質な若返りを導きます。</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="swiper-slide">
                                                <div class="bl_featuerSection_list_item">
                                                    <div class="bl_featuerSection_list_item_imgWrapper">
                                                        <p class="el_featuerSection_list_item_imgWrapper_num">03</p>
                                                        <img class="bl_featuerSection_list_item_imgWrapper_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/featuer-03.jpg" alt="国際的視点と信頼の医療体制">
                                                    </div>
                                                    <div class="bl_featuerSection_list_item_txtWrapper">
                                                        <p class="el_featuerSection_list_item_ttl">国際的視点と信頼の医療体制</p>
                                                        <p class="el_featuerSection_list_item_txt">日韓両国の医師免許を持つ院長が多言語の能力を活かし、世界の医療技術を基に、安心と信頼の医療を提供します。</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div class="bl_commonLowPageWrapper_contents bl_aboutInformationSectionOuter">
            <div class="bl_commonLowPageWrapper_contents_inner">
                <div class="bl_aboutContentsWrapper">
                    <section class="bl_aboutInformationSection">
                        <div class="bl_aboutInformationSection_inner">
                            <div class="bl_aboutInformationSection_ttlWrapper">
                                <div class="bl_aboutInformationTtlWrapper">
                                    <hgroup class="bl_aboutInformationTtlWrapper_group">
                                        <h2 class="el_aboutInformationTtlWrapper_en">Information</h2>
                                        <p class="el_aboutInformationTtlWrapper_ja">クリニック情報</p>
                                    </hgroup>
                                </div>

                                <div class="bl_aboutInformationSection_infoWrapper">
                                    <?php if (get_field('clinic-name', 'option')) : ?>
                                        <dl class="bl_aboutInformationSection_infoWrapper_item">
                                            <dt class="el_aboutInformationSection_infoWrapper_item_ttl">クリニック名</dt>
                                            <dd class="el_aboutInformationSection_infoWrapper_item_txt"><?php echo get_field('clinic-name', 'option'); ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                    <?php if (get_field('clinic-director', 'option')) : ?>
                                        <dl class="bl_aboutInformationSection_infoWrapper_item">
                                            <dt class="el_aboutInformationSection_infoWrapper_item_ttl">院長</dt>
                                            <dd class="el_aboutInformationSection_infoWrapper_item_txt"><?php echo get_field('clinic-director', 'option'); ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                    <?php if (get_field('medical-subject', 'option')) : ?>
                                        <dl class="bl_aboutInformationSection_infoWrapper_item">
                                            <dt class="el_aboutInformationSection_infoWrapper_item_ttl">診療科目</dt>
                                            <dd class="el_aboutInformationSection_infoWrapper_item_txt"><?php echo get_field('medical-subject', 'option'); ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                    <?php if (get_field('address', 'option')) : ?>
                                        <dl class="bl_aboutInformationSection_infoWrapper_item">
                                            <dt class="el_aboutInformationSection_infoWrapper_item_ttl">所在地</dt>
                                            <dd class="el_aboutInformationSection_infoWrapper_item_txt">
                                                <p><?php echo get_field('post-code', 'option'); ?></p>
                                                <p><?php echo get_field('address', 'option'); ?></p>

                                                <?php if (get_field('google_map_link', 'option')): ?>
                                                    <a href="<?php echo get_field('google_map_link', 'option'); ?>" class="bl_commonGoogleMapLink" target="_blank">
                                                        <p class="el_commonGoogleMapLink_txt">Google Maps</p>
                                                        <img class="el_commonGoogleMapLink_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/out-arrow.svg" alt="">
                                                    </a>
                                                <?php endif; ?>
                                            </dd>
                                        </dl>
                                    <?php endif; ?>
                                    <?php if (get_field('clinic-hour', 'option')) : ?>
                                        <dl class="bl_aboutInformationSection_infoWrapper_item">
                                            <dt class="el_aboutInformationSection_infoWrapper_item_ttl">営業時間</dt>
                                            <dd class="el_aboutInformationSection_infoWrapper_item_txt"><?php echo get_field('clinic-hour', 'option'); ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                    <?php if (get_field('clinic-tel', 'option')) : ?>
                                        <dl class="bl_aboutInformationSection_infoWrapper_item">
                                            <dt class="el_aboutInformationSection_infoWrapper_item_ttl">電話番号</dt>
                                            <dd class="el_aboutInformationSection_infoWrapper_item_txt">
                                                <a href="tel:<?php echo get_field('clinic-tel', 'option'); ?>" class="el_aboutInformationSection_infoWrapper_item_txt_link"><?php echo get_field('clinic-tel', 'option'); ?></a>
                                            </dd>
                                        </dl>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="splide bl_aboutInformationSection_slider">
                            <div class="splide__track">
                                <div class="splide__list">
                                    <div class="splide__slide">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-01.jpg" alt="院内写真">
                                    </div>
                                    <div class="splide__slide">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-02.jpg" alt="院内写真">
                                    </div>
                                    <div class="splide__slide">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-03.jpg" alt="院内写真">
                                    </div>
                                    <div class="splide__slide">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-04.jpg" alt="院内写真">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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