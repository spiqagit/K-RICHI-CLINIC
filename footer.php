<div class="ly_footerContainer">
    <div class="ly_reserveOutLineWrapper">
        <div class="ly_reserveOutLine">
            <section class="ly_reserveSection">
                <div class="bl_reserveSection_inner">
                    <div class="bl_reserveSection_title">
                        <h2 class="el_reserveSection_title_ttl">Reserve</h2>
                        <p class="el_reserveSection_title_txt">ご予約</p>
                    </div>

                    <div class="bl_reserveSection_txtWrapper">
                        <?php if (get_field('time', 'option')): ?>
                            <p class="el_reserveSection_timeTxt"><?php echo get_field('time', 'option'); ?></p>
                        <?php endif; ?>

                        <div class="bl_reserveBtnWrapper">
                            <?php if (get_field('re-tel-num', 'option')): ?>
                                <a href="tel:<?php echo get_field('re-tel-num', 'option'); ?>" class="bl_reserveBtn">
                                    <div class="bl_reserveBtn_iconWrapper">
                                        <svg class="el_reserveBtn_icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path d="M17.6693 14.0998L13.562 10.3654C13.368 10.1887 13.1128 10.0944 12.8505 10.1025C12.5882 10.1106 12.3393 10.2205 12.1565 10.4089L9.73862 12.8954C9.15662 12.7843 7.98657 12.4195 6.78216 11.2182C5.57775 10.0128 5.21299 8.8397 5.10488 8.26175L7.58948 5.84284C7.77783 5.66009 7.88768 5.41122 7.89579 5.14891C7.9039 4.88659 7.80963 4.63141 7.63292 4.43737L3.89946 0.331101C3.72268 0.136454 3.47698 0.0183856 3.21455 0.00197209C2.95212 -0.0144414 2.69363 0.0720925 2.49398 0.243196L0.301387 2.12355C0.126699 2.29887 0.0224326 2.53221 0.00836817 2.7793C-0.00678798 3.0319 -0.295765 9.01551 4.34404 13.6573C8.39174 17.704 13.462 18 14.8584 18C15.0625 18 15.1878 17.9939 15.2211 17.9919C15.468 17.9773 15.7009 17.8727 15.8758 17.6979L17.7552 15.5043C17.927 15.3053 18.0142 15.047 17.9981 14.7846C17.9821 14.5222 17.8641 14.2765 17.6693 14.0998Z" />
                                        </svg>
                                    </div>
                                    <p class="el_reserveBtn_txt">電話予約</p>
                                </a>
                            <?php endif; ?>

                            <?php if (get_field('re-line-url', 'option')): ?>
                                <a href="<?php echo get_field('re-line-url', 'option'); ?>" class="bl_reserveBtn bl_reserveBtn_brown">
                                    <div class="bl_reserveBtn_iconWrapper">
                                        <svg class="el_reserveBtn_icon" xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                            <path d="M20.999 8.52046C20.999 3.8223 16.289 0 10.4995 0C4.70997 0 0 3.8223 0 8.52046C0 12.7325 3.7357 16.2595 8.78125 16.9268C9.12273 17.0006 9.58822 17.1521 9.70631 17.4444C9.8126 17.7101 9.7752 18.1254 9.74076 18.3941C9.74076 18.3941 9.61774 19.1351 9.59117 19.2926C9.54492 19.5583 9.38057 20.3308 10.5005 19.8584C11.6214 19.3861 16.5469 16.2979 18.7493 13.7628C20.2708 12.0938 21 10.4011 21 8.52046H20.999ZM6.7953 11.0329C6.7953 11.1441 6.70575 11.2337 6.59455 11.2337H3.64516C3.53395 11.2337 3.4444 11.1441 3.4444 11.0329V11.0299V6.45086C3.4444 6.33966 3.53395 6.2501 3.64516 6.2501H4.39013C4.50035 6.2501 4.59089 6.34064 4.59089 6.45086V10.0881H6.59553C6.70575 10.0881 6.79629 10.1787 6.79629 10.2889V11.0339L6.7953 11.0329ZM8.57065 11.0329C8.57065 11.1431 8.48109 11.2337 8.36989 11.2337H7.62491C7.51469 11.2337 7.42415 11.1441 7.42415 11.0329V6.45086C7.42415 6.34064 7.51371 6.2501 7.62491 6.2501H8.36989C8.48109 6.2501 8.57065 6.33966 8.57065 6.45086V11.0329ZM13.6398 11.0329C13.6398 11.1431 13.5503 11.2337 13.4391 11.2337H12.699C12.6813 11.2337 12.6636 11.2307 12.6468 11.2268C12.6468 11.2268 12.6449 11.2268 12.6439 11.2268C12.639 11.2258 12.635 11.2238 12.6301 11.2228C12.6281 11.2228 12.6262 11.2209 12.6242 11.2209C12.6213 11.2199 12.6173 11.2179 12.6144 11.2169C12.6114 11.215 12.6075 11.214 12.6045 11.212C12.6026 11.211 12.6006 11.21 12.5986 11.2091C12.5947 11.2071 12.5898 11.2041 12.5858 11.2012C12.5858 11.2012 12.5839 11.2002 12.5839 11.1992C12.5642 11.1854 12.5465 11.1687 12.5317 11.149L10.4326 8.31379V11.0349C10.4326 11.1451 10.343 11.2356 10.2318 11.2356H9.48686C9.37663 11.2356 9.2861 11.1461 9.2861 11.0349V6.45283C9.2861 6.34261 9.37565 6.25207 9.48686 6.25207H10.2269C10.2269 6.25207 10.2318 6.25207 10.2338 6.25207C10.2377 6.25207 10.2407 6.25207 10.2446 6.25207C10.2486 6.25207 10.2515 6.25207 10.2554 6.25306C10.2584 6.25306 10.2614 6.25306 10.2643 6.25404C10.2682 6.25404 10.2722 6.25601 10.2761 6.25699C10.2781 6.25699 10.281 6.25798 10.283 6.25896C10.2869 6.25995 10.2909 6.26191 10.2948 6.2629C10.2968 6.2629 10.2987 6.26487 10.3017 6.26487C10.3056 6.26683 10.3096 6.26782 10.3135 6.26979C10.3155 6.27077 10.3174 6.27176 10.3194 6.27274C10.3234 6.27471 10.3273 6.27668 10.3302 6.27864C10.3322 6.27963 10.3342 6.28061 10.3361 6.28258C10.3401 6.28455 10.343 6.2875 10.347 6.28947C10.3489 6.29045 10.3509 6.29242 10.3529 6.29341C10.3568 6.29636 10.3598 6.29931 10.3637 6.30226C10.3647 6.30325 10.3667 6.30423 10.3676 6.30522C10.3716 6.30915 10.3755 6.31309 10.3794 6.31801C10.3794 6.31801 10.3794 6.31801 10.3804 6.31899C10.3863 6.32588 10.3913 6.33277 10.3962 6.33966L12.4923 9.17095V6.44988C12.4923 6.33966 12.5819 6.24912 12.6931 6.24912H13.4381C13.5483 6.24912 13.6388 6.33868 13.6388 6.44988V11.0319L13.6398 11.0329ZM17.7062 7.19485C17.7062 7.30606 17.6166 7.39561 17.5054 7.39561H15.5008V8.16913H17.5054C17.6156 8.16913 17.7062 8.25967 17.7062 8.36989V9.11486C17.7062 9.22606 17.6166 9.31562 17.5054 9.31562H15.5008V10.0891H17.5054C17.6156 10.0891 17.7062 10.1797 17.7062 10.2899V11.0349C17.7062 11.1461 17.6166 11.2356 17.5054 11.2356H14.556C14.4448 11.2356 14.3553 11.1461 14.3553 11.0349V11.0319V6.45775V6.45283C14.3553 6.34163 14.4448 6.25207 14.556 6.25207H17.5054C17.6156 6.25207 17.7062 6.34261 17.7062 6.45283V7.19781V7.19485Z" />
                                        </svg>
                                    </div>
                                    <p class="el_reserveBtn_txt">LINE予約</p>
                                </a>
                            <?php endif; ?>

                            <?php if (get_field('re-web-url', 'option')): ?>
                                <a href="<?php echo get_field('re-line-url', 'option'); ?>" class="bl_reserveBtn ">
                                    <div class="bl_reserveBtn_iconWrapper">
                                        <svg class="el_reserveBtn_icon" xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17" fill="none">
                                            <path d="M17.7778 0C18.3671 0 18.9324 0.212691 19.3491 0.591284C19.7659 0.969877 20 1.48336 20 2.01877V14.1314C20 14.6668 19.7659 15.1803 19.3491 15.5589C18.9324 15.9375 18.3671 16.1502 17.7778 16.1502H2.22222C1.63285 16.1502 1.06762 15.9375 0.650874 15.5589C0.234126 15.1803 0 14.6668 0 14.1314V2.01877C0 1.48336 0.234126 0.969877 0.650874 0.591284C1.06762 0.212691 1.63285 0 2.22222 0H17.7778ZM17.7778 6.05631H2.22222V13.122C2.22226 13.3692 2.32217 13.6079 2.50302 13.7926C2.68386 13.9774 2.93305 14.0954 3.20333 14.1243L3.33333 14.1314H16.6667C16.9388 14.1314 17.2015 14.0406 17.4049 13.8763C17.6082 13.712 17.7382 13.4856 17.77 13.2401L17.7778 13.122V6.05631ZM3.33333 2.01877C3.03865 2.01877 2.75603 2.12512 2.54766 2.31441C2.33929 2.50371 2.22222 2.76045 2.22222 3.02816C2.22222 3.29586 2.33929 3.5526 2.54766 3.7419C2.75603 3.9312 3.03865 4.03754 3.33333 4.03754C3.62802 4.03754 3.91063 3.9312 4.11901 3.7419C4.32738 3.5526 4.44444 3.29586 4.44444 3.02816C4.44444 2.76045 4.32738 2.50371 4.11901 2.31441C3.91063 2.12512 3.62802 2.01877 3.33333 2.01877ZM6.66667 2.01877C6.37198 2.01877 6.08937 2.12512 5.88099 2.31441C5.67262 2.50371 5.55556 2.76045 5.55556 3.02816C5.55556 3.29586 5.67262 3.5526 5.88099 3.7419C6.08937 3.9312 6.37198 4.03754 6.66667 4.03754C6.96135 4.03754 7.24397 3.9312 7.45234 3.7419C7.66071 3.5526 7.77778 3.29586 7.77778 3.02816C7.77778 2.76045 7.66071 2.50371 7.45234 2.31441C7.24397 2.12512 6.96135 2.01877 6.66667 2.01877ZM10 2.01877C9.70532 2.01877 9.4227 2.12512 9.21433 2.31441C9.00595 2.50371 8.88889 2.76045 8.88889 3.02816C8.88889 3.29586 9.00595 3.5526 9.21433 3.7419C9.4227 3.9312 9.70532 4.03754 10 4.03754C10.2947 4.03754 10.5773 3.9312 10.7857 3.7419C10.994 3.5526 11.1111 3.29586 11.1111 3.02816C11.1111 2.76045 10.994 2.50371 10.7857 2.31441C10.5773 2.12512 10.2947 2.01877 10 2.01877Z" />
                                        </svg>
                                    </div>
                                    <p class="el_reserveBtn_txt">WEB予約</p>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <footer class="ly_footer">
        <div class="bl_footer_upper">
            <div class="bl_footerClinicInfoContainer">
                <div class="bl_footerClinicInfoWrapper">
                    <div class="bl_footerClinicInfoWrapper_logoContainer">
                        <div class="bl_footerClinicInfoWrapper_logo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/logo.svg" alt="K-RICH Clinic">
                        </div>
                        <div class="bl_commonSnsIconContainer">
                            <?php if (get_field('instagram-url', 'option')): ?>
                                <a href="<?php echo get_field('instagram-url', 'option'); ?>" class="bl_commonSnsIconContainer_btn" target="_blank">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/instagram-icon.svg" alt="Instagram">
                                </a>
                            <?php endif; ?>
                            <?php if (get_field('youtube-url', 'option')): ?>
                                <a href="<?php echo get_field('youtube-url', 'option'); ?>" class="bl_commonSnsIconContainer_btn" target="_blank">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/youtube-icon.svg" alt="YouTube">
                                </a>
                            <?php endif; ?>
                            <?php if (get_field('x-url', 'option')): ?>
                                <a href="<?php echo get_field('x-url', 'option'); ?>" class="bl_commonSnsIconContainer_btn" target="_blank">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/x-icon.svg" alt="X">
                                </a>
                            <?php endif; ?>
                            <?php if (get_field('tiktok-url', 'option')): ?>
                                <a href="<?php echo get_field('tiktok-url', 'option'); ?>" class="bl_commonSnsIconContainer_btn" target="_blank">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/tiktok-icon.svg" alt="X">
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="bl_footerClinicInfoWrapper_addressContainer">
                        <div class="bl_footerClinicInfoWrapper_addressWrapper">
                            <?php if (get_field('post-code', 'option')): ?>
                                <p class="el_footerClinicInfoWrapper_numberTxt"><?php echo get_field('post-code', 'option'); ?></p>
                            <?php endif; ?>
                            <?php if (get_field('address', 'option')): ?>
                                <p class="el_footerClinicInfoWrapper_addressTxt"><?php echo get_field('address', 'option'); ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if (get_field('google_map_link', 'option')): ?>
                            <a href="<?php echo get_field('google_map_link', 'option'); ?>" class="bl_commonGoogleMapLink" target="_blank">
                                <p class="el_commonGoogleMapLink_txt">Google Maps</p>
                                <img class="el_commonGoogleMapLink_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/out-arrow.svg" alt="">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="bl_footerClinicInfoWrapper_mapContainer">
                    <?php if (get_field('googlemap-code', 'option')): ?>
                        <?php echo get_field('googlemap-code', 'option'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="bl_footer_lower">
            <div class="bl_footer_aboutClinicContainer">
                <div class="bl_footer_btnTitle">
                    <p class="el_footer_btnTitle_en">clinic</p>
                    <p class="el_footer_btnTitle_ja">クリニックについて</p>
                </div>
                <div class="bl_footer_aboutClinicLinkContainer">
                    <a class="el_footer_aboutClinicLinkContainer_link" href="<?php echo home_url(); ?>/about/">クリニックについて</a>
                    <a class="el_footer_aboutClinicLinkContainer_link" href="<?php echo home_url(); ?>/manager/">院長紹介</a>
                    <a class="el_footer_aboutClinicLinkContainer_link" href="<?php echo home_url(); ?>/staff/">スタッフ紹介</a>
                </div>
            </div>

            <div class="bl_footer_btnContainer">
                <a href="<?php echo home_url(); ?>/guide/" class="bl_footer_btnTitle bl_footer_btn">
                    <p class="el_footer_btnTitle_en">guide</p>
                    <p class="el_footer_btnTitle_ja">初めての方へ</p>
                </a>

                <a href="<?php echo home_url(); ?>/regen-med/" class="bl_footer_btnTitle bl_footer_btn">
                    <p class="el_footer_btnTitle_en">regen.med.</p>
                    <p class="el_footer_btnTitle_ja">再生医療</p>
                </a>

                <a href="<?php echo home_url(); ?>/recruit/" class="bl_footer_btnTitle bl_footer_btn">
                    <p class="el_footer_btnTitle_en">recruit</p>
                    <p class="el_footer_btnTitle_ja">採用情報</p>
                </a>

                <a href="<?php echo home_url(); ?>/concern/" class="bl_footer_btnTitle bl_footer_btn">
                    <p class="el_footer_btnTitle_en">concern</p>
                    <p class="el_footer_btnTitle_ja">お悩み</p>
                </a>

                <a href="<?php echo home_url(); ?>/case/" class="bl_footer_btnTitle bl_footer_btn">
                    <p class="el_footer_btnTitle_en">case</p>
                    <p class="el_footer_btnTitle_ja">症例</p>
                </a>

                <a href="<?php echo home_url(); ?>/column/" class="bl_footer_btnTitle bl_footer_btn">
                    <p class="el_footer_btnTitle_en">column</p>
                    <p class="el_footer_btnTitle_ja">コラム</p>
                </a>

                <a href="<?php echo home_url(); ?>/treatment/" class="bl_footer_btnTitle bl_footer_btn">
                    <p class="el_footer_btnTitle_en">treatment</p>
                    <p class="el_footer_btnTitle_ja">施術</p>
                </a>

                <a href="<?php echo home_url(); ?>/news/" class="bl_footer_btnTitle bl_footer_btn">
                    <p class="el_footer_btnTitle_en">news</p>
                    <p class="el_footer_btnTitle_ja">お知らせ</p>
                </a>

                <a href="<?php echo home_url(); ?>/access/" class="bl_footer_btnTitle bl_footer_btn">
                    <p class="el_footer_btnTitle_en">access</p>
                    <p class="el_footer_btnTitle_ja">アクセス</p>
                </a>

                <a href="<?php echo home_url(); ?>/price/" class="bl_footer_btnTitle bl_footer_btn">
                    <p class="el_footer_btnTitle_en">price</p>
                    <p class="el_footer_btnTitle_ja">料金</p>
                </a>
            </div>
        </div>

        <div class="bl_footer_copyrightContainer">
            <div class="bl_footer_copyrightWrapper_inner">
                <a class="bl_footer_copyrightLink" href="<?php echo home_url(); ?>/privacy-policy/">プライバシーポリシー</a>
                <small class="bl_footer_copyrightTxt">&copy;K-rich Clinic</small>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</div>