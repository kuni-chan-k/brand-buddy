<?php
add_action('admin_menu', 'html_tag_setting_admin');

function html_tag_setting_admin()
{
  add_menu_page('HTMLタグ設定', 'HTMLタグ設定', 'administrator', 'html_tag_setting', 'html_tag_setting', '', 24);
  add_action('admin_init', 'register_html_tag_setting');
}

function register_html_tag_setting()
{
  register_setting('html-tag--settings-group', 'add_html_head');
}

function html_tag_setting()
{
  global $parent_file;
  if ($parent_file != 'options-general.php') {
    require(ABSPATH . 'wp-admin/options-head.php');
  }
?>
  <div class="wrap">
    <h2>HTMLタグ設定</h2>
    <form method="post" action="options.php">
      <?php settings_fields('html-tag--settings-group'); ?>
      <?php do_settings_sections('html-tag--settings-group'); ?>

      <p>head内にGoogle Analytics、Google AdSense、SearchConsoleなど計測タグを挿入できます｡</p>
      <p>※HTMLタグ設定が保存できない場合､サーバーのWAF設定を確認してみてください｡</p>
      <table>
        <tr>
          <td><textarea type="text" name="add_html_head" cols="60" rows="12"><?php echo (get_option('add_html_head')); ?></textarea></td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>
<?php } ?>