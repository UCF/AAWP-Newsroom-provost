<?php


/*

filter the search page results

 */

/*query variables */
add_action('init','add_get_val');
function add_get_val() {
    global $wp;
    $wp->add_query_var('cat');
    $wp->add_query_var('units');
    $wp->add_query_var('listorder');
}





function search_filter($query) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( $query->is_search ) {
            $query->set( 'post_type', 'post' );

    $tax_query = array('relation' => 'AND');

          if ( get_query_var('cat') ) {
            $tax_query[] =  array(
                      'taxonomy' => 'category',
                      'field' => 'term_id',
                      'terms' => get_query_var('cat')
                  );
          }


          if ( get_query_var('units') ) {
            $tax_query[] =  array(
                      'taxonomy' => 'academic_units',
                      'field' => 'slug',
                      'terms' => get_query_var('units')
                  );
          }


 $query->set( 'tax_query', $tax_query );


        }
    }
}
add_action( 'pre_get_posts', 'search_filter' );




function highlight_results($text){
    if(is_search()){
		$keys = implode('|', explode(' ', get_search_query()));
		$text = preg_replace('/(' . $keys .')/iu', '<span class="search-highlight">\0</span>', $text);
    }
    return $text;
}
add_filter('the_content', 'highlight_results');
add_filter('the_excerpt', 'highlight_results');
add_filter('the_title', 'highlight_results');

function highlight_results_css() {
	?>
	<style>
	.search-highlight { background-color:#FF0; font-weight:bold; }
	</style>
	<?php
}
add_action('wp_head','highlight_results_css');
