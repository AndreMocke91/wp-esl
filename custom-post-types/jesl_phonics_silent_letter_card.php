<?php

function jesl_register_silent_letter_card_cpt() {
	
	$singular = 'Silent Letter Card';
	$plural = 'Silent Letter Cards';
	$slug = str_replace( ' ', '_', strtolower( $singular ) );

	$capabilities = array(
					  'edit_post'          	=> 'edit_'.$singular, 
					  'read_post'          	=> 'read_'.$singular, 
					  'delete_post'        	=> 'delete_'.$singular, 
					  'edit_posts'         	=> 'edit_'.$plural, 
					  'edit_others_posts'  	=> 'edit_others_'.$plural,  
					  'publish_posts'      	=> 'publish_'.$plural,       
					  'read_private_posts' 	=> 'read_private_'.$plural, 
					  'create_posts'       	=> 'edit_'.$plural,
					  'read'				=> 'read',
						);

	$labels = array(
		'name' 					=> $plural,
		'singular_name' 		=> $singular,
		'add_new' 				=> 'Add New',
		'add_new_item'  		=> 'Add New ' . $singular,
		'edit'		        	=> 'Edit',
		'edit_item'	        	=> 'Edit ' . $singular,
		'new_item'	        	=> 'New ' . $singular,
		'view' 					=> 'View ' . $singular,
		'view_item' 			=> 'View ' . $singular,
		'search_term'   		=> 'Search ' . $plural,
		'parent' 				=> 'Parent ' . $singular,
		'not_found' 			=> 'No ' . $plural .' found',
		'not_found_in_trash' 	=> 'No ' . $plural .' in Trash'
		);
	$args = array(
		'labels'              => $labels,
	        'public'              => true,
	        'publicly_queryable'  => true,
	        'exclude_from_search' => false,
	        'show_in_nav_menus'   => true,
	        'show_ui'             => true,
	        'show_in_menu'        => true,
	        'show_in_admin_bar'   => true,
	        'menu_position'       => 10,
	        'menu_icon'           => 'dashicons-format-gallery',
	        'can_export'          => true,
	        'delete_with_user'    => false,
	        'hierarchical'        => false,
	        'has_archive'         => true,
	        'query_var'           => true,
			
	        'capability_type'     => array( $singular, $plural ),
	        'map_meta_cap'        => true,
	        'capabilities' 		   => $capabilities ,

	        'rewrite'             => array( 
	        	'slug' 			=> $slug,
	        	'with_front' 	=> true,
	        	'pages' 		=> true,
	        	'feeds' 		=> true,
	        ),			

	        'supports'            => array( 
	        	'title', 
	        	'thumbnail',
	        	'editor'
	        )
	);
	register_post_type( $slug, $args );	   

}
add_action( 'init', 'jesl_register_silent_letter_card_cpt' );

 //////////////////////////////////////////////////Silent Letter Card Word Printer//////////////////////////////////////////////////////////
/**
 * Adds a new item into the Bulk Actions dropdown.
 */
function register_silent_letter_card_word_printer( $bulk_actions ) {
	$bulk_actions['print_word_cards'] = __( 'Print Word Cards', 'domain' );
	return $bulk_actions;
}
add_filter( 'bulk_actions-edit-silent_letter_card', 'register_silent_letter_card_word_printer' );

/**
 * Handles the bulk action.
 */
function silent_letter_card_word_printer_handler( $redirect_to, $action, $post_ids ) {
	if ( $action !== 'print_word_cards' ) {
		return $redirect_to;
	}

	$post_titles = array();
	$post_tax;

	foreach ( $post_ids as $post_id ) {
		array_push($post_titles, get_the_title($post_id));
		$post_tax = wp_get_post_terms($post_id, 'silent_letter')[0];
	}

	$redirect_to = add_query_arg( 'words', $post_titles, $redirect_to );
	$redirect_to = add_query_arg( 'tax', $post_tax, $redirect_to );
	$redirect_to = add_query_arg( 'level', 'silent_letter', $redirect_to );

	return $redirect_to;
}
add_filter( 'handle_bulk_actions-edit-silent_letter_card', 'silent_letter_card_word_printer_handler', 10, 3 );

/**
 * Shows a notice in the admin once the bulk action is completed.
 */
function silent_letter_card_word_printer_handler_admin_notice() {
	if ( ! empty( $_REQUEST['words'] ) && ($_REQUEST['level'] == 'silent_letter') ) {
		$drafts_count = intval( $_REQUEST['words'] );

		// this function is defined in jesl-card-printer/jesl_card_printer.php
		jesl_word_printer_builder($_REQUEST['words'], $_REQUEST['level'], $_REQUEST['tax']);
	}
}
add_action( 'admin_notices', 'silent_letter_card_word_printer_handler_admin_notice' );