<?php
/**
 * The front page template file.
 *
 *
 * @package Beautify
 */
 
if ( 'posts' == get_option( 'show_on_front' ) ) { 
	get_template_part('index');
} else {

	 
    get_header(); 

	$slider_cat = get_theme_mod( 'slider_cat', '' );
	$slider_count = get_theme_mod( 'slider_count', 5 );   
	$slider_posts = array(   
		'cat' => absint($slider_cat),
		'posts_per_page' => intval($slider_count)              
	);

	$home_slider = get_theme_mod('slider_field',true); 
	if( $home_slider ):
		if ( $slider_cat ) {
			$query = new WP_Query($slider_posts);        
			if( $query->have_posts()) : ?> 
				<div class="flexslider free-flex">  
					<ul class="slides">
						<?php while($query->have_posts()) :
								$query->the_post();
								if( has_post_thumbnail() ) : ?>
								    <li>
								    	<div class="flex-image">
								    		<?php the_post_thumbnail('full'); ?>
								    	</div>
								    	<?php $content = get_the_content();
								    	if( !empty( $content ) ) { ?>
								    		<div class="flex-caption">
									    		<?php the_content( __('Read More','beautify') ); 
										    	wp_link_pages( array(
													'before' => '<div class="page-links">' . esc_html__( 'Pages: ', 'beautify' ),
													'after'  => '</div>',
												) ); ?>
								    		</div>
								    	<?php } ?>
								    </li>
							    <?php endif;?>			   
						<?php endwhile; ?>
					</ul>
				</div>
		
			<?php endif; ?>
		   <?php  
			$query = null;
			wp_reset_postdata();
			
		}
    endif; 
	if( get_theme_mod('service_field',true) ) {
       do_action('service_content_before');
      
		$service_page1 = intval(get_theme_mod('service_1'));
		$service_page2 = intval(get_theme_mod('service_2'));
		$service_page3 = intval(get_theme_mod('service_3'));
		$service_section_title = intval(get_theme_mod('service_section_title'));

		if( $service_page1 || $service_page2 || $service_page3 ) { ?>
			<div class="service-wrapper row">
			    <div class="container">
			    <?php  if($service_section_title ) {
					echo '<div class="section-head">';
					echo '<h2 class="title-divider"><span>' . get_the_title(absint($service_section_title)) . '</span></h2>';
					$description = get_post_field('post_content',absint($service_section_title));
					echo '<p class="sub-description">' . esc_html($description) . '</p>';
				    echo '</div>';
				}
				$service_pages = array($service_page1,$service_page2,$service_page3);
				$args = array(
					'post_type' => 'page',
					'post__in' => $service_pages,
					'posts_per_page' => -1,
					'orderby' => 'post__in'
				);
				$query = new WP_Query($args);
				if( $query->have_posts()) : ?>	
				    
					<?php do_action('beautify_service_title');
					 $i = 1; ?>
					<?php while($query->have_posts()) :
						$query->the_post(); ?>
				    	<div class="one-third column">
				    	    <div class="service-section">
				    	    	<div class="service-content">
						    	    <?php the_title( sprintf( '<h4><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
							    	<?php the_content(); 
										wp_link_pages( array(
											'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'beautify' ),
											'after'  => '</div>',
										) );
									?>
						    	</div>
						    	<?php if(has_post_thumbnail()): ?>
									<div class="service-image"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('beautify-service-img'); ?></a></div>
							    <?php endif; ?>
						    	
							</div>
						</div>
						<?php 
						$i++;
						
					endwhile; ?>
					
						
					<?php 
				endif; 
				$query = null;
				$args = null;
				wp_reset_postdata(); ?>
			</div>
			</div><?php
		} 	

		
		do_action('service_content_after'); 

	}	
	if( get_theme_mod('enable_recent_post_service',true) ) :
	   	do_action('beautify_recent_post_before');
		beautify_recent_posts(); 
	    do_action('beautify_recent_post_after');
    endif;
    
	$client_cat = get_theme_mod( 'client_cat', '' );
	$client_posts = array(   
		'cat' => absint($client_cat),
		//'posts_per_page' => intval($client_count)              
	);?>
		<?php $home_client = get_theme_mod('client_field',true); 
			if( $home_client ):?>
				<div class="client-carousel">
					<div class="container">

			<?php	if ( $client_cat ) {
					$query = new WP_Query($client_posts);        
					if( $query->have_posts()) : ?> 
						<div class="flex-carousel">  
							<ul class="slides">
								<?php while($query->have_posts()) :
										$query->the_post();
										if( has_post_thumbnail() ) : ?>
										    <li>
										    	<div class="flex-image">
										    		<?php the_post_thumbnail('full'); ?>
										    	</div>
										    </li>
									    <?php endif;?>			   
								<?php endwhile; ?>
							</ul>
						</div>
				
					<?php endif; ?>
				   <?php  
					$query = null;
					wp_reset_postdata();
					
				} ?>
				</div>
			</div><?php
		   endif; ?>

 
  <?php  if( get_theme_mod('enable_home_default_content',false ) ) {   ?>
		<div id="content" class="site-content">
			<div class="container">
				<main id="main" class="site-main" role="main"><?php
					while ( have_posts() ) : the_post();       
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'beautify' ),
							'after'  => '</div>',
						) );
					endwhile; ?>
			    </main><!-- #main -->
		    </div><!-- #primary -->
		</div>
    <?php }
    get_footer();

}
