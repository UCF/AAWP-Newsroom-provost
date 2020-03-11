<?php

// Check value exists.
if( have_rows('alert_style') ): ?>

<section class="provost-alerts">


<?php
    // Loop through rows.
    while ( have_rows('alert_style') ) : the_row();


        if( get_row_layout() == 'provost_news_ucf_alert' ):?>

            <div class="alert alert-info">
              <div class="container">
        <?php

            the_sub_field('provost_news_alert_content');

        ?>
            </div>
          </div>

        <?php

        elseif( get_row_layout() == 'provost_news_alert_articles' ): ?>

        <div class="article-alerts">
          <div class="container border py-4 px-4">

          <h2 class="heading-underline"><?php  the_sub_field('provost_news_alert_title'); ?></h2>

          <?php the_sub_field('provost_news_alert_info');

                $rows = get_sub_field('provost_news_alert_article_listing');

                    if($rows) { ?>

                      <ul class="list-unstyled">

                    <?php

                    foreach($rows as $row)  {

                      $postID = $row['provost_news_alert_article'];

                      echo '<li><a href="'. get_permalink($postID) .'" class="text-secondary-aw font-weight-bold"> <span class="text-default-aw">'.get_the_date('M j', $postID) .'</span> - ' . get_the_title($postID)  .'</li>';
                    } ?>

                    </ul>

                    <?php
                    }
            ?>


        </div>
      </div>

        <?php endif; ?>

        </section>

        <?php

    // End loop.
    endwhile;

endif;
