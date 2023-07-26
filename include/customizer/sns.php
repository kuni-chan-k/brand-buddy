<?php
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