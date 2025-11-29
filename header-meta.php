<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">

    <!-- キャッシュ対策 -->
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+Display:wght@100..900&family=Noto+Serif+JP:wght@200..900&family=Old+Standard+TT:wght@400;700&display=swap" rel="stylesheet">

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="
https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js
"></script>

    <script type="module" src="<?php echo get_template_directory_uri(); ?>/assets/js/common.js"></script>
    <?php if (is_front_page()): ?>
        <script type="module" src="<?php echo get_template_directory_uri(); ?>/assets/js/top.js"></script>
    <?php endif; ?>

    <?php if (is_singular('price') || is_post_type_archive('price')): ?>
        <script type="module" src="<?php echo get_template_directory_uri(); ?>/assets/js/price.js"></script>
    <?php endif; ?>

    <?php if (is_singular('menu')): ?>
        <script type="module" src="<?php echo get_template_directory_uri(); ?>/assets/js/menu.js"></script>
    <?php endif; ?>

    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/common.css?<?php echo date_i18n("YmdHis"); ?>" type="text/css" />