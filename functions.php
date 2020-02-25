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
//add_action( 'after_setup_theme', 'athena_custom_logo_setup' ); // add suport for a custom logo inc/header.php
//filters
add_filter( 'ucfwp_get_header_content_markup',  '__return_false' ); //remove the title from the header
add_filter( 'ucfwp_get_header_markup',  '__return_false' ); //remove the the whole nav
add_filter( 'get_the_archive_title', 'my_theme_archive_title' ); //Remove “Category:”, “Tag:”, “Author:” from the_archive_title - inc/archive-title.php
// add page-link class to pagination buttons for bootstrap
add_filter('next_posts_link_attributes', 'boostrap_4_pagination_posts_link_attributes'); //pagination
add_filter('previous_posts_link_attributes', 'boostrap_4_pagination_posts_link_attributes'); //pagination
add_theme_support('html5', array('search-form'));


add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );// add parent style

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
   wp_enqueue_style( 'provost-news-style', get_stylesheet_directory_uri() .'/assets/css/provostnews.css', array(),'1.0.0' );
   wp_enqueue_script('provost-news-search', get_stylesheet_directory_uri() .'/assets/js/search.js', array(),'1.0.0');
}


/*
Custom image sizes
 */
 add_action( 'after_setup_theme', 'image_sizes_theme_setup' );
 function image_sizes_theme_setup() {
     add_image_size( 'homepage-thumb', 220, 180, true ); // (cropped)
     add_image_size( 'archive_thumb', 300, 200, true ); // (cropped)
	 add_image_size( 'other_articles_thumb', 200, 150, true ); // (cropped)

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


/*
Redirects post to an external site using the article link acf field.
 */
 function provost_news_permalink( $url, $post ) {

   if ( is_admin() ) {
      return $url;
   }

    $pn_url_redirect =  get_post_meta( $post->ID, 'article_link', TRUE );

    if (   $pn_url_redirect && 'post' === get_post_type( $post->ID ) ) {

        $url =   $pn_url_redirect;
    }

    return $url;
}

add_filter( 'post_link', 'provost_news_permalink', 10, 2 );



//Themeisle external link for imported articles

add_filter('post_link', function($url,$post) {


   if ( is_admin() ) {
      return $url;
   }


   $current_post_meta = get_post_meta( $post->ID, 'feedzy_item_url', true );
/*
   if ( ! empty( $current_post_meta ) ) {
      return $current_post_meta;
   }
*/

if (   $current_post_meta && 'post' === get_post_type( $post->ID ) ) {

    $url =   $current_post_meta;
}



   return $url;
}, 99, 2);



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



/**
 * Disable the UCF WP Theme's template redirect overrides so that we can
 * define our own in this theme.
  */


function remove_redirects() {
    remove_action( 'template_redirect', 'ucfwp_kill_unused_templates' );
}
add_action( 'after_setup_theme', 'remove_redirects');


/**
 * Kill unused templates in this theme.  Redirect to the homepage if
 * an unused template is requested.
 */

function today_kill_unused_templates() {
	global $wp_query, $post;

	if ( is_author() || is_attachment() || is_date() || is_comment_feed() ) {
		wp_redirect( home_url() );
		exit();
	}
}

add_action( 'template_redirect', 'today_kill_unused_templates' );


/*

filter the search page results

 */

/*query variables */
add_action('init','add_get_val');
function add_get_val() {
    global $wp;
    $wp->add_query_var('cat');
    $wp->add_query_var('units');
    $wp->add_query_var('listorder');
}





function search_filter($query) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( $query->is_search ) {
            $query->set( 'post_type', 'post' );

    $tax_query = array('relation' => 'AND');

          if ( get_query_var('cat') ) {
            $tax_query[] =  array(
                      'taxonomy' => 'category',
                      'field' => 'term_id',
                      'terms' => get_query_var('cat')
                  );
          }


          if ( get_query_var('units') ) {
            $tax_query[] =  array(
                      'taxonomy' => 'academic_units',
                      'field' => 'slug',
                      'terms' => get_query_var('units')
                  );
          }


 $query->set( 'tax_query', $tax_query );


        }
    }
}
add_action( 'pre_get_posts', 'search_filter' );



/*
function highlight_results($text){
    if(is_search()){
		$keys = implode('|', explode(' ', get_search_query()));
		$text = preg_replace('/(' . $keys .')/iu', '<span class="search-highlight">\0</span>', $text);
    }
    return $text;
}
add_filter('the_content', 'highlight_results');
add_filter('the_excerpt', 'highlight_results');
add_filter('the_title', 'highlight_results');

function highlight_results_css() {
	?>
	<style>
	.search-highlight { background-color:#FF0; font-weight:bold; }
	</style>
	<?php
}
add_action('wp_head','highlight_results_css');

*/
