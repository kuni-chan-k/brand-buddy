	<footer class="footer">
	  <div class="footer__inner">
	    <?php if (has_nav_menu('footer')) : ?>
	      <div id="commonFooterSiteMenu">
	        <div>
	          <?php
            wp_nav_menu(
              array(
                'theme_location'  => 'footer',
                'container'       => 'nav',
                'container_class' => 'o--nav-box',
                'items_wrap'      => '<ul id="footer-menu-list">%3$s</ul>',
              )
            );
            ?>
	        </div>
	      </div>
	    <?php endif; ?>
	    <small>©<?php echo get_bloginfo('name') ?> Inc.All rights Reserved</small>
	  </div>
	</footer>

	<!-- トップに戻るボタン -->
	<div id="return__top">
	  <a class="pagetop" href="#">
	    <div class="pagetop__arrow"></div>
	    TOP
	  </a>
	</div>

	<?php wp_footer(); ?>

	<script>
	  // 	トップに戻るボタン
	  jQuery(function() {
	    var pageTop = jQuery('#return__top');
	    pageTop.hide();
	    jQuery(window).scroll(function() {
	      if (jQuery(this).scrollTop() > 600) {
	        pageTop.fadeIn();
	      } else {
	        pageTop.fadeOut();
	      }
	    });
	    pageTop.click(function() {
	      jQuery('html, body').animate({
	        scrollTop: 0
	      }, 500, 'swing');
	      return false;
	    });
	  });
	</script>


	</body>

	</html>