<?php
/**
 * Custom widgets.
 *
 */
if ( !class_exists( 'envo_blog_split_images_News' ) ) :

	/**
	 * Two Column News widget class.
	 *
	 */
	class envo_blog_split_images_News extends WP_Widget {

		function __construct() {
			$opts = array(
				'classname'		 => 'split-img-section',
				'description'	 => esc_html__( 'Widget to display news in three columns layout.', 'envo-blog' ),
			);

			parent::__construct( 'envo-blog-split-imgages-section', esc_html__( 'Envo Blog: Split Images News', 'envo-blog' ), $opts );
		}

		function widget( $args, $instance ) {

			$title = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );

			$three_category = !empty( $instance[ 'three_category' ] ) ? $instance[ 'three_category' ] : 0;

			$view_all_text = !empty( $instance[ 'view_all_text' ] ) ? $instance[ 'view_all_text' ] : '';

			$post_number = !empty( $instance[ 'post_number' ] ) ? $instance[ 'post_number' ] : 3;

			echo $args[ 'before_widget' ];
			?>

			<div class="three-news-section">

				<div class="section-title">

					<?php
					if ( !empty( $title ) ) {
						echo $args[ 'before_title' ] . esc_html( $title ) . $args[ 'after_title' ];
					}

					if ( !empty( $view_all_text ) ) {

						if ( absint( $three_category ) > 0 ) {

							$cat_link = get_category_link( $three_category );
						} else {

							$cat_link = '';
						}
						?>

						<a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $view_all_text ); ?></a>

					<?php }
					?>

				</div>

				<div class="inner-wrapper split-images">
					<?php
					$three_args = array(
						'posts_per_page'		 => absint( $post_number ),
						'no_found_rows'			 => true,
						'post__not_in'			 => get_option( 'sticky_posts' ),
						'ignore_sticky_posts'	 => true,
					);

					if ( absint( $three_category ) > 0 ) {

						$three_args[ 'cat' ] = absint( $three_category );
					}


					$three_posts = new WP_Query( $three_args );

					if ( $three_posts->have_posts() ) :

						$first_col_count = 1;

						while ( $three_posts->have_posts() ) :

							$three_posts->the_post();
							if ( 1 === $first_col_count ) {
								?>

								<div class="split-box <?php echo 'news-item-' . absint( $first_col_count ); ?>">
									<?php envo_blog_thumb_img( 'envo-blog-single' ); ?>
									<div class="news-text-wrap first-wrap">
										<?php envo_blog_widget_date_comments(); ?>
										<h2>
											<a href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
											</a>
										</h2>
										<span class="author-meta">
											<span class="author-meta-by"><?php esc_html_e( 'By', 'envo-blog' ); ?></span>
											<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>">
												<?php the_author(); ?>
											</a>
										</span>
									</div><!-- .news-text-wrap -->
								</div>

							<?php } else { ?>

								<div class="split-slider <?php echo 'news-item-' . absint( $first_col_count ); ?>">
									<?php envo_blog_thumb_img( 'envo-blog-single' ); ?>
									<div class="news-text-wrap first-wrap">
										<?php envo_blog_widget_date_comments(); ?>
										<h2>
											<a href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
											</a>
										</h2>
										<span class="author-meta">
											<span class="author-meta-by"><?php esc_html_e( 'By', 'envo-blog' ); ?></span>
											<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>">
												<?php the_author(); ?>
											</a>
										</span>
									</div><!-- .news-text-wrap -->
								</div>
								<?php
							}

							$first_col_count++;
						endwhile;

						wp_reset_postdata();
						?>

					<?php endif; ?>
				</div><!-- .inner-wrapper -->

			</div><!-- .mix-column-news -->

			<?php
			echo $args[ 'after_widget' ];
		}

		function update( $new_instance, $old_instance ) {
			$instance						 = $old_instance;
			$instance[ 'title' ]			 = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'three_category' ]	 = absint( $new_instance[ 'three_category' ] );
			$instance[ 'view_all_text' ]	 = sanitize_text_field( $new_instance[ 'view_all_text' ] );
			$instance[ 'post_number' ]		 = absint( $new_instance[ 'post_number' ] );

			return $instance;
		}

		function form( $instance ) {

			$instance	 = wp_parse_args( (array) $instance, array(
				'title'			 => '',
				'three_category' => '',
				'view_all_text'	 => '',
				'post_number'	 => 3,
			) );
			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'envo-blog' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" />
			</p>


			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'three_category' ) ); ?>"><strong><?php esc_html_e( 'Category:', 'envo-blog' ); ?></strong></label>
				<?php
				$cat_args	 = array(
					'orderby'			 => 'name',
					'hide_empty'		 => 0,
					'class'				 => 'widefat',
					'taxonomy'			 => 'category',
					'name'				 => $this->get_field_name( 'three_category' ),
					'id'				 => $this->get_field_id( 'three_category' ),
					'selected'			 => absint( $instance[ 'three_category' ] ),
					'show_option_all'	 => esc_html__( 'All Categories', 'envo-blog' ),
				);
				wp_dropdown_categories( $cat_args );
				?>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'view_all_text' ) ); ?>"><strong><?php esc_html_e( 'View All Text:', 'envo-blog' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'view_all_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'view_all_text' ) ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'view_all_text' ] ); ?>" />
				<small>
					<?php esc_html_e( 'Leave this field empty if you want to hide it.', 'envo-blog' ); ?>   
				</small>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>"><strong><?php esc_html_e( 'Number of Posts:', 'envo-blog' ); ?></strong></label>
				<?php
				$this->dropdown_post_number( array(
					'id'		 => $this->get_field_id( 'post_number' ),
					'name'		 => $this->get_field_name( 'post_number' ),
					'selected'	 => absint( $instance[ 'post_number' ] ),
				)
				);
				?>
			</p>

			<?php
		}

		function dropdown_post_number( $args ) {
			$defaults = array(
				'id'		 => '',
				'name'		 => '',
				'selected'	 => 0,
			);

			$r		 = wp_parse_args( $args, $defaults );
			$output	 = '';

			$choices = array(
				'1'	 => 1,
				'2'	 => 2,
				'3'	 => 3,
			);

			if ( !empty( $choices ) ) {

				$output = "<select name='" . esc_attr( $r[ 'name' ] ) . "' id='" . esc_attr( $r[ 'id' ] ) . "'>\n";
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r[ 'selected' ], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>\n';
				}
				$output .= "</select>\n";
			}

			echo $output;
		}

	}

endif;
