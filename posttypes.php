<?php
/**
 * Plugin Name: Custom Post Types and Taxonomies
 * Plugin URI: http://yoursite.com
 * Description: A simple plugin that adds custom post types and taxonomies
 * Version: 0.1
 * Author: Your Name
 * Author URI: http://yoursite.com
 * License: GPL2
 */

/*  Copyright 2014  Morten  (email : morten@pinkandyellow.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function my_custom_posttypes() {
    
    $labels = array(
        'name'               => 'Testimonials',
        'singular_name'      => 'Testimonial',
        'menu_name'          => 'Testimonials',
        'name_admin_bar'     => 'Testimonial',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Testimonial',
        'new_item'           => 'New Testimonial',
        'edit_item'          => 'Edit Testimonial',
        'view_item'          => 'View Testimonial',
        'all_items'          => 'All Testimonials',
        'search_items'       => 'Search Testimonials',
        'parent_item_colon'  => 'Parent Testimonials:',
        'not_found'          => 'No testimonials found.',
        'not_found_in_trash' => 'No testimonials found in Trash.',
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-universal-access-alt',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail' )
    );
    register_post_type( 'testimonial', $args );
    
    $labels = array(
        'name'               => 'Reviews',
        'singular_name'      => 'Review',
        'menu_name'          => 'Reviews',
        'name_admin_bar'     => 'Review',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Review',
        'new_item'           => 'New Review',
        'edit_item'          => 'Edit Review',
        'view_item'          => 'View Review',
        'all_items'          => 'All Reviews',
        'search_items'       => 'Search Reviews',
        'parent_item_colon'  => 'Parent Reviews:',
        'not_found'          => 'No reviews found.',
        'not_found_in_trash' => 'No reviews found in Trash.',
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'reviews' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-star-half',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'taxonomies'         => array( 'category', 'post_tag' )
    );
    register_post_type( 'review', $args );
    
    
    
}
add_action( 'init', 'my_custom_posttypes' );

// Flush rewrite rules to add "review" as a permalink slug
function my_rewrite_flush() {
    my_custom_posttypes();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );



// Custom Taxonomies
function my_custom_taxonomies() {
	
    // Add Genre taxonomy
	$labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Genres' ),
		'all_items'         => __( 'All Genres' ),
		'parent_item'       => __( 'Parent Genre' ),
		'parent_item_colon' => __( 'Parent Genre:' ),
		'edit_item'         => __( 'Edit Genre' ),
		'update_item'       => __( 'Update Genre' ),
		'add_new_item'      => __( 'Add New Genre' ),
		'new_item_name'     => __( 'New Genre Name' ),
		'menu_name'         => __( 'Genre' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'genres' ),
	);
	register_taxonomy( 'genre', array( 'review' ), $args );

    
    
    // Add Year of Release taxonomy
	$labels = array(
		'name'              => _x( 'Years of Release', 'taxonomy general name' ),
		'singular_name'     => _x( 'Year of Release', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Years of Release' ),
		'all_items'         => __( 'All Years of Release' ),
		'parent_item'       => __( 'Parent Year of Release' ),
		'parent_item_colon' => __( 'Parent Year of Release:' ),
		'edit_item'         => __( 'Edit Year of Release' ),
		'update_item'       => __( 'Update Year of Release' ),
		'add_new_item'      => __( 'Add New Year of Release' ),
		'new_item_name'     => __( 'New Year of Release Name' ),
		'menu_name'         => __( 'Year of Release' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'release-years' ),
	);
	register_taxonomy( 'release_year', array( 'review' ), $args );
        
        // Add Rating
	$labels = array(
		'name'              => _x( 'Ratings', 'taxonomy general name' ),
		'singular_name'     => _x( 'Rating', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Ratings' ),
		'all_items'         => __( 'All Ratings' ),
		'parent_item'       => __( 'Parent Rating' ),
		'parent_item_colon' => __( 'Parent Rating:' ),
		'edit_item'         => __( 'Edit Rating' ),
		'update_item'       => __( 'Update Rating' ),
		'add_new_item'      => __( 'Add New Rating' ),
		'new_item_name'     => __( 'New Rating Name' ),
		'menu_name'         => __( 'Rating' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'ratings' ),
	);
	register_taxonomy( 'rating', array( 'review' ), $args );
        
        // Add Mood taxonomy
	$labels = array(
		'name'                       => 'Moods',
		'singular_name'              => 'Mood',
		'search_items'               => 'Search Moods',
		'popular_items'              => 'Popular Moods',
		'all_items'                  => 'All Moods',
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => 'Edit Mood',
		'update_item'                => 'Update Mood',
		'add_new_item'               => 'Add New Mood',
		'new_item_name'              => 'New Mood Name',
		'separate_items_with_commas' => 'Separate Moods with commas',
		'add_or_remove_items'        => 'Add or remove Moods',
		'choose_from_most_used'      => 'Choose from the most used Moods',
		'not_found'                  => 'No Moods found',
		'menu_name'                  => 'Moods',
	);
	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'moods' ),
	);
	register_taxonomy( 'mood', 'review', $args );
        
        // Add Features taxonomy
	$labels = array(
		'name'                       => 'Features',
		'singular_name'              => 'Feature',
		'search_items'               => 'Search Features',
		'popular_items'              => 'Popular Features',
		'all_items'                  => 'All Features',
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => 'Edit Feature',
		'update_item'                => 'Update Feature',
		'add_new_item'               => 'Add New Feature',
		'new_item_name'              => 'New Feature Name',
		'separate_items_with_commas' => 'Separate Features with commas',
		'add_or_remove_items'        => 'Add or remove Features',
		'choose_from_most_used'      => 'Choose from the most used Features',
		'not_found'                  => 'No Features found',
		'menu_name'                  => 'Features',
	);
	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'features' ),
	);
	register_taxonomy( 'feature', 'review', $args );
}

add_action( 'init', 'my_custom_taxonomies' );










