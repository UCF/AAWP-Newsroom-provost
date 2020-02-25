<?php
function athena_custom_logo_setup() {
 $defaults = array(
 'height'      => 100,
 'width'       => 400,
 'flex-height' => true,
 'flex-width'  => true,
 'header-text' => array( 'site-title', 'site-description' ),
 );
 //add_theme_support( 'custom-logo', $defaults );
}



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
        <a class="navbar-brand mr-lg-5 text-uppercase" href="<?php echo esc_url( home_url( '/' )); ?>"> <?php echo bloginfo( 'name' ); ?></a>

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
