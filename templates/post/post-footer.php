<?php
// entry footer look

function provost_news_entry_footer1() { ?>
 <footer class="entry-footer mt-5 pb-5 row">

           <div class="post-tags  col-12 col-md-6">
             <?php if ( is_active_sidebar( 'social_sidebar' ) ) : ?>
                <ul id="social">
                    <?php dynamic_sidebar( 'social_sidebar' ); ?>
                </ul>
            <?php endif; ?>
           </div>



             <div class="post-full-author col-12 col-md-6">
               <h2 class="mb-0 h5">Author</h2>
               <div class="author font-weight-bold small"><?php the_author();?></div>

             </div>



</footer>
<?php }
