<?php get_header(); ?>

<?php $cat = get_the_category(); ?>
<div class="container">
  <main class="main">
    <div class="main__inner">
      <?php get_template_part('object/main_head'); ?>

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

    </div>
  </main>
</div>

<?php get_footer(); ?>