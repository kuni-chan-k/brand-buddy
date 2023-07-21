<?php get_header(); ?>

<div class="container">
  <main class="main single">
    <div class="main__inner">
      <?php get_template_part('object/main_head'); ?>
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

          <?php get_template_part('object/breadcrumb'); ?>

          <header id="postHeader">
            <h1><?php the_title(); ?></h1>
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