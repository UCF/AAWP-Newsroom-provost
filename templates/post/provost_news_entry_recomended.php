<?php

/*
Adds the recommend stories on post pages. It's created as a sidebar alllwoing you to add whatever you want.
 */

function provost_news_entry_recomended(){

if ( is_singular() ):
 ?>
  <section class="trending-news mt-3 pt-5 mb-5"  >

    <div class="row justify-content-center ">

      <div class="col-12 col-md-6 py-4 px-5" style="background:#eee;">

        <h2 class="h3 text-uppercase mb-3">Articles like this one</h2>

          <?php tax_post_listing(); ?>

    </div>

    <div class="col-12 col-md-6 py-4 px-3" style="">

      <h2 class="h3 text-uppercase mb-3">Latest News</h2>

        <?php echo do_shortcode('[ucf-post-list layout="news" numberposts=4]'); ?>

    </div>

  </section>

<?php endif;

}


function tax_post_listing(){
?>

<?php
global $post;

$categories = get_the_category( $post->ID );

$postcat = array();
//  print_r($categories);
  foreach( $categories as $category ) {

        $postcat[] = $category->slug;
    }
$str = implode (", ", $postcat);

echo do_shortcode('[ucf-post-list layout="card" show_excerpt="false" tax_category__field="slug" tax_category="'.$str.'" post__not_in="'. get_the_ID() .'"  posts_per_row="2" numberposts=4]');

}
