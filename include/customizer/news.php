<?php
function news_customizer($wp_customize)
{
  $prefix = 'news';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'       => 'お知らせエリア設定',
      'priority'    => 25,
    ]
  );
  $fields = [
    'news_section_view' => [
      'label'       => 'お知らせエリアを表示する',
      'type'        => 'checkbox',
      'default'     => false,
    ],
    'news_section_name' => [
      'label'       => 'セクション名',
      'type'        => 'text',
      'default'     => 'お知らせ',
      'description' => 'セクション名に入力がない場合は表示されません｡',
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);

  $wp_customize->add_setting('news_view_count');
  $wp_customize->add_control(
    new WP_Customize_Range_Control(
      $wp_customize,
      'news_view_count',
      array(
        'label'    => 'トップページで表示する記事数',
        'section'  => $section_name,
        'settings' => 'news_view_count',
        'type'     => 'range',
        'input_attrs' => array(
          'min'     => 2,
          'max'     => 6,
          'step'    => 1,
          'default' => 3,
        ),
      )
    )
  );
}