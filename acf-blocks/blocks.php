<?php


/*
/ Register and display ACF Blocks for the provost newsrrom
*/




//Add bootstrap to the backend editor
function cre8_add_editor_styles() {
    add_theme_support( 'editor-styles' );

    add_editor_style( [
        'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css',
        //'style.css',
        //'css/editor.css',
    ] );
}
add_action( 'after_setup_theme', 'cre8_add_editor_styles' );


// register provost news category for blocks
function register_layout_category( $categories ) {
	
	$categories[] = array(
		'slug'  => 'aawp-news-category',
		'title' => 'Provost News'
	);

	return $categories;
}

if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
	add_filter( 'block_categories_all', 'register_layout_category' );
} else {
	add_filter( 'block_categories', 'register_layout_category' );
}



//Register blocks
add_action( 'acf/init', 'register_provost_news_top_articles_block' );
function register_provost_news_top_articles_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Provost News Top Articles block
		acf_register_block_type( array(
			'name' 					=> 'provost-news-top-articles',
			'title' 				=> __( 'Provost News Top Articles' ),
			'description' 			=> __( 'A custom Provost News Top Articles block.' ),
			'category' 				=> 'aawp-news-category',
			'icon'					=> 'layout',
			'keywords'				=> array( 'provost', 'news', 'top', 'articles' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'preview',
			// 'align'				=> 'wide',
			//'render_template'		=> 'acf-blocks/top-article.php',
			 'render_callback'	=> 'provost_news_top_articles_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/provost-news-top-articles/provost-news-top-articles.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/provost-news-top-articles/provost-news-top-articles.js',
			// 'enqueue_assets' 	=> 'provost_news_top_articles_block_enqueue_assets',
		));


		// Register feature Article/ Faculty
		acf_register_block_type( array(
			'name' 					=> 'provost-news-spotlight',
			'title' 				=> __( 'Provost News Spotlight' ),
			'description' 			=> __( 'A custom Provost News Top Articles block.' ),
			'category' 				=> 'aawp-news-category',
			'icon'					=> 'layout',
			'keywords'				=> array( 'provost', 'news', 'spotlight', 'article' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'preview',
			// 'align'				=> 'wide',
			//'render_template'		=> 'acf-blocks/top-article.php',
			 'render_callback'	=> 'provost_news_spotlight_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/provost-news-top-articles/provost-news-top-articles.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/provost-news-top-articles/provost-news-top-articles.js',
			// 'enqueue_assets' 	=> 'provost_news_top_articles_block_enqueue_assets',
		));

	}

}



