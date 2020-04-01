<?php
/**
 * Menus configuration.
 *
 * @package Aura
 */

add_action( 'after_setup_theme', 'aura_register_menus', 5 );
function aura_register_menus() {

	register_nav_menus( array(
		'main'   => esc_html__( 'Main', 'aura' ),
	) );
}
