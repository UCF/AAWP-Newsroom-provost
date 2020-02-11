<?php get_header();?>
  <div class="container mt-3 mt-sm-2 mb-3 pb-sm-4">
    <h1 class="page-title mt-5 mb-5">Search</h1>
    <div class="pt-5 pb-2 px-4" style="background-color: #eceeef;">
      <?php get_search_form(); ?>
    </div>
    <hr/>

    <?php
    if ( have_posts() ):
    while ( have_posts() ) : the_post(); ?>
    <article class="term-list-item mb-4 py-5 divider">
      <?php $link = get_permalink(); ?>
      <div class="row">
        <div class="order-1 order-sm-0 col-12 col-sm-6 col-md-8">

    	       <h2 class="h3 archive-title text-secondary"><a href="<?php echo $link; ?>" class="text-secondary"><?php the_title(); ?> </a></h2>

             <div class="post-cat">

               <?php
               $categories = get_the_category();
               $separator = ', ';
               $output = '';

               if ( ! empty( $categories ) ) {
                  foreach( $categories as $category ) {
                      $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                  }
                  echo trim( $output, $separator );
              }

                ?>


              </div>
             <p><?php the_excerpt(); ?></p>
             <div class="read-more text-uppercase font-weight-bold"><a href="<?php echo $link; ?>" class="">Read More ></a></div>
       </div>
        <div class="order-0 order-sm-1 col-12 col-sm-6 col-md-4">
            <?php if(has_post_thumbnail()): ?>
                    <div class="archive-thumbnail"> <a href="<?php echo $link; ?>"> <?php the_post_thumbnail( 'archive_thumb' ); ?> </a><div>
            <?php else: ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/provost-newsroom.jpg"  width="200" height="200" alt="Provost news deafult image"/>
            <?php endif; ?>

        </div>
    	</div>
    </article>

  <?php endwhile; // end of the loop. ?>

        <?php boostrap_4_pagination(); ?>
  <?php else: ?>

    no post found

  <?php endif ?>

    </div>

  <?php get_footer(); ?>
