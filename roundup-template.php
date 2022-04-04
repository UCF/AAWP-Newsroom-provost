	
<?php 
/*
Template Name: Roundup
Template Post Type: post, page
*/

?>

<?php get_header();?>

<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">

        <section class="roundup-header mb-md-5" >

           <div class="row  d-flex h-100">
             <div class="col-12 col-md-2 text-center offset-md-1">
               <div class="twitter-icon"><img src="https://provost.ucf.edu/news/wp-content/uploads/sites/3/2020/03/UCF-Academics-Avatar-150x150.png" class="img-fluid"></div>
               <div class="twitter-handle"><i class="fa fa-twitter" aria-hidden="true"></i><a href="https://twitter.com/UCFAcademics" class="text-default-aw">ucfacademics</a></div>
             </div>
             <div class="col-12 col-md-8 h-100 text-center text-md-left pt-3 pt-md-0 align-self-center">
               <h1 class="has-text-align-left"><?php the_title(); ?></h1>
               <p class="has-text-align-left lead text-default-aw">UCF has a long history of <a href="https://digitallearning.ucf.edu/">pioneering excellence and innovation</a> in digital learning.</p>
             </div>
           </div>
        </section>

        <?php $postContent = get_field('provost_roundup_show_post_content') ?>

        <?php
          if($postContent):
            if( $postContent == 'Top' ){the_content();}
          endif;
            ?>

           <section class="roundup-stories mt-0 mt-md-5">
           <div class="row">

             <?php

                // Check value exists.
                if( have_rows('provost_roundup_roundups') ):

                // Loop through rows.
                while ( have_rows('provost_roundup_roundups') ) : the_row();

                $numberOfColumns = get_field('provost_roundup_columns');
                               // Case: internal link layout.
                   if( get_row_layout() == 'provost_roundup_internal_link' ):
                       $postID = get_sub_field('provost_roundup_internal_post'); ?>

                       <div class="pb-3 pb-md-5 text-center col-12 col-md-<?php echo esc_attr($numberOfColumns); ?>">
                         <div class="links-article px-md-1 h-100">

                            <div class="links-article-info h-100">

                                <a href="<?php echo esc_url( get_permalink($postID)); ?>">
                                  <?php echo get_the_post_thumbnail( $postID, 'archive_thumb', array( 'class' => 'img-fluid roundup-img' ) ); ?>
                                <h2 class="h6 text-secondary links-header px-md-4"><?php echo get_the_title($postID); ?></h2>
                                </a>

                            </div>
                      </div>
                    </div>

                        <?php
                   // Case: External Links layout.
                   elseif( get_row_layout() == 'provost_roundup_external_link' ):
                       $postTitle = get_sub_field('provost_roundup_external_title');
                       $postImage = get_sub_field('provost_roundup_external_image');
                       $postURL = get_sub_field('provost_roundup_external_url');

                       ?>

                       <div class="pb-3 pb-md-5 text-center col-12 col-md-<?php echo esc_attr($numberOfColumns) ?>">
                         <div class="links-article px-md-1 h-100">

                            <div class="links-article-info h-100">

                                <a href="<?php echo esc_url( $postURL );?>">
                                  <?php echo wp_get_attachment_image( $postImage, 'archive_thumb', "", array( "class" => "img-fluid roundup-img" ) ); ?>
                                <h2 class="h6 text-secondary links-header px-md-4"><?php echo $postTitle; ?></h2>
                                </a>

                            </div>
                      </div>
                      </div>


                      <?php
                   endif;

                // End loop.
                endwhile;

                endif;
              ?>


           </div>
         </section>

         <?php
           if($postContent):
             if($postContent == 'Bottom' ){the_content();}
           endif;
             ?>
        <div class="text-center"><a href="<?php esc_attr(bloginfo('url')); ?>" class="text-uppercase btn btn-outline-secondary btn-sm"><?php bloginfo('name') ?></a></div>
       </div>
<?php get_footer(); ?>
