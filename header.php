<header class="ly_header">
    <div class="bl_header_inenr">
        <div class="bl_header_logo">
            <?php if (is_front_page()): ?>
                <h1 class="bl_header_logoWrapper">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/logo.svg" alt="K-RICH Clinic">
                </h1>
            <?php else: ?>
                <a class="bl_header_logoWrapper is_hoverOpacity" href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/logo.svg" alt="K-RICH Clinic">
                </a>
            <?php endif; ?>
        </div>
        <div class="bl_header_navWrapper">
            <nav class="bl_header_navWrapper_nav">
                <button class="bl_header_navBtn" type="button">
                    <span class="el_header_navBtn_en">Clinic</span>
                    <span class="el_header_navBtn_ja">クリニックについて</span>
                </button>
                <a class="bl_header_navBtn" href="<?php echo home_url(); ?>/concern/">
                    <span class="el_header_navBtn_en">Concern</span>
                    <span class="el_header_navBtn_ja">お悩み</span>
                </a>
                <a class="bl_header_navBtn" href="<?php echo home_url(); ?>/treatment/">
                    <span class="el_header_navBtn_en">treatment</span>
                    <span class="el_header_navBtn_ja">施術</span>
                </a>
                <a class="bl_header_navBtn" href="<?php echo home_url(); ?>/price/">
                    <span class="el_header_navBtn_en">price</span>
                    <span class="el_header_navBtn_ja">料金</span>
                </a>
                <a class="bl_header_navBtn" href="<?php echo home_url(); ?>/regen-med/">
                    <span class="el_header_navBtn_en">regen.med.</span>
                    <span class="el_header_navBtn_ja">再生医療</span>
                </a>
                <a class="bl_header_navBtn" href="<?php echo home_url(); ?>/case/">
                    <span class="el_header_navBtn_en">case</span>
                    <span class="el_header_navBtn_ja">症例</span>
                </a>
                <a class="bl_header_navBtn" href="<?php echo home_url(); ?>/case/">
                    <span class="el_header_navBtn_en">news</span>
                    <span class="el_header_navBtn_ja">お知らせ</span>
                </a>
                <a class="bl_header_navBtn" href="<?php echo home_url(); ?>/recruit/">
                    <span class="el_header_navBtn_en">recruit</span>
                    <span class="el_header_navBtn_ja">採用情報</span>
                </a>
                <a class="bl_header_navBtn" href="<?php echo home_url(); ?>/column/">
                    <span class="el_header_navBtn_en">column</span>
                    <span class="el_header_navBtn_ja">コラム</span>
                </a>
                <a class="bl_header_navBtn" href="<?php echo home_url(); ?>/access/">
                    <span class="el_header_navBtn_en">access</span>
                    <span class="el_header_navBtn_ja">アクセス</span>
                </a>
            </nav>
            <div>
                <?php echo do_shortcode('[gtranslate]'); ?>
            </div>
        </div>
    </div>
</header>