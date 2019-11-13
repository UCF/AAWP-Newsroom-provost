<?php get_header(); the_post(); ?>


	<div class="main mb-5 pb-sm-4">
    <?php provost_news_featured_article(); ?>
		<div class="row">
			<div class="main  col-md-12">
				<section class="provost-section">
        <?php provost_news_section() ?>
			</section>
				<section class="pn-tax">
				<?php provost_news_featured_tax(); ?>
			</section>
			<?php if ( is_active_sidebar( 'front-sidebar' ) ) : ?>
				<section class="ucf-today pt-4">
					<div class="container">
					<?php dynamic_sidebar( 'front-sidebar' ); ?>
					</div>
				</section>
				<?php endif; ?>
      <?php //get_sidebar(); ?>
    </div>
	</div>


<?php get_footer(); ?>
