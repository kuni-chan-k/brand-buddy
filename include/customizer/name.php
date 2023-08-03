<?php
function name_customizer($wp_customize)
{
  $prefix = 'name';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'       => '名前エリア設定',
      'priority'    => 23,
    ]
  );
  $wp_customize->add_setting('name_icon');
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'my_control_top',
      array(
        'label'    => 'アイコン',
        'section'  => $section_name,
        'settings' => 'name_icon',
      )
    )
  );
  $fields = [
    'name' => [
      'label'       => '名前',
      'type'        => 'text',
      'default'     => 'お名前'
    ],
    'name_job' => [
      'label'       => '肩書',
      'type'        => 'text',
      'default'     => '肩書'
    ],
    'name_lead_summary' => [
      'label'       => '紹介文',
      'type'        => 'textarea',
      'default'     => '自己紹介文'
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);

  $fields = [
    'name_under' => [
      'label'       => '',
      'type'        => 'hidden',
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);

  $fields = [
    'profile_button_view' => [
      'label'       => '詳細ボタンを表示する',
      'type'        => 'checkbox',
      'default'     => false,
    ],
    'profile_button_text' => [
      'label'       => '詳細ボタンのテキスト',
      'type'        => 'text',
      'default'     => '',
      'description' => '何も入力がなければ「詳細を見る」がセットされます｡',
    ],
    'profile_button_url' => [
      'label'       => '詳細ボタンのリンク先',
      'type'        => 'url',
      'default'     => ''
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);

}