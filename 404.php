<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="bl_commonLowPagebg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWrapper">
        <div class="bl_commonLowPageWrapper_ttlContainer">
            <hgroup class="bl_commonLowPageWrapper_ttl">
                <h1 class="el_commonLowPageWrapper_ttl_en">404 Not found</h1>
                <p class="el_commonLowPageWrapper_ttl_ja"><span>ページが見つかりませんでした</span></p>
            </hgroup>
        </div>
        <div class="bl_commonLowPageWrapper_contentsOuter">
            <div class="bl_commonLowPageWrapper_contents">
                <div class="bl_commonLowPageWrapper_contents_inner">
                    <div class="bl_page404Contents">
                        <p class="bl_page404Contents_txt">お探しのページが見つかりませんでした。<br>一時的にアクセスできない状況にあるか、移動もしくは削除された可能性があります。</p>
                        <a href="<?php echo home_url(); ?>" class="bl_page404Contents_btn">トップへ戻る</a>
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