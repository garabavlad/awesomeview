</div><!-- end main-container -->
</div><!-- end page-area -->
<?php if ( is_active_sidebar( 'envo-blog-footer-area' ) ) { ?>  				
	<div id="content-footer-section" class="container-fluid clearfix">
		<div class="container">
			<?php dynamic_sidebar( 'envo-blog-footer-area' ) ?>
		</div>	
	</div>		
<?php } ?>
<?php do_action( 'envo_blog_before_footer' ); ?> 
<footer id="colophon" class="footer-credits container-fluid">
	<div class="container">
		<?php do_action( 'envo_blog_generate_footer' ); ?> 
	</div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</footer>
<?php do_action( 'envo_blog_after_footer' ); ?> 
<?php wp_footer(); ?>


</body>
</html>