//Top Article blocks
function provost_news_top_articles_block_render_callback($block) {
	
	// Create id attribute allowing for custom "anchor" value.
	$id = 'pn-top-stories-' . $block['id'];
	if( !empty($block['anchor']) ) {
		$id = $block['anchor'];
	}
	
	$className = 'pn-top-stories';
	if (!empty($block['className'])) {
		$className .= ' ' . $block['className'];
	} 
	?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php if ( have_rows( 'provost_top_articles_repeater' ) ) : ?>
        <?php $rowcount = 0;
					$field_object = get_field_object('provost_top_articles_repeater');
					$total_rows = count($field_object['value']);					?>
        <div class="row">
            <?php while ( have_rows( 'provost_top_articles_repeater' ) ) : the_row(); ?>
            <?php $provost_top_article = get_sub_field( 'provost_top_article', false, false ); ?>
            <?php if ( $provost_top_article ) : //get all the subfields?>
            <?php
						$link = get_permalink( $provost_top_article );
						$thumb = get_the_post_thumbnail_url( $provost_top_article ,'aawwp-newsroom-article-lg' );
						$thumb_small = get_the_post_thumbnail_url( $provost_top_article ,"aawwp-newsroom-article-sm" );
						$alt = get_post_meta( $provost_top_article, '_wp_attachment_image_alt', true);
						$title = get_the_title( $provost_top_article );
						$categories = get_the_category($provost_top_article);
						$description = get_field( "article_description", $provost_top_article );
						$cat_link = get_category_link( $categories[0]->term_id );
							?>
            <?php if( $rowcount == 0): //first item im the repeater. Large image ?>
            <div class="col-12 col-md-7 mb-3 mb-md-0">
                <article class="card overflow-hidden border-0 rounded-0 pn-article-lg">
                    <?php if (has_post_thumbnail( $provost_top_article ) ): ?>
                    <div class="pn-article-sm-image"><img src="<?php echo esc_url( $thumb ); ?>"
                            class="img-fluid rounded" alt="<?php echo esc_attr( $alt ); ?>" /></div>
                    <?php endif; ?>
                    <div class="card-img-overlay d-flex flex-column d-flex p-0 justify-content-end">
                        <div class="pn-content bg-black-gradiant p-3 rounded">
                            <?php  if ( ! empty( $categories ) ): ?>
                            <div class="pn-article-lg-cat mb-2">
                                <a href="<?php echo esc_url($cat_link); ?>"
                                    class="text-secondary bg-primary px-2 py-1  font-weight-bold fontpage-cat-link"><?php echo esc_html( $categories[0]->name ); ?></a>
                            </div>
                            <?php endif; ?>
                            <div class="pn-article-lg"><a href="<?php echo esc_url($link ); ?>" class="text-white">
                                    <h2 class="h4 "><?php echo esc_html($title); ?></h2>
                                </a></div>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-12 col-md-5 d-flex flex-column justify-content-between">
                <?php else: //The other three articles on the right sise ?>
                <article class="d-flex row pn-article-sm mb-3 mb-md-0">
                    <div class="col-12 col-sm-3 mb-3 mb-md-0">
                        <?php if (has_post_thumbnail( $provost_top_article ) ): ?>
                        <div class="pn-article-sm-image"><a href="<?php echo esc_url($link ); ?>"><img
                                    src="<?php echo esc_url( $thumb_small ); ?>" class="img-fluid rounded mb-0"
                                    alt="<?php echo esc_attr( $alt ); ?>" /></a></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-md-9 pl-3">
                        <?php  if ( ! empty( $categories ) ): ?>
                        <div class="mb-2 pn-article-sm-cat">
                            <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"
                                class="text-secondary bg-primary px-2 py-1 font-weight-bold fontpage-cat-link"><?php echo esc_html( $categories[0]->name ); ?></a>
                        </div>
                        <?php endif; ?>
                        <div class="pn-article-sm-title"><a href="<?php echo esc_url( $link ); ?>"
                                class="text-secondary h6 mb-0"><?php echo esc_html($title) ?></a></div>

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
</div>


<?php
}



//Spotlight Blocks
function provost_news_spotlight_block_render_callback($block) {
/**
 * Block template file: 
 *
 * Provost News Spotlight Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'provost-news-spotlight-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-provost-news-spotlight';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
<?php echo '#'. $id;

?> {
    /* Add styles that use ACF values here */
}
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="container jumbotron- bg-inverse- bg-faded rounded pt-3 px-4">
        <div class="row">
            <div class="col-12 col-md-3">
                <?php $aawp_newsroom_spotlight_image = get_field( 'aawp_newsroom_spotlight_image' ); ?>
                <?php if ( $aawp_newsroom_spotlight_image ) : ?>
                <img src="<?php echo esc_url( $aawp_newsroom_spotlight_image['url'] ); ?>"
                    alt="<?php echo esc_attr( $aawp_newsroom_spotlight_image['alt'] ); ?>" class="img-fluid" />
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-9 d-flex align-items-center pl-md-5">
                <?php $aawp_newsroom_spotlight = get_field( 'aawp_newsroom_spotlight' );
				$link = get_permalink( $aawp_newsroom_spotlight );				
				$title = get_the_title( $aawp_newsroom_spotlight );
				$categories = get_the_category($aawp_newsroom_spotlight);
				$description = get_field( "article_description", $aawp_newsroom_spotlight );			
				
			?>
                <?php if ( $aawp_newsroom_spotlight ) : ?>
                <div>
                    <h2 class=""><a href="<?php echo $link ?>" class="text-secondary"><?php echo $title ?></a></h2>
                    <p><?php echo $description ?></p>
                    <a href="<?php echo $link ?>" class="btn btn-primary mb-3">View Story</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php	}