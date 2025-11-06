<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="pg_top">
    <?php get_header(); ?>
    <main>
        <div class="bl_fvSection">
            <picture class="bl_fvSection_bg">
                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/fv-sp.jpg" media="(max-width: 768px)">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/fv-pc.jpg" alt="">
            </picture>
            <div class="bl_fvSection_txt">
                <p>あなたの<br>人生を、<br>美しく彩る</p>
            </div>
        </div>

        <div class="bl_secondViewSectionWrapper_outer">
            <div class="bl_secondViewSectionWrapper_outline">
                <div class="bl_secondViewSectionWrapper">
                    <section class="bl_newsSection bl_topSection">
                        <?php
                        $news_query = new WP_Query(array(
                            'post_type' => 'news',
                            'posts_per_page' => 3,
                            'orderby' => 'date',
                            'order' => 'DESC',
                        ));
                        ?>
                        <div class="bl_topSection_inner bl_newsSection_inner">
                            <div class="bl_newsttlWrapper">
                                <div class="blcommonSectionTtlWrapper">
                                    <hgroup class="bl_commonSectionTtl">
                                        <h2 class="el_commonSectionTtl_ttl_en">News</h2>
                                        <p class="el_commonSectionTtl_ttl_ja">お知らせ</p>
                                    </hgroup>
                                </div>
                                <?php if ($news_query->have_posts()) : ?>
                                    <div class="bl_commonAllviewBtnWrapper">
                                        <a href="#" class="bl_commonAllviewBtn">
                                            <p class="el_commonAllviewBtn_txt">View all</p>
                                            <div class="el_commonAllviewBtn_arrow">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/white-arrow.svg" alt="">
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if ($news_query->have_posts()) : ?>
                                <div class="bl_newsSliderWrapper">
                                    <div class="swiper bl_newsSlider">
                                        <div class="swiper-wrapper">
                                            <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                                                <div class="swiper-slide">
                                                    <a href="<?php the_permalink(); ?>" class="bl_topNewsItem">
                                                        <div class="bl_topNewsItem_thumbnailWrapper">
                                                            <?php if (has_post_thumbnail()) : ?>
                                                                <img class="el_topNewsItem_thumbnailWrapper_img" src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                                                            <?php else : ?>
                                                                <img class="el_topNewsItem_thumbnailWrapper_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/news-nospot-img.jpg" alt="<?php the_title(); ?>">
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="bl_topNewsItem_txtWrapper">
                                                            <p class="el_topNewsItem_txtWrapper_date"><?php the_time('Y.m.d'); ?></p>
                                                            <p class="el_topNewsItem_txtWrapper_ttl"><?php the_title(); ?></p>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="">
                                    <div class="bl_topNoPostContainer">
                                        <p class="bl_topNoPostContainer_txtEn">Coming soon...</p>
                                        <p class="bl_topNoPostContainer_txtJa">ただいま公開準備中です。</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </section>

                    <?php
                    $column_query = new WP_Query(array(
                        'post_type' => 'column',
                        'posts_per_page' => 4,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    ));
                    ?>

                    <section class="bl_topColumnSection bl_topSection">
                        <div class="bl_topSection_inner">
                            <div class="bl_topColumnSection_ttlWrapper blcommonSectionTtlWrapper">
                                <hgroup class="bl_commonSectionTtl">
                                    <h2 class="el_commonSectionTtl_ttl_en">Column</h2>
                                    <p class="el_commonSectionTtl_ttl_ja">コラム</p>
                                </hgroup>
                                <?php if ($column_query->have_posts()) : ?>
                                    <div class="bl_topColumnSection_sliderNaviWrapper">
                                        <button class="el_topColumnSection_sliderNaviWrapper_btn el_topColumnSection_sliderNaviWrapper_btnPrev" type="button">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/prev-arrow.svg" alt="前へ">
                                        </button>
                                        <button class="el_topColumnSection_sliderNaviWrapper_btn el_topColumnSection_sliderNaviWrapper_btnNext" type="button">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/next-arrow.svg" alt="次へ">
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if ($column_query->have_posts()) : ?>
                                <div class="bl_topColumnSection_sliderWrapper">
                                    <div class="swiper bl_topColumnSection_slider">
                                        <div class="swiper-wrapper">
                                            <?php while ($column_query->have_posts()) : $column_query->the_post(); ?>
                                                <div class="swiper-slide">
                                                    <a href="<?php the_permalink(); ?>" class="bl_columnBtnItem">
                                                        <div class="bl_columnBtnItem_inner">
                                                            <div class="bl_columnBtnItem_imgWrapper">
                                                                <?php if (has_post_thumbnail()) : ?>
                                                                    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                                                                <?php else : ?>
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/column-nospot-img.jpg" alt="<?php the_title(); ?>">
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="bl_columnBtnItem_txtWrapper">
                                                                <div class="bl_columnBtnItem_txtWrapper_upper">
                                                                    <div class="bl_columnBtnItem_postInfoWrapper">
                                                                        <p class="el_columnBtnItem_postInfoWrapper_date"><?php the_date('Y.m.d'); ?></p>

                                                                        <?php
                                                                        $column_cats = get_the_terms(get_the_ID(), 'column-cat');
                                                                        ?>
                                                                        <?php if (!empty($column_cats)) : ?>
                                                                            <div class="bl_columnBtnItem_postInfoWrapper_cats">
                                                                                <?php foreach ($column_cats as $column_cat) : ?>
                                                                                    <p class="el_columnBtnItem_postInfoWrapper_cats_cat"><?php echo $column_cat->name; ?></p>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <p class="el_columnBtnItem_txtWrapper_ttl"><?php the_title(); ?></p>
                                                                </div>

                                                                <div class="bl_columnBtnItem_txtWrapper_arrow">
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/black-arrow.svg" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endwhile; ?>
                                            <?php wp_reset_postdata(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="bl_commonAllviewBtnWrapper bl_topColumnSection_btnWrapper">
                                    <a href="<?php echo home_url(); ?>/column/" class="bl_commonAllviewBtn">
                                        <p class="el_commonAllviewBtn_txt">View all</p>
                                        <div class="el_commonAllviewBtn_arrow">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/white-arrow.svg" alt="">
                                        </div>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="">
                                    <div class="bl_topNoPostContainer">
                                        <p class="bl_topNoPostContainer_txtEn">Coming soon...</p>
                                        <p class="bl_topNoPostContainer_txtJa">ただいま公開準備中です。</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>

                    <section class="bl_topSnsSection">
                        <div class="bl_topSnsSection_inner">

                            <div class="bl_topInstagramContainer">
                                <div class="bl_topInstagramContainer_inner">
                                    <div class="bl_topInstagramContainer_ttlWrapper">
                                        <h2 class="el_topInstagramContainer_ttl">Instagram</h2>
                                        <?php if (get_field('instagram-url', 'option')): ?>
                                            <div class="bl_commonAllviewBtnWrapper bl_topColumnSection_btnWrapper">
                                                <a href="<?php echo get_field('instagram_url', 'option'); ?>" class="bl_commonAllviewBtn" target="_blank">
                                                    <p class="el_commonAllviewBtn_txt">View post</p>
                                                    <div class="el_commonAllviewBtn_arrow">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/white-arrow.svg" alt="">
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div>

                                    </div>
                                </div>
                            </div>

                            <div class="bl_topSnsSection_otherSnsWrapper">
                                <h3 class="el_topSnsSection_otherSnsWrapper_ttl">その他SNSはこちら</h3>
                                <div class="bl_topSnsSection_otherSnsWrapper_snsList">
                                    <?php if (get_field('youtube-url', 'option')): ?>
                                        <a class="bl_topSnsSection_otherSnsWrapper_snsbtn" href="<?php echo get_field('youtube-url', 'option'); ?>" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/youtube-icon.svg" alt="YouTube">
                                        </a>
                                    <?php endif; ?>
                                    <?php if (get_field('x-url', 'option')): ?>
                                        <a class="bl_topSnsSection_otherSnsWrapper_snsbtn" href="<?php echo get_field('x-url', 'option'); ?>" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/x-icon.svg" alt="X">
                                        </a>
                                    <?php endif; ?>
                                    <?php if (get_field('tiktok-url', 'option')): ?>
                                        <a class="bl_topSnsSection_otherSnsWrapper_snsbtn" href="<?php echo get_field('tiktok-url', 'option'); ?>" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/tiktok-icon.svg" alt="TikTok">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <section class="bl_conceptSection bl_topSection">
            <div class="bl_conceptSection_inner bl_topSection_inner">
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

        <section class="bl_topDoctorSection bl_topSection">
            <div class="bl_topDoctorSection_inner bl_topSection_inner">
                <div class="blcommonSectionTtlWrapper">
                    <hgroup class="bl_commonSectionTtl">
                        <h2 class="el_commonSectionTtl_ttl_en">Doctor</h2>
                        <p class="el_commonSectionTtl_ttl_ja">院長紹介</p>
                    </hgroup>
                </div>
                <div class="bl_doctorContentsWrapper">
                    <div class="bl_doctorContentsWrapper_imgWrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/doctor-img.png" alt="院長 金 玟圭 キム・ミンギュ">
                    </div>
                    <div class="bl_doctorContentsWrapper_txtWrapper">
                        <div class="bl_doctorContentsWrapper_nameWrapper">
                            <p class="el_doctorContentsWrapper_nameWrapper_job">院長</p>
                            <div class="bl_doctorContentsWrapper_nameWrapper_name">
                                <p class="el_doctorContentsWrapper_nameWrapper_name_first">金 玟圭</p>
                                <p class="el_doctorContentsWrapper_nameWrapper_name_last">キム・ミンギュ</p>
                            </div>
                        </div>
                        <div class="bl_doctorContentsWrapper_txtWrapper_txt">
                            <p>ダミーテキストです。美容医療は、外見の変化だけでなく、心まで明るく前向きにしてくれる力があると信じています。</p>
                            <p>私たちは患者様との信頼関係を大切にし、安心して任せていただける医療を目指してきました。</p>
                            <p>一人ひとりの悩みに真摯に向き合い、その方にとって最も自然で美しい結果を追求してまいります。<br>
                                小さな不安でも、ぜひお気軽にご相談ください。</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="bl_topMenuSection bl_topSection">
            <div class="bl_topMenuSection_inner bl_topSection_inner">
                <?php
                $concern_cats = get_terms([
                    'taxonomy' => 'concern-cat',
                    'post_type' => 'concern',
                    'orderby' => 'concern_order',
                    'order' => 'ASC',
                    'hide_empty' => true,
                ]);
                ?>
                <div class="bl_topMenuSection_item">
                    <div class="bl_topMenuSection_item_ttlWrapper">
                        <div class="blcommonSectionTtlWrapper">
                            <hgroup class="bl_commonSectionTtl">
                                <h2 class="el_commonSectionTtl_ttl_en">Concern</h2>
                                <p class="el_commonSectionTtl_ttl_ja">お悩み</p>
                            </hgroup>
                        </div>
                        <div class="bl_commonAllviewBtnWrapper">
                            <a href="<?php echo home_url(); ?>/treatment/" class="bl_commonAllviewBtn">
                                <p class="el_commonAllviewBtn_txt">View all</p>
                                <div class="el_commonAllviewBtn_arrow">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/white-arrow.svg" alt="">
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="bl_topConcernContainer">
                        <?php if (!empty($concern_cats)) : ?>

                            <div class="swiper bl_topConcernSwiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ($concern_cats as $concern_cat) : ?>
                                        <div class="swiper-slide">
                                            <div class="bl_concernItem">
                                                <div class="bl_concernItem_upper">
                                                    <div class="bl_concernItem_upper_imgWrapper">
                                                        <img src="<?php echo get_field('concern-icon', 'concern-cat_' . $concern_cat->term_id); ?>" alt="<?php echo esc_html($concern_cat->name); ?>">
                                                    </div>
                                                    <div class="bl_concernItem_upper_txtWrapper">
                                                        <p class="el_concernItem_upper_txtWrapper_txtEn"><?php echo get_field('concern-txt-en', 'concern-cat_' . $concern_cat->term_id); ?></p>
                                                        <p class="el_concernItem_upper_txtWrapper_txtJa"><?php echo esc_html($concern_cat->name); ?></p>
                                                    </div>
                                                </div>
                                                <?php
                                                $concern_posts = get_posts([
                                                    'post_type' => 'concern',
                                                    'posts_per_page' => -1,
                                                    'orderby' => 'concern_order',
                                                    'order' => 'ASC',
                                                    'tax_query' => [
                                                        [
                                                            'taxonomy' => 'concern-cat',
                                                            'field' => 'term_id',
                                                            'terms' => $concern_cat->term_id,
                                                        ],
                                                    ],
                                                ]);
                                                ?>
                                                <?php if (!empty($concern_posts)) : ?>
                                                    <div class="bl_concernItem_lower">
                                                        <ul class="bl_concernItem_postList">
                                                            <?php foreach ($concern_posts as $concern_post) : ?>
                                                                <li class="bl_concernItem_postList_item">
                                                                    <a class="bl_concernItem_postList_item_btn" href="<?php echo get_the_permalink($concern_post); ?>">
                                                                        <p class="el_concernItem_postList_item_btn_txt"><?php echo get_the_title($concern_post); ?></p>
                                                                        <img class="el_concernItem_postList_item_btn_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/open-arrow.svg" alt="">
                                                                    </a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php wp_reset_postdata(); ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="">
                                <div class="bl_topNoPostContainer">
                                    <p class="bl_topNoPostContainer_txtEn">Coming soon...</p>
                                    <p class="bl_topNoPostContainer_txtJa">ただいま公開準備中です。</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>


                <?php
                $treatment_cats = get_terms([
                    'post_type' => 'menu',
                    'taxonomy' => 'menu-cat',
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'hide_empty' => true,
                ]);
                ?>

                <div class="bl_topMenuSection_item">
                    <div class="bl_topMenuSection_item_ttlWrapper">
                        <div class="blcommonSectionTtlWrapper">
                            <hgroup class="bl_commonSectionTtl">
                                <h2 class="el_commonSectionTtl_ttl_en">Treatment</h2>
                                <p class="el_commonSectionTtl_ttl_ja">施術</p>
                            </hgroup>
                        </div>

                        <?php if (!empty($treatment_cats)) : ?>
                            <div class="bl_commonAllviewBtnWrapper is_txten">
                                <a href="<?php echo home_url(); ?>/treatment/" class="bl_commonAllviewBtn">
                                    <p class="el_commonAllviewBtn_txt">View all</p>
                                    <div class="el_commonAllviewBtn_arrow">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/white-arrow.svg" alt="">
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>


                    <?php if (!empty($treatment_cats)) : ?>
                        <div class="bl_topSection_treatmentContainer">
                            <?php foreach ($treatment_cats as $treatment_cat) :
                                $banner = get_field('menu-cat-banner', 'menu-cat_' . $treatment_cat->term_id);
                                $txt = get_field('menu-cat-txt', 'menu-cat_' . $treatment_cat->term_id);
                            ?>
                                <div class="bl_treatmentBtnItem">
                                    <a href="<?php echo home_url(); ?>/treatment-cat/<?php echo esc_attr($treatment_cat->slug); ?>" class="bl_treatmentBtnItem_btn"
                                        style="background-image: url(<?php echo $banner; ?>);">
                                        <div class="bl_treatmentBtnItem_btn_inner">
                                            <div class="bl_treatmentBtnItem_btn_inner_upper">
                                                <p class="el_topMenuSection_item_txtWrapper_ttl">
                                                    <?php echo esc_html($treatment_cat->name); ?>
                                                </p>
                                                <p class="el_topMenuSection_item_txtWrapper_txt">
                                                    <?php echo $txt; ?>
                                                </p>
                                            </div>
                                            <div class="bl_treatmentBtnItem_btn_inner_arrow">
                                                <p class="el_treatmentBtnItem_btn_inner_arrow_txt">メニューを見る</p>
                                                <img class="el_treatmentBtnItem_btn_inner_arrow_img" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/common/black-arrow.svg" alt="">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php else : ?>

                        <div class="">
                            <div class="bl_topNoPostContainer">
                                <p class="bl_topNoPostContainer_txtEn">Coming soon...</p>
                                <p class="bl_topNoPostContainer_txtJa">ただいま公開準備中です。</p>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
        </section>

        <?php
        $case_posts = new WP_Query([
            'post_type' => 'case',
            'posts_per_page' => 10,
            'orderby' => 'date',
            'order' => 'DESC'
        ]);
        ?>
        <section class="bl_topCaseSection bl_topSection">
            <div class="bl_topSection_inner">
                <div class="bl_topCaseSection_ttlWrapper">
                    <div class="blcommonSectionTtlWrapper">
                        <hgroup class="bl_commonSectionTtl">
                            <h2 class="el_commonSectionTtl_ttl_en">Case</h2>
                            <p class="el_commonSectionTtl_ttl_ja">症例</p>
                        </hgroup>
                    </div>

                    <?php if (!empty($treatment_cats)) : ?>
                        <div class="bl_commonAllviewBtnWrapper is_txten">
                            <a href="<?php echo home_url(); ?>/treatment/" class="bl_commonAllviewBtn">
                                <p class="el_commonAllviewBtn_txt">View all</p>
                                <div class="el_commonAllviewBtn_arrow">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/white-arrow.svg" alt="">
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($case_posts)) : ?>
                    <div class="bl_caseSliderWrapper">
                        <div class="splide bl_caseSliderWrapper_slider">
                            <div class="splide__track">
                                <div class="splide__list">
                                    <?php while ($case_posts->have_posts()) : $case_posts->the_post(); ?>
                                        <div class="splide__slide">
                                            <div class="bl_caseItem">
                                                <a href="<?php the_permalink(); ?>" class="bl_caseItem_linkWrapper">
                                                    <div class="bl_caseItem_imgWrapper">
                                                        <?php if (have_rows('slide')): ?>
                                                            <?php while (have_rows('slide')): the_row(); ?>
                                                                <img src="<?php the_sub_field('img'); ?>" alt="<?php the_title(); ?>">
                                                                <?php continue; ?>
                                                            <?php endwhile; ?>
                                                        <?php else: ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/news-no-post.jpg" alt="<?php the_title(); ?>">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="bl_caseItem_txtWrapper">
                                                        <div class="bl_caseItem_treatmentsWrapper">
                                                            <?php $treatments = get_field('menu_select'); ?>
                                                            <?php if (!empty($treatments)): ?>
                                                                <?php foreach ($treatments as $treatment): ?>
                                                                    <p class="bl_caseItem_treatmentsWrapper_txt">
                                                                        <?php echo get_the_title($treatment); ?>
                                                                    </p>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <p class="el_caseItem_ttl"><?php the_title(); ?></p>
                                                    </div>
                                                </a>
                                                <?php
                                                $case_treatment = get_field('case-treatment');
                                                $case_time = get_field('case-time');
                                                $case_downtime = get_field('case-downtime');
                                                $case_makeup = get_field('case-makeup');
                                                $case_risk = get_field('case-risk');
                                                ?>
                                                <details class="bl_caseItem_details">
                                                    <summary class="bl_caseItem_details_summary">
                                                        <span class="bl_caseItem_details_summary_txt">詳細を見る</span>
                                                        <span class="bl_caseItem_details_summary_icon"></span>
                                                    </summary>
                                                    <div class="bl_caseItem_details_content">
                                                        <div class="bl_caseItem_details_content_inner">
                                                            <?php if (!empty($case_treatment)): ?>
                                                                <dl class="bl_caseItem_details_content_item">
                                                                    <dt class="bl_caseItem_details_content_item_dt">施術名</dt>
                                                                    <dd class="bl_caseItem_details_content_item_dd">
                                                                        <?php echo $case_treatment; ?>
                                                                    </dd>
                                                                </dl>
                                                            <?php endif; ?>

                                                            <?php if (!empty($case_time)): ?>
                                                                <dl class="bl_caseItem_details_content_item">
                                                                    <dt class="bl_caseItem_details_content_item_dt">施術時間</dt>
                                                                    <dd class="bl_caseItem_details_content_item_dd">
                                                                        <?php echo $case_time; ?>
                                                                    </dd>
                                                                </dl>
                                                            <?php endif; ?>

                                                            <?php if (!empty($case_time)): ?>
                                                                <dl class="bl_caseItem_details_content_item">
                                                                    <dt class="bl_caseItem_details_content_item_dt">ダウンタイム</dt>
                                                                    <dd class="bl_caseItem_details_content_item_dd">
                                                                        <?php echo $case_downtime; ?>
                                                                    </dd>
                                                                </dl>
                                                            <?php endif; ?>

                                                            <?php if (!empty($case_makeup)): ?>
                                                                <dl class="bl_caseItem_details_content_item">
                                                                    <dt class="bl_caseItem_details_content_item_dt">メイク</dt>
                                                                    <dd class="bl_caseItem_details_content_item_dd">
                                                                        <?php echo $case_makeup; ?>
                                                                    </dd>
                                                                </dl>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </details>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php else : ?>
                    <div class="">
                        <div class="bl_topNoPostContainer">
                            <p class="bl_topNoPostContainer_txtEn">Coming soon...</p>
                            <p class="bl_topNoPostContainer_txtJa">ただいま公開準備中です。</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <?php get_footer(); ?>
</body>

</html>