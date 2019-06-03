<?php

function provost_news_section(){?>
<section class="provost provost-section mt-4 pb-4">
  <div class="row">
    <div class="col-12 col-md-3">
      <h3 class="h4 divider pb-3 mb-3">Provost News</h3>
        <ul class="list-unstyled provost-new-list">
          <li class="divider pb-2 mb-3">Test 1</li>
          <li class="divider pb-2 mb-3">Test 1</li>
          <li class="divider pb-2 mb-3">Test 1</li>
        </ul>
    </div>
    <div class="col-12 col-md-8 offset-md-1">
      <h3 class="h4 divider pb-3 mb-5">News by Colleges</h3>
      <div class="">
      <?php
          $terms = get_terms( array(
            'taxonomy'    => 'colleges',
            'hide_empty'  => false,
            'orderby'     => 'name',
            ) );

            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                echo '<div class="row provost-new-list">';
                foreach ( $terms as $term ) {
                   $term_link = get_term_link( $term );
                    echo '<div class="pb-1 mb-2 col-md-4"> <a class="text-secondary d-block h-100" href="' . esc_url( $term_link ) . '">' . $term->name . '</a></div>';
                }
                echo '</div>';
            }
       ?>
     </div>

    </div>

  </div>
</section>
  <?php
}
