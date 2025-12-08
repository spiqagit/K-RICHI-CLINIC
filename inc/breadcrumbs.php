<div class="bl_commonBreadcrumbsContainer">
    <ul class="bl_commonBreadcrumbsList">
        <li class="bl_commonBreadcrumbsItem">
            <a href="<?php echo home_url(); ?>" class="bl_commonBreadcrumbsLink">トップ</a>
        </li>
        <li class="bl_commonBreadcrumbsItem bl_commonBreadcrumbsSeparator">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-icon.svg" alt="">
        </li>
        <?php if (is_page('about')): ?>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText">クリニックについて</p>
            </li>
        <?php endif; ?>
        <?php if (is_post_type_archive('price')  && is_archive()): ?>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText">料金表</p>
            </li>
        <?php endif; ?>

        <?php if (is_singular("price")): ?>
            <li class="bl_commonBreadcrumbsItem">
                <a href="<?php echo home_url(); ?>/price/" class="bl_commonBreadcrumbsLink">料金表</a>
            </li>
            <li class="bl_commonBreadcrumbsItem bl_commonBreadcrumbsSeparator">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-icon.svg" alt="">
            </li>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText"><?php the_title(); ?></p>
            </li>
        <?php endif; ?>

        <?php if (is_post_type_archive('staff')  && is_archive()): ?>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText">スタッフ紹介</p>
            </li>
        <?php endif; ?>

        <?php if (is_post_type_archive('concern')  && is_archive()): ?>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText">お悩み</p>
            </li>
        <?php endif; ?>

        <?php if (is_singular("concern")): ?>
            <li class="bl_commonBreadcrumbsItem">
                <a href="<?php echo home_url(); ?>/concern/" class="bl_commonBreadcrumbsLink">お悩み一覧</a>
            </li>
            <li class="bl_commonBreadcrumbsItem bl_commonBreadcrumbsSeparator">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-icon.svg" alt="">
            </li>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText"><?php the_title(); ?></p>
            </li>
        <?php endif; ?>

        <?php if (is_singular("menu")): ?>
            <li class="bl_commonBreadcrumbsItem">
                <a href="<?php echo home_url(); ?>/treatment/" class="bl_commonBreadcrumbsLink">施術メニュー</a>
            </li>
            <li class="bl_commonBreadcrumbsItem bl_commonBreadcrumbsSeparator">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-icon.svg" alt="">
            </li>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText"><?php the_title(); ?></p>
            </li>
        <?php endif; ?>

        <?php if (is_post_type_archive('recruit')  && is_archive()): ?>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText">採用情報</p>
            </li>
        <?php endif; ?>


        <?php if (is_post_type_archive('case')  && is_archive()): ?>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText">症例</p>
            </li>
        <?php endif; ?>

        <?php if (is_singular("case")): ?>  
            <li class="bl_commonBreadcrumbsItem">
                <a href="<?php echo home_url(); ?>/case/" class="bl_commonBreadcrumbsLink">症例</a>
            </li>
            <li class="bl_commonBreadcrumbsItem bl_commonBreadcrumbsSeparator">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-icon.svg" alt="">
            </li>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText"><?php the_title(); ?></p>
            </li>
        <?php endif; ?>

        <?php if (is_404()): ?>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText">ページが見つかりませんでした</p>
            </li>
        <?php endif; ?>


        <?php if (is_page('thanks')): ?>
            <li class="bl_commonBreadcrumbsItem">
                <a href="<?php echo home_url(); ?>/recruit/" class="bl_commonBreadcrumbsLink">採用情報</a>
            </li>
            <li class="bl_commonBreadcrumbsItem bl_commonBreadcrumbsSeparator">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-icon.svg" alt="">
            </li>
        <?php endif; ?>

        <?php if (is_page()): ?>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText"><?php the_title(); ?></p>
            </li>
        <?php endif; ?>
    </ul>
</div>