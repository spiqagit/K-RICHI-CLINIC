<?php
/* ---------- デフォルト設定 ---------- */
// titleタグの出力
add_theme_support('title-tag');
// 固定ページで抜粋を有効化
add_post_type_support('page', 'excerpt');
// アイキャッチ画像を有効化
add_theme_support('post-thumbnails');
// menu投稿タイプでサムネイルを有効化
add_post_type_support('menu', 'thumbnail');

//自動更新を無効化
add_filter('automatic_updater_disabled', '__return_true');

/* ---------- 管理画面 ---------- */
// サイドメニューを非表示
function remove_menus()
{
    remove_menu_page('edit.php'); // 投稿
    remove_menu_page('edit-comments.php'); // コメント
}
add_action('admin_menu', 'remove_menus', 999);

// 投稿タイプ「staff」「concern」のブロックエディターを非表示
function disable_block_editor_for_stuff($use_block_editor, $post_type)
{
    if ($post_type === 'staff' || $post_type === 'concern') {
        return false;
    }
    return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', 'disable_block_editor_for_stuff', 10, 2);

// 投稿タイプ「staff」「concern」のクラシックエディターも非表示
function remove_editor_for_staff()
{
    remove_post_type_support('staff', 'editor');
    remove_post_type_support('concern', 'editor');
    remove_post_type_support('recruit', 'editor');
}
add_action('init', 'remove_editor_for_staff');



// price-catタクソノミーの「表示」ボタンを非表示にする
function remove_price_cat_view_action($actions, $tag)
{
    if (isset($actions['view'])) {
        unset($actions['view']);
    }
    return $actions;
}
add_filter('price-cat_row_actions', 'remove_price_cat_view_action', 10, 2);

// menu-catタクソノミーの「表示」ボタンを非表示にする
function remove_menu_cat_view_action($actions, $tag)
{
    if (isset($actions['view'])) {
        unset($actions['view']);
    }
    return $actions;
}
add_filter('menu-cat_row_actions', 'remove_menu_cat_view_action', 10, 2);

/* ---------- 投稿関連 ---------- */
// single生成制御

// アーカイブの表示条件
function change_posts_per_page($query)
{
    if (is_admin() || !$query->is_main_query())
        return;

    // price投稿タイプのアーカイブページで全件表示
    if (is_post_type_archive('price')) {
        $query->set('posts_per_page', -1);
    }

    // 新着順
    if (is_post_type_archive('case')) {
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
        $query->set('posts_per_page', 9);
    }

    // search-caseページでsパラメータに基づいてフィルタリング
    if (get_query_var('search_case')) {
        $query->set('post_type', 'case');
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
        $query->set('posts_per_page', 9);
        
        $case_id = isset($_GET['s']) ? intval($_GET['s']) : 0;
        if ($case_id > 0) {
            $query->set('meta_query', array(
                array(
                    'key' => 'menu_select',
                    'value' => '"' . $case_id . '"',
                    'compare' => 'LIKE'
                )
            ));
        }
    }
}
add_action('pre_get_posts', 'change_posts_per_page');

// the_archive_title 余計な文字を削除
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_date()) {
        $title = get_the_time('Y年n月');
    } elseif (is_search()) {
        $title = '検索結果：' . esc_html(get_search_query(false));
    } elseif (is_404()) {
        $title = '「404」ページが見つかりません';
    } else {
    }
    return $title;
});


// 一覧・single生成制御
// 共通の404処理関数
function set_404_and_exit()
{
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    get_template_part(404);
    exit;
}

// シンプルな条件チェック用の関数
function disable_pages_by_conditions()
{
    // FAQ関連
    if (is_singular('faq') || is_tax('faq-cat')) {
        set_404_and_exit();
    }

    // menu投稿タイプの個別記事
    if (is_tax('menu-cat') || is_post_type_archive('menu')) {
        set_404_and_exit();
    }

    // price投稿タイプの個別記事
    if (is_singular('price')) {
        set_404_and_exit();
    }

    // staff投稿タイプの個別記事
    if ( is_singular('staff') || is_tax('staff-cat') ) {
        set_404_and_exit();
    }

    // case投稿タイプの個別記事
    if (is_singular('case') || is_tax('case-cat')) {
        set_404_and_exit();
    }

    // concern投稿タイプの個別記事
    if ( is_tax('concern-cat')) {
        set_404_and_exit();
    }

    // news投稿タイプの個別記事
    if (is_singular('news') || is_tax('news-cat') || is_post_type_archive('news')) {
        set_404_and_exit();
    }

    // タクソノミーページ
    $disabled_taxonomies = ['price-cat', 'menu-cat'];
    foreach ($disabled_taxonomies as $taxonomy) {
        if (is_tax($taxonomy)) {
            set_404_and_exit();
        }
    }
}
add_action('template_redirect', 'disable_pages_by_conditions');

