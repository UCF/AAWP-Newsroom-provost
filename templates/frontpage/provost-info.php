<?php
/*
Homepage sidebar below top articles
 */

function provost_news_section(){ //provides information on the provost?>

    <section class="provost provost-section mt-4 mb-4 py-5">
      <div class="container">
      <div class="row">
        <div class="col-12 col-md-4">
          <?php

                $image = get_field('pn_provost_image');

                $size = 'large'; // (thumbnail, medium, large, full or custom size)
                      if( $image ) {

                      echo wp_get_attachment_image( $image, $size,"", array( "class" => "img-fluid" ) ); //adds the provost imate

                      }

                ?>

                <?php if( get_field('pn_provost_name') ): //provost name?>

                  <div class="provost-name h5 mt-2">Provost <?php the_field('pn_provost_name'); ?></div>

              <?php endif; ?>
              <?php

                // add a repeater field for provost resources
                if( have_rows('pn_provost_resources') ):

                      echo '<ul class="list-unstyled">';

                 	// loop through the rows of data
                    while ( have_rows('pn_provost_resources') ) : the_row();

                        // display a sub field value
                        echo '<li><a href="'. get_sub_field('pn_provost_link_url') .'" >'. get_sub_field('pn_provost_link_title') . '</a></li>';

                    endwhile;

                    echo '</ul>';

                else :

                    // no rows found

                endif;



                ?>


        </div>

              <?php

              $provost_terms = get_terms(array(
                'taxonomy' => 'category',
                'parent'   => 0,
                'orderby'=> 'count',
                'slug'=> 'provost',
                ) );

                  foreach($provost_terms as $provost_term) { //loop for provost sub categories
                      wp_reset_query();

                      $terms = get_terms( 'category', array( 'parent' => $provost_term->term_id, 'orderby' => 'slug', 'hide_empty' => false, 'include' => array(16) ) );

                         foreach( $terms as $term ) { ?>

                              <?php
                              $args = array(
                                  'post_type' => 'post',
                                  'posts_per_page' => 4,
                                  'orderby' => 'date',
                                  'order'   => 'DESC',
                                  'tax_query' => array(
                                      array(
                                          'taxonomy' => 'category',
                                          'field' => 'slug',
                                          'terms' => $term->slug,
                                      ),
                                  ),
                               );

                               $loop = new WP_Query($args); //Display provost categories and pages
                               if($loop->have_posts()) {?>
                                 <div class="col-12 col-md-4">
                                    <h3 class="title-underline h4"> <?php
                                    echo esc_html($term->name); ?>

                                  </h3>
                                      <ul class="list-unstyled">
                                    <?php

                                  while($loop->have_posts()) : $loop->the_post();
                                      echo '<li class="divider"><a  class="text-secondary d-block py-2 my-2" href="'. get_post_permalink( ) .'">'.get_the_title().'</a></li>';
                                  endwhile;
                                    ?>
                                    </ul>
                                    <a href="<?php echo get_category_link($term->term_id); ?>" class="text-uppercase"> More <?php echo esc_html($term->name); ?> >  </a>
                                  </div>
                                  <?php
                               }
                               ?>

                           <?php
                         }
                      }       ?>
		   <div class="col-12 col-md-4">
			   <?php echo do_shortcode('[custom-twitter-feeds screenname="ucfacademics"   num=1 showbutton=false]') ?>
		  </div>
        </div>
      </div>
    </section>
  <?php
}
