<?php get_header();?>
  <div class="container mt-3 mt-sm-2 mb-3 pb-sm-4">
    <h1 class="page-title mt-5 mb-5">Latest News</h1>

<?php while ( have_posts() ) : the_post(); ?>
    <article class="term-list-item mb-4 py-5 divider">
      <?php $link = get_permalink(); ?>
      <div class="row">
        <div class="order-1 order-sm-0 col-12 col-sm-6 col-md-8">
            <p class="font-italic entry-date"><?php echo esc_html( get_the_date('D M j')); ?></p>
    	       <h2 class="h3 archive-title mb-5 text-secondary"><a href="<?php echo $link; ?>" class="text-secondary"><?php the_title(); ?> </a></h2>
             <div class="read-more text-uppercase font-weight-bold"><a href="<?php echo $link; ?>" class="btn btn-outline-secondary btn-sm">Read More ></a></div>
       </div>
        <div class="order-0 order-sm-1 col-12 col-sm-6 col-md-4">
            <?php if(has_post_thumbnail()): ?>
                    <div class="archive-thumbnail"> <a href="<?php echo $link; ?>"> <?php the_post_thumbnail( 'archive_thumb' ); ?> </a><div>
            <?php else: ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/provost-newsroom.jpg"  width="300" height="200" alt="Provost news deafult image"/>
            <?php endif; ?>

        </div>
    	</div>
    </article>


<?php endwhile; // end of the loop. ?>

      <?php boostrap_4_pagination(); ?>

  </div>

<?php get_footer(); ?>
