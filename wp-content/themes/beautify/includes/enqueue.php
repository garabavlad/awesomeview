<?php 

/**
 * Enqueue scripts and styles.  
 */ 
function beautify_scripts() {    
	wp_enqueue_style( 'beautify-noto-sans', beautify_theme_font_url('Noto Sans:400,700'), array(), 20141212 );
	wp_enqueue_style( 'beautify-pt-sans', beautify_theme_font_url('PT Sans:400,700'), array(), 20141212 );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), 20150224 );
	wp_enqueue_style( 'jquery-flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), 20150224 );
	wp_enqueue_style( 'beautify-style', get_template_directory_uri() . '/style.css');

	wp_enqueue_script( 'beautify-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'beautify-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );   
	}

	wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '2.4.0', true );
	wp_enqueue_script( 'beautify-custom', get_template_directory_uri() . '/js/custom.js', array(), '1.0.0', true );
	
}
add_action( 'wp_enqueue_scripts', 'beautify_scripts' );       

/**
 * Register Google fonts.
 *
 * @return string
 */
function beautify_theme_font_url($font) {       
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Font, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Font: on or off', 'beautify' ) ) {   
		$font_url = esc_url( add_query_arg( 'family', urlencode($font), "//fonts.googleapis.com/css" ) );
	}

	return $font_url;
}

function beautify_admin_enqueue_scripts( $hook ) {  
	if( strpos($hook, 'beautify_upgrade') ) {
		wp_enqueue_style( 
			'font-awesome', 
			get_template_directory_uri() . '/css/font-awesome.min.css', 
			array(), 
			'4.3.0', 
			'all' 
		);
		wp_enqueue_style( 
			'beautify-admin', 
			get_template_directory_uri() . '/admin/css/admin.css', 
			array(), 
			'1.0.0', 
			'all' 
		);
	}
}
add_action( 'admin_enqueue_scripts', 'beautify_admin_enqueue_scripts' );