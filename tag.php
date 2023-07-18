<?php get_header(); ?>

<?php $cat = get_the_category(); ?>
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

    <section class="main__work">
      <h3 class="main__section__title">タグ:<?php single_tag_title() ?></h3>

      <?php get_template_part('object/breadcrumb'); ?>

      <div class="main__work__wrapper">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php get_template_part('object/work_card'); ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>

      <?php
      $args = array(
        'mid_size' => 1,
        'prev_text' => '&lt;&lt;前へ',
        'next_text' => '次へ&gt;&gt;',
        'screen_reader_text' => ' ',
      );
      the_posts_pagination($args);
      ?>

    </section>
  </main>
</div>

<?php get_footer(); ?>