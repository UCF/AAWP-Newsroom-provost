<?php


function provost_news_latest_articles() {

  // WP_Query arguments
$args = array(
	'post_type'              => array( 'post' ),
	'post_status'            => array( 'publish' ),
	'posts_per_page'         => '6',
	'order'                  => 'DESC',
	'orderby'                => 'date',
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();?>
    <article class="post-<?php the_ID(); ?> front-post pb-4 mt-3 mb-4 d-flex">
      <div class="article-img col-md-3">
        <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail('thumbnail', ['class' => 'img-fluid']); ?>
        </a>
      <?php else: ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
          <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/provost-newrrom.jpg" class="img-fluid" alt="<?php the_title(); ?>"> 
        </a>
      <?php endif; ?>
      </div>
      <div class="article-content col-md-9">
		      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php the_title('<h3 class="h5 pft-title">', '</h2>'); ?>
          </a>
        <p class="pft-content"><?php the_excerpt(); ?></p>
      </div>
    </article>
    <?php
	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();

}
