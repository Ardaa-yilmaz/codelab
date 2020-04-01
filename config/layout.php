<?php
/**
 * Layout configuration.
 *
 * @package Aura
 */

add_action( 'after_setup_theme', 'aura_set_layout', 5 );
function kava_set_layout() {

	aura_theme()->layout = array(
		'fullwidth' => array(
			array(
				'content' => array( 'col-xs-12' ),
			),
		),
		'single-post-fullwidth' => array(
			array(
				'content' => array( 'col-xs-12', 'col-lg-8', 'col-lg-push-2' ),
			),
		),
	);
}
