<?php
function contact_customizer($wp_customize)
{
  $prefix = 'contact';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'       => '問い合わせエリア設定',
      'priority'    => 28,
    ]
  );
  $fields = [
    'contact_section_view' => [
      'label'       => '問い合わせエリアを表示する',
      'type'        => 'checkbox',
      'default'     => false,
    ],
    'contact_section_name' => [
      'label'       => 'セクション名',
      'type'        => 'text',
      'default'     => '',
      'description' => 'セクション名に入力がない場合は表示されません｡',
    ],
    'contact_lead_summary' => [
      'label'       => 'セクションのテキスト',
      'type'        => 'textarea',
      'default'     => '',
      'description' => '何も入力がなければ表示されません｡',
    ],
    'contact_button_text' => [
      'label'       => '問い合わせボタンのテキスト',
      'type'        => 'text',
      'default'     => '',
      'description' => '何も入力がなければ「お問い合わせはこちら」がセットされます｡',
    ],
    'contact_button_url' => [
      'label'       => '問い合わせボタンのリンク先',
      'type'        => 'url',
      'default'     => ''
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
}