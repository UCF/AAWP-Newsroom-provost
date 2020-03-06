<?php
/*
Custom image sizes
 */
 add_action( 'after_setup_theme', 'image_sizes_theme_setup' );
 function image_sizes_theme_setup() {
     add_image_size( 'homepage-thumb', 220, 180, true ); // (cropped)
     add_image_size( 'archive_thumb', 300, 200, true ); // (cropped)
	 add_image_size( 'other_articles_thumb', 200, 150, true ); // (cropped)

 }
