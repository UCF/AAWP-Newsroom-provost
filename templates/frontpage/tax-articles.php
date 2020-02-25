<?php

/*
Homepage of listing articles by category. As of right now it will list all categories and add articles if they have an image
 */


function provost_news_featured_tax() {

  // check if the repeater field has rows of data
  $post_id = get_option('page_on_front');

$topArticles = array();

// check if the repeater field has rows of data
if( have_rows('provost_top_articles_repeater', $post_id) ):

 	// loop through the rows of data
    while ( have_rows('provost_top_articles_repeater', $post_id) ) : the_row();

        // display a sub field value
         $topArticles[] = get_sub_field('provost_top_article');

    endwhile;

endif;

//repeater field to get categories to display


    $topics = array();

      $person_relationships = get_field('pn_topics', $post_id);


      if (have_rows('pn_topics', $post_id)) {
        while (have_rows('pn_topics', $post_id)) {
          the_row();

            $topic_id =  get_sub_field('pn_topic');
              //var_dump($topic_id);
              $topics[] = $topic_id->term_id;

        }
      }


          $evenodd = 1;




                  $categories = get_terms( array( // get categories
                        'taxonomy' => 'category',
                        'orderby' => 'include',
                        'order' => 'ASC',
                        'parent' => 0,
                        'hide_empty' => true,
                        'include' => $topics,
                    ) );

                  foreach($categories as $category) {
                      wp_reset_query();
                      $args = array(
                        'post_type' => 'post',
                        'post__not_in' => $topArticles,
                        'posts_per_page' => 3,
                        'tax_query' => array(
                              array(
                                  'taxonomy' => 'category',
                                  'field' => 'slug',
                                  'terms' => $category->slug,
                              ),
                          ),
                        'meta_query' => array( //requires a feature image
                            array(
                             'key' => '_thumbnail_id',
                             'compare' => 'EXISTS'
                            ),
                        ),
                       );

                       $loop = new WP_Query($args);

                       if($loop->have_posts()) {?>

                         <?php if($evenodd  % 2 == 0):
                            echo '<section class="cat-' . esc_html($category->slug) .  ' py-5 divider" id="'. esc_html($category->slug) .'">';
                          else:
                              echo '<section class="cat-' . esc_html($category->slug) .  ' py-5 divider light-grey" id="'. esc_html($category->slug) .'">';
                          endif;
                         ?>

                         <div class="container">

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
                               $postcat = get_the_category();

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
                                  <a href="<?php echo esc_url( $category_link );  ?>" class="text-uppercase btn btn-outline-secondary btn-sm">More <?php echo esc_html($category->name); ?> ></a>

                                </div>
                              </div>
                          </div>
                        </div>
                        <?php

                       }
                      ?>

                    </section> <?php
                  }?>
          <?php }



function provost_news_cat_odd($count,$link_url){ //grey background

  if($count == 1):?>

  <?php
      $format = get_post_format() ? : 'standard';
      $link_url = get_the_permalink();
  ?>

  <div class="row no-gutters">
    <div class="col-12 col-md-7">

      <article>
        <a href="<?php echo $link_url; ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'full', array('class' => 'img-fluid mb-3')); ?></a>
        <p class="font-italic published-date mb-0"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="entry-date pl-1"><?php echo esc_html( get_the_date('D M j')); ?></span></p>
        <h2 class="h4 "> <a href="<?php echo $link_url ?>" class="text-secondary"><?php the_title(); ?> test</a></h2>
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

function provost_news_cat_even($count,$link_url){ //white

    if($count == 1):?>

    <?php
        $format = get_post_format() ? : 'standard';
        $link_url = get_the_permalink();

    ?>

        <div class="row no-gutters">
          <div class="col-12 col-md-7 push-md-5">
            <article>
              <a href="<?php echo $link_url; ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'medium-large', array('class' => 'img-fluid mb-3')); ?></a>
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
