<?php
/**
 * Envo Blog Theme Customizer
 *
 * @package Envo Blog
 */

$envo_blog_sections = array( 'info' );

foreach( $envo_blog_sections as $s ){
    require get_template_directory() . '/lib/customizer/' . $s . '.php';
}

function envo_blog_customizer_scripts() {
    wp_enqueue_style( 'envo-blog-customize',get_template_directory_uri().'/lib/customizer/css/customize.css', '', 'screen' );
    wp_enqueue_script( 'envo-blog-customize', get_template_directory_uri() . '/lib/customizer/js/customize.js', array( 'jquery' ), '20170404', true );
}
add_action( 'customize_controls_enqueue_scripts', 'envo_blog_customizer_scripts' );
