<?php
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
      'priority'    => 27,
    ]
  );
  $fields = [
    'work_section_view' => [
      'label'       => '実績エリアを表示する',
      'type'        => 'checkbox',
      'default'     => false,
    ],
    'work_section_name' => [
      'label'       => 'セクション名',
      'type'        => 'text',
      'default'     => '',
      'description' => 'セクション名に入力がない場合は表示されません｡',
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
        'label'    => 'トップページで表示する記事数',
        'section'  => $section_name,
        'settings' => 'work_view_count',
        'description' => 'スマホ表示時は1列､それ以外では2列表示になります｡',
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