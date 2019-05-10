<?php

//define('PLUGIN_FOLDER', plugin_dir_path( __FILE__ )  );
define( 'PROVOST_NEWS_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );// add parent style

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
   wp_enqueue_style( 'provost-news-style', get_stylesheet_directory_uri() .'/assets/css/provostnews.css', array(),'1.0.0' );
}


add_filter( 'ucfwp_get_header_content_markup',  '__return_false' ); //remove the title from the header

add_filter( 'ucfwp_get_header_markup',  '__return_false' ); //remove the the whole nav

function ucfwp_get_header_markup(){?>

  <div class="container top-nav">
    <div class="d-flex justify-content-end">
      <ul class="mb-0 pt-2 small list-unstyled">
        <li><a href="">Back to Provost Website <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>

  <nav class="navbar navbar-toggleable-md navbar-news-custom news-nav pt-md-0 pb-md-0" role="navigation" aria-label="Site navigation">
    <div class="container d-flex flex-row flex-nowrap justify-content-between">
      <span class="mb-0">
        <a class="navbar-brand mr-lg-5" href="<?php echo get_option("siteurl"); ?>"><?php bloginfo( 'name' ); ?></a>
      </span>
      <button class="navbar-toggler ml-auto align-self-start collapsed" type="button" data-toggle="collapse" data-target="#header-menu" aria-controls="header-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-text">Navigation</span>
        <span class="navbar-toggler-icon"></span>
      </button>

      <?php
      wp_nav_menu( array(
        'container'       => 'div',
        'container_class' => 'collapse navbar-collapse align-self-lg-stretch',
        'container_id'    => 'header-menu',
        'depth'           => 2,
        'fallback_cb'     => 'bs4Navwalker::fallback',
        'menu_class'      => 'nav navbar-nav ml-md-auto',
        'theme_location'  => 'header-menu',
        'walker'          => new bs4Navwalker()
      ) );
      ?>
    </div>
  </nav>

<?php
}


require_once( PROVOST_NEWS_THEME_DIR . 'templates/frontpage/top-articles.php');
require_once( PROVOST_NEWS_THEME_DIR . 'templates/frontpage/latest-articles.php');


// article layout
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/post-header.php'); //post header
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/post-footer.php'); //post header
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/provost_news_entry_header.php'); //post header
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/provost_news_entry_content.php'); //post content
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/provost_news_entry_footer.php'); //post footer
require_once( PROVOST_NEWS_THEME_DIR . 'templates/post/provost_news_entry_recomended.php'); //the suggest articles to view


//register sidebar
function provost_news_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Frontpage Sidebar' ),
            'id' => 'sidebar-1',
            'description' => __( 'Sidebar for the frontpage' ),
            'before_widget' => '<div class="widget-content mb-5">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title h6 py-2 px-3 bg-inverse text-uppercase font-weight-bold">',
            'after_title' => '</h3>',
        )

    );

    register_sidebar(
        array (
            'name' => __( 'Social' ),
            'id' => 'social_sidebar',
            'description' => __( 'Display at the top of articles and catagories' ),
            'before_widget' => '<div class="social-content">',
            'after_widget' => "</div>",
            'before_title' => '<div class="">',
            'after_title' => '</div>',
        )

    );
}
add_action( 'widgets_init', 'provost_news_sidebar' );




function frontpage_excerpt_length( $length ) {
  if(is_singular('post')){
    continue;
    }
    return 30;
}
add_filter( 'excerpt_length', 'frontpage_excerpt_length', 999 );


function new_excerpt_more($more) {
    global $post;
    return $more . '<a href="'. get_permalink( $post->ID ). '" class="pft-readmore d-block"> <span class="badge badge-primary mt-3">Learn More &raquo;</span></a>';
}
//add_filter('the_excerpt', 'new_excerpt_more');



function provost_news_formats_setup() {
    add_theme_support( 'post-formats', array('link', 'video' ) );
}
add_action( 'after_setup_theme', 'provost_news_formats_setup' );
