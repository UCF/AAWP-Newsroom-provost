<?php

function provost_news_featured_article() {

  //get the top articles
  $topArticles = [];

  // check if the repeater field has rows of data
  if( have_rows('provost_top_articles_repeater', $post_id) ):

   	// loop through the rows of data
      while ( have_rows('provost_top_articles_repeater', $post_id) ) : the_row();

          // display a sub field value
           $topArticles[] = get_sub_field('provost_top_article');

      endwhile;

  endif;

  // WP_Query arguments
  $args = array(
  'post_type'              => array( 'post' ),
  'post_status'            => array( 'publish' ),
  'order'                  => 'DESC',
  'post__in'               => $topArticles,
  'orderby'                =>  'post__in',
  'posts_per_page'          => 3,

  'meta_query' => array(
              array(
          			'key'     => '_thumbnail_id', // Makes sure post have an image
              ),
    )
  );

$count = 1;
  // The Query
  $featured = new WP_Query( $args );

  // The Loop
  if ( $featured->have_posts() ) {

    ?>

    <section class="featured-stories cat-provost light-grey pt-5 pt-sm-4">
      <div class="top-container container py-3">
        <div class="row no-gutters">

    <?php
  while ( $featured->have_posts() ) {
    $featured->the_post();

      if($count==1): //large feature image ?>

        <div class="col-12 col-md-7">

            <?php
                $format = get_post_format() ? : 'standard';

                $link_url = get_the_permalink();

                 if( get_field('pub_article_url') and ($format == 'link' ) ):

                    $link_url = get_field( "pub_article_url" );

                endif;
            ?>
            <article class="post-<?php the_ID(); ?> pn-article pnt-article">

              <a href="<?php echo $link_url; ?>"><?php the_post_thumbnail( 'medium-large', array('class' => 'img-fluid mb-3')); ?></a>

              <p class="font-italic published-date mb-0"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="entry-date pl-1"><?php echo esc_html( get_the_date('D M j')); ?></span></p>

              <h2 class="h4 "> <a href="<?php echo $link_url ?>" class="text-secondary"><?php the_title(); ?></a></h2>

              <p><?php the_excerpt(); ?></p>

          </article>

        </div>

        <div class="d-none d-md-flex justify-content-center col-md-1">

          <div class="d-flex flex-column h-100 vertical-divider"></div>

        </div>

      <?php endif; ?>

      <?php if( $count > 1):?>

        <?php if( $count== 2):?>

            <div class="col-12 col-md-4">

        <?php endif;?>

        <?php
            $format = get_post_format() ? : 'standard';

            $link_url = get_the_permalink();

            if( get_field('pub_article_url')  and ($format == 'link' )):

               $link_url = get_field( "pub_article_url" );

           endif;
        ?>

            <article class="mb-5" >

              <a href="<?php echo $link_url ?>" class="d-flex w-100 mb-2 media-background-container text-inverse text-decoration-none news-md-bg">

                  <?php the_post_thumbnail( 'medium', array('class' => 'media-background object-fit-cover img-fluid')); ?>

              </a>

              <p class="font-italic published-date mb-0"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="entry-date pl-1"><?php echo esc_html( get_the_date('D M j')); ?></span></p>

                <a href="<?php echo $link_url ?>" class="text-secondary">

                  <h2 class="h6"><?php the_title(); ?></h2>

                </a>

            </article>

        <?php if($count== 3):?>

              </div>

        <?php endif;?>

      <?php endif;?>

<?php

$count++;

} ?>

        <div class="col-12 my-3">

          <div class="d-flex align-items-center justify-content-end">

            <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) );  ?>" class="text-uppercase btn btn-outline-secondary btn-sm">Latest News > </a>

          </div>

        </div>

      </div>

    </div>

  </section>

  <?php
} else {
// no posts found
}

// Restore original Post Data
wp_reset_postdata();


}
