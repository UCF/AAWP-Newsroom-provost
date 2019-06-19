<?php

/*
Homepage of listing articles by category. As of right now it will list all categories and add articles if they have an image
 */


function provost_news_featured_tax() {
          $evenodd = 1;

                  $categories = get_terms( array( // get categories
                        'taxonomy' => 'category',
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                        'parent' => 0,
                        'hide_empty' => True,
                    ) );

                  foreach($categories as $category) {
                      wp_reset_query();
                      $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                          'tax_query' => array(
                              array(
                                  'taxonomy' => 'category',
                                  'field' => 'slug',
                                  'terms' => $category->slug,
                              ),
                          ),
                        'meta_query' => array( //requires a feature i,age
                            array(
                             'key' => '_thumbnail_id',
                             'compare' => 'EXISTS'
                            ),
                        ),
                       );

                       $loop = new WP_Query($args);

                       if($loop->have_posts()) {?>

                         <section class="cat-<?php echo esc_html($category->slug); ?> py-4 ">
                           <?php  $evenodd = $evenodd + 1; ?>

                          <?php $category_link = get_category_link($category->term_id);  ?>

                         <div class="d-flex justify-content-between bd-highlight mb-3 news-cat">
                            <h2 class="header-tabe heading-underline"><?php echo esc_html($category->name); ?></h2>
                        </div>
                         <?php
                          $count = 1;
                          while($loop->have_posts()) : $loop->the_post();
                              $link_url = esc_url(get_permalink());
                             if ($evenodd % 2 == 0):
                               /*
                               Odd number design. Left column bigger image

                                */
                                provost_news_cat_odd($count,$link_url); //big image on the left


                              else:
                              provost_news_cat_even($count,$link_url); //big image on the right
                            endif;



                          $count++;
                        endwhile; ?>

                            </div>
                              <div class="col-12 my-3">
                                <div class="d-flex align-items-center justify-content-end">
                                  <a href="<?php echo esc_url( $category_link );  ?>" class="text-uppercase">More <?php echo esc_html($category->name); ?> ></a>

                                </div>
                              </div>
                          </div>
                        <?php

                       }
                      ?>
                        <hr class="mt-3 mb-2">
                    </section> <?php
                  }?>
          <?php }



function provost_news_cat_odd($count,$link_url){

  if($count == 1):?>

  <?php
      $format = get_post_format() ? : 'standard';
      $link_url = get_the_permalink();
      if( get_field('pub_article_url') and ($format == 'link' )):
        $link_url = get_field( "pub_article_url" );
     endif;
  ?>

  <div class="row no-gutters">
    <div class="col-12 col-md-7">
      <article>
        <a href="<?php echo $link_url; ?>"><?php the_post_thumbnail( 'medium-large', array('class' => 'img-fluid mb-3')); ?></a>
        <p class="font-italic published-date mb-0"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="entry-date pl-1"><?php echo esc_html( get_the_date('D M j')); ?></span></p>
        <h2 class="h4 "> <a href="<?php echo $link_url ?>" class="text-secondary"><?php the_title(); ?></a></h2>
        <p><?php the_excerpt(); ?></p>
    </article>
    </div>
    <div class="d-none d-md-flex justify-content-center col-md-1">
      <div class="d-flex flex-column h-100 vertical-divider"></div>
    </div>
    <div class="col-12 col-md-4">

<?php endif;
if($count > 1):?>
<article class="mb-5" >
  <a href="<?php echo $link_url ?>" class="d-flex w-100 mb-2 media-background-container text-inverse text-decoration-none news-md-bg">
      <?php the_post_thumbnail( 'medium', array('class' => 'media-background object-fit-cover img-fluid')); ?>
  </a>
  <p class="font-italic published-date mb-0"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="entry-date pl-1"><?php echo esc_html( get_the_date('D M j')); ?></span></p>
  <h2 class="h6"><?php the_title(); ?></h2>
</article>
<?php endif;


}

function provost_news_cat_even($count,$link_url){

    if($count == 1):?>

    <?php
        $format = get_post_format() ? : 'standard';
        $link_url = get_the_permalink();
        if( get_field('pub_article_url') and ($format == 'link' )):
          $link_url = get_field( "pub_article_url" );
       endif;
    ?>

        <div class="row no-gutters">
          <div class="col-12 col-md-7 push-md-5">
            <article>
              <a href="<?php echo $link_url; ?>"><?php the_post_thumbnail( 'medium-large', array('class' => 'img-fluid mb-3')); ?></a>
              <p class="font-italic published-date mb-0"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="entry-date pl-1"><?php echo esc_html( get_the_date('D M j')); ?></span></p>
              <h2 class="h4 "> <a href="<?php echo $link_url ?>" class="text-secondary"><?php the_title(); ?></a></h2>
              <p><?php the_excerpt(); ?></p>
          </article>
          </div>
          <div class="d-none d-md-flex justify-content-center col-md-1 pull-md-3">
            <div class="d-flex flex-column h-100 vertical-divider"></div>
          </div>
          <div class="col-12 col-md-4 pull-md-8">

      <?php endif;
      if($count > 1):?>
      <article class="mb-5" >
        <a href="<?php echo $link_url ?>" class="d-flex w-100 mb-2 media-background-container text-inverse text-decoration-none news-md-bg">
            <?php the_post_thumbnail( 'medium', array('class' => 'media-background object-fit-cover img-fluid')); ?>
        </a>
        <p class="font-italic published-date mb-0"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="entry-date pl-1"><?php echo esc_html( get_the_date('D M j')); ?></span></p>
        <h2 class="h6"><?php the_title(); ?></h2>
      </article>
  <?php endif;




}
