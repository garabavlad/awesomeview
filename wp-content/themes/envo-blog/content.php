<article>
	<div <?php post_class(); ?>>                    
		<div class="news-item row text-center">
			<?php envo_blog_thumb_img( 'envo-blog-single', 'col-md-12' ); ?>
			<div class="news-text-wrap col-md-12">
				<?php
				$categories_list = get_the_category_list( ' ' );
				// Make sure there's more than one category before displaying.
				if ( $categories_list ) {
					echo '<div class="cat-links">' . wp_kses_data( $categories_list ) . '</div>';
				}
				?>
				<h2>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<?php envo_blog_widget_date_comments(); ?>

				<div class="post-excerpt">
					<?php the_excerpt(); ?>
				</div><!-- .post-excerpt -->
				<span class="author-meta">
					<span class="author-meta-by"><?php esc_html_e( 'By', 'envo-blog' ); ?></span>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>">
						<?php the_author(); ?>
					</a>
				</span>
				<div class="read-more-button">
					<a href="<?php the_permalink(); ?>">
						<?php esc_html_e( 'Read More', 'envo-blog' ); ?>
					</a>
					</h2>
				</div><!-- .news-text-wrap -->

			</div><!-- .news-item -->
		</div>
</article>
