  <form role="search" method="get" action="<?php echo home_url( '/' ); ?>" class="search-input">

        <?php
    if( is_search() && is_main_query() ):

            get_template_part( 'templates/search', 'pageform' );

    else:

      get_template_part( 'templates/search', 'box' );

    endif; ?>

  </form>
