<?php


/*
remove UCF wordpres theme default image sizes
*/
function remove_theme_image_sizes() {
 // Remove page header image sizes, since the UCF WP Theme's
 // media header logic isn't utilized in this theme.
 remove_image_size( 'header-img' );
 remove_image_size( 'header-img-sm' );
 remove_image_size( 'header-img-md' );
 remove_image_size( 'header-img-lg' );
 remove_image_size( 'header-img-xl' );
 remove_image_size( 'bg-img' );
 remove_image_size( 'bg-img-sm' );
 remove_image_size( 'bg-img-md' );
 remove_image_size( 'bg-img-lg' );
 remove_image_size( 'bg-img-xl' );
}

add_action( 'after_setup_theme', 'remove_theme_image_sizes', 11 );

/*
Custom image sizes
 */
 add_action( 'after_setup_theme', 'image_sizes_theme_setup' );
 function image_sizes_theme_setup() {
     add_image_size( 'homepage-thumb', 220, 180, true ); // (cropped)
     add_image_size( 'archive_thumb', 300, 200, true ); // (cropped)
	 add_image_size( 'other_articles_thumb', 200, 150, true ); // (cropped)

 }
