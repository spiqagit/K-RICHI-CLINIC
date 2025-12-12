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
    remove_post_type_support('faq', 'editor');
}
add_action('init', 'remove_editor_for_staff');

// 特定のページテンプレートでエディタを無効化
function remove_editor_for_page_templates()
{
    if (!isset($_GET['post'])) {
        return;
    }

    $post_id = $_GET['post'];
    $post = get_post($post_id);

    if (!$post || $post->post_type !== 'page') {
        return;
    }

    // 無効にしたいページテンプレートを配列で指定
    $disabled_templates = [
        'page-access.php',
    ];

    $template = get_post_meta($post_id, '_wp_page_template', true);

    if (in_array($template, $disabled_templates)) {
        remove_post_type_support('page', 'editor');
    }
}
add_action('admin_init', 'remove_editor_for_page_templates');

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

    // news投稿タイプのアーカイブページ（年月アーカイブ含む）で10件表示
    if (is_post_type_archive('news') || (is_date() && get_query_var('post_type') === 'news')) {
        $query->set('posts_per_page', 10);
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }

    // column投稿タイプのアーカイブページ（年月アーカイブ含む）で10件表示
    if (is_post_type_archive('column') || (is_date() && get_query_var('post_type') === 'column')) {
        $query->set('posts_per_page', 10);
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
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
    if ( is_tax('department-cat')) {
        set_404_and_exit();
    }

    // price投稿タイプの個別記事
    if (is_singular('price')) {
        set_404_and_exit();
    }

    // staff投稿タイプの個別記事
    if (is_singular('staff') || is_tax('staff-cat')) {
        set_404_and_exit();
    }

    // concern投稿タイプの個別記事
    if (is_tax('concern-cat')) {
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

    // staff投稿タイプの個別記事
    if (is_singular('faq') || is_tax('faq-cat')) {
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
$post_types_with_menu_select = ['price', 'case'];
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

    // カラムに値を表示（クリックで絞り込みリンク）
    add_action("manage_{$post_type}_posts_custom_column", function ($column_name, $post_id) {
        if ($column_name === 'menu_select') {
            $related_posts = get_field('menu_select', $post_id);
            if ($related_posts) {
                $output = '';
                $current_post_type = get_post_type($post_id);
                foreach ($related_posts as $related_post) {
                    $related_post_id = is_object($related_post) ? $related_post->ID : $related_post;
                    $filter_url = admin_url("edit.php?post_type={$current_post_type}&filter_menu_select={$related_post_id}");
                    $output .= '<a href="' . esc_url($filter_url) . '">' . esc_html(get_the_title($related_post_id)) . '</a><br>';
                }
                echo $output;
            }
        }
    }, 10, 2);
}

// 関連施術で絞り込みフィルターを追加
add_action('restrict_manage_posts', function ($post_type) {
    $post_types_with_menu_select = ['price', 'case'];
    if (!in_array($post_type, $post_types_with_menu_select)) {
        return;
    }

    // menuの投稿一覧を取得
    $menus = get_posts([
        'post_type'      => 'menu',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    ]);

    if (empty($menus)) {
        return;
    }

    $selected = isset($_GET['filter_menu_select']) ? $_GET['filter_menu_select'] : '';

    echo '<select name="filter_menu_select">';
    echo '<option value="">関連施術で絞り込み</option>';
    foreach ($menus as $menu) {
        $is_selected = selected($selected, $menu->ID, false);
        echo '<option value="' . esc_attr($menu->ID) . '"' . $is_selected . '>' . esc_html($menu->post_title) . '</option>';
    }
    echo '</select>';
});

// 絞り込みクエリを修正
add_action('pre_get_posts', function ($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    $post_types_with_menu_select = ['price', 'case'];
    $current_post_type = $query->get('post_type');

    if (!in_array($current_post_type, $post_types_with_menu_select)) {
        return;
    }

    if (empty($_GET['filter_menu_select'])) {
        return;
    }

    $menu_id = intval($_GET['filter_menu_select']);

    // ACFのリレーションフィールドはシリアライズされた配列で保存されるためLIKE検索
    $meta_query = $query->get('meta_query') ?: [];
    $meta_query[] = [
        'key'     => 'menu_select',
        'value'   => '"' . $menu_id . '"',
        'compare' => 'LIKE',
    ];
    $query->set('meta_query', $meta_query);
});


// Contact Form 7 で生年月日の年の選択肢を動的に生成
add_filter('wpcf7_form_tag', 'dynamic_birth_year_options', 10, 1);
function dynamic_birth_year_options($tag)
{
    if ($tag['name'] === 'birth-year') {
        $currentYear = intval(date('Y'));
        $options = array('');  // 最初に空のオプション（プレースホルダー用）

        for ($year = 1936; $year <= $currentYear; $year++) {
            $options[] = strval($year);
        }

        $tag['raw_values'] = $options;
        $tag['values'] = $options;
        $tag['labels'] = $options;
    }
    return $tag;
}


/**
 * Contact Form 7のフォームにh-adrクラスを追加
 */
add_filter('wpcf7_form_class_attr', 'add_h_adr_class_to_cf7', 10, 1);

function add_h_adr_class_to_cf7($class)
{
    // フォームID 76 に h-adr クラスを追加
    $contact_form = wpcf7_get_current_contact_form();
    if ($contact_form && $contact_form->id() == 1974) {
        $class .= ' h-adr';
    }
    return $class;
}



/**
 * Contact Form 7 生年月日フィールドのカスタム検証
 */
add_filter('wpcf7_validate_select', 'custom_birthdate_validation', 20, 2);
add_filter('wpcf7_validate_select*', 'custom_birthdate_validation', 20, 2);

function custom_birthdate_validation($result, $tag)
{
    $tag = new WPCF7_FormTag($tag);
    $name = $tag->name;

    // 生年月日フィールドの検証
    if (in_array($name, array('birth-year', 'birth-month', 'birth-date'))) {
        $year = isset($_POST['birth-year']) ? trim($_POST['birth-year']) : '';
        $month = isset($_POST['birth-month']) ? trim($_POST['birth-month']) : '';
        $date = isset($_POST['birth-date']) ? trim($_POST['birth-date']) : '';

        // いずれかが空の場合
        if (empty($year) || empty($month) || empty($date)) {
            // 最初のフィールド(year)でのみエラーを表示
            if ($name === 'birth-year') {
                $result->invalidate($tag, '生年月日を入力してください');
            }
        } else {
            // すべて入力されている場合、日付の妥当性チェック
            if (!checkdate((int)$month, (int)$date, (int)$year)) {
                if ($name === 'birth-year') {
                    $result->invalidate($tag, '正しい日付を入力してください');
                }
            }
        }
    }

    return $result;
}

/**
 * 生年月日エラーメッセージの表示位置をカスタマイズ
 */
add_filter('wpcf7_ajax_json_echo', 'wpcf7_birthdate_error_position', 10, 2);

function wpcf7_birthdate_error_position($items, $result)
{
    $class = 'wpcf7-custom-item-error';
    // birth-yearのエラーをfulldateの位置に表示
    $target_names = array('birth-year');

    if (isset($items['invalid_fields'])) {
        foreach ($items['invalid_fields'] as $k => $v) {
            $orig = $v['into'];
            // フィールド名を抽出
            foreach ($target_names as $name) {
                if (strpos($orig, $name) !== false) {
                    // エラー表示位置を変更
                    $items['invalid_fields'][$k]['into'] = ".{$class}.fulldate";
                    break;
                }
            }
        }
    }
    return $items;
}

/**
 * hidden フィールド "fulldate" に値を設定
 */
add_filter('wpcf7_posted_data', 'combine_birthdate_fields');

function combine_birthdate_fields($posted_data)
{
    if (
        isset($posted_data['birth-year']) &&
        isset($posted_data['birth-month']) &&
        isset($posted_data['birth-date'])
    ) {

        // 配列の場合は最初の要素を取得
        $year = is_array($posted_data['birth-year']) ? $posted_data['birth-year'][0] : $posted_data['birth-year'];
        $month = is_array($posted_data['birth-month']) ? $posted_data['birth-month'][0] : $posted_data['birth-month'];
        $date = is_array($posted_data['birth-date']) ? $posted_data['birth-date'][0] : $posted_data['birth-date'];

        if (!empty($year) && !empty($month) && !empty($date)) {
            $month = str_pad($month, 2, '0', STR_PAD_LEFT);
            $date = str_pad($date, 2, '0', STR_PAD_LEFT);
            $posted_data['fulldate'] = $year . '-' . $month . '-' . $date;
        }
    }

    return $posted_data;
}



/**
 * カスタム投稿タイプに日付ベースのリライトルールを追加
 * example.com/news/2025/10/ の形式でアクセス可能にする
 */

function add_custom_post_date_rewrite_rules()
{
    // 対象のカスタム投稿タイプを指定
    $post_types = array('news', 'column'); // ここに実際の投稿タイプ名を設定

    foreach ($post_types as $post_type) {
        $post_type_obj = get_post_type_object($post_type);

        if (!$post_type_obj || !$post_type_obj->has_archive) {
            continue;
        }

        // 投稿タイプのスラッグを取得
        $archive_slug = $post_type_obj->rewrite['slug'];

        // 年月 + ページネーション: /news/2025/10/page/2/
        add_rewrite_rule(
            $archive_slug . '/([0-9]{4})/([0-9]{1,2})/page/([0-9]+)/?$',
            'index.php?post_type=' . $post_type . '&year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]',
            'top'
        );

        // 年月: /news/2025/10/
        add_rewrite_rule(
            $archive_slug . '/([0-9]{4})/([0-9]{1,2})/?$',
            'index.php?post_type=' . $post_type . '&year=$matches[1]&monthnum=$matches[2]',
            'top'
        );

        // 年 + ページネーション: /news/2025/page/2/
        add_rewrite_rule(
            $archive_slug . '/([0-9]{4})/page/([0-9]+)/?$',
            'index.php?post_type=' . $post_type . '&year=$matches[1]&paged=$matches[2]',
            'top'
        );

        // 年: /news/2025/
        add_rewrite_rule(
            $archive_slug . '/([0-9]{4})/?$',
            'index.php?post_type=' . $post_type . '&year=$matches[1]',
            'top'
        );
    }
}
add_action('init', 'add_custom_post_date_rewrite_rules');



function add_multiple_attribute_to_cf7_file_field($tag)
{
    // $tagがオブジェクトでない場合はそのまま返す
    if (!is_object($tag)) {
        return $tag;
    }

    // ファイルフィールドかどうかを basetype で確認
    if ('file' !== $tag->basetype) {
        return $tag;
    }

    // multipleオプションが既に存在するかチェックして追加
    if (!in_array('multiple', $tag->options)) {
        $tag->options[] = 'multiple';
    }

    return $tag;
}
add_filter('wpcf7_form_tag', 'add_multiple_attribute_to_cf7_file_field');

// プライバシーポリシーリンクのショートコード
function privacy_link_shortcode($atts) {
    $atts = shortcode_atts(array(
        'text' => 'プライバシーポリシー',
        'class' => '',
    ), $atts, 'privacy_link');

    $privacy_url = get_permalink(get_page_by_path('privacy'));
    
    if (!$privacy_url) {
        $privacy_url = home_url('/privacy/');
    }

    $class_attr = !empty($atts['class']) ? ' class="' . esc_attr($atts['class']) . '"' : '';
    
    return '<a href="' . esc_url($privacy_url) . '"' . $class_attr . ' target="_blank" rel="noopener noreferrer">' . esc_html($atts['text']) . '</a>';
}
add_shortcode('privacy_link', 'privacy_link_shortcode');

// Contact Form 7 でショートコードを有効にする
add_filter('wpcf7_form_elements', 'do_shortcode');
