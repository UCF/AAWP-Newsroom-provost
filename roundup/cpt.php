<?php

function cptui_register_my_cpts_ucf_provost_roundup() {

	/**
	 * Post Type: Roundups.
	 */

	$labels = [
		"name" => __( "Roundups", "custom-post-type-ui" ),
		"singular_name" => __( "Roundup", "custom-post-type-ui" ),
		"menu_name" => __( "Roundups", "custom-post-type-ui" ),
		"all_items" => __( "All Roundups", "custom-post-type-ui" ),
		"add_new" => __( "Add new", "custom-post-type-ui" ),
		"add_new_item" => __( "Add new Roundup", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Roundup", "custom-post-type-ui" ),
		"new_item" => __( "New Roundup", "custom-post-type-ui" ),
		"view_item" => __( "View Roundup", "custom-post-type-ui" ),
		"view_items" => __( "View Roundups", "custom-post-type-ui" ),
		"search_items" => __( "Search Roundups", "custom-post-type-ui" ),
		"not_found" => __( "No Roundups found", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "No Roundups found in trash", "custom-post-type-ui" ),
		"parent" => __( "Parent Roundup:", "custom-post-type-ui" ),
		"featured_image" => __( "Featured image for this Roundup", "custom-post-type-ui" ),
		"set_featured_image" => __( "Set featured image for this Roundup", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Remove featured image for this Roundup", "custom-post-type-ui" ),
		"use_featured_image" => __( "Use as featured image for this Roundup", "custom-post-type-ui" ),
		"archives" => __( "Roundup archives", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insert into Roundup", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Upload to this Roundup", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filter Roundups list", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Roundups list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Roundups list", "custom-post-type-ui" ),
		"attributes" => __( "Roundups attributes", "custom-post-type-ui" ),
		"name_admin_bar" => __( "Roundup", "custom-post-type-ui" ),
		"item_published" => __( "Roundup published", "custom-post-type-ui" ),
		"item_published_privately" => __( "Roundup published privately.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "Roundup reverted to draft.", "custom-post-type-ui" ),
		"item_scheduled" => __( "Roundup scheduled", "custom-post-type-ui" ),
		"item_updated" => __( "Roundup updated.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Roundup:", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Roundups", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "This house all the rounds for social media.",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "roundup", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 10.3,
		"menu_icon" => "dashicons-welcome-learn-more",
		"supports" => [ "title", "editor", "thumbnail", "excerpt" ],
	];

	register_post_type( "ucf_provost_roundup", $args );
}

add_action( 'init', 'cptui_register_my_cpts_ucf_provost_roundup' );
