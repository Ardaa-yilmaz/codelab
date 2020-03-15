<?php

/**
 * Show main menu.
 *
 * @since  1.0.0
 * @return void
 */
function kava_main_menu() {

	$classes[] = 'main-navigation';

	?>
	<nav id="site-navigation" class="<?php echo join( ' ', $classes ); ?>" role="navigation">
		<div class="main-navigation-inner">
		<?php
			$args = apply_filters( 'kava-theme/menu/main-menu-args', array(
				'theme_location'   => 'main',
				'container'        => '',
				'menu_id'          => 'main-menu',
				'fallback_cb'      => 'kava_set_nav_menu',
				'fallback_message' => esc_html__( 'Set main menu', 'kava' ),
			) );

			wp_nav_menu( $args );
		?>
		</div>
	</nav><!-- #site-navigation -->
	<?php
}