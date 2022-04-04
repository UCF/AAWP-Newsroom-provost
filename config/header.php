<?php

/*
A list of all the actions and filters
*/


//filters
add_filter( 'ucfwp_get_header_content_markup',  '__return_false' ); //remove the title from the header
add_filter( 'ucfwp_get_header_markup',  '__return_false' ); //remove the the whole nav
add_filter( 'get_the_archive_title', 'my_theme_archive_title' ); //Remove “Category:”, “Tag:”, “Author:” from the_archive_title - inc/archive-title.php
// add page-link class to pagination buttons for bootstrap
add_filter('next_posts_link_attributes', 'boostrap_4_pagination_posts_link_attributes'); //pagination
add_filter('previous_posts_link_attributes', 'boostrap_4_pagination_posts_link_attributes'); //pagination

function ucfwp_get_header_markup(){?>

  <?php $menu_container_class = 'collapse navbar-collapse'; ?>

  <?php
  $menu =  wp_nav_menu( array(
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
  ?>

  <nav class="navbar navbar-toggleable-md navbar-custom news-nav" role="navigation" aria-label="Site navigation">
    <div class="container d-flex flex-row flex-nowrap justify-content-between">
      <span class="mb-0">
        <a class="navbar-brand mr-lg-5 text-uppercase" href="<?php echo esc_url( home_url( '/' )); ?>"><div class="pn-logo">Provost <span class="text-primary">Newsroom</span></div></a>

      </span>
      <?php if ( $menu ): ?>
      <button class="navbar-toggler ml-auto align-self-start collapsed" type="button" data-toggle="collapse" data-target="#header-menu" aria-controls="header-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-text">Navigation</span>
        <span class="navbar-toggler-icon "><i class="fa fa-bars fa-2 my-auto" aria-hidden="true"></i></span>
      </button>
      <?php echo $menu; ?>
      <?php endif; ?>

    </div>
  </nav>

<?php
}




