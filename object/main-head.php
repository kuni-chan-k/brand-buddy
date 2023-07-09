<div class="main__head">
  <div class="main__head__icon">
    <img src="
    <?php
    if (!empty(get_theme_mod('top_icon'))) {
      $image = get_theme_mod('top_icon');
    } else {
      $image = get_template_directory_uri() . '/img/default_head_icon.png';
    }
    echo $image;
    ?>" alt="<?php trim(esc_html(get_theme_mod('top_name'))) ?>" width="90" height="90">
  </div>

  <h2 class="main__head__name">
    <?php echo trim(esc_html(get_theme_mod('top_name', 'お名前'))) ?>
  </h2>

  <?php if (!empty(get_theme_mod('top_job'))) : ?>
    <p class="main__head__job">
      <?php echo trim(esc_html(get_theme_mod('top_job', ''))) ?>
    </p>
  <?php endif; ?>
</div>