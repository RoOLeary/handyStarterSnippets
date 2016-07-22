<?php

/*-------------------------------------------------------------------------------------------*/
/* Sample CPT Type:: Ex: Ticket type
/* Enabled for WP-REST API   */
/*-------------------------------------------------------------------------------------------*/

class review {
	
	function review() {
		add_action('init',array($this,'create_post_type'));
	}
	
	function create_post_type() {
		$labels = array(
		    'name' => __('Reviewss'),
		    'singular_name' => 'review',
		    'add_new' => 'Add New Review',
		    'all_items' => 'All Reviews',
		    'add_new_item' => 'Add New Review',
		    'edit_item' => 'Edit Review',
		    'new_item' => 'New Review',
		    'view_item' => 'View Review',
		    'search_items' => 'Search Reviews',
		    'not_found' =>  'No Reviews found',
		    'not_found_in_trash' => 'No Reviews found in trash',
		    'parent_item_colon' => 'Parent Review:',
		    'menu_name' => 'Reviews',
	
		);
		$args = array(
			'labels' => $labels,
			'taxonomies' => array('review', 'review-category'),
			'description' => "Reviews post type",
			'public' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_nav_menus' => true, 
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'show_in_rest'       => true,
	        'rest_base'          => 'reviews',
	        'rest_controller_class' => 'WP_REST_Posts_Controller',
			'menu_position' => 20,
			'menu_icon' => 'dashicons-format-quote',
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array('title','editor','thumbnail','custom-fields','revisions'),
			'has_archive' => false,
			'rewrite' => array(
		        'slug'=>'reviews'
		        ),
			'query_var' => true,
			'can_export' => true
		); 
		register_post_type('review',$args);
		flush_rewrite_rules();
	}
}

$review = new review();					

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_reviews_hierarchical_taxonomy', 0 );
//create a custom taxonomy name it topics for your posts
function create_reviews_hierarchical_taxonomy() {
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x( 'Reviews', 'taxonomy general name' ),
    'singular_name' => _x( 'review', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Reviews' ),
    'all_items' => __( 'All Reviews' ),
    'parent_item' => __( 'Parent Reviews' ),
    'parent_item_colon' => __( 'Parent review:' ),
    'edit_item' => __( 'Edit review' ), 
    'update_item' => __( 'Update review' ),
    'add_new_item' => __( 'Add New Review Category' ),
    'new_item_name' => __( 'New Topic Review' ),
    'menu_name' => __( 'Review Categories' ),
  ); 	

// Now register the taxonomy

  register_taxonomy('review',array('review'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_rest' => true, 
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'query_var' => true,
	'rewrite' => array( 'slug' => 'reviews')
  ));

}
?>