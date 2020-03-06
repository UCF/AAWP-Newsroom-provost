<?php


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
