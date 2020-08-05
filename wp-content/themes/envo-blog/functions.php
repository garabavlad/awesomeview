<?php
add_action( 'after_setup_theme', 'envo_blog_setup' );

if ( !function_exists( 'envo_blog_setup' ) ) :

	/**
	 * Global functions
	 */
	function envo_blog_setup() {

		// Theme lang.
		load_theme_textdomain( 'envo-blog', get_template_directory() . '/languages' );

		// Add Title Tag Support.
		add_theme_support( 'title-tag' );

		// Register Menus.
		register_nav_menus(
			array(
				'main_menu' => esc_html__( 'Main Menu', 'envo-blog' ),
				'top_menu_left' => esc_html__( 'Top Menu Left', 'envo-blog' ),
				'top_menu_right' => esc_html__( 'Top Menu Right', 'envo-blog' ),
				'main_menu_logged' => esc_html__( 'Main Menu Logged', 'envo-blog' ),
			)
		);

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 300, true );
		add_image_size( 'envo-blog-single', 1140, 641, true );
		add_image_size( 'envo-blog-thumbnail', 120, 90, true );

		// Add Custom Background Support.
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );
		// Add theme support for Custom Header.
		$custom_header_defaults = array(
			'width'       			=> 2000,
			'height'      			=> 500,
			'flex-width'  			=> true,
			'flex-height' 			=> true,
			'default-image' 		=> esc_url( get_template_directory_uri() ) .'/img/bg.jpg',
			'wp-head-callback'   => 'envo_blog_header_style',
		);
		add_theme_support( 'custom-header', $custom_header_defaults );
		add_theme_support( 'custom-logo', array(
			'flex-height'	 => true,
			'flex-width'	 => true,
			'header-text'	 => array( 'site-title', 'site-description' ),
		) );

		// Adds RSS feed links to for posts and comments.
		add_theme_support( 'automatic-feed-links' );
	}

endif;

/**
 * Set Content Width
 */
function envo_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'envo_blog_content_width', 1170 );
}

add_action( 'after_setup_theme', 'envo_blog_content_width', 0 );

