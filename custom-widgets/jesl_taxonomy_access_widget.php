<?php

class RoleAccessTaxonomiesWidget extends WP_Widget {

	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'JESL Custom Tax Access' );
	}

	function widget( $args, $instance ) {

		//echo '<h1> Theme Levels </h1>';
		
		$caps = wp_get_current_user()->allcaps;
		$readcaps = array();
		
		while ( $cap = current($caps) ) {
			if ( strpos(key($caps),'read') !== false ) {
				array_push($readcaps, key($caps));
			}
		next($caps);
		}
		
		foreach($readcaps as $readcap){
			if(	(	strpos( strtolower($readcap), 'card' ) ||
			 		strpos( strtolower($readcap), 'vowel' ) ||
			 		strpos( strtolower($readcap), 'abc' )
			 	 ) &&
				!strpos( strtolower($readcap), 'private' )
			){
				$linkcap = str_replace('_','',strtolower($readcap));
				$linkcap = str_replace('read','',$linkcap);

				$linkcap = '<a href=' . get_site_url() . '/' . str_replace(' ', '_',$linkcap) .'><h4 class="majorLink">View All '. ucfirst($linkcap) .'s</h4></a> <br>';
				echo $linkcap;
			}
		}
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {
		// Output admin widget options form
	}
}

function jesl_register_widgets() {
	register_widget( 'RoleAccessTaxonomiesWidget' );
}

add_action( 'widgets_init', 'jesl_register_widgets' );