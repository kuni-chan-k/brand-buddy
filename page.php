<?php get_header(); ?>

<div class="container">
  <main class="main">
    <div class="main__head">
      <div class="main__head__icon">
        <img src="https://www.kuni-chan.com/triathlon-challenger/wp-content/uploads/2023/06/トライアスリートくにちゃん-150x150.jpg" alt="くにちゃん" width="90" height="90">
      </div>
      <h2 class="main__head__name">
        國光 健太郎
      </h2>
      <p class="main__head__job">走るシステムエンジニア</p>
    </div>

    <div class="main__introduction">
      <p>
        今はフロントエンド(react・NextJS)をメインに扱っているフリーランスシステムエンジニアです｡PHPの開発実績もあります｡<br>
        コーディングより喋りのほうが得意かも？
      </p>
      <p>
        2021年からロードバイクにはまり､37歳でフルマラソン・トライアスロンデビュー｡<br>
        自転車のイベントに貢献したいと考えています｡
      </p>
    </div>

    <div class="main__sns">
      <!-- 順番を並び替えられるようにする -->
      <a class="main__sns__twitter" href="https://twitter.com/kunimitsu_k" target="_blank">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/svg/twitter_b.svg" alt="twitter" />
      </a>
      <a class="main__sns__facebook" href="https://www.facebook.com/kunimitsukentaro" target="_blank">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/svg/facebook_b.svg" alt="facebook" />
      </a>
      <a class="main__sns__instagram" href="https://www.instagram.com/kunimitsu_ken/" target="_blank">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/svg/instagram_b.svg" alt="instagram" />
      </a>
      <a class="main__sns__youtube" href="https://www.youtube.com/channel/UCWVSZMDednNBevPQ1R_gruw" target="_blank">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/svg/youtube_b.svg" alt="youtube" />
      </a>
      <!-- <a class="main__sns__tiktok" href="/">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/svg/tiktok_b.svg" alt="tiktok" />
      </a> -->
      <!-- <a class="main__sns__line" href="/">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/svg/line_b.svg" alt="line" />
      </a> -->
    </div>

    <!-- <div class="main__news">
      <h3>お知らせ</h3>
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

    <div class="main__banner">
      <h3>運営メディア</h3>
      <div class="main__banner__wrapper">
        <article class="main__banner__wrapper__item">
          <a href="https://www.kuni-chan.com/triathlon-challenger/">
            <img src="https://kuni-chan.com/wp-content/uploads/2023/06/banner1.png" alt="トライアスロン挑戦レポ" />
          </a>
        </article>
      </div>
    </div>

    <!-- <div class="main__work">
      <h3>実績</h3>
      <div class="main__work__wrapper">
        <article class="main__work__wrapper__item">
          <a href="">
            <img src="img/dummy1.png" alt="実績タイトル" />
            <p>実績タイトル</p>
          </a>
        </article>
        <article class="main__work__wrapper__item">
          <a href="">
            <img src="img/dummy2.png" alt="実績タイトル2" />
            <p>実績タイトル2 長いタイトルの場合の表示を確認</p>
          </a>
        </article>
        <article class="main__work__wrapper__item">
          <a href="">
            <img src="img/dummy3.png" alt="実績タイトル3" />
            <p>実績タイトル3</p>
          </a>
        </article>
        <article class="main__work__wrapper__item">
          <a href="">
            <img src="img/dummy4.png" alt="実績タイトル4" />
            <p>実績タイトル4</p>
          </a>
        </article>
      </div>
    </div> -->

    <div class="main__contact">
      <h3>お問い合わせ</h3>
      <p>上記の各種SNSからご連絡ください｡</p>
    </div>

    <!-- <?php
    if (have_posts()) :
      while (have_posts()) :
        the_post();
    ?>
        あああ
        <?php the_content(); ?>
    <?php
      endwhile;
    endif;
    ?> -->

  </main>
</div>

<?php get_footer(); ?>