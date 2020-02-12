<div class="form-group">
   <input type="search" class="form-control" placeholder="Search the newsroom" value="<?php echo get_search_query() ?>" name="s" title="Search" />
</div>

<div class="form-group row">

  <div class="col">

    <?php


    if ( get_query_var('cat') ) {
        // If so echo the value
        $cat = get_query_var('cat');
    }

    wp_dropdown_categories( array(
    //	'show_option_all' => 'All Categories',
      'show_option_none'  => 'All Categories',
      'option_none_value'  => '',
      'orderby' => 'name',
      'echo' => 1,
      'selected' => $cat,
      'hierarchical' => true,
      'name' => 'cat',
      'class'	=> 'cat-dropdown  form-control',
      'id'	=> 'custom-cat-drop',
      'value_field' => 'term_id'
    ) ); ?>

</div>

<div class="col">

  <?php


  if ( get_query_var('units') ) {
      // If so echo the value
      $au = get_query_var('units');

  }

  wp_dropdown_categories( array(
    'show_option_none'  => 'All Academic Units',
    'option_none_value'  => '',
    'orderby' => 'name',
    'echo' => 1,
    'selected' => $au,
    'taxonomy' => 'academic_units',
    'hierarchical' => true,
    'name' => 'units',
    'class'	=> 'unit-dropdown form-control',
    'id'	=> 'academic-unit-drop',
    'value_field' => 'slug'
  ) ); ?>


</div>

<div class="col-12 col-md-2 text-right">

<button type="submit" class="search-submit btn btn-primary" title="Search Button">Search</button>

</div>

</div>
