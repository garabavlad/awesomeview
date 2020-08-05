<?php
/**
 * beautify functions and definitions
 *
 * @package Beautify
 */

if ( ! function_exists( 'beautify_setup' ) ) :  
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function beautify_setup() { 

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on beautify, use a find and replace
	 * to change 'beautify' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'beautify', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'beautify' ),
	) );

	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-list', 'gallery', 'caption',
	) );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'beautify_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    /**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 */
	$GLOBALS['content_width'] = apply_filters( 'beautify_content_width', 780 );


    /* 
    * Custom Logo 
    */
    add_theme_support( 'custom-logo' );

    
	/* Woocommerce support */

	add_theme_support('woocommerce');
	add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

	/*
	 * Add Additional image sizes
	 *
	 */
	add_image_size( 'beautify-recent-posts-img', 560, 310, true );
	add_image_size( 'beautify-service-img', 380, 180, true );
	add_image_size( 'beautify-small-featured-image-width', 450,300, true );
	add_image_size( 'beautify-blog-large-width', 800,300, true );     

    // Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
		
			'top-left' => array(
				// Widget ID
			    'my_text' => array(
					// Widget $id -> set when creating a Widget Class
		        	'custom_html' , 
		        	// Widget $instance -> settings 
					array(
					  'content'  =>sprintf('<ul><li><i class="fa fa-building"></i>%1$s</li><li><a 	href="#"><i class="fa fa-envelope"></i>%2$s</a></li></ul>',__('256 Interior the good, New York.','beautify'),__('example@gmail.com','beautify') )
					)
				)
			),

			// Put two core-defined widgets in the footer 2 area.
			'top-right' => array(
				// Widget ID
			    'my_text' => array(
					// Widget $id -> set when creating a Widget Class
		        	'custom_html' , 
		        	// Widget $instance -> settings 
					array (
					  'content'  => '<ul><li><i class="fa fa-phone"></i>(+321) 2345 6789</li><li><ul><li><a href="#"><i class="fa fa-facebook"></i></a></li><li><a href="#"><i class="fa fa-skype"></i></a></li><li><a href="#"><i class="fa fa-linkedin"></i></a></li><li><a href="#"><i class="fa fa-twitter"></i></a></li></ul></li></ul>'
					)
				),
			),

			'footer' => array(
				// Widget ID
			    'my_text' => array(
					// Widget $id -> set when creating a Widget Class
		        	'custom_html' , 
		        	// Widget $instance -> settings 
					array(
						'content'  => sprintf('<h4 class="widget-title">%1$s</h4><p>%2$s</p>',__('About Us','beautify'),__('Structure personal participate in ethics training as part of our best practices program and each employee is provided with a skillset that help them makes the best decisions.','beautify') )
					)
				)
			),
			'footer-2' => array(
				// Widget ID
			    'archives'
			),
			'footer-3' => array(
				// Widget ID
			    'my_text' => array(
					// Widget $id -> set when creating a Widget Class
		        	'custom_html' , 
		        	// Widget $instance -> settings 
					array(
						'content' => sprintf('<h4 class="widget-title">%1$s</h4><ul><li>%2$s</li><li>(102) 6666 8888</li><li>%3$s</li><li>(102) 8888 9999</li><li>%4$s</li></ul>',__('Contact Details','beautify'),__('14 Tottenham Court Road, London, English','beautify'),__('example.com','beautify'),__('Mon - Sat: 9:00 - 18:00','beautify'))
					)
				)
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home' => array(
				'post_type' => 'page',
			),
			'blog' => array(
				'post_type' => 'page',
			),
			'service-section-title' => array(  
				'post_type' => 'page',
				'post_title' => __( 'Who We Are', 'beautify'),
	        ),
			'slider-one' => array( 
	            'post_type' => 'post',
	            'post_title' => __( 'Post One', 'beautify'),
	            'post_content' => __( '<p>OUR EXPERTISE FOR</p><h1>INTERIOR DESIGN</h1><p><a href="#">OUR PORTFOLIO</a></p>', 'beautify'),
	            'thumbnail' => '{{post-featured-image}}',
	        ),
	        'slider-two' => array(
	            'post_type' => 'post',
	            'post_title' => __( 'Post Two', 'beautify'),
	            'post_content' => __( '<p>OUR EXPERTISE FOR</p><h1>INTERIOR DESIGN</h1><p><a href="#">OUR PORTFOLIO</a></p>', 'beautify'),
	            'thumbnail' => '{{post-featured-image}}',
	        ), 
			'service-one' => array(  
				'post_type' => 'page',
				'post_title' => __( 'Commercial Design', 'beautify'),
	            'post_content' => __( 'Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean lacinia bibendum nulla sed consectetur.<p><a href="#">Read More</a></p>', 'beautify'),
				'thumbnail' => '{{page-images}}',
			),
			'service-two' => array(
				'post_type' => 'page',
				'post_title' => __( 'Official Design', 'beautify'),
	            'post_content' => __( 'Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean lacinia bibendum nulla sed consectetur.<p><a href="#">Read More</a></p>', 'beautify'),
				'thumbnail' => '{{page-images1}}',
			),
			'service-three' => array(
				'post_type' => 'page',
				'post_title' => __( 'Residential Design', 'beautify'),
	            'post_content' => __( 'Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean lacinia bibendum nulla sed consectetur.<p><a href="#">Read More</a></p>', 'beautify'),
				'thumbnail' => '{{page-images2}}',
			),
			'recent-post-section-title' => array(  
				'post_type' => 'page',
				'post_title' => __( 'Our Blog', 'beautify'),
	        ),
			
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'post-featured-image' => array( 
				'post_title' => __( 'slider one', 'beautify' ),
				'file' => 'images/slider.png', // URL relative to the template directory.
			),
			'page-images' => array(
				'post_title' => __( 'Page Images', 'beautify' ),
				'file' => 'images/page1.png', // URL relative to the template directory.
			),
			'page-images1' => array(
				'post_title' => __( 'Page Images', 'beautify' ),
				'file' => 'images/page2.png', // URL relative to the template directory.
			),
			'page-images2' => array(
				'post_title' => __( 'Page Images', 'beautify' ),
				'file' => 'images/page3.png', // URL relative to the template directory.
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),  

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array( 
			'slider_cat' => '1',
			'service_1' => '{{service-one}}',
			'service_2' => '{{service-two}}',
			'service_3' => '{{service-three}}',
			'service_section_title' => '{{service-section-title}}',
			'recent_post_section_title' => '{{recent-post-section-title}}'
			
		),

	);

	$starter_content = apply_filters( 'beautify_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );

	     
}
endif; // beautify_setup
add_action( 'after_setup_theme', 'beautify_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function beautify_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'beautify' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );  
	register_sidebar( array(
		'name'          => __( 'Top Left', 'beautify' ),
		'id'            => 'top-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Top Right', 'beautify' ),
		'id'            => 'top-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebars( 3, array(
		'name'          => __( 'Footer %d', 'beautify' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'beautify_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/includes/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';
/**
 * Implement the Custom Header feature.
 */
require  get_template_directory()  . '/includes/custom-header.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load Theme Options Panel
 */
require get_template_directory() . '/includes/theme-options.php';

/**  
 * Load TGM plugin 
 */
require get_template_directory() . '/admin/class-tgm-plugin-activation.php';


/* Woocommerce support */

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper');
add_action('woocommerce_before_main_content', 'beautify_output_content_wrapper');

function beautify_output_content_wrapper() {
	echo '<div class="container"><div class="row"><div id="primary" class="content-area eleven columns">';
}

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );
add_action( 'woocommerce_after_main_content', 'beautify_output_content_wrapper_end' );

function beautify_output_content_wrapper_end () {
	echo "</div>";
}

add_action( 'wp_head', 'beautify_remove_wc_breadcrumbs' );
function beautify_remove_wc_breadcrumbs() {
   	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}


/* Demo importer */
add_filter( 'pt-ocdi/import_files', 'beautify_import_demo_data' );
if ( ! function_exists( 'beautify_import_demo_data' ) ) {
	function beautify_import_demo_data() {
	  return array(
	    array(   
	      'import_file_name'             => __('Demo Import','beautify'),
	      'categories'                   => array( 'Category 1', 'Category 2' ),
	      'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo/demo-content.xml',
	      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo/widgets.json',
	      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo/customizer.dat',
	    ),
	  ); 
	}
}

add_action( 'pt-ocdi/after_import', 'beautify_after_import' );
if ( ! function_exists( 'beautify_after_import' ) ) {
	function beautify_after_import( $selected_import ) { 
		$importer_name  = __('Demo Import','beautify');
	 
	    if ( $importer_name === $selected_import['import_file_name'] ) {
	        //Set Menu
	        $top_menu = get_term_by('name', 'Primary Menu', 'nav_menu'); 
	        set_theme_mod( 'nav_menu_locations' , array( 
	              'primary' => $top_menu->term_id,
	             ) 
	        );

		    //Set Front page
		    if( get_option('page_on_front') === '0' && get_option('page_for_posts') === '0' ) {
			   $page = get_page_by_title( 'Home');
			   $blog = get_page_by_title( 'Blog');
			   if ( isset( $page->ID ) ) {
			   	    update_option( 'show_on_front', 'page' );
				    update_option( 'page_on_front', $page->ID );
				    update_option('page_for_posts', $blog->ID);
			   }
		    }
	    }
	     
	}
}

/* Check whether the One Click Import Plugin is installed or not */

function beautify_is_plugin_installed($plugin_title)
{
    // get all the plugins
    $installed_plugins = get_plugins();

    foreach ($installed_plugins as $installed_plugin => $data) {

        // check for the plugin title
        if ($data['Title'] == $plugin_title) {

            // return the plugin folder/file
            return true;
        }
    }

    return false;
}

/* Recommended plugin using TGM */
add_action( 'tgmpa_register', 'beautify_register_plugins');
if( !function_exists('beautify_register_plugins') ) {
	function beautify_register_plugins() {
       /**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			array(
				'name'     => 'One Click Demo Import', // The plugin name.
				'slug'     => 'one-click-demo-import', // The plugin slug (typically the folder name).
				'required' => false, // If false, the plugin is only 'recommended' instead of required.
			),
			array(
				'name'               => 'WPForms Lite', // The plugin name.
				'slug'               => 'wpforms-lite', // The plugin slug (typically the folder name).
				'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			),
		);
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'tgmpa',
			// Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',
			// Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins',
			// Menu slug.
			'parent_slug'  => 'themes.php',
			// Parent menu slug.
			'capability'   => 'edit_theme_options',
			// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,
			// Show admin notices or not.
			'dismissable'  => true,
			// If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',
			// If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,
			// Automatically activate plugins after installation or not.
			'message'      => '',
			// Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}

/* To Hide Branding message in One Click demo import*/

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );


