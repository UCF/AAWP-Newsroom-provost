<?php

/*
post header It includes the category, date published, title, excerpt, and image
*/

 function provost_news_entry_header1 (){
 ?>

<header class="entry-header mb-5">
  <div class="d-flex justify-content-center">
      <div class="col-md-10">
        <div class="meta post-category text-center mt-4 mb-4 ">
              <?php
              foreach((get_the_category()) as $category){?>
                  <a href="<?php echo esc_url( get_category_link( $category->cat_ID ) );  ?>"  class="heading-underline1 py-1 cat-link"> <?php echo $category->name; ?> </a>
                <?php
              }
              ?>
          </div>
          <div class="post-date font-italic"> <?php $post_date = get_the_date( 'M j, Y' ); echo esc_html($post_date); ?></div>
        <div class="post-title">
          <?php the_title('<h1 class="post-title mb-3">', '</h1>'); ?>
        </div>
        <div class="post-excerpt lead">
          <p><?php the_excerpt(); ?> </p>
        </div>
        <div class="post-author font-italic"> By: <?php the_author();?></div>
        <div class="spacer mb-4"> </div>
			<?php if ( has_post_thumbnail() ): ?>
				<div class="post-thumbnail ">
						<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid mx-auto d-block' ) ); ?>
              <div class="caption text-default-aw"><?php the_post_thumbnail_caption(); ?></div>
				</div><!-- .post-thumbnail -->
			<?php endif; ?>
    </div>
  </div>

</header><!-- .entry-header -->

<?php }
