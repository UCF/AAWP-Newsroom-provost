

<article itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" class="post-<?php the_ID(); ?> <?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-3 mt-sm-2 mb-3 pb-sm-4 ucf-news-entry">

	  		<?php provost_news_entry_header(); //post header?>

	

	<div class="row justify-content-center">
		<div class="col-11 col-md-8">
			<div class="entry-content" itemprop="articleBody">
		  		      <?php the_content(); ?>
		  </div>
					<?php provost_news_entry_footer(); //post footer ?>
		  </div>
		</div><!-- .container -->
</article><!-- #post-## -->

<?php provost_news_entry_recomended(); //recommended post ?>
