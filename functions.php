<?php
function stuajnht_wp_mdl_scripts() {
	// MDL main script
	wp_register_script( 'material-script', 'https://storage.googleapis.com/code.getmdl.io/1.0.2/material.min.js', false, false, true );
	wp_enqueue_script( 'material-script' );
}

add_action( 'wp_enqueue_scripts', 'stuajnht_wp_mdl_scripts' );
?>