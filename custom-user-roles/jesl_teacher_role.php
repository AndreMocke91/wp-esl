<?php

function add_teacher_role_on_plugin_activation() {
	
	remove_role('teacher_role');
    add_role( 'teacher_role', 'ESL Teacher', array( 'read' => true, 'level_0' => true ) );
  
}
add_action( 'init', 'add_teacher_role_on_plugin_activation' );

