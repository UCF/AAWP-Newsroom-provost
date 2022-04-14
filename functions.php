<?php




function enqueue_parent_styles()
{
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('provost-news-style', get_stylesheet_directory_uri() . '/assets/css/provostnews.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'enqueue_parent_styles'); // add parent style


define('PROVOST_NEWS_THEME_DIR', trailingslashit(get_stylesheet_directory()));
require_once(PROVOST_NEWS_THEME_DIR . 'acf-blocks/blocks.php'); //acf blocks


/*
A list of all the actions and filters
*/


//filters
add_filter( 'ucfwp_get_header_content_markup',  '__return_false' ); //remove the title from the header
add_filter( 'ucfwp_get_header_markup',  '__return_false' ); //remove the the whole nav
add_filter( 'get_the_archive_title', 'my_theme_archive_title' ); //Remove “Category:”, “Tag:”, “Author:” from the_archive_title
// add page-link class to pagination buttons for bootstrap
add_filter('next_posts_link_attributes', 'boostrap_4_pagination_posts_link_attributes'); //pagination
add_filter('previous_posts_link_attributes', 'boostrap_4_pagination_posts_link_attributes'); //pagination



/*
* Add theme support for a custom logo
*/

function theme_support_options() {
	$defaults = array(
	'height'      => 37,
	'width'       => 250,
	'flex-height' => false, // <-- setting both flex-height and flex-width to false maintains an aspect ratio
	'flex-width'  => false
	);
	add_theme_support( 'custom-logo', $defaults );
   }

   add_action( 'after_setup_theme', 'theme_support_options' );


/*
* Change the wordpress default header to white
*/

function ucfwp_get_header_markup(){?>

<?php $menu_container_class = 'collapse navbar-collapse'; ?>

<?php
	$menu =  wp_nav_menu( array( // create bootstrap menu
	  'container'       => 'div',
	  'container_class' => 'collapse navbar-collapse',
	  'container_id'    => 'header-menu',
	  'depth'           => 2,
	  'echo'            => false,
	  'fallback_cb'     => 'bs4Navwalker::fallback',
	  'menu_class'      => 'nav navbar-nav ml-md-auto',
	  'theme_location'  => 'header-menu',
	  'walker'          => new bs4Navwalker()
	) );

	$custom_logo_id = get_theme_mod( 'custom_logo' );// get custom logo
	$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

	?>

<nav class="navbar navbar-toggleable-md navbar-custom news-nav" role="navigation" aria-label="Site navigation">
    <div class="container d-flex flex-row flex-nowrap justify-content-between">
        <span class="mb-0">
            <a class="navbar-brand mr-lg-5" href="<?php echo esc_url( home_url( '/' )); ?>">
                <div class="pn-logo">
                    <?php if ( has_custom_logo() ): ?>
                    <img src="<?php echo esc_url( $logo[0] ); ?>" class="img-fluid"
                        alt="<?php echo get_bloginfo( 'name' ); ?>" width="<?php echo esc_attr( $logo[1] ); ?>"
                        height="<?php echo esc_attr( $logo[2] ); ?>">
                    <?php else: ?>
                    <div><?php echo esc_html(get_bloginfo('name')); ?></div>
                    <?php endif; ?>
                </div>
            </a>

        </span>
        <?php if ( $menu ): ?>
        <button class="navbar-toggler ml-auto align-self-start collapsed" type="button" data-toggle="collapse"
            data-target="#header-menu" aria-controls="header-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-text">Navigation</span>
            <span class="navbar-toggler-icon "><i class="fa fa-bars fa-2 my-auto" aria-hidden="true"></i></span>
        </button>
        <?php echo $menu; ?>
        <?php endif; ?>

    </div>
</nav>

<?php
  }
  




/* Image sizes */

/*
* remove UCF wordpres theme default image sizes
*/
function remove_theme_image_sizes()
{
	// 
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
*   Custom image sizes
*/

function aawwp_newsroom_image_sizes_theme_setup()
{

	add_image_size('aawwp-newsroom-article-lg', 636, 423, true); // (cropped)
	add_image_size('aawwp-newsroom-article-sm', 112, 112, true); // (cropped)
	add_image_size('aawwp-newsroom-md-article', 352, 235, true); // (cropped)
	add_image_size('aawwp-newsroom-md-lg-article', 388, 279, true); // (cropped)
	add_image_size('aawwp-newsroom-article-image', 1200, 800, true); // (cropped)
	add_image_size('aawwp-newsroom-article-thumb', 227, 155, true); // (cropped)


}
add_action('after_setup_theme', 'aawwp_newsroom_image_sizes_theme_setup');



/*
 * Make custom image sizes selectable
*/
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
add_filter('image_size_names_choose', 'aawwp_newsroom_custom_image_sizes');


/*Filter except length
*  If archive or home page set the exerpt length to 55 or 30 words.
*  Everything else is set to 30 words.
*/
function tn_custom_excerpt_length( $length ) {

    if ( is_archive() || is_home() ):
 
        return 55;
 
  else:
 
    return 30;
 
  endif;
 
 }
 add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );


  /*
Remove “Category:”, “Tag:”, “Author:” from the_archive_title

 */

function my_theme_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

    return $title;
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
*rss feed add featured image
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

/*
* change site pagination usitg bootstrap for.
*/

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