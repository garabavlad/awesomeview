<?php
/**
 * Custom widgets.
 *
 * @package PT_Magazine
 */

if ( ! function_exists( 'envo_blog_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function envo_blog_load_widgets() {

		// Extended Recent Post.
		register_widget( 'envo_blog_Extended_Recent_Posts' );

		// Popular Post.
		register_widget( 'envo_blog_Popular_Posts' );
		
		// Spit images news.
		register_widget( 'envo_blog_split_images_News' );

	}

endif;

add_action( 'widgets_init', 'envo_blog_load_widgets' );

/**
 * Recent Posts Widget
 */
require get_template_directory() . '/includes/widgets/recent-posts.php';

/**
 * Popular Posts Widget
 */
require get_template_directory() . '/includes/widgets/popular-posts.php';


/**
 * Split Images News Widget
 */
require get_template_directory() . '/includes/widgets/split-images-news.php';