<?php
/*
Homepage sidebar below top articles
 */
function provost_news_section(){?>
  <?php if ( is_active_sidebar( 'provost_news' ) ) : ?>
    <section class="provost provost-section mt-4 mb-4 pb-4">
      <div class="row">
        <div class="col-12">
          <?php dynamic_sidebar( 'provost_news' ); ?>
        </div>
      </div>
    </section>
      <?php endif; ?>

  <?php
}
