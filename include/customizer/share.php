<?php
function share_customizer($wp_customize)
{
  $prefix = 'share';
  $option_name = "{$prefix}_options";
  $section_name = "{$prefix}_section";
  $wp_customize->add_section(
    $section_name,
    [
      'title'       => 'SNSシェア設定',
      'priority'    => 29,
    ]
  );
  $wp_customize->add_setting('share_ogp');
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'my_control_share',
      array(
        'label'    => 'OGP画像',
        'description' => 'TOPページがシェアされた時の画像を選んでください｡',
        'section'  => $section_name,
        'settings' => 'share_ogp',
      )
    )
  );
  $fields = [
    'share_twitter_card' => [
      'label'       => 'X(旧Twitter)カードタイプ',
      'type'        => 'select',
      'description' => 'X(旧Twitter)でシェアしたときのリンクの表示方法を選べます｡',
      'choices'     => array(
        'summary'             => 'コンパクト',
        'summary_large_image' => 'ラージ',
      ),
    ],
    'share_facebook_id' => [
      'label'       => 'Facebookの管理者ID(15桁の数字)',
      'type'        => 'text',
      'description' => 'FacebookでシェアしたときのリンクのOGPを取得するのに必要なIDです｡',
    ],
  ];
  add_customizer_control($wp_customize, $fields, $option_name, $section_name);
}