<?php get_header(); the_post(); ?>
	<div class="main mt-5">
		<?php the_content(); ?>
		<section class="mb-5"> 
			<div class="container"> 
			<?php if ( have_rows( 'provost_top_articles_repeater' ) ) : ?>
				<?php $rowcount = 0;
					$field_object = get_field_object('provost_top_articles_repeater');
					$total_rows = count($field_object['value']);					?>
				<div class="row">
					<?php while ( have_rows( 'provost_top_articles_repeater' ) ) : the_row(); ?>
						<?php $provost_top_article = get_sub_field( 'provost_top_article', false, false ); ?>
						<?php if ( $provost_top_article ) : ?>
							<?php
									$link = get_permalink( $provost_top_article );
									$thumb = get_the_post_thumbnail_url( $provost_top_article ,'medium-large' );
									$thumb_small = get_the_post_thumbnail_url( $provost_top_article ,'thumbmail' );
									$alt = get_post_meta( $provost_top_article, '_wp_attachment_image_alt', true);
									$title = get_the_title( $provost_top_article );
									$categories = get_the_category($provost_top_article);
							?>
							<?php if( $rowcount == 0): ?>
								<div class="col-12 col-md-7">										
									<article class="card overflow-hidden border-0 rounded-0">		
										<a href="<?php echo esc_url($link ); ?>"><img src="<?php echo esc_url( $thumb ); ?>" class="img-fluid rounded" alt="<?php echo esc_attr( $alt ); ?>"/></a>
										<div class="card-img-overlay d-flex flex-column d-flex p-0 justify-content-end">
												<div class="pn-content bg-black-gradiant p-3 rounded">
											<?php  if ( ! empty( $categories ) ): ?>
												<div class="pn-category mb-2">
													<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?>" class="text-secondary bg-primary px-2 py-1  font-weight-bold fontpage-cat-link" > <?php echo esc_html( $categories[0]->name ) ?> </a>
												</div>
											<?php endif; ?>
												<a href="<?php echo esc_url($link ); ?>" class="text-white"><h2 class="h4 "><?php echo esc_html($title) ?></h2></a>
												</div>
										</div>
									</article>
								</div>
								<div class="col-12 col-md-5">
							<?php else: ?>								
									<article class="d-flex mb-3">
										<div class="w-25">		
											<a href="<?php echo esc_url($link ); ?>"><img src="<?php echo esc_url( $thumb_small ); ?>" class="img-fluid rounded mb-2" alt="<?php echo esc_attr( $alt ); ?>"/></a>
										</div>
										<div class="w-75 pl-3">
										<?php  if ( ! empty( $categories ) ): ?>
											<div class="mb-2">
												<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?>" class="text-secondary bg-primary px-2 py-1 font-weight-bold fontpage-cat-link" > <?php echo esc_html( $categories[0]->name ) ?> </a>
											</div>
										<?php endif; ?>
											<a href="<?php echo esc_url($link ); ?>" class="text-secondary"><?php echo esc_html($title) ?></a>
										</div>
									</article>						
							<?php endif; ?>
							<?php $rowcount++; ?>	
						<?php endif; ?>						
					<?php endwhile; ?>
							</div>
				</div>
			<?php endif; ?>
			</div>	
		</section>

		<section class="">
			<div class="container jumbotron- bg-inverse- bg-faded rounded pt-3 px-4">
				<div class="row">
					<div class="col-12 col-md-3">
					<?php echo wp_get_attachment_image( '26114', 'medium', "", array( "class" => "img-fluid" ) ); ?>
					</div>
					<div class="col-12 col-md-9 d-flex align-items-center">
						<div>
							<h2>Addressing Violence Against Women: A Q&A with UCF’s Julia O’Connor</h2>
							<p>Dr. O’Connor discusses her research aimed at making a difference in interpersonal violence against women.</p>
							<a href="#" class="btn btn-primary">View Story</a>
						</div>

					</div>
				</div>				
			</div> 
		</section>

		<section class="my-5">
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-12 col-md-3">
						<?php wpgb_render_facet([ 'id'   => 1, 'grid' => 1, ]); ?>
					</div>
					<div class="col-12 col-md-3">
						<?php wpgb_render_facet([ 'id'   => 2, 'grid' => 1, ]); ?>
					</div>	
				</div>	 
					<?php wpgb_render_grid( 1 ); ?>	
			</div>
		</section>

		<section class="pt-5">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-3">
						<?php echo wp_get_attachment_image( '26115', 'medium', "", array( "class" => "img-fluid" ) ); ?>
					</div>
					<div class="col-12 col-md-9">
						<h2 class="text-right">Provost Updates</h2>
							<div class="row d-flex align-items-center h-100">
								<div class="col-12 col-md-4 "><h3 class="h5">5 Things to Know About UCF Day of Giving 2022</h3></div> 
								<div class="col-12 col-md-4"><h3 class="h5">5 Things to Know About UCF Day of Giving 2022</h3></div> 
								<div class="col-12 col-md-4"><h3 class="h5">5 Things to Know About UCF Day of Giving 2022</h3></div> 

							</div>
					</div>
				</div>
			</div>

<?php get_footer(); ?>

