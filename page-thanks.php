<?php

/**
 * Template Name: サンクスページ
 */

?>



<?php get_header('meta'); ?>
<?php wp_head(); ?>
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
</head>


<body class="bl_commonLowPageWhiteBg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWhiteMain">
        <div class="bl_thanksWrapper">
            <div class="bl_thanksWrapper_inner">
                <h1 class="el_thanksWrapper_ttl">エントリーいただき<br class="sp_only">ありがとうございます</h1>

                <div class="bl_thanksWrapper_inner_content">
                    <p class="el_thanksWrapper_inner_content_txt">このたびはK-RICH CLINIC の求人にご応募ありがとうございました。<br>【書類選考が通過した方のみ】ご返信をさせていただきます。</p>
                    <p class="el_thanksWrapper_inner_content_txt">ご提出いただいた履歴書等の書類は返却致しかねますので予めご了承ください。<br>こちらで責任を持って破棄いたします。</p>
                </div>

                <a href="<?php echo home_url(); ?>" class="bl_thanksWrapper_inner_btn">トップへ戻る</a>
            </div>
        </div>
        <div>
            <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
        </div>
    </main>

    <?php get_footer(); ?>
</body>