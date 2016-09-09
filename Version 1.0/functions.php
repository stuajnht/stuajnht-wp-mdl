<?php
function stuajnht_wp_mdl_scripts() {
	// MDL main script
	wp_register_script( 'material-script', 'https://storage.googleapis.com/code.getmdl.io/1.0.2/material.min.js', false, false, true );
	wp_enqueue_script( 'material-script' );
	
	// WOW.js script
	wp_register_script( 'wow-js-script', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', false, false, true );
	wp_enqueue_script( 'wow-js-script' );
	
	// Animsition script
	wp_register_script( 'animsition-script', 'https://cdnjs.cloudflare.com/ajax/libs/animsition/3.5.2/js/jquery.animsition.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'animsition-script' );
}

add_action( 'wp_enqueue_scripts', 'stuajnht_wp_mdl_scripts' );

/**
 * Runs any JS init scripts at the end of the page, after they have been loaded
 * from the WP enqueued script function
 */
function stuajnht_wp_mdl_footer_js_init_scripts() {
	// WOW.js
	echo '<script>new WOW().init();</script>';
	
	// Animsition
	echo '<script>jQuery(document).ready(function() {jQuery(".animsition").animsition({loading:true})});</script>';
}

// The footer_js_init_scripts must run after the wp_enqueue_script footer functions
add_action( 'wp_footer', 'stuajnht_wp_mdl_footer_js_init_scripts', 100 );
?>