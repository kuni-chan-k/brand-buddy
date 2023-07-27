<?php

/**
 * カスタマイザーに任意のCSSを読み込ませる
 */
function customizer_script()
{
  wp_enqueue_style('customizer-css', get_theme_file_uri('/css/customizer.css'));
}
add_action('customize_controls_enqueue_scripts', 'customizer_script');

/**
 * ブロックエディターに任意のCSSを読み込ませる
 */
function block_editor_script()
{
  // ブロックエディタ用スタイル機能をテーマに追加
  add_theme_support('editor-styles');
  // ブロックエディタ用CSSの読み込み
  add_editor_style(array('/css/single.css', '/css/block.css'));
}
add_action('after_setup_theme', 'block_editor_script');

/**
 * 設定有効化
 */
// アイキャッチ
add_theme_support('post-thumbnails');
//メニュー
function register_my_menus()
{
  register_nav_menus(array(
    'footer' => 'フッター',
  ));
}
add_action('after_setup_theme', 'register_my_menus');

/**
 * OGP設定
 */
function my_meta_ogp()
{
  // 画像 （アイキャッチ画像が無い時に使用する代替画像URL）
  if (!empty(get_theme_mod('share_ogp'))) {
    $ogp_image = get_theme_mod('share_ogp');
  } else {
    $ogp_image = get_template_directory_uri() . '/img/default_thumbnail.png';
  }

  // Twitterカードの種類（summary_large_image または summary を指定）
  if (!empty(get_theme_mod('share_twitter_card'))) {
    $twitter_card = get_theme_mod('share_twitter_card');
  } else {
    $twitter_card = 'summary_large_image';
  }

  // Facebook APP ID
  if (!empty(get_theme_mod('share_facebook_id'))) {
    $facebook_app_id = get_theme_mod('share_facebook_id');
  } else {
    $facebook_app_id = '';
  }

  global $post;
  $ogp_title = '';
  $ogp_description = '';
  $ogp_url = '';
  $html = '';
  if (is_singular()) {
    // 記事＆固定ページ
    setup_postdata($post);
    $ogp_title = $post->post_title . ' | ' . get_bloginfo('name');
    $ogp_description = mb_substr(get_the_excerpt(), 0, 100);
    $ogp_url = get_permalink();
    wp_reset_postdata();
  } elseif (is_front_page() || is_home()) {
    // トップページ
    $ogp_title = get_bloginfo('name');
    $ogp_description = get_bloginfo('description') ?? '';
    $ogp_url = home_url();
  } elseif (is_category()) {
    // カテゴリーアーカイブ
    $cat = get_the_category();
    $ogp_title = $cat[0]->name . ' | ' . get_bloginfo('name');
    $ogp_description = ($cat[0]->description) ? $cat[0]->description : get_bloginfo('description');
    $ogp_url = get_category_link($cat[0]->term_id);
    wp_reset_postdata();
  } elseif (is_tag()) {
    // タグーアーカイブ
    $tag = get_the_tags();
    $ogp_title = $tag[0]->name . ' | ' . get_bloginfo('name');
    $ogp_description = ($tag[0]->description) ? $tag[0]->description : get_bloginfo('description');
    $ogp_url = get_tag_link($tag[0]->term_id);
    wp_reset_postdata();
  } elseif (is_404()) {
    $ogp_title = 'ページが見つかりませんでした | ' . get_bloginfo('name');
    $ogp_description = 'お探しのページが見つかりませんでした';
  }

  // og:type
  $ogp_type = (is_front_page() || is_home()) ? 'website' : 'article';

  // og:image
  if (is_singular() && has_post_thumbnail()) {
    $ps_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
    $ogp_image = $ps_thumb[0];
  }

  // 出力するOGPタグをまとめる
  $html = "\n";
  $html .= '<title>' . esc_attr($ogp_title) . '</title>' . "\n";
  $html .= '<meta property="og:title" content="' . esc_attr($ogp_title) . '">' . "\n";
  $html .= '<meta property="og:description" content="' . esc_attr($ogp_description) . '">' . "\n";
  $html .= '<meta property="og:type" content="' . $ogp_type . '">' . "\n";
  $html .= '<meta property="og:url" content="' . esc_url($ogp_url) . '">' . "\n";
  $html .= '<meta property="og:image" content="' . esc_url($ogp_image) . '">' . "\n";
  $html .= '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
  $html .= '<meta name="twitter:card" content="' . $twitter_card . '">' . "\n";
  $html .= '<meta property="og:locale" content="ja_JP">' . "\n";

  if ($facebook_app_id != "") {
    $html .= '<meta property="fb:app_id" content="' . $facebook_app_id . '">' . "\n";
  }

  echo $html;
}
// headタグ内にOGPを出力する
add_action('wp_head', 'my_meta_ogp');

