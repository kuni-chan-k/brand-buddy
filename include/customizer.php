<?php

/**
 * テーマカスタマイザー
 */
require_once trailingslashit(get_template_directory()) . 'include/customizer/design.php';
require_once trailingslashit(get_template_directory()) . 'include/customizer/name.php';
require_once trailingslashit(get_template_directory()) . 'include/customizer/sns.php';
require_once trailingslashit(get_template_directory()) . 'include/customizer/banner.php';
require_once trailingslashit(get_template_directory()) . 'include/customizer/work.php';
require_once trailingslashit(get_template_directory()) . 'include/customizer/share.php';
require_once trailingslashit(get_template_directory()) . 'include/customizer/contact.php';

/**
 * テーマカスタマイザーにフォームコントロールを追加
 * @param {Object} $wp_customize
 * @param {Object} $fields 追加するオプションの配列
 * @param {Object} $fields 追加するオプション名
 * @param {Object} $section_name 追加するセクション名
 */
function add_customizer_control($wp_customize, $fields, $option_name, $section_name)
{
  foreach ((array)$fields as $id => $value) {
    $default = !empty($value['default']) ? $value['default'] : null;
    $wp_customize->add_setting(
      $id,
      [
        'default'     => $default,
        'transport'   => 'postMessage'
      ]
    );
    $wp_customize->selective_refresh->add_partial(
      $id,
      [
        'selector'            => "#{$id}-customizer",
        'container_inclusive' => false,
        'render_callback'     => function ($partial = null) {
          return get_theme_mod($partial->id, $default);
        }
      ]
    );
    $wp_customize->add_control(
      "{$option_name}_{$id}",
      [
        'settings'    => $id,
        'label'       => $value['label'],
        'section'     => $section_name,
        'type'        => !empty($value['type']) ? $value['type'] : 'textarea',
        'description' => !empty($value['description']) ? $value['description'] : null,
        'choices'     => !empty($value['choices']) ? $value['choices'] : null,
      ]
    );
  }
}

include_once ABSPATH . 'wp-includes/class-wp-customize-control.php';
class WP_Customize_Range_Control extends WP_Customize_Control
{
  public $type = 'custom_range';
  public function render_content()
  {
?>
    <label>
      <?php if (!empty($this->label)) : ?>
        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
      <?php endif; ?>
      <input data-input-type="range" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> oninput="jQuery(this).next().text( jQuery(this).val() )" />
      <div class="cs-range-value">
        <?php
          if (!empty($this->value())) {
          echo esc_attr($this->value());
          } else {
          echo esc_attr($this->input_attrs['default']);
          }  ?>
      </div>
      <?php if (!empty($this->description)) : ?>
        <span class="description customize-control-description"><?php echo $this->description; ?></span>
      <?php endif; ?>
    </label>
  <?php
  }
}

/**
 * テーマカスタマイザー反映
 */
function my_theme_customize_register($wp_customize)
{
  design_customizer($wp_customize);
  name_customizer($wp_customize);
  sns_customizer($wp_customize);
  banner_customizer($wp_customize);
  work_customizer($wp_customize);
  share_customizer($wp_customize);
  contact_customizer($wp_customize);
}
add_action('customize_register', 'my_theme_customize_register');

/**
 * テーマカスタマイザーで設定した線の太さ､色を反映
 */
function customizer_color()
{
  $border_color = !empty(get_theme_mod('border_color')) ? get_theme_mod('border_color') : '#000';
  $main_border_thickness = !empty(get_theme_mod('main_border_thickness')) ? get_theme_mod('main_border_thickness') : '6';
  $main_background_color = !empty(get_theme_mod('main_background_color')) ? get_theme_mod('main_background_color') : '#fff';
  ?>
  <style type="text/css">
    .container {
      background-color: <?php echo $main_background_color; ?>;
    }

    .main {
      background-color: <?php echo $border_color; ?>;
      --matched-radius-padding: <?php echo $main_border_thickness . 'px'; ?>;
    }

    .more_read_link {
      border: 4px solid <?php echo $border_color; ?>;
    }
  </style>
<?php
}
add_action('wp_head', 'customizer_color');
