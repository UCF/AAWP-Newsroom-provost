<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );// add parent style


function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
   wp_enqueue_style( 'provost-news-style', get_stylesheet_directory_uri() .'/assets/css/provostnews.css', array(),'1.0.0' );
   wp_enqueue_script('provost-news-search', get_stylesheet_directory_uri() .'/assets/js/search.js', array(),'1.0.0');
}

add_theme_support('html5', array('search-form'));

//define('PLUGIN_FOLDER', plugin_dir_path( __FILE__ )  );
define( 'PROVOST_NEWS_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );



require_once( PROVOST_NEWS_THEME_DIR . 'config/image-sizes.php'); // different image sizes
require_once( PROVOST_NEWS_THEME_DIR . 'config/header.php'); // removes some of the athena theme filters
require_once( PROVOST_NEWS_THEME_DIR . 'config/redirects.php'); // Handles Athena, post and feedzy plugin redirects
require_once( PROVOST_NEWS_THEME_DIR . 'config/search.php'); //sets up the search filters


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
require_once( PROVOST_NEWS_THEME_DIR . 'templates/frontpage/alerts.php');

//Archive pages (tags, categories, authorpage)
require_once( PROVOST_NEWS_THEME_DIR . 'inc/archive-title.php');

// article layout
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/post-header.php'); //post header
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/post-footer.php'); //post header
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/post-content.php'); //post content
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/provost_news_entry_recomended.php'); //the suggest articles to view

//pagination
require_once( PROVOST_NEWS_THEME_DIR . 'inc/pagination.php');

//cpt roundup
require_once( PROVOST_NEWS_THEME_DIR . 'roundup/cpt.php');


/*ACF Option Page */

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme Template Images',
		'menu_title'	=> 'Default Images',
		'menu_slug' 	=> 'theme-template-images-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
    'parent_slug' => 'edit.php',
	));

}
