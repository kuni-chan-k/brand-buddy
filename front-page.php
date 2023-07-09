<?php get_header(); ?>

<div class="container">
  <main class="main">
    <?php get_template_part('object/main-head'); ?>

    <?php if (!empty(get_theme_mod('top_lead_summary'))) : ?>
      <div class="main__introduction">
        <p>
          <?php echo nl2br(get_theme_mod('top_lead_summary', '')) ?>
        </p>
      </div>
    <?php endif; ?>

    <div class="main__sns">
      <?php if (!empty(get_theme_mod('sns_twitter'))) : ?>
        <a class="main__sns__twitter" href="<?php echo esc_html(get_theme_mod('sns_twitter', '')) ?>" target="_blank">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/svg/twitter_b.svg" alt="twitter" />
        </a>
      <?php endif; ?>

      <?php if (!empty(get_theme_mod('sns_facebook'))) : ?>
        <a class="main__sns__facebook" href="<?php echo esc_html(get_theme_mod('sns_facebook', '')) ?>" target="_blank">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/svg/facebook_b.svg" alt="facebook" />
        </a>
      <?php endif; ?>

      <?php if (!empty(get_theme_mod('sns_instagram'))) : ?>
        <a class="main__sns__instagram" href="<?php echo esc_html(get_theme_mod('sns_instagram', '')) ?>" target="_blank">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/svg/instagram_b.svg" alt="instagram" />
        </a>
      <?php endif; ?>

      <?php if (!empty(get_theme_mod('sns_youtube'))) : ?>
        <a class="main__sns__youtube" href="<?php echo esc_html(get_theme_mod('sns_youtube', '')) ?>" target="_blank">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/svg/youtube_b.svg" alt="youtube" />
        </a>
      <?php endif; ?>

      <?php if (!empty(get_theme_mod('sns_tiktok'))) : ?>
        <a class="main__sns__tiktok" href="<?php echo esc_html(get_theme_mod('sns_tiktok', '')) ?>" target="_blank">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/svg/tiktok_b.svg" alt="tiktok" />
        </a>
      <?php endif; ?>

      <?php if (!empty(get_theme_mod('sns_line'))) : ?>
        <a class="main__sns__line" href="<?php echo esc_html(get_theme_mod('sns_line', '')) ?>" target="_blank">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/svg/line_b.svg" alt="line" />
        </a>
      <?php endif; ?>
    </div>

    <!-- <div class="main__news">
      <h3 class="main__section__title">お知らせ</h3>
      <ul class="posts-wrapper">
        <li class="news-wrapper">
          <a href="/">
            <div class="news-date">2023.06.19</div>
            <div class="news-title">お知らせタイトルお知らせタイトルお知らせタイトルお知らせタイトルお知らせタイトル</div>
          </a>
        </li>
        <li class="news-wrapper">
          <a href="/">
            <div class="news-date">2023.06.18</div>
            <div class="news-title">お知らせタイトル</div>
          </a>
        </li>
      </ul>
    </div> -->

    <?php if (!empty(get_theme_mod('banner_section_name'))) : ?>
      <section class="main__banner">
        <h3 class="main__section__title">運営メディア</h3>
        <div class="main__banner__wrapper">
          <article class="main__banner__wrapper__item">
            <a href="https://www.kuni-chan.com/triathlon-challenger/">
              <img src="https://kuni-chan.com/wp-content/uploads/2023/06/banner1.png" alt="トライアスロン挑戦レポ" />
            </a>
          </article>
        </div>
      </section>
    <?php endif; ?>

    <?php if ((get_theme_mod('work_section_view') === true)) : ?>
      <section class="main__work">
        <h3 class="main__section__title"><?php echo !empty(get_theme_mod('work_section_name')) ? get_theme_mod('work_section_name') : '実績' ?></h3>

        <?php
        if (!empty(get_theme_mod('work_category'))) {
          query_posts('category_name=' . get_theme_mod('work_category'));
        }
        ?>

        <div class="main__work__wrapper">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              <article class="main__work__wrapper__item">
                <a href="<?php the_permalink(); ?>">

                  <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                  <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/default_thumbnail.png" alt="">
                  <?php endif; ?>
                  <div class="main__work__post__title">
                    <h3><?php echo get_the_title(); ?></h3>
                    <span class="post-date-modified"><time datetime=<?php echo get_the_modified_time('Y-m-d'); ?>>最終更新:<?php echo get_the_modified_time('Y/m/d'); ?></time></span>
                  </div>
                </a>
              </article>
            <?php endwhile; ?>
        </div>
      <?php else : ?>
        <div class="main__work__wrapper">
          <p>記事が見つかりません</p>
        </div>
      <?php endif; ?>
      </section>
    <?php endif; ?>

    <section class="main__contact">
      <h3 class="main__section__title">お問い合わせ</h3>
      <p>上記の各種SNSからご連絡ください｡</p>
    </section>

    <!-- <?php
          if (have_posts()) :
            while (have_posts()) :
              the_post();
          ?>
        <?php the_content(); ?>
    <?php
            endwhile;
          endif;
    ?> -->

  </main>
</div>

<?php get_footer(); ?>