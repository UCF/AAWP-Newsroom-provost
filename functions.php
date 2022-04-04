<?php

add_action('wp_enqueue_scripts', 'enqueue_parent_styles'); // add parent style


function enqueue_parent_styles()
{
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('provost-news-style', get_stylesheet_directory_uri() . '/assets/css/provostnews.css', array(), '1.0.0');
	//wp_enqueue_script('provost-news-search', get_stylesheet_directory_uri() .'/assets/js/search.js', array(),'1.0.0');
}

//add_theme_support('html5', array('search-form'));

//define('PLUGIN_FOLDER', plugin_dir_path( __FILE__ )  );
define('PROVOST_NEWS_THEME_DIR', trailingslashit(get_stylesheet_directory()));



require_once(PROVOST_NEWS_THEME_DIR . 'config/image-sizes.php'); // different image sizes
require_once(PROVOST_NEWS_THEME_DIR . 'config/header.php'); // removes some of the athena theme filters
require_once(PROVOST_NEWS_THEME_DIR . 'config/redirects.php'); // Handles Athena, post and feedzy plugin redirects




//ACF Blocks
require_once(PROVOST_NEWS_THEME_DIR . 'acf-blocks/blocks.php');


/* Image sizes */

/*
remove UCF wordpres theme default image sizes
*/
function remove_theme_image_sizes()
{
	// Remove page header image sizes, since the UCF WP Theme's
	// media header logic isn't utilized in this theme.
	remove_image_size('header-img');
	remove_image_size('header-img-sm');
	remove_image_size('header-img-md');
	remove_image_size('header-img-lg');
	remove_image_size('header-img-xl');
	remove_image_size('bg-img');
	remove_image_size('bg-img-sm');
	remove_image_size('bg-img-md');
	remove_image_size('bg-img-lg');
	remove_image_size('bg-img-xl');
}

add_action('after_setup_theme', 'remove_theme_image_sizes', 11);


/*
   Custom image sizes
	*/
add_action('after_setup_theme', 'aawwp_newsroom_image_sizes_theme_setup');
function aawwp_newsroom_image_sizes_theme_setup()
{
	// add_image_size( 'homepage-thumb', 220, 180, true ); // (cropped)
	//add_image_size( 'archive_thumb', 300, 200, true ); // (cropped)
	// add_image_size( 'other_articles_thumb', 200, 150, true ); // (cropped)

	add_image_size('aawwp-newsroom-article-lg', 636, 423, true); // (cropped)
	add_image_size('aawwp-newsroom-article-sm', 112, 112, true); // (cropped)
	add_image_size('aawwp-newsroom-md-article', 352, 235, true); // (cropped)
	add_image_size('aawwp-newsroom-md-lg-article', 388, 279, true); // (cropped)
	add_image_size('aawwp-newsroom-article-image', 1200, 800, true); // (cropped)
	add_image_size('aawwp-newsroom-article-thumb', 227, 155, true); // (cropped)


}

add_filter('image_size_names_choose', 'aawwp_newsroom_custom_image_sizes');

function aawwp_newsroom_custom_image_sizes($sizes)
{
	return array_merge($sizes, array(
		'aawwp-newsroom-article-image' => __('Full Article'),
		'aawwp-newsroom-article-lg' => __('Article Large'),
		'aawwp-newsroom-md-article' => __('Article Medium'),
		'aawwp-newsroom-article-sm' => __('Article Small'),
		'aawwp-newsroom-article-thumb' => __('Article Thumbnail'),
	));
}