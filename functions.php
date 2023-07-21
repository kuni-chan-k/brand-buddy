<?php

/**
 * カスタマイザーに任意のCSSを読み込ませる
 */
function customizer_script()
{
  wp_enqueue_style('customizer-css', get_theme_file_uri('/css/customizer.css'));
}
add_action('customize_controls_enqueue_scripts', 'customizer_script');


// すべてのアイキャッチ画像の有効化
add_theme_support('post-thumbnails');

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
    $ogp_description = get_bloginfo('description');
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
function my_theme_customize_register($wp_customize)
{
  design_customizer($wp_customize);
  name_customizer($wp_customize);
  sns_customizer($wp_customize);
  banner_customizer($wp_customize);
  work_customizer($wp_customize);
  share_customizer($wp_customize);
}
add_action('customize_register', 'my_theme_customize_register');

function design_customizer($wp_customize)
{
  $prefix = 'design';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'       => 'デザイン設定',
      'priority'    => 22,
    ]
  );
  $wp_customize->add_setting('main_border_thickness');
  $wp_customize->add_control(
    new WP_Customize_Range_Control(
      $wp_customize,
      'main_border_thickness',
      array(
        'label'    => 'メインエリアの枠線の太さ',
        'section'  => $section_name,
        'settings' => 'main_border_thickness',
        'description' => '枠線をなくしたい場合は枠線の太さを0にしてください',
        'type'     => 'range',
        'input_attrs' => array(
          'min'     => 0,
          'max'     => 12,
          'step'    => 1,
          'default' => 6,
        ),
      )
    )
  );

  $wp_customize->add_setting('border_color', array(
    'default' => '#000',
  ));
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'border_color',
      array(
        'label' => '枠線の色',
        'section' => $section_name,
        'settings' => 'border_color',
        'description' => '「もっと見る」ボタンの枠の色にも反映されます',
      )
    )
  );
  $fields = [
    'border_under' => [
      'label'       => '',
      'type'        => 'hidden',
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);

  $wp_customize->add_setting('main_background_color', array(
    'default' => '#fff',
  ));
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'main_background_color',
      array(
        'label' => '枠外の背景色',
        'section' => $section_name,
        'settings' => 'main_background_color',
      )
    )
  );
}

function name_customizer($wp_customize)
{
  $prefix = 'top';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'       => '名前エリア設定',
      'priority'    => 23,
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

function sns_customizer($wp_customize)
{
  $prefix = 'sns';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'       => 'SNS設定',
      'priority'    => 24,
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
  $fields = [
    'sns_line_under' => [
      'label'       => '',
      'type'        => 'hidden',
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);

  $fields = [
    'sns_github' => [
      'label'       => 'GithubアカウントのURL',
      'type'        => 'url',
      'default'     => ''
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
}

function banner_customizer($wp_customize)
{
  $prefix = 'banner';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'           => 'バナーエリア設定',
      'priority'        => 25,
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
  $fields = [
    'banner_section_name_under' => [
      'label'       => '',
      'type'        => 'hidden',
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);

  $wp_customize->add_setting('banner_section_image1');
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'my_control_image1',
      array(
        'label'    => 'バナー1 画像',
        'section'  => $section_name,
        'settings' => 'banner_section_image1',
      )
    )
  );
  $wp_customize->add_setting('banner_section_url1');
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'my_control_utl1',
      array(
        'label' => 'バナー1 URL',
        'section'  => $section_name,
        'settings' => 'banner_section_url1',
        'type'     => 'url',
      )
    )
  );
  $wp_customize->add_setting('banner_section_title1');
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'my_control_text1',
      array(
        'label' => 'バナー1 タイトル',
        'section'  => $section_name,
        'settings' => 'banner_section_title1',
        'type'     => 'text',
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
  $wp_customize->add_setting('banner_section_image2');
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'my_control_image2',
      array(
        'label'    => 'バナー2 画像',
        'section'  => $section_name,
        'settings' => 'banner_section_image2',
      )
    )
  );
  $wp_customize->add_setting('banner_section_url2');
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'my_control_url2',
      array(
        'label' => 'バナー2 URL',
        'section'  => $section_name,
        'settings' => 'banner_section_url2',
        'type'     => 'url',
      )
    )
  );
  $wp_customize->add_setting('banner_section_title2');
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'my_control_text2',
      array(
        'label' => 'バナー2 タイトル',
        'section'  => $section_name,
        'settings' => 'banner_section_title2',
        'type'     => 'text',
      )
    )
  );

  $wp_customize->add_setting('my_control_banner3');
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'my_control_banner3',
      array(
        'label'    => 'バナー3',
        'section'  => $section_name,
        'settings' => 'my_control_banner3',
        'type'     => 'hidden',
      )
    )
  );
  $wp_customize->add_setting('banner_section_image3');
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'my_control_image3',
      array(
        'label'    => 'バナー3 画像',
        'section'  => $section_name,
        'settings' => 'banner_section_image3',
      )
    )
  );
  $wp_customize->add_setting('banner_section_url3');
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'my_control_url3',
      array(
        'label' => 'バナー3 URL',
        'section'  => $section_name,
        'settings' => 'banner_section_url3',
        'type'     => 'url',
      )
    )
  );
  $wp_customize->add_setting('banner_section_title3');
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'my_control_text3',
      array(
        'label' => 'バナー3 タイトル',
        'section'  => $section_name,
        'settings' => 'banner_section_title3',
        'type'     => 'text',
      )
    )
  );
}