// デフォルト投稿のアーカイブ・個別記事を404にする
function disable_default_post_pages()
{
    // デフォルト投稿の個別記事とstaff-catタクソノミー
    if (is_singular('post')) {
        set_404_and_exit();
    }

    //お悩みカテゴリー
    if (is_tax('concern-cat')) {
        set_404_and_exit();
    }

    // staff投稿タイプの個別記事
    if (is_singular('staff') || is_tax('staff-cat')) {
        set_404_and_exit();
    }

    // デフォルト投稿のアーカイブ（ホームページが投稿一覧の場合）
    if (is_home() && !is_front_page()) {
        set_404_and_exit();
    }

    // カテゴリー・タグアーカイブ（デフォルト投稿のみの場合）
    if (is_category() || is_tag()) {
        global $wp_query;
        // クエリにpost_typeが指定されていない、またはpostのみの場合
        if (empty($wp_query->query_vars['post_type']) || $wp_query->query_vars['post_type'] === 'post') {
            set_404_and_exit();
        }
    }
}
add_action('template_redirect', 'disable_default_post_pages');



/* ---------- 検索機能 ---------- */
function custom_search_case_rewrite_rule()
{
    add_rewrite_rule('^search-case/?$', 'index.php?search_case=1', 'top');
    add_rewrite_rule('^search-case/page/([0-9]+)/?$', 'index.php?search_case=1&paged=$matches[1]', 'top');
    add_rewrite_rule('^search-price/?$', 'index.php?search_price=1', 'top');
    add_rewrite_rule('^search-price/page/([0-9]+)/?$', 'index.php?search_price=1&paged=$matches[1]', 'top');
}
add_action('init', 'custom_search_case_rewrite_rule');

function add_query_vars_for_search_case($vars)
{
    $vars[] = 'search_case';
    $vars[] = 'search_price';
    return $vars;
}
add_filter('query_vars', 'add_query_vars_for_search_case');


function load_custom_search_case_template($template)
{
    if (get_query_var('search_case')) {
        $new_template = locate_template('search-case.php');
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    if (get_query_var('search_price')) {
        $new_template = locate_template('search-price.php');
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'load_custom_search_case_template');



function my_custom_search($search, $wp_query)
{
    global $wpdb;
    if (!$wp_query->is_search)
        return $search;
    if (!isset($wp_query->query_vars))
        return $search;
    $search_words = explode(' ', isset($wp_query->query_vars['s']) ? $wp_query->query_vars['s'] : '');
    if (count($search_words) > 0) {
        $search = '';
        foreach ($search_words as $word) {
            if (!empty($word)) {
                $search_word = '%' . esc_sql($word) . '%';
                $search .= " AND (
                    {$wpdb->posts}.post_title LIKE '{$search_word}'
                    OR {$wpdb->posts}.post_content LIKE '{$search_word}'
                    OR {$wpdb->posts}.ID IN (
                        SELECT distinct tr.object_id
                        FROM {$wpdb->term_relationships} AS tr
                        INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                        INNER JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id
                        WHERE t.name LIKE '{$search_word}'
                        OR t.slug LIKE '{$search_word}'
                        OR tt.description LIKE '{$search_word}'
                    )
                    OR {$wpdb->posts}.ID IN (
                        SELECT distinct post_id
                        FROM {$wpdb->postmeta}
                        WHERE meta_value LIKE '{$search_word}'
                    )
                ) ";
            }
        }
    }
    return $search;
}
add_filter('posts_search', 'my_custom_search', 10, 2);
if (isset($_GET['s'])) $_GET['s'] = mb_convert_kana($_GET['s'], 's', 'UTF-8');


function solecolor_wp_terms_checklist_args($args, $post_id)
{
    if (!isset($args['checked_ontop']) || $args['checked_ontop'] !== false) {
        $args['checked_ontop'] = false;
    }
    return $args;
}
add_filter('wp_terms_checklist_args', 'solecolor_wp_terms_checklist_args', 10, 2);


// 投稿一覧にカスタムカラムを追加（foods, price, case）
$post_types_with_menu_select = ['foods', 'price', 'case'];
foreach ($post_types_with_menu_select as $post_type) {
    // カラムを追加
    add_filter("manage_{$post_type}_posts_columns", function ($columns) {
        $new_columns = [];
        foreach ($columns as $key => $value) {
            $new_columns[$key] = $value;
            if ($key === 'title') {
                $new_columns['menu_select'] = '選択している関連施術';
            }
        }
        return $new_columns;
    });

    // カラムに値を表示
    add_action("manage_{$post_type}_posts_custom_column", function ($column_name, $post_id) {
        if ($column_name === 'menu_select') {
            $related_posts = get_field('menu_select', $post_id);
            if ($related_posts) {
                $output = '';
                foreach ($related_posts as $related_post) {
                    $related_post_id = is_object($related_post) ? $related_post->ID : $related_post;
                    $output .= get_the_title($related_post_id) . '<br>';
                }
                echo $output;
            }
        }
    }, 10, 2);
}
