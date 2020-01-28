<?php

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function Reepulse_menus() {

	$locations = array(
		'primary'  => __( 'Main menu', 'Reepulse' ),
		'social'   => __( 'Social Menu', 'Reepulse' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'Reepulse_menus' );
