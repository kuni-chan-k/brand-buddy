<?php get_header(); ?>

<div class="container">
  <main class="main">
    <div class="main__inner">
      <?php get_template_part('object/main_head'); ?>
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

          <header id="postHeader">
            <?php get_template_part('object/breadcrumb'); ?>
            <h2><?php the_title(); ?></h2>
            <div class="post-tag-area">
              <?php $tags = get_the_tags();
              if ($tags) {
                echo '<ul>';
                foreach ($tags as $tag) {
                  echo '<li class="' . $tag->slug . '"><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
                }
                echo '</ul>';
              }
              ?>
            </div>
            <span class="post-date-modified"><time datetime=<?php echo get_the_modified_time('Y-m-d'); ?>>最終更新:<?php echo get_the_modified_time('Y/m/d'); ?></time></span>
            <?php if (has_post_thumbnail()) : ?>
              <div id="postThumb">
                <?php echo the_post_thumbnail('large_size'); ?>
              </div>
            <?php endif; ?>
          </header>

          <section id="postContent">
            <?php the_content(); ?>
          </section>

        <?php endwhile; ?>
      <?php endif; ?>

    </div>
  </main>
</div>

<?php get_footer(); ?>