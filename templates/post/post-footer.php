<?php

/*
Post footer. It adds a sidebar so you your own content under the post
*/


function provost_news_entry_footer() { ?>
 <footer class="entry-footer mt-4 pb-5 row divider">
      <div class="post-tags  col-12 col-md-8">

          <?php
          if(get_the_tag_list()) {
            echo get_the_tag_list('<p><Strong>Filed Under: </Strong> ',', ','</p>');
            }
            ?>
      </div >
      <div class="post-share col-12 col-md-4 ">
        <?php if ( is_active_sidebar( 'social_sidebar' ) ) : ?>
          <div class="list">
             <?php dynamic_sidebar( 'social_sidebar' ); ?>
         </div>
       <?php endif; ?>
      </div>

</footer>
<?php }
