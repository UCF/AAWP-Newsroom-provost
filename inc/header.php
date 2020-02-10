<?php
function athena_custom_logo_setup() {
 $defaults = array(
 'height'      => 100,
 'width'       => 400,
 'flex-height' => true,
 'flex-width'  => true,
 'header-text' => array( 'site-title', 'site-description' ),
 );
 add_theme_support( 'custom-logo', $defaults );
}



function ucfwp_get_header_markup(){?>

  <nav class="navbar navbar-toggleable-md navbar-news-custom news-nav pt-md-0 pb-md-0" role="navigation" aria-label="Site navigation">
    <div class="container d-flex flex-row flex-nowrap justify-content-between">
      <span class="logo">
        <?php/* if ( has_custom_logo() ) {
          the_custom_logo();
        } else { */?>
        <a class="navbar-brand mr-lg-5 text-uppercase" href="<?php echo esc_url( home_url( '/' )); ?>"> Provost &nbsp; <span class="text-primary">Newsroom</span></a>
        <?php  /* } */ ?>
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
