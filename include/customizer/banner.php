<?php
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