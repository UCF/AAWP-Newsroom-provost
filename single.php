<?php get_header(); the_post(); ?>
  <div class="container mt-3 mt-sm-2 mb-3 pb-sm-4">
    <article  class="<?php echo $post->post_status; ?> post-<?php the_ID();?> article">
      <?php provost_news_entry_header1(); //post header ?>

      <div class="row justify-content-center">
		<div class="col-11 col-md-8">
			<?php provost_news_entry_content(); //post content?>
				<?php provost_news_entry_footer1(); //post footer ?>
		</div>
	</div><!-- .container -->

    </article><!-- #post-## -->
  </div>

<?php get_footer(); ?>
