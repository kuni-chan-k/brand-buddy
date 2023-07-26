  <footer class="footer">
    <div class="footer_inner">
      <?php if (has_nav_menu('footer')) : ?>
        <div id="commonFooterSiteMenu">
          <!-- global navigation -->
          <div id="footerMenuBox">
            <?php
            wp_nav_menu(
              array(
                'theme_location'  => 'footer',
                'container'       => 'nav',
                'container_class' => 'o--nav-box',
                'items_wrap'      => '<ul id="footerMenuList">%3$s</ul>',
              )
            );
            ?>
          </div>
        </div>
      <?php endif; ?>
      <small>©<?php echo get_bloginfo('name') ?> Inc.All rights Reserved</small>
    </div>
  </footer>

  <?php wp_footer(); ?>

  </body>

  </html>