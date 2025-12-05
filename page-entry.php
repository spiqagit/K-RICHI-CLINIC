<?php

/**
 * Template Name: エントリーフォーム
 */
?>


<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>


<body class="bl_commonLowPageWhiteBg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWhiteMain">

        <div class="bl_commonLowPageWhiteMain_ttlWrapper">
            <h1 class="el_commonLowPageWhiteMain_ttl">採用エントリーフォーム</h1>
        </div>

        <section class="bl_entryFormSection">
            <div class="bl_entryFormSection_inner">
                <!-- <div class="bl_entryFormWrapper">
                    <div class="bl_entryFormWrapper_item">
                        <h2 class="el_entryFormWrapper_item_ttl">お問い合わせフォーム</h2>
                        <div class="bl_entryFormInputList">
                            <div class="bl_entryFormInputList_item">
                                <div class="bl_entryFormInputList_item_ttlWrapper">
                                    <label for="name" class="el_entryFormInputList_item_ttl">
                                        <span class="el_entryFormInputList_item_ttl_txt">名前</span>
                                        <span class="el_entryFormInputList_item_ttl_option is-required">必須</span>
                                    </label>
                                </div>
                                <div class="bl_entryFormInputList_item_inputWrapper">

                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <?php the_content(); ?>
            </div>
        </section>

        <div>
            <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>