<?php
/**
 * カスタマイザーに任意のCSSを読み込ませる
 */
function customizer_css(){
  wp_enqueue_style('customizer-css', get_theme_file_uri('/css/customizer.css'));
}
add_action('customize_controls_enqueue_scripts', 'customizer_css');


// すべてのアイキャッチ画像の有効化
add_theme_support('post-thumbnails');

/**
 * OGP設定
 */
function my_meta_ogp()
{
  if (is_front_page() || is_home() || is_singular() || is_404()) {
    // 画像 （アイキャッチ画像が無い時に使用する代替画像URL）
    if (!empty(get_theme_mod('top_job'))) {
      // TODO
      $ogp_image = 'https://kuni-chan.com/wp-content/uploads/2023/06/OGP.png';
    } else {
      $ogp_image = get_template_directory_uri() . '/img/default_thumbnail.png';
    }

    // Twitterカードの種類（summary_large_image または summary を指定）
    $twitter_card = 'summary_large_image';
    // Facebook APP ID
    $facebook_app_id = '';

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
      $ogp_description = get_bloginfo('description');
      $ogp_url = home_url();
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
    $html .= '<title>'. esc_attr($ogp_title) .'</title>' . "\n";
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
}
// headタグ内にOGPを出力する
add_action('wp_head', 'my_meta_ogp');


/**
 * Custom Functions
 */
get_template_part('include/custom-functions');

/**
 * テーマカスタマイザー
 */
function my_theme_customize_register($wp_customize){
  name_customizer($wp_customize);
  sns_customizer($wp_customize);
  banner_customizer($wp_customize);
  work_customizer($wp_customize);
}
add_action('customize_register', 'my_theme_customize_register');

function name_customizer($wp_customize){
  $prefix = 'top';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'       => '名前エリア設定',
      'priority'    => 22,
    ]
  );
  $wp_customize->add_setting('top_icon');
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'my_control_top',
      array(
        'label'    => 'アイコン',
        'section'  => $section_name,
        'settings' => 'top_icon',
      )
    )
  );
  $fields = [
    'top_name' => [
      'label'       => '名前',
      'type'        => 'text',
      'default'     => ''
    ],
    'top_job' => [
      'label'       => '肩書',
      'type'        => 'text',
      'default'     => ''
    ],
    'top_lead_summary' => [
      'label'       => '紹介文',
      'type'        => 'textarea',
      'default'     => ''
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
}

function sns_customizer($wp_customize){
  $prefix = 'sns';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'       => 'SNS設定',
      'priority'    => 23,
    ]
  );
  $fields = [
    'sns_twitter' => [
      'label'       => 'TwitterアカウントのURL',
      'type'        => 'url',
      'default'     => ''
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
  $fields = [
    'sns_twitter_under' => [
      'label'       => '',
      'type'        => 'hidden',
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);

  $fields = [
    'sns_facebook' => [
      'label'       => 'FacebookアカウントのURL',
      'type'        => 'url',
      'default'     => ''
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
  $fields = [
    'sns_facebook_under' => [
      'label'       => '',
      'type'        => 'hidden',
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);

  $fields = [
    'sns_instagram' => [
      'label'       => 'InstagramアカウントのURL',
      'type'        => 'url',
      'default'     => ''
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
  $fields = [
    'sns_instagram_under' => [
      'label'       => '',
      'type'        => 'hidden',
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);

  $fields = [
    'sns_youtube' => [
      'label'       => 'YouTubeアカウントのURL',
      'type'        => 'url',
      'default'     => ''
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
  $fields = [
    'sns_youtube_under' => [
      'label'       => '',
      'type'        => 'hidden',
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);

  $fields = [
    'sns_tiktok' => [
      'label'       => 'tiktokアカウントのURL',
      'type'        => 'url',
      'default'     => ''
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
  $fields = [
    'sns_tiktok_under' => [
      'label'       => '',
      'type'        => 'hidden',
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);

  $fields = [
    'sns_line' => [
      'label'       => 'LINEアカウントのURL',
      'type'        => 'url',
      'default'     => ''
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
}

function banner_customizer($wp_customize){
  $prefix = 'banner';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'           => 'バナーエリア設定',
      'priority'        => 24,
    ]
  );
  $fields = [
    'banner_section_view' => [
      'label'       => 'バナーエリアを表示する',
      'type'        => 'checkbox',
      'default'     => true,
    ],
    'banner_section_name' => [
      'label'       => 'セクション名',
      'type'        => 'text',
      'default'     => ''
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
  $wp_customize->add_setting('my_control_banner1');
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'my_control_banner1',
      array(
        'label'    => 'バナー1',
        'section'  => $section_name,
        'settings' => 'my_control_banner1',
        'type'     => 'hidden',
      )
    )
  );
  $wp_customize->add_setting('banner_section_title1');
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'my_control_image',
      array(
        'label'    => 'バナー1 画像',
        'section'  => $section_name,
        'settings' => 'banner_section_title1',
      )
    )
  );
  $wp_customize->add_setting('banner_section_url1');
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'my_control_text',
      array(
        'label' => 'バナー1 URL',
        'section'  => $section_name,
        'settings' => 'banner_section_url1',
        'type'     => 'url',
      )
    )
  );

  $wp_customize->add_setting('my_control_banner2');
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'my_control_banner2',
      array(
        'label'    => 'バナー2',
        'section'  => $section_name,
        'settings' => 'my_control_banner2',
        'type'     => 'hidden',
      )
    )
  );
  $wp_customize->add_setting('banner_section_title2');
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'my_control_image2',
      array(
        'label'    => 'バナー2 画像',
        'section'  => $section_name,
        'settings' => 'banner_section_title2',
      )
    )
  );
  $wp_customize->add_setting('banner_section_url2');
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'my_control_text2',
      array(
        'label' => 'バナー2 URL',
        'section'  => $section_name,
        'settings' => 'banner_section_url2',
        'type'     => 'url',
      )
    )
  );
}

function work_customizer($wp_customize){
  $categories = get_categories(array(
    'hide_empty' => 0,
    'orderby' => 'name',
    'order' => 'ASC',
  ));
  $category = array();
  foreach ($categories as $value) {
    $category[$value->slug] = $value->name;
  }

  $prefix = 'work';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'       => '実績エリア設定',
      'priority'    => 25,
    ]
  );
  $fields = [
    'work_section_view' => [
      'label'       => '実績エリアを表示する',
      'type'        => 'checkbox',
      'default'     => true,
    ],
    'work_section_name' => [
      'label'       => 'セクション名',
      'type'        => 'text',
      'default'     => '実績'
    ],
    'work_category' => [
      'label'       => '記事カテゴリー',
      'type'        => 'select',
      'choices'     => $category,
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
}

/*
* テーマカスタマイザーにフォームコントロールを追加する
* @param {Object} $wp_customize
* @param {Object} $fields 追加するオプションの配列
* @param {Object} $fields 追加するオプション名
* @param {Object} $section_name 追加するセクション名
*/
function add_customizer_control($wp_customize, $fields, $option_name, $section_name)
{
  foreach ((array)$fields as $id => $value) {
    $default = !empty($value['default']) ? $value['default'] : null;
    $wp_customize->add_setting(
      $id,
      [
        'default'     => $default,
        'transport'   => 'postMessage'
      ]
    );
    $wp_customize->selective_refresh->add_partial(
      $id,
      [
        'selector'            => "#{$id}-customizer",
        'container_inclusive' => false,
        'render_callback'     => function ($partial = null) {
          return get_theme_mod($partial->id, $default);
        }
      ]
    );
    $wp_customize->add_control(
      "{$option_name}_{$id}",
      [
        'settings'    => $id,
        'label'       => $value['label'],
        'section'     => $section_name,
        'type'        => !empty($value['type']) ? $value['type'] : 'textarea',
        'description' => !empty($value['description']) ? $value['description'] : null,
        'choices'     => !empty($value['choices']) ? $value['choices'] : null
      ]
    );
  }
}

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

  //画像サイズのwidth
  $img_width = "300";
  //画像サイズのheight
  $img_height = "300";

  //OGPを取得
  require_once 'OpenGraph.php';
  $graph = OpenGraph::fetch($url);

  //OGPタグからタイトルを取得
  $Link_title = $graph->title;
  if (!empty($title)) {
    $Link_title = $title; //title=""の入力がある場合はそちらを優先
  }

  //OGPタグからdescriptionを取得
  $Link_description = wp_trim_words($graph->description, 60, '…'); //文字数は任意で変更
  if (!empty($excerpt)) {
    $Link_description = $excerpt; //値を取得できない時は手動でexcerpt=""を入力
  }

  //wordpress.comのAPIを利用してスクリーンショットを取得
  $screenShot = 'https://s.wordpress.com/mshots/v1/' . urlencode(esc_url(rtrim($url, '/'))) . '?w=' . $img_width . '&h=' . $img_height . '';
  $xLink_img = '<img src="' . $screenShot . '" width="' . $img_width . '" />';

  //ファビコンGET
  $host = parse_url($url)['host'];
  $searchFavcon = 'https://www.google.com/s2/favicons?domain=' . $host;
  if ($searchFavcon) {
    $favicon = '<img class="favicon" src="' . $searchFavcon . '">';
  }

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
 * HTMLタグ設定
 */
get_template_part('include/html-tag-setting');

//テーマアップデート
// https://kuni-chan.com/theme.json
require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
  'https://github.com/kuni-chan-k/bb-theme/',
  __FILE__,
  'unique-plugin-or-theme-slug'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('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');