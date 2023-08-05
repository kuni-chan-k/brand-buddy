<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="format-detection" content="telephone=no" />
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/reset.css" type="text/css" media="all">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/styles.css" type="text/css" media="all">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/blogcard.css" type="text/css" media="all">
  <?php if (is_single() || is_page()) : ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/single.css" type="text/css" media="all">
  <?php endif; ?>
  <?php wp_head(); ?>

  <?php if (!get_option('add_html_head') == null) : ?>
    <?php echo get_option('add_html_head'); ?>
  <?php endif; ?>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>