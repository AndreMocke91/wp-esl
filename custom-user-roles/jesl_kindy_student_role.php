<?php

function add_kindy_student_role_on_plugin_activation() {
	
	remove_role('kindy_student_role');
    add_role( 'kindy_student_role', 'Kindy Student', array( 'read' => true, 'level_0' => true ) );
  
}
add_action( 'init', 'add_kindy_student_role_on_plugin_activation' );

