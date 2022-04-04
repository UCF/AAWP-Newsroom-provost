<?php


/**
 * Disable the UCF WP Theme's template redirect overrides so that we can
 * define our own in this theme.
  */


function remove_redirects() {
    remove_action( 'template_redirect', 'ucfwp_kill_unused_templates' );
}
//add_action( 'after_setup_theme', 'remove_redirects');


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

//add_action( 'template_redirect', 'today_kill_unused_templates' );





/*
Redirects post to an external site using the article link acf field.
 */
 function provost_news_permalink( $url, $post ) {

   if ( is_admin() ) {
      return $url;
   }

    $pn_url_redirect =  get_post_meta( $post->ID, 'article_link', TRUE );

    if (   $pn_url_redirect && 'post' === get_post_type( $post->ID ) ) {

        $url =   $pn_url_redirect . '?utm_source=provost_newsroom';
    }

    return $url;
}

add_filter( 'post_link', 'provost_news_permalink', 10, 2 );



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

    printf('<enclosure url="%s" length="%s" type="%s" /> ', $url, $length, $type);


  }

}



function boostrap_4_pagination(){
   if( is_singular() )
       return;

   global $wp_query;

   /** Stop execution if there's only 1 page */
   if( $wp_query->max_num_pages <= 1 )
       return;

   $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
   $max   = intval( $wp_query->max_num_pages );

   /** Add current page to the array */
   if ( $paged >= 1 )
       $links[] = $paged;

   /** Add the pages around the current page to the array */
   if ( $paged >= 3 ) {
       $links[] = $paged - 1;
       $links[] = $paged - 2;
   }

   if ( ( $paged + 2 ) <= $max ) {
       $links[] = $paged + 2;
       $links[] = $paged + 1;
   }

   echo '<div class="pagination-container mt-5"><ul class="pagination justify-content-center">' . "\n";


   /** Link to first page, plus ellipses if necessary */
   if ( ! in_array( 1, $links ) ) {
       $class = 1 == $paged ? ' class="page-item active"' : ' class="page-item"';

       printf( '<li%s><a class="page-link" href="%s">First</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

     /*  if ( ! in_array( 2, $links ) )
           echo '<li>…</li>'; */
   }

   /** Previous Post Link */
   if ( get_previous_posts_link() )
       printf( '<li class="page-item">%s</li>' . "\n", get_previous_posts_link("Previous") );



   /** Link to current page, plus 2 pages in either direction if necessary */
   sort( $links );
   foreach ( (array) $links as $link ) {
       $class = $paged == $link ? ' class="page-item active"' : ' class="page-item"';
       printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
   }


   /** Next Post Link */
   if ( get_next_posts_link() )
       printf( '<li class="page-item">%s</li>' . "\n", get_next_posts_link("Next") );


       /** Link to last page, plus ellipses if necessary */
       if ( ! in_array( $max, $links ) ) {
         /*
           if ( ! in_array( $max - 1, $links ) )
               echo '<li>…</li>' . "\n"; */

           $class = $paged == $max ? ' class="page-item active"' : ' class="page-item"';
           printf( '<li%s><a class="page-link" href="%s">Last</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
       }

   echo '</ul></div>' . "\n";

}



function boostrap_4_pagination_posts_link_attributes() {
   return 'class="page-link"';
}
