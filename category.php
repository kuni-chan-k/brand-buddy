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
      <h3 class="main__section__title">カテゴリー:<?php echo !empty(get_theme_mod('work_section_name')) ? get_theme_mod('work_section_name') : '実績' ?></h3>

      <?php get_template_part('object/breadcrumb'); ?>

      <div class="main__work__wrapper">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $the_query = new WP_Query(array(
          'post_status' => 'publish',
          'paged' => $paged,
          'orderby' => 'date',
          'order' => 'DESC'
        ));
        ?>

        <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <?php get_template_part('object/work_card'); ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>

      <?php
      if ($the_query->max_num_pages > 1) {
        echo '<nav class="navigation pagination" role="navigation">';
        echo '<div class="nav-links">';
        echo paginate_links(array(
          'base' => get_pagenum_link(1) . '%_%',
          // 'format' => 'page/%#%/',
          'format' => '?paged=%#%',
          'current' => max(1, $paged),
          'mid_size' => 1,
          'prev_text' => '&lt;',
          'next_text' => '&gt;',
          'total' => $the_query->max_num_pages
        ));
        echo '</div>';
        echo '</nav>';
      }
      wp_reset_postdata();
      ?>
    </section>
  </main>
</div>

<?php get_footer(); ?>