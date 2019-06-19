<?php

/*
Adds the recommend stories on post pages. It's created as a sidebar alllwoing you to add whatever you want.
 */

function provost_news_entry_recomended(){

if ( is_singular() ):
 ?>
 <?php if ( is_active_sidebar( 'posts-block' ) ) : ?>
<section class="trending-news mt-3 pt-5 mb-5">
    <div class="row justify-content-center">
           <?php dynamic_sidebar( 'posts-block' ); ?>
    </div>
</section>
  <?php endif; ?>
<?php endif;

}
