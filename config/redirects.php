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

/*
rss feed add featured image
 */


add_action( 'rss2_item', 'rss_add_featured_image' );
function rss_add_featured_image(){

  if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( $post->ID ) ) {

    $attachment_id = get_post_thumbnail_id($post->ID);

    $featured_image = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );

    $url = $featured_image[0];

    $length = filesize(get_attached_file($attachment_id));

    $type = get_post_mime_type($attachment_id);

    printf('<enclosure url="%s" length="%s" type="%s" />', $url, $length, $type);


  }

}


/*
* Add full size image to rss feed
*
* @author Mark Bennett
*/

function today_add_full_featured_image(){

  if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( $post->ID ) ) {
    //get curent post featured image iff it has one

    $attachment_id = get_post_thumbnail_id($post->ID);
    $featured_image = wp_get_attachment_image_src( $attachment_id, 'full' );
    $url = $featured_image[0];
    $fileSize = filesize(get_attached_file($attachment_id));
    $type = get_post_mime_type($attachment_id);

//print featured iamge to rss feed
    printf('<media:content url="%s" fileSize="%s" type="%s" medium="image" />', $url, $fileSize, $type);

  }

}
add_action( 'rss2_item', 'today_add_full_featured_image' );
