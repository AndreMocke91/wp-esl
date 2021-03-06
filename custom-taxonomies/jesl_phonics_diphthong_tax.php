<?php

function jesl_register_diphthong_taxonomy() {
	$singular = 'Diphthong Sound';
	$plural = 'Diphthong Sounds';
	$slug = str_replace( ' ', '_', strtolower( $singular ) );

    $capabilities = array(
                       'edit_terms' => 'edit_' . $slug,
                       'delete_terms' => 'delete_' . $slug,
                       'assign_terms' => 'assign_' . $slug,
                       'manage_terms' => 'manage_' . $slug
                       );   

	$labels = array(
		'name'                       => $plural,
        'singular_name'              => $singular,
        'search_items'               => 'Search ' . $plural,
        'popular_items'              => 'Popular ' . $plural,
        'all_items'                  => 'All ' . $plural,
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit ' . $singular,
        'update_item'                => 'Update ' . $singular,
        'add_new_item'               => 'Add New ' . $singular,
        'new_item_name'              => 'New ' . $singular . ' Name',
        'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
        'add_or_remove_items'        => 'Add or remove ' . $plural,
        'choose_from_most_used'      => 'Choose from the most used ' . $plural,
        'not_found'                  => 'No ' . $plural . ' found.',
        'menu_name'                  => $plural,
	);
	$args = array(
            'hierarchical'          => true,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite'               => array( 'slug' => $slug ),
            'capabilities'          => $capabilities,         
        );
	register_taxonomy( $slug, array('diphthong_card'), $args ); 

}
add_action( 'init', 'jesl_register_diphthong_taxonomy' );