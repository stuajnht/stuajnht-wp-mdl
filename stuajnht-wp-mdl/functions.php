<?php
function stuajnht_wp_mdl_scripts() {
	// MDL main script
	wp_register_script( 'material-script', 'https://code.getmdl.io/1.2.1/material.min.js', false, false, true );
	wp_enqueue_script( 'material-script' );
}

add_action( 'wp_enqueue_scripts', 'stuajnht_wp_mdl_scripts' );

/**
 * Registering menu locations for the theme
 *
 * The available menus for this theme are:
 *  - Footer Main Menu: Links to pages on this site
 *  - Footer Social Menu: Links to external sites you have accounts on
 */
add_action( 'init', 'stuajnht_wp_mdl_menus' );

function stuajnht_wp_mdl_menus() {
	register_nav_menus(
		array(
			'footer-main-menu' => __( 'Footer Main Menu' ),
			'footer-social-menu' => __( 'Footer Social Menu' ),
		)
	);
}