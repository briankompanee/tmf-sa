<?php
/*
Plugin Name: Register Custom Post Types for TMF SA
Plugin URI: https://github.com/briankompanee/tmf-sa
Description: Plugin to register News, Stock Recommendations, Companies Post Types and  Ticker Symbols Taxonomy.
Version: 1.0
Author: Brian Brown
Author URI:https://github.com/briankompanee
License: GPLv2
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function cptui_register_my_cpts() {

	/**
	 * Post Type: News Articles.
	 */

	$labels = [
		"name" => __( "News Articles", "sage" ),
		"singular_name" => __( "News Article", "sage" ),
		"menu_name" => __( "News", "sage" ),
		"all_items" => __( "All News Articles", "sage" ),
		"add_new" => __( "Add new", "sage" ),
		"add_new_item" => __( "Add new News Article", "sage" ),
		"edit_item" => __( "Edit News Article", "sage" ),
		"new_item" => __( "New News Article", "sage" ),
		"view_item" => __( "View News Article", "sage" ),
		"view_items" => __( "View News Articles", "sage" ),
		"search_items" => __( "Search News Articles", "sage" ),
		"not_found" => __( "No News Articles found", "sage" ),
		"not_found_in_trash" => __( "No News Articles found in trash", "sage" ),
		"parent" => __( "Parent News Article:", "sage" ),
		"featured_image" => __( "Featured image for this News Article", "sage" ),
		"set_featured_image" => __( "Set featured image for this News Article", "sage" ),
		"remove_featured_image" => __( "Remove featured image for this News Article", "sage" ),
		"use_featured_image" => __( "Use as featured image for this News Article", "sage" ),
		"archives" => __( "News Article archives", "sage" ),
		"insert_into_item" => __( "Insert into News Article", "sage" ),
		"uploaded_to_this_item" => __( "Upload to this News Article", "sage" ),
		"filter_items_list" => __( "Filter News Articles list", "sage" ),
		"items_list_navigation" => __( "News Articles list navigation", "sage" ),
		"items_list" => __( "News Articles list", "sage" ),
		"attributes" => __( "News Articles attributes", "sage" ),
		"name_admin_bar" => __( "News Article", "sage" ),
		"item_published" => __( "News Article published", "sage" ),
		"item_published_privately" => __( "News Article published privately.", "sage" ),
		"item_reverted_to_draft" => __( "News Article reverted to draft.", "sage" ),
		"item_scheduled" => __( "News Article scheduled", "sage" ),
		"item_updated" => __( "News Article updated.", "sage" ),
		"parent_item_colon" => __( "Parent News Article:", "sage" ),
	];

	$args = [
		"label" => __( "News Articles", "sage" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => "news",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "news", "with_front" => false ],
		"query_var" => true,
		"menu_icon" => "dashicons-media-text",
		"supports" => [ "title", "editor", "thumbnail", "custom-fields", "revisions", "author" ],
		"taxonomies" => [ "ticker_symbol" ],
		"show_in_graphql" => false,
	];

	register_post_type( "news", $args );

	/**
	 * Post Type: Stock Recommendations.
	 */

	$labels = [
		"name" => __( "Stock Recommendations", "sage" ),
		"singular_name" => __( "Stock Recommendation", "sage" ),
		"menu_name" => __( "Stock Recs", "sage" ),
		"all_items" => __( "All Stock Recommendations", "sage" ),
		"add_new" => __( "Add new", "sage" ),
		"add_new_item" => __( "Add new Stock Recommendation", "sage" ),
		"edit_item" => __( "Edit Stock Recommendation", "sage" ),
		"new_item" => __( "New Stock Recommendation", "sage" ),
		"view_item" => __( "View Stock Recommendation", "sage" ),
		"view_items" => __( "View Stock Recommendations", "sage" ),
		"search_items" => __( "Search Stock Recommendations", "sage" ),
		"not_found" => __( "No Stock Recommendations found", "sage" ),
		"not_found_in_trash" => __( "No Stock Recommendations found in trash", "sage" ),
		"parent" => __( "Parent Stock Recommendation:", "sage" ),
		"featured_image" => __( "Featured image for this Stock Recommendation", "sage" ),
		"set_featured_image" => __( "Set featured image for this Stock Recommendation", "sage" ),
		"remove_featured_image" => __( "Remove featured image for this Stock Recommendation", "sage" ),
		"use_featured_image" => __( "Use as featured image for this Stock Recommendation", "sage" ),
		"archives" => __( "Stock Recommendation archives", "sage" ),
		"insert_into_item" => __( "Insert into Stock Recommendation", "sage" ),
		"uploaded_to_this_item" => __( "Upload to this Stock Recommendation", "sage" ),
		"filter_items_list" => __( "Filter Stock Recommendations list", "sage" ),
		"items_list_navigation" => __( "Stock Recommendations list navigation", "sage" ),
		"items_list" => __( "Stock Recommendations list", "sage" ),
		"attributes" => __( "Stock Recommendations attributes", "sage" ),
		"name_admin_bar" => __( "Stock Recommendation", "sage" ),
		"item_published" => __( "Stock Recommendation published", "sage" ),
		"item_published_privately" => __( "Stock Recommendation published privately.", "sage" ),
		"item_reverted_to_draft" => __( "Stock Recommendation reverted to draft.", "sage" ),
		"item_scheduled" => __( "Stock Recommendation scheduled", "sage" ),
		"item_updated" => __( "Stock Recommendation updated.", "sage" ),
		"parent_item_colon" => __( "Parent Stock Recommendation:", "sage" ),
	];

	$args = [
		"label" => __( "Stock Recommendations", "sage" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => "stock-recommendations",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "stock-recommendation", "with_front" => false ],
		"query_var" => true,
		"menu_icon" => "dashicons-chart-area",
		"supports" => [ "title", "editor", "thumbnail", "custom-fields", "revisions", "author" ],
		"taxonomies" => [ "ticker_symbol" ],
		"show_in_graphql" => false,
	];

	register_post_type( "stock-recommendation", $args );

	/**
	 * Post Type: Companies.
	 */

	$labels = [
		"name" => __( "Companies", "sage" ),
		"singular_name" => __( "Company", "sage" ),
		"menu_name" => __( "Companies", "sage" ),
		"all_items" => __( "All Companies", "sage" ),
		"add_new" => __( "Add new", "sage" ),
		"add_new_item" => __( "Add new Company", "sage" ),
		"edit_item" => __( "Edit Company", "sage" ),
		"new_item" => __( "New Company", "sage" ),
		"view_item" => __( "View Company", "sage" ),
		"view_items" => __( "View Companies", "sage" ),
		"search_items" => __( "Search Companies", "sage" ),
		"not_found" => __( "No Companies found", "sage" ),
		"not_found_in_trash" => __( "No Companies found in trash", "sage" ),
		"parent" => __( "Parent Company:", "sage" ),
		"featured_image" => __( "Featured image for this Company", "sage" ),
		"set_featured_image" => __( "Set featured image for this Company", "sage" ),
		"remove_featured_image" => __( "Remove featured image for this Company", "sage" ),
		"use_featured_image" => __( "Use as featured image for this Company", "sage" ),
		"archives" => __( "Company archives", "sage" ),
		"insert_into_item" => __( "Insert into Company", "sage" ),
		"uploaded_to_this_item" => __( "Upload to this Company", "sage" ),
		"filter_items_list" => __( "Filter Companies list", "sage" ),
		"items_list_navigation" => __( "Companies list navigation", "sage" ),
		"items_list" => __( "Companies list", "sage" ),
		"attributes" => __( "Companies attributes", "sage" ),
		"name_admin_bar" => __( "Company", "sage" ),
		"item_published" => __( "Company published", "sage" ),
		"item_published_privately" => __( "Company published privately.", "sage" ),
		"item_reverted_to_draft" => __( "Company reverted to draft.", "sage" ),
		"item_scheduled" => __( "Company scheduled", "sage" ),
		"item_updated" => __( "Company updated.", "sage" ),
		"parent_item_colon" => __( "Parent Company:", "sage" ),
	];

	$args = [
		"label" => __( "Companies", "sage" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => "companies",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "page",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "company-name", "with_front" => false ],
		"query_var" => true,
		"menu_icon" => "dashicons-portfolio",
		"supports" => [ "title", "editor", "thumbnail", "custom-fields", "revisions", "author" ],
		"taxonomies" => [ "ticker_symbol" ],
		"show_in_graphql" => false,
	];

	register_post_type( "company", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Ticker Symbols.
	 */

	$labels = [
		"name" => __( "Ticker Symbols", "sage" ),
		"singular_name" => __( "Ticker Symbol", "sage" ),
		"menu_name" => __( "Ticker Symbols", "sage" ),
		"all_items" => __( "All Ticker Symbols", "sage" ),
		"edit_item" => __( "Edit Ticker Symbol", "sage" ),
		"view_item" => __( "View Ticker Symbol", "sage" ),
		"update_item" => __( "Update Ticker Symbol name", "sage" ),
		"add_new_item" => __( "Add new Ticker Symbol", "sage" ),
		"new_item_name" => __( "New Ticker Symbol name", "sage" ),
		"parent_item" => __( "Parent Ticker Symbol", "sage" ),
		"parent_item_colon" => __( "Parent Ticker Symbol:", "sage" ),
		"search_items" => __( "Search Ticker Symbols", "sage" ),
		"popular_items" => __( "Popular Ticker Symbols", "sage" ),
		"separate_items_with_commas" => __( "Separate Ticker Symbols with commas", "sage" ),
		"add_or_remove_items" => __( "Add or remove Ticker Symbols", "sage" ),
		"choose_from_most_used" => __( "Choose from the most used Ticker Symbols", "sage" ),
		"not_found" => __( "No Ticker Symbols found", "sage" ),
		"no_terms" => __( "No Ticker Symbols", "sage" ),
		"items_list_navigation" => __( "Ticker Symbols list navigation", "sage" ),
		"items_list" => __( "Ticker Symbols list", "sage" ),
		"back_to_items" => __( "Back to Ticker Symbols", "sage" ),
	];

	
	$args = [
		"label" => __( "Ticker Symbols", "sage" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'ticker_symbol', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "ticker_symbol",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
		"meta_box_cb" => false,
	];
	register_taxonomy( "ticker_symbol", [ "news", "stock-recommendation", "company" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
