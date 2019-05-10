<?php

// entry footer look

function provost_news_entry_recomended(){

if ( is_singular() ):
 ?>
<section class="trending-news mt-3 mb-4">
  <div class="container">

    <div class="row justify-content-center">
      <div class="col-11 col-md-8">
        <h2 class="h5">What's Trending</h2>
      </div>
      <!--
      <div class="col-11 col-md-8">
        <div class="row no-gutters">

        <div class="col-12 col-md-7">
            <h2 class="h5">Recomnended Articles</h2>
        </div>

      <div class="col-12 col-md-5">
         <h2 class="h5">Latest Articles</h2>

      </div>
    </div>

  </div> -->
  </div>
  </div>
</section>
<?php endif;

}