/**
 * テーマカスタマイザー
 */
require_once trailingslashit(get_template_directory()) . 'include/customizer.php';

/**
 * WordPress標準のサイト内検索を無効化
 */

function search_404($query)
{
  if (is_search()) {
    // 404ページを返す
    $query->set_404();
    // 404コードを返す
    status_header(404);
    // キャッシュの無効化
    nocache_headers();
  }
}
add_filter('parse_query', 'search_404');

/**
 * 外部リンク対応リンクカードのショートコード
 */
function show_Linkcard($atts)
{
  extract(shortcode_atts(array(
    'url' => "",
    'title' => "",
    'excerpt' => ""
  ), $atts));

  $img_width = "300";
  $img_height = "300";

  //OGPを取得
  require_once 'OpenGraph.php';
  $graph = OpenGraph::fetch($url);

  //OGPタグからタイトルを取得
  $Link_title = $graph->title ?? '';
  if (!empty($title)) {
    $Link_title = $title; //title=""の入力がある場合はそちらを優先
  }

  //OGPタグからdescriptionを取得
  $Link_description = $graph->description ? wp_trim_words($graph->description, 60, '…') : '';
  if (!empty($excerpt)) {
    $Link_description = $excerpt; //値を取得できない時は手動でexcerpt=""を入力
  }

  //wordpress.comのAPIを利用してスクリーンショットを取得
  $screenShot = 'https://s.wordpress.com/mshots/v1/' . urlencode(esc_url(rtrim($url, '/'))) . '?w=' . $img_width . '&h=' . $img_height . '';
  $xLink_img = '<img src="' . $screenShot . '" width="' . $img_width . '" />';

  //HTML出力
  $linkcard = '
  <div class="blogcard ex">
  <a href="' . $url . '" target="_blank" rel="noopener noreferrer">
   <div class="blogcard_thumbnail">' . $xLink_img . '</div>
   <div class="blogcard_content">
    <div class="blogcard_title"><p>' . $Link_title . '</p></div>
    <div class="blogcard_description"><p>' . $Link_description . '<p></div>
    <div class="blogcard_link"><span>URL</span>' . $url . '<i class="icon-external-link-alt"></i></div>
   </div>
   <div class="clear"></div>
  </a>
  </div>';

  return $linkcard;
}
add_shortcode("linkcard", "show_Linkcard");

/**
 * テンプレート読み込み
 */
get_template_part('include/html-tag-setting');


/**
 * ページネーションの表示件数をカスタマイズ
 */
add_action('pre_get_posts', function ($query) {
  if (is_search() || is_category() || is_tag()) {
    // if (!empty(get_theme_mod('work_view_count'))) {
    //   $query->set('posts_per_page', get_theme_mod('work_view_count'));
    // } else {
    //   $query->set('posts_per_page', 6);
    // }
    // 一旦､ページネーションを8で固定にする
    $query->set('posts_per_page', 8);
    return;
  }
});

/**
 * ページネーションの404回避
 */
add_filter('redirect_canonical', 'my_disable_redirect_canonical');
function my_disable_redirect_canonical($redirect_url)
{
  if (is_archive()) {
    $subject = $redirect_url;
    $pattern = '/\/page\//'; // URLに「/page/」があるかチェック
    preg_match($pattern, $subject, $matches);

    if ($matches) {
      //リクエストURLに「/page/」があれば、リダイレクトしない。
      $redirect_url = false;
      return $redirect_url;
    }
  }
}

/**
 * テーマアップデート
 */
require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$myUpdateChecker = PucFactory::buildUpdateChecker(
  'https://github.com/kuni-chan-k/brand-buddy/',
  __FILE__,
  'brand-buddy'
);
$myUpdateChecker->setBranch('main');
$myUpdateChecker->setAuthentication('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');
