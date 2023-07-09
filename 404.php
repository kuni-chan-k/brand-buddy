<?php get_header(); ?>

<div class="container">
  <main class="main single">
    <?php get_template_part('object/main-head'); ?>
    <?php get_template_part('object/breadcrumb'); ?>
    <section id="postContent" class="notfound">
      <span class="notfound-en">404 NOT FOUND</span>
      <h1 class="notfound-jp">お探しのページが見つかりませんでした</h1>
    </section>
  </main>
</div>

<?php get_footer(); ?>