<?php

// entry footer look

function provost_news_entry_footer() { ?>
 <footer class="entry-footer mt-5 pb-5">

           <div class="post-tags mb-4">
                <div class="post-tags"><?php the_tags( '<strong>Fill Under:</strong> ', ', ', '<br />' ); ?></div>
                <div class="post-tags mt-3"><?php the_tags( '<strong>Tags:</strong> ', ', ', '<br />' ); ?></div>
           </div>

           <hr/>

             <div class="post-full-author mt-5">
               <h2 class="mb-4">Author</h2>
               <div class="author h6"><?php the_author();?></div>
               <div>Office of the Provost and Academic Affairs</div>
             </div>



</footer>
<?php }
