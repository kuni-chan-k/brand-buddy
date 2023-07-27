<?php
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
      'default'     => 'お名前'
    ],
    'top_job' => [
      'label'       => '肩書',
      'type'        => 'text',
      'default'     => '肩書'
    ],
    'top_lead_summary' => [
      'label'       => '紹介文',
      'type'        => 'textarea',
      'default'     => '自己紹介文'
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
}