if ( ! function_exists( 'envo_blog_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see envo_blog_custom_header_setup().
 */
function envo_blog_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	// get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style id="twentyseventeen-custom-header-styles" type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' === $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		h1.site-title a, 
		.site-title a, 
		h1.site-title, 
		.site-title,
		.site-description
		{
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // End of envo_blog_header_style.

/**
 * Register custom fonts.
 */
function envo_blog_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Roboto Condensed, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$the_font = _x( 'on', 'Quicksand font: on or off', 'envo-blog' );

	if ( 'off' !== $the_font ) {
		$font_families = array();

		$font_families[] = 'Quicksand:300,400,500,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue Styles (normal style.css and bootstrap.css)
 */
function envo_blog_theme_stylesheets() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'envo-blog-fonts', envo_blog_fonts_url(), array(), null );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.7' );
	// Theme stylesheet.
	wp_enqueue_style( 'envo-blog-stylesheet', get_stylesheet_uri(), array('bootstrap'), '1.1.1'  );
	// Load Font Awesome css.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0' );
}

add_action( 'wp_enqueue_scripts', 'envo_blog_theme_stylesheets' );

/**
 * Register Bootstrap JS with jquery
 */
function envo_blog_theme_js() {
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
	wp_enqueue_script( 'envo-blog-theme-js', get_template_directory_uri() . '/js/customscript.js', array( 'jquery' ), '1.1.1', true );
}

add_action( 'wp_enqueue_scripts', 'envo_blog_theme_js' );


/**
 * Register Custom Navigation Walker include custom menu widget to use walkerclass
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/wp_bootstrap_navwalker.php' );

/**
 * Widgets
 */
require_once( trailingslashit( get_template_directory() ) . 'includes/widgets.php' );

/**
 * Register Theme Info Page
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/dashboard.php' );

/**
 * Register PRO notify
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/customizer.php' );

/**
 * Register preview
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/demo-preview.php' );

add_action( 'widgets_init', 'envo_blog_widgets_init' );

/**
 * Register the Sidebar(s)
 */
function envo_blog_widgets_init() {
	register_sidebar(
		array(
			'name'			 => __( 'Homepage Full Width Section #1', 'envo-blog' ),
			'id'			 => 'envo-blog-homepage-area',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
			'after_widget'	 => '</div>',
			'before_title'	 => '<div class="widget-title"><h3>',
			'after_title'	 => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name'			 => esc_html__( 'Right Sidebar', 'envo-blog' ),
			'id'			 => 'envo-blog-right-sidebar',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
			'after_widget'	 => '</div>',
			'before_title'	 => '<div class="widget-title"><h3>',
			'after_title'	 => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name'			 => __( 'Footer Section', 'envo-blog' ),
			'id'			 => 'envo-blog-footer-area',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s col-md-3">',
			'after_widget'	 => '</div>',
			'before_title'	 => '<div class="widget-title"><h3>',
			'after_title'	 => '</h3></div>',
		)
	);
}

function envo_blog_main_content_width_columns() {

	$columns = '12';

	if ( is_active_sidebar( 'envo-blog-right-sidebar' ) ) {
		$columns = $columns - 3;
	}

	echo absint( $columns );
}

if ( !function_exists( 'envo_blog_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function envo_blog_entry_footer() {

		// Get Categories for posts.
		$categories_list = get_the_category_list( ' ' );

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', ' ' );

		// We don't want to output .entry-footer if it will be empty, so make sure its not.
		if ( $categories_list || $tags_list || get_edit_post_link() ) {

			echo '<div class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( $categories_list || $tags_list ) {

					// Make sure there's more than one category before displaying.
					if ( $categories_list ) {
						echo '<div class="cat-links"><span class="space-right">' . esc_html__( 'Category', 'envo-blog' ) . '</span>' . wp_kses_data( $categories_list ) . '</div>';
					}

					if ( $tags_list ) {
						echo '<div class="tags-links"><span class="space-right">' . esc_html__( 'Tags', 'envo-blog' ) . '</span>' . wp_kses_data( $tags_list ) . '</div>';
					}
				}
			}

			edit_post_link();

			echo '</div>';
		}
	}

endif;

if ( !function_exists( 'envo_blog_generate_construct_footer' ) ) :
	/**
	 * Build footer
	 */
	add_action( 'envo_blog_generate_footer', 'envo_blog_generate_construct_footer' );

	function envo_blog_generate_construct_footer() {
		?>
		<p class="footer-credits-text text-center">
			<?php
			/* translators: %1$s: Envo Blog name with envothemes.com URL */
			printf( esc_html__( 'Edited by: %1$s', 'envo-blog' ), '<a href="' . esc_url( '#' ) . '">Vladislav Garaba</a>' );
			?>
			<span class="sep"> | </span>
			<?php 
			/* translators: %s: WordPress name with wordpress.org URL */
			printf( esc_html__( 'Powered by %s', 'envo-blog' ), '<a href="' . esc_url( __( 'https://wordpress.org/', 'envo-blog' ) ) . '">WordPress</a>' );
			?>
			<span class="sep"> | </span>
			<?php
			/* translators: %1$s: Envo Blog name with envothemes.com URL */
			printf( esc_html__( 'Theme: %1$s', 'envo-blog' ), '<a href="' . esc_url( 'http://envothemes.com/' ) . '">Envo Blog</a>' );
			?>
		</p> 
		<?php
	}

endif;

if ( ! function_exists( 'envo_blog_get_the_excerpt' ) ) :

	/**
	 * Returns post excerpt.
	 */
	function envo_blog_get_the_excerpt( $length = 0, $post_object = null ) {
		global $post;

		if ( is_null( $post_object ) ) {
			$post_object = $post;
		}

		$length = absint( $length );
		if ( 0 === $length ) {
			return;
		}

		$source_content = $post_object->post_content;

		if ( ! empty( $post_object->post_excerpt ) ) {
			$source_content = $post_object->post_excerpt;
		}

		$source_content = strip_shortcodes( $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );
		return $trimmed_content;
	}

endif;

if ( ! function_exists( 'envo_blog_widget_date_comments' ) ) :

	/**
	 * Returns date for widgets.
	 */
	function envo_blog_widget_date_comments( ) {
	?>
	<span class="posted-date">
		<?php echo esc_html( get_the_date() ); ?>
	</span>
	<span class="comments-meta">
		<?php
			if ( !comments_open() ) 
				{ esc_html_e('Off','envo-blog'); }
			else { ?>
				<a href="<?php echo esc_url( get_comments_link() ); ?>" rel="nofollow" title="<?php esc_html_e( 'Comment on ', 'envo-blog' ) . the_title_attribute(); ?>">
					<?php echo absint( get_comments_number() ); ?>
				</a>
			<?php } ?>
		<i class="fa fa-comments-o"></i>
	</span>
	<?php
	}

endif;

if ( ! function_exists( 'envo_blog_excerpt_more' ) ) :
	/**
	 * Excerpt more.
	 */
	function envo_blog_excerpt_more( $more ) {
    if( is_admin() ) return $more;
		return '&hellip;';
	}
	
	add_filter( 'excerpt_more', 'envo_blog_excerpt_more' );
	
endif;

if ( ! function_exists( 'envo_blog_thumb_img' ) ) :

	/**
	 * Returns widget thumbnail.
	 */
	function envo_blog_thumb_img( $img = 'full', $col = '', $link = true ) {
		if ( function_exists( 'envo_blog_pro_thumb_img' ) ) {
			envo_blog_pro_thumb_img( $img, $col, $link);
		} elseif ( envo_blog_is_preview() && !has_post_thumbnail() ) {
		$placeholder = envo_blog_get_preview_img_src();
		?>
			<div class="news-thumb <?php echo esc_attr( $col ); ?>">
				<img src="<?php echo esc_url( $placeholder ); ?>" alt="<?php the_title_attribute(); ?>" />
			</div><!-- .news-thumb -->
		<?php } elseif ( ( has_post_thumbnail() && $link == true ) ) { ?>
			<div class="news-thumb <?php echo esc_attr( $col ); ?>">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<img src="<?php the_post_thumbnail_url( $img ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
				</a>
			</div><!-- .news-thumb -->
		<?php } elseif ( has_post_thumbnail() ) { ?>
			<div class="news-thumb <?php echo esc_attr( $col ); ?>">
				<img src="<?php the_post_thumbnail_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" />
			</div><!-- .news-thumb -->
		<?php
		}
	}

endif;

function homepage_add_libraries() {
    if ( is_page('Table') or is_page("Session History") ) {
        wp_enqueue_style('style', "/wp-content/themes/envo-blog/external/assets/css/my_style.css");
        wp_enqueue_script( 'ajax', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js' );
//        wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.3.1.js');
//        wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
//        wp_enqueue_script( 'ajax2', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js');
//        wp_enqueue_script( 'bootstrap-js2', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js');
        add_action('wp_enqueue_scripts', 'homepage_add_libraries');

    }
}


/************************************************ CUSTOM CODE *****************************************/

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if(!isset($_SESSION['recursion']))
    require_once (__DIR__ . '/' . 'external/connection.php');
else
    unset($_SESSION['recursion']);
require_once (__DIR__ . '/' . 'external/fitness.php');
require_once (__DIR__ . '/' . 'external/spa.php');
require_once (__DIR__ . '/' . 'external/massage.php');
require_once (__DIR__ . '/' . 'external/swimming.php');
require_once (__DIR__ . '/' . 'external/functions.php');
require_once (__DIR__ . '/' . 'shortcodes.php');