include_once ABSPATH . 'wp-includes/class-wp-customize-control.php';
class WP_Customize_Range_Control extends WP_Customize_Control
{
  public $type = 'custom_range';
  public function render_content()
  {
?>
    <label>
      <?php if (!empty($this->label)) : ?>
        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
      <?php endif; ?>
      <input data-input-type="range" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> oninput="jQuery(this).next().text( jQuery(this).val() )" />
      <div class="cs-range-value"><?php echo esc_attr($this->value()); ?>
        <?php get_theme_mod('work_view_count'); ?>
      </div>
      <?php if (!empty($this->description)) : ?>
        <span class="description customize-control-description"><?php echo $this->description; ?></span>
      <?php endif; ?>
    </label>
  <?php
  }
}

function work_customizer($wp_customize)
{
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
      'priority'    => 26,
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

  $wp_customize->add_setting('work_view_count');
  $wp_customize->add_control(
    new WP_Customize_Range_Control(
      $wp_customize,
      'work_view_count',
      array(
        'label'    => '1度に表示する記事数',
        'section'  => $section_name,
        'settings' => 'work_view_count',
        'description' => 'スマホ表示時は1列､それ以外では2列表示になります',
        'type'     => 'range',
        'input_attrs' => array(
          'min'     => 2,
          'max'     => 12,
          'step'    => 1,
          'default' => 4,
        ),
      )
    )
  );
}

function share_customizer($wp_customize)
{
  $prefix = 'share';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'       => 'SNSシェア設定',
      'priority'    => 27,
    ]
  );
  $wp_customize->add_setting('share_ogp');
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'my_control_share',
      array(
        'label'    => 'OGP画像',
        'description' => 'TOPページがシェアされた時の画像',
        'section'  => $section_name,
        'settings' => 'share_ogp',
      )
    )
  );
  $fields = [
    'share_twitter_card' => [
      'label'       => 'Twitterカードタイプ',
      'type'        => 'select',
      'description' => 'Twitterでシェアしたときのリンクの表示方法を選べます',
      'choices'     => array(
        'summary'             => 'コンパクト',
        'summary_large_image' => 'ラージ',
      ),
    ],
    'share_facebook_id' => [
      'label'       => 'Facebookの管理者ID(15桁の数字)',
      'type'        => 'text',
      'description' => 'FacebookでシェアしたときのリンクのOGPを取得するのに必要なIDです',
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
        'choices'     => !empty($value['choices']) ? $value['choices'] : null,
      ]
    );
  }
}

/**
 * テーマカスタマイザーで設定した線の太さ､色を反映
 */
function customizer_color()
{
  $border_color = get_theme_mod('border_color', '#000');
  $main_border_thickness = get_theme_mod('main_border_thickness', 6);
  $main_background_color = get_theme_mod('main_background_color', 6);
  ?>
  <style type="text/css">
    .container {
      background-color: <?php echo $main_background_color; ?>;
    }

    .main {
      background-color: <?php echo $border_color; ?>;
      --matched-radius-padding: <?php echo $main_border_thickness . 'px'; ?>;
    }

    .more_read_link {
      border: 4px solid <?php echo $border_color; ?>;
    }
  </style>
<?php
}
add_action('wp_head', 'customizer_color');

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


/**
 * ページネーションの表示件数をカスタマイズ
 */
add_action('pre_get_posts', function ($query) {
  if (is_search() || is_category() || is_tag()) {
    if (!empty(get_theme_mod('work_view_count'))) {
      $query->set('posts_per_page', get_theme_mod('work_view_count'));
    } else {
      $query->set('posts_per_page', 6);
    }
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
