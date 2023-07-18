<?php get_header(); ?>

<div class="container">
  <main class="main single">
    <div class="main__head">
      <div class="main__head__icon">
        <img src="https://www.kuni-chan.com/triathlon-challenger/wp-content/uploads/2023/06/トライアスリートくにちゃん-150x150.jpg" alt="くにちゃん" width="90" height="90">
      </div>

      <h2 class="main__head__name">
        <?php echo esc_html(get_theme_mod('top_name', 'お名前')) ?>
      </h2>

      <?php if (!empty(get_theme_mod('top_job'))) : ?>
        <p class="main__head__job">
          <?php echo esc_html(get_theme_mod('top_job', '')) ?>
        </p>
      <?php endif; ?>
    </div>

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

  </main>
</div>

<?php get_footer(); ?>