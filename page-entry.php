<?php

/**
 * Template Name: エントリーフォーム
 */

$postid = isset($_GET['postid']) ? intval($_GET['postid']) : 0;

if (empty($postid)) {
    wp_redirect(home_url());
    exit;
}

$post_title = get_the_title($postid);
?>



<?php get_header('meta'); ?>
<?php wp_head(); ?>
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
</head>


<body class="bl_commonLowPageWhiteBg">
    <?php get_header(); ?>

    <main class="bl_commonLowPageWhiteMain">

        <div class="bl_commonLowPageWhiteMain_ttlWrapper">
            <h1 class="el_commonLowPageWhiteMain_ttl">採用エントリーフォーム</h1>
        </div>

        <section class="bl_entryFormSection">
            <div class="bl_entryFormSection_inner">
                <?php the_content(); ?>
            </div>
        </section>

        <div>
            <?php include(get_template_directory() . '/inc/breadcrumbs.php'); ?>
        </div>
    </main>

    <?php get_footer(); ?>
    <script>
        (function() {
            var postTitle = '<?php echo esc_js($post_title); ?>';
            
            function setJobValue() {
                var jobInput = document.querySelector("input[name='job']");
                if (jobInput) {
                    jobInput.value = postTitle;
                    return true;
                }
                return false;
            }
            
            // DOMContentLoaded時に試行
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', setJobValue);
            } else {
                setJobValue();
            }
            
            // Contact Form 7が遅延読み込みの場合に備えて再試行
            window.addEventListener('load', function() {
                if (!setJobValue()) {
                    // それでも見つからない場合は少し待ってから再試行
                    setTimeout(setJobValue, 500);
                }
            });
        })();
    </script>
</body>

</html>