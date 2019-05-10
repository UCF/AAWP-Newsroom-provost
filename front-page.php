<?php get_header(); the_post(); ?>


	<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">
    <?php provost_news_featured_article(); ?>
    <div class="row mt-4">
      <div class="main  col-md-8 pr-md-5">
        <div class="pft-intro pb-3 mb-4">
        <?php the_content(); ?>
      </div>
        <?php provost_news_latest_articles(); ?>
      </div>
      <?php get_sidebar(); ?>
    </div>
	</div>


<?php get_footer(); ?>
