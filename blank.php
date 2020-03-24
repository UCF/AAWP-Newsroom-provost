<?php
/**
 * Template Name: Blank Page Template
 * Template Post Type: ucf_provost_roundupsss
 */
 ?>

 <!DOCTYPE html>
 <html <?php language_attributes(); ?>>
 <head>
     <meta charset="<?php bloginfo( 'charset' ); ?>">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <?php wp_head(); ?>
 </head>
 <body ontouchstart <?php body_class(); ?>>
   <main class="site-main">
       <div class="site-content" id="content" tabindex="-1">
         <p class="text-center"><a href="<?php esc_attr(bloginfo('url')); ?>" class="text-default"><?php bloginfo('name') ?></a></p>
         <div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">

       <?php the_content(); ?>

       </div>
     </div>
   </main>
 </body>
 </html>
