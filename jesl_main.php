<?php
/**
*	Plugin Name: ESL Plugin
*	
*	Author: Andre Mocke
*	Version: 0.0.1
*	Description: Material Management for distributed teachers
*/

//Exit if accessed directly
if( ! defined ( 'ABSPATH' ) ){
	exit;
}

// add utils
require( '/utils/jesl_utils.php' );

// add custom user roles
//require( '/custom-user-roles/jesl_kindy_student_role.php');
//require( '/custom-user-roles/jesl_teacher_role.php');

// add custom post types
require('/custom-post-types/jesl_theme_LK_card.php');
require('/custom-post-types/jesl_theme_L1_card.php');
require('/custom-post-types/jesl_theme_L2_card.php');
require('/custom-post-types/jesl_phonics_abc_card.php');
require('/custom-post-types/jesl_phonics_short_vowel_card.php');
require('/custom-post-types/jesl_phonics_blend_card.php');
require('/custom-post-types/jesl_phonics_digraph_card.php');
require('/custom-post-types/jesl_phonics_long_vowel_card.php');
require('/custom-post-types/jesl_phonics_diphthong_others_card.php');
require('/custom-post-types/jesl_phonics_silent_letter_card.php');


// add custom taxonomies
require('/custom-taxonomies/jesl_theme_tax.php');
require('/custom-taxonomies/jesl_phonics_abc_tax.php');
require('/custom-taxonomies/jesl_phonics_blends_tax.php');
require('/custom-taxonomies/jesl_phonics_digraphs_tax.php');
require('/custom-taxonomies/jesl_phonics_diphthong_tax.php');
require('/custom-taxonomies/jesl_phonics_long_vowel_tax.php');
require('/custom-taxonomies/jesl_phonics_short_vowel_tax.php');
require('/custom-taxonomies/jesl_phonics_silent_letter_tax.php');

// add custom widgets
require( '/custom-widgets/jesl_taxonomy_access_widget.php' );

//add search ammendments
require('jesl_search_ammendmends.php');

// add card printer
// require('/jesl-card-printer/jesl_card_printer.php');

//enqueue styles
function jesl_frontend_enqueue_scripts() {	
	
		//Plugin Main CSS File.
		wp_enqueue_style( 'jesl-main-css', plugins_url( 'css/jesl_main.css', __FILE__ ) );		
	
}
//This hook ensures our scripts and styles are only loaded in the admin.
add_action( 'wp_enqueue_scripts', 'jesl_frontend_enqueue_scripts' );


