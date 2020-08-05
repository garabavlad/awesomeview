<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beautify
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class ="latest-content">
	<div class="header-content">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<div class="title-meta"> 
			<?php if ( 'post' == get_post_type() ) : ?>
				<?php beautify_top_meta();?>
			<?php endif; ?>
		</div>
		<br class="clear">
	</div><!-- .entry-header -->

	<div class="entry-summary">    
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
</div>
</article><!-- #post-## -->
