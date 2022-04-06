<?php get_header();?>
<div class="container mt-3 mt-sm-2 mb-3 pb-sm-4">
    <?php the_archive_title( '<h1 class="page-title mt-5 mb-3">', '</h1>' );

    if( get_the_archive_description() ):

      the_archive_description( '<p class="lead archive-description mb-5">', '</p>' );
    else:
      esc_html('<div class="mb-3"> </div>');
    endif;

      ?>


    <?php while ( have_posts() ) : the_post(); ?>
    <article class="term-list-item mb-4 py-5 divider">
        <?php $link = get_permalink(); ?>
        <div class="row">
            <div class="flex-md-last col-12 col-md-4">
                <?php if(has_post_thumbnail()): ?>
                <div class="archive-thumbnail pb-4"> <a href="<?php echo $link; ?>">
                        <?php the_post_thumbnail( 'archive_thumb', array('class' => 'img-fluid rounded' ) ); ?>
                    </a></div>
                <?php else: ?>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/provost-newsroom.jpg" width="200"
                    height="200" alt="Provost news deafult rounded image" />
                <?php endif; ?>

            </div>
            <div class=" order-sm-1 col-12 col-md-8">
                <h2 class="h3 archive-title mb-2 text-secondary"><a href="<?php echo $link; ?>"
                        class="text-secondary"><?php the_title(); ?> </a></h2>
                <p class="font-italic entry-date"><?php echo esc_html( get_the_date('D M j')); ?></p>
                <p class="entry-excerpt"><?php the_excerpt(); ?></p>
                <div class="read-more text-uppercase font-weight-bold"><a href="<?php echo $link; ?>"
                        class="btn btn-outline-secondary btn-sm">Read More ></a></div>
            </div>
        </div>
    </article>


    <?php endwhile; // end of the loop. ?>

    <?php boostrap_4_pagination(); ?>

</div>

<?php get_footer(); ?>