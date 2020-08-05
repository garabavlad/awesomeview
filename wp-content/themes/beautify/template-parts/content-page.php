<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Beautify
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="entry-content">    
	 <?php  if( has_post_thumbnail() && ! post_password_required() ) :   
				the_post_thumbnail('beautify-blog-large-width'); 		
			endif;?>

		<?php the_content(); ?>
		
	</div><!-- .entry-content -->

	   <?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'beautify' ),
				'after'  => '</div>',
			) );
		?>

	
	<?php edit_post_link( __( 'Edit', 'beautify' ), '<footer class="entry-footer"><span class="edit-link"><i class="fa fa-pencil"></i>', '</span></footer>' ); ?>


</article><!-- #post-## -->
