<!-- breadcrumb -->
<?php if (!is_home() && !is_front_page()) : ?>
  <section id="breadCrumb">
    <ul id="breadCrumbInner">
      <li class="breadcrumb-item"><a href="<?php echo home_url('/'); ?>">TOP</a></li>
      <?php
      if (is_single()) {

        // if (get_the_category() != false) {
        //   $category           = get_the_category();
        //   $category_hierarchy = get_category_parents($category[0]->term_id, true, '////');
        //   $category_hierarchy = explode('////', $category_hierarchy);
        //   foreach ($category_hierarchy as $cat_list) {
        //     if (!empty($cat_list)) {
        //       $cat_list = preg_replace('/href="(\S+)"/', 'href="$1"', $cat_list);
        //       $cat_list = preg_replace('/>/', '>', $cat_list, 1);
        //       $cat_list = preg_replace('/<\/a>/', '</a>', $cat_list);
        //       echo '<li class="breadcrumb-item"><span class="breadcrumb-parts">＞</span>' . $cat_list . '</li>';
        //     }
        //   }
        // }
      // } elseif (is_category()) {

      //   if (get_the_category() != false) {
      //     global $cat;
      //     $category_hierarchy = array_reverse(get_ancestors($cat, 'category'));
      //     foreach ($category_hierarchy as $cat_list) {
      //       if (!empty($cat_list)) {
      //         $cat_name = get_category($cat_list)->name;
      //         $cat_link = get_category_link($cat_list);
      //         echo '<li class="breadcrumb-item"><span class="breadcrumb-parts">＞</span><a href="' . $cat_link . '">' . $cat_name . '</a></li>';
      //       }
      //     }
      //   }

      } elseif (is_tag()) {

        $tag = single_tag_title('', false);
        echo '<li class="breadcrumb-item">タグ:' . $tag . '</li>';

      } elseif (is_search()) {

        $str = '<li class="breadcrumb-item"><span class="breadcrumb-parts">＞</span>検索結果「' . get_search_query() . '」</li>';
        echo $str;

      } elseif (is_author()) {

        $str = '<li class="breadcrumb-item"><span class="breadcrumb-parts">＞</span>投稿者：' . get_the_author_meta('display_name', get_query_var('author')) . '</li>';
        echo $str;

      } elseif (is_404()) {

        $str = '<li class="breadcrumb-item"><span class="breadcrumb-parts">＞</span>ページが見つかりませんでした</li>';
        echo $str;

      } elseif (is_post_type_archive()) {

        $customPostTitle = post_type_archive_title('', false);
        $str = '<li class="breadcrumb-item"><span class="breadcrumb-parts">＞</span>' . $customPostTitle . '</li>';
        echo $str;

      }
      ?>

      <?php if (is_singular()) : ?>
        <li class="breadcrumb-item"><span class="breadcrumb-parts">＞</span><?php the_title(); ?></li>
      <?php elseif (is_category()) : ?>
        <li class="breadcrumb-item"><span class="breadcrumb-parts">＞</span>
        <?php
          global $cat;
          echo get_category($cat)->name;
        ?>
        </li>
      <?php endif; ?>
    </ul>
  </section>

<?php endif; ?>
<!--breadcrumb-->