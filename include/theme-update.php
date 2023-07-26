<?php

/**
 * テーマアップデート
 */
require 'plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
  'https://github.com/kuni-chan-k/brand-buddy/',
  __FILE__,
  'brand-buddy'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('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');
