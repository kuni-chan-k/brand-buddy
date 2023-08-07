<div class="main__head">
  <div class="main__head__icon">
    <img src="
    <?php
    if (!empty(get_theme_mod('name_icon'))) {
      $image = get_theme_mod('name_icon');
    } else {
      $image = get_template_directory_uri() . '/img/default_head_icon.png';
    }
    echo $image;
    ?>" alt="<?php trim(esc_html(get_theme_mod('name'))) ?>" width="90" height="90">
  </div>

  <h1 class="main__head__name">
    <?php echo trim(esc_html(get_theme_mod('name', 'お名前'))) ?>
  </h1>

  <?php if (!empty(get_theme_mod('name_job'))) : ?>
    <p class="main__head__job">
      <?php echo trim(esc_html(get_theme_mod('name_job', ''))) ?>
    </p>
  <?php endif; ?>
</div>