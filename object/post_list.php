<li>
  <div class="post-wrapper">
    <div class="post-date">
      <time datetime=<?php echo get_the_modified_time('Y-m-d'); ?>><?php echo get_the_modified_time('Y/m/d'); ?></time>
    </div>
    <div class="post-category">
      <?php $postcategorys = get_the_category();
      if ($postcategorys) {
        echo '<ul>';
        foreach ($postcategorys as $category) {
          echo '<li class="' . $category->slug . '"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
        }
        echo '</ul>';
      }
      ?>
    </div>
    <div class="post-title">
      <a href="<?php the_permalink(); ?>">
        <?php echo esc_html(get_the_title()); ?>
      </a>
    </div>
  </div>
</li>