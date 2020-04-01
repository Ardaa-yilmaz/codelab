<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Aura
 */

/**
 * Set post specific meta value.
 *
 * @param  string $value Default meta-value.
 * @return string
 */

/**
 * Support `wp_body_open` action, available since WordPress 5.2.
 */
function aura_body_open() {
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
}