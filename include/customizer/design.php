<?php
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
        'description' => '枠線をなくしたい場合は枠線の太さを0にしてください｡',
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
        'label'       => '枠線の色',
        'section'     => $section_name,
        'settings'    => 'border_color',
        'description' => '「もっと見る」ボタン､「TOP」ボタンの枠の色にも反映されます｡',
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