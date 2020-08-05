<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Beautify
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function beautify_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'beautify_jetpack_setup' );
