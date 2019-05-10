<?php
function provost_news_featured_article() {

  // WP_Query arguments
  $args = array(
  'post_type'              => array( 'post' ),
  'post_status'            => array( 'publish' ),
  'order'                  => 'DESC',
  'orderby'                => 'date',
  'posts_per_page'          => 3,
  'meta_query' => array(
		        array(
			'key'     => '_thumbnail_id',
			'value'   => '',
			'compare' => '!=',
		        )
         	      )


  );

$count = 1;
  // The Query
  $featured = new WP_Query( $args );

  // The Loop
  if ( $featured->have_posts() ) {?>
    <section class="featured-stories">
      <div class="top-container py-3">
        <div class="row no-gutters">

    <?php
  while ( $featured->have_posts() ) {
    $featured->the_post();
      if($count==1):?>
        <div class="col-12 col-md-7 p-1">
          <article class="left-featured post-<?php the_ID(); ?>">
            <?php
                $format = get_post_format() ? : 'standard';
                $link_url = get_the_permalink();

                 if( get_field('pub_article_url') and ($format == 'link' ) ):
                    $link_url = get_field( "pub_article_url" );
                endif;
            ?>
            <a href="<?php echo $link_url ?>" class="d-flex w-100 p-4 media-background-container text-inverse text-decoration-none news-lg-bg">
                <?php the_post_thumbnail( 'large', array('class' => 'media-background object-fit-cover img-fluid hover-scale-up')); ?>
                <div class="align-self-end featured-text">
                  <div class="home-cat">
                    <span class="bg-inverse p-1 small text-uppercase font-weight-bold">
                      <?php $categories = get_the_category();
                      if ( ! empty( $categories ) ):
                            echo esc_html( $categories[0]->name );
                      endif;
                       ?>
                    </span>
                  </div>
                  <h2 class="text-shadow"><?php the_title(); ?></h2>
                </div>
            </a>
          </article>
        </div>
      <?php endif; ?>

      <?php if( $count > 1):?>

        <?php if( $count== 2):?>
            <div class="col-12 col-md-5 p-1">
        <?php endif;?>

        <?php
            $format = get_post_format() ? : 'standard';
            $link_url = get_the_permalink();
            if( get_field('pub_article_url')  and ($format == 'link' )):
               $link_url = get_field( "pub_article_url" );
           endif;
        ?>

            <article class="right-featured post-<?php the_ID(); ?>">
              <a href="<?php echo $link_url ?>" class="d-flex w-100 p-4 media-background-container text-inverse text-decoration-none news-md-bg mb-2">
                <?php the_post_thumbnail( 'large', array('class' => 'media-background object-fit-cover img-fluid hover-scale-up')); ?>
                <div class="align-self-end">
                  <div class="home-cat">
                    <span class="bg-inverse p-1 small text-uppercase font-weight-bold">
                      <?php $categories = get_the_category();
                      if ( ! empty( $categories ) ):
                            echo esc_html( $categories[0]->name );
                      endif;
                       ?>
                    </span>
                  </div>
                  <h3 class="text-shadow h5"><?php the_title(); ?></h3>
                </div>
              </a>
            </article>


        <?php if($count== 3):?>
              </div>
        <?php endif;?>
      <?php endif;?>


<?php
$count++;
} ?>

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
