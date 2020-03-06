<?php

/*
A list of all the actions and filters
*/

//actions
add_action( 'widgets_init', 'provost_news_sidebar' ); // add all the aditional sidebars inc/sidebars.php
//add_action( 'after_setup_theme', 'athena_custom_logo_setup' ); // add suport for a custom logo inc/header.php
//filters
add_filter( 'ucfwp_get_header_content_markup',  '__return_false' ); //remove the title from the header
add_filter( 'ucfwp_get_header_markup',  '__return_false' ); //remove the the whole nav
add_filter( 'get_the_archive_title', 'my_theme_archive_title' ); //Remove “Category:”, “Tag:”, “Author:” from the_archive_title - inc/archive-title.php
// add page-link class to pagination buttons for bootstrap
add_filter('next_posts_link_attributes', 'boostrap_4_pagination_posts_link_attributes'); //pagination
add_filter('previous_posts_link_attributes', 'boostrap_4_pagination_posts_link_attributes'); //pagination



// Filter except length to 35 words.
// tn custom excerpt length
function tn_custom_excerpt_length( $length ) {

  if ( is_page_template( 'archives.php' ) ):

       return 55;

 else:

   return 30;

 endif;

}
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );


function provost_news_formats_setup() {
    add_theme_support( 'post-formats', array('link', 'video' ) );
}
add_action( 'after_setup_theme', 'provost_news_formats_setup' );
