<?php

if ( ! class_exists( 'RePulse_Widget_CTA_Post' ) ) {

	/**
	 * Adds RePulse_Widget_CTA widget.
	 */
	class RePulse_Widget_CTA_Post extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			parent::__construct(
				'Reepulse_widget_cta_post', // Base ID
				'RePulse : CTA for Single Post', // Name
				array( 'description' => __( 'Create a beautiful call-to-action for your single posts.', 'Reepulse' ), ) // Args
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @param array $args Widget arguments.
		 * @param array $instance Saved values from database.
		 *
		 * @see WP_Widget::widget()
		 *
		 */
		public function widget( $args, $instance ) {
			extract( $args );
			$id = apply_filters( 'widget_title', $instance['id'] );

			/** @var WP_Post **/
			$post = get_post( $id );
			$post_image = Reepulse_get_post_thumbnail_url( $post );

			if ( $post ) {
				ob_start();
				?>
                <div class="cta-single is-white"<?php if ( $post_image ): ?> style="<?php echo sprintf( " background-image: url('%s')", $post_image ) ?>"<?php endif ?>>
                    <div class="filtered-black has-padding-x-5 has-padding-y-3">
                        <p class="title h2 has-margin-bottom-0"><?php echo $post->post_title; ?></p>
                        <p class="description"><?php echo $post->post_excerpt; ?></p>
                        <a href="<?php echo get_the_permalink( $id ) ?>"
                           class="button has-margin-bottom-0"
                           title="<?php echo __( 'Read now', 'Reepulse' ) . " : $post->post_title"; ?>">
							<?php _e( 'Read now', 'Reepulse' ) ?>
                        </a>
                    </div>
                </div><!-- cta-single -->

				<?php

				$output = ob_get_contents();

				ob_clean();

				echo $output;
			} else {
				echo sprintf('<p>The following post id (%d) does not exist.</p>', $id);
			}
		}

		/**
		 * Back-end widget form.
		 *
		 * @param array $instance Previously saved values from database.
		 *
		 * @see WP_Widget::form()
		 *
		 */
		public function form( $instance ) {
			if ( isset( $instance['id'] ) ) {
				$id = $instance['id'];
			} else {
				$id = '';
			}
			?>
            <p>
                <label for="<?php echo $this->get_field_name( 'id' ); ?>"><?php _e( 'Single Post Id:', 'Reepulse' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'id' ); ?>"
                       name="<?php echo $this->get_field_name( 'id' ); ?>" type="text"
                       value="<?php echo esc_attr( $id ); ?>"/>
            </p>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 * @see WP_Widget::update()
		 *
		 */
		public function update( $new_instance, $old_instance ) {
			$instance          = array();
			$instance['id'] = ( ! empty( $new_instance['id'] ) && is_numeric($new_instance['id']) ) ? sanitize_text_field( $new_instance['id'] ) : '';

			return $instance;
		}

	} // class RePulse_Widget_CTA_Post

}
