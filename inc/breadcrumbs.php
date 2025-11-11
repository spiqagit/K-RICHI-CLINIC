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

        <?php if (is_404()): ?>
            <li class="bl_commonBreadcrumbsItem">
                <p class="bl_commonBreadcrumbsText">ページが見つかりませんでした</p>
            </li>
        <?php endif; ?>
    </ul>
</div>