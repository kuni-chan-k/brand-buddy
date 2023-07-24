<article class="main__work__wrapper__item">
  <div class="post-link-area">
    <a href="<?php the_permalink(); ?>">

      <?php if (has_post_thumbnail()) : ?>
        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
      <?php else : ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/default_thumbnail.png" alt="">
      <?php endif; ?>

      <div class="main__work__post__title">
        <h3><?php echo esc_html(get_the_title()); ?></h3>
      </div>
    </a>

    <div class="post-tag-area">
      <?php $posttags = get_the_tags();
      if ($posttags) {
        echo '<ul>';
        foreach ($posttags as $tag) {
          echo '<li class="' . $tag->slug . '"><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
        }
        echo '</ul>';
      }
      ?>
    </div>
  </div>
  
  <div class="main__work__post__meta">
    <span class="post-date-modified"><time datetime=<?php echo get_the_modified_time('Y-m-d'); ?>>最終更新:<?php echo get_the_modified_time('Y/m/d'); ?></time></span>
  </div>
</article>