<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Beautify
 */
?>
		</div> <!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	<?php 
		$footer_widgets = get_theme_mod( 'footer_widgets',true );
		if( $footer_widgets && ( is_active_sidebar('footer') ||is_active_sidebar('footer-2') ||is_active_sidebar('footer-3') ) ) : ?>
		<div class="footer-widgets">
			<div class="container">
				<?php get_template_part('footer','widgets'); ?>
			</div>
		</div>
	<?php endif; ?>
		<div class="site-info">
			<div class="container">
				<div class="copyright sixteen columns">   
				<?php if( get_theme_mod('copyright') ) : ?>
							<p><?php echo beautify_footer_copyright(get_theme_mod('copyright')); ?></p>
						<?php else : 
							echo sprintf( '<p> %1$s <a href="%2$s" target="_blank"> %3$s</a> %4$s <a href="%5$s" target="_blank" rel="designer">%6$s</a></p>', __('Powered by','beautify'), esc_url( 'http://wordpress.org/'), __('WordPress.','beautify'), __('Theme: beautify by','beautify'), esc_url('https://www.webulousthemes.com/'), __('Webulous Themes','beautify')) ;
					 endif;  ?>
				</div>

			</div>
		</div><!-- .site-info -->
		<?php if( get_theme_mod('scroll_to_top') ) : ?>
			<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
		<?php endif;  ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
