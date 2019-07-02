<?php

//define('PLUGIN_FOLDER', plugin_dir_path( __FILE__ )  );
define( 'PROVOST_NEWS_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );


 /*
Require php files
 */
//header
require_once( PROVOST_NEWS_THEME_DIR . 'inc/header.php'); // adds custom logo and changes the header markup
require_once( PROVOST_NEWS_THEME_DIR . 'inc/sidebars.php'); // stores all the sidebars in one file

//front page
require_once( PROVOST_NEWS_THEME_DIR . 'templates/frontpage/top-articles.php'); //homepage top article
require_once( PROVOST_NEWS_THEME_DIR . 'templates/frontpage/tax-articles.php'); //homepage article by categories
require_once( PROVOST_NEWS_THEME_DIR . 'templates/frontpage/provost-info.php');

//Archive pages (tags, categories, authorpage)
require_once( PROVOST_NEWS_THEME_DIR . 'inc/archive-title.php');

// article layout
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/post-header.php'); //post header
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/post-footer.php'); //post header
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/post-content.php'); //post content
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/provost_news_entry_recomended.php'); //the suggest articles to view

//pagination
require_once( PROVOST_NEWS_THEME_DIR . 'inc/pagination.php');


/*
A list of all the actions and filters
*/

//actions
add_action( 'widgets_init', 'provost_news_sidebar' ); // add all the aditional sidebars inc/sidebars.php
add_action( 'after_setup_theme', 'athena_custom_logo_setup' ); // add suport for a custom logo inc/header.php
//filters
add_filter( 'ucfwp_get_header_content_markup',  '__return_false' ); //remove the title from the header
add_filter( 'ucfwp_get_header_markup',  '__return_false' ); //remove the the whole nav
add_filter( 'get_the_archive_title', 'my_theme_archive_title' ); //Remove “Category:”, “Tag:”, “Author:” from the_archive_title - inc/archive-title.php
// add page-link class to pagination buttons for bootstrap
add_filter('next_posts_link_attributes', 'boostrap_4_pagination_posts_link_attributes'); //pagination
add_filter('previous_posts_link_attributes', 'boostrap_4_pagination_posts_link_attributes'); //pagination



add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );// add parent style

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
   wp_enqueue_style( 'provost-news-style', get_stylesheet_directory_uri() .'/assets/css/provostnews.css', array(),'1.0.0' );
}


/*
Custom image sizes
 */
 add_action( 'after_setup_theme', 'image_sizes_theme_setup' );
 function image_sizes_theme_setup() {
     add_image_size( 'homepage-thumb', 220, 180, true ); // (cropped)
     add_image_size( 'archive_thumb', 400, 200, true ); // (cropped)

 }


 // Filter except length to 35 words.
 // tn custom excerpt length
 function tn_custom_excerpt_length( $length ) {
 return 20;
 }
 add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );


 function provost_news_formats_setup() {
     add_theme_support( 'post-formats', array('link', 'video' ) );
 }
 add_action( 'after_setup_theme', 'provost_news_formats_setup' );




 add_action('get_footer', 'off_canvas_menu_footer');
 function off_canvas_menu_footer() {
   do_action('website_after');
 }
