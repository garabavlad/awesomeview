<?php if ( has_nav_menu( 'top_menu_left' ) || has_nav_menu( 'top_menu_right' ) ) : ?>
	<div class="top-menu" >
		<nav id="top-navigation" class="navbar navbar-inverse bg-dark">     
			<div class="container">   
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-2-collapse">
						<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'envo-blog' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse navbar-2-collapse">
					<ul class="nav navbar-nav search-icon navbar-right hidden-xs">
						<li class="top-search-icon">
							<a href="#">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<div class="top-search-box">
							<?php get_search_form(); ?>
						</div>
					</ul>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'top_menu_left',
						'depth'			 => 5,
						'menu_class'	 => 'nav navbar-nav navbar-left',
						'fallback_cb'	 => 'wp_bootstrap_navwalker::fallback',
						'walker'		 => new wp_bootstrap_navwalker(),
					) );

					wp_nav_menu( array(
						'theme_location' => 'top_menu_right',
						'depth'			 => 5,
						'menu_class'	 => 'nav navbar-nav navbar-right',
						'fallback_cb'	 => 'wp_bootstrap_navwalker::fallback',
						'walker'		 => new wp_bootstrap_navwalker(),
					) );
					?>
				</div>
			</div>    
		</nav> 
	</div>
<?php endif; ?>
<div class="site-header container-fluid" style="background-image: url(<?php esc_url( header_image() ); ?>)">
	<div class="custom-header container" >
		<div class="site-heading text-center">
			<div class="site-branding-logo">
				<?php the_custom_logo(); ?>
			</div>
			<div class="site-branding-text">
				<?php if ( is_front_page() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif; ?>

				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) :
					?>
					<p class="site-description">
						<?php echo esc_html( $description ); ?>
					</p>
				<?php endif; ?>
			</div><!-- .site-branding-text -->
		</div>	

	</div>
</div>
<?php do_action( 'envo_blog_before_menu' ); ?> 
<div class="main-menu">
	<nav id="site-navigation" class="navbar navbar-default navbar-center">     
		<div class="container">   
			<div class="navbar-header">
				<?php if ( has_nav_menu( 'main_menu' ) ) : ?>
					<div id="main-menu-panel" class="open-panel" data-panel="main-menu-panel">
						<span></span>
						<span></span>
						<span></span>
					</div>
				<?php endif; ?>
			</div>
			<?php
			if ( envo_blog_is_preview() ) {
				echo '<div class="menu-container"><ul id="main-menu" class="nav navbar-nav navbar-left">';
				envo_blog_preview_navigation();
				echo '</ul></div>';
			} else {

			    // !!!
//                add_shortcode( 'gooo', 'prowp_twitter' );
//                function prowp_twitter()
//                {
//                    return '<a href = "http://localhost/wordpress-proj/wordpress/my-account/">html</a>';
//                }
//                echo do_shortcode('[gooo]');

			    // !!! Interchanging navbar menus whenever user is logged:
			    $menu_to_show = "main_menu";
			    if(is_user_logged_in())
                {
                    $menu_to_show = "main_menu_logged";
                }



				wp_nav_menu( array(
					'theme_location'	 => $menu_to_show,
					'depth'				 => 5,
					'container'			 => 'div',
					'container_class'	 => 'menu-container',
					'menu_class'		 => 'nav navbar-nav',
					'fallback_cb'		 => 'wp_bootstrap_navwalker::fallback',
					'walker'			 => new wp_bootstrap_navwalker(),
				) );
			}
			?>
		</div>
		<?php do_action( 'envo_blog_menu' ); ?>
	</nav> 
</div>
<?php do_action( 'envo_blog_after_menu' ); ?>
