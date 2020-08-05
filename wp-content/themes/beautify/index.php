<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beautify
 */

get_header();  ?>


<div id="content" class="site-content">   
		<div class="container">
		
	<?php $sidebar_position = get_theme_mod( 'sidebar_position', 'right' ); ?>
		<?php if( 'left' == $sidebar_position ) :?>
			<?php get_sidebar(); ?>
		<?php endif; ?>  

	<div id="primary" class="content-area <?php beautify_layout_class(); ?>  columns">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php 
			    if(  get_theme_mod ('numeric_pagination',true) ) : 
					the_posts_pagination();
				else :
					the_posts_navigation( array(
					    'prev_text' => __(' &larr; Previous Post','beautify'),
					    'next_text' => __('Next Post &rarr;','beautify'),
					) );    
				endif; 
			?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

		<?php if( 'right' == $sidebar_position ) :?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
		
<?php get_footer(); ?>
