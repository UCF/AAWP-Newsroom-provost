<?php

/*
Post footer. It adds a sidebar so you your own content under the post
*/


function provost_news_entry_footer() { ?>
 <footer class="entry-footer mt-4 pb-5 row divider">
      <div class="post-tags  col-12 col-md-8">

        <?php

        $termsArray = get_the_terms(
            $post->ID,
                array(
                    'category',
                    'academic_units',
                )
            );

            if( $termsArray):
                echo '<div><strong>Tags:</strong></div>';
              foreach( $termsArray as $term ) {

                $term_link = get_term_link( $term );

                  echo '<a href="' . esc_url( $term_link ) .'" class="term-link btn btn-secondary btn-sm my-1 mr-2">' . $term->name .'</a>';


                  }

            endif;
         ?>
</footer>
<?php }
