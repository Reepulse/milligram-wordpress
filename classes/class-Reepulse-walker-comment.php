<?php
/**
 * Custom comment walker for this theme.
 *
 * @package WordPress
 * @subpackage RePulse
 * @since 1.0.0
 */

if ( ! class_exists( 'RePulse_Walker_Comment' ) ) {
	/**
	 * CUSTOM COMMENT WALKER
	 * A custom walker for comments, based on the walker in Twenty Nineteen.
	 */
	class RePulse_Walker_Comment extends Walker_Comment {

		/**
		 * Outputs a comment in the HTML5 format.
		 *
		 * @see wp_list_comments()
		 * @see https://developer.wordpress.org/reference/functions/get_comment_author_url/
		 * @see https://developer.wordpress.org/reference/functions/get_comment_author/
		 * @see https://developer.wordpress.org/reference/functions/get_avatar/
		 * @see https://developer.wordpress.org/reference/functions/get_comment_reply_link/
		 * @see https://developer.wordpress.org/reference/functions/get_edit_comment_link/
		 *
		 * @param WP_Comment $comment Comment to display.
		 * @param int        $depth   Depth of the current comment.
		 * @param array      $args    An array of arguments.
		 */
		protected function html5_comment( $comment, $depth, $args ) {

			$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

			?>
            <<?php echo $tag; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>

            <article id="div-comment-<?php comment_ID(); ?>" class="media comment-body vcard">
                <figure class="media-left has-margin-left-0 has-margin-top-0">
                    <p class="image is-64x64">
			            <?php
						$avatar = get_avatar( $comment, $args['avatar_size'] );

						if ( 0 !== $args['avatar_size'] ) {
							echo wp_kses_post( $avatar );
						}
						?>
                    </p> <!-- .image -->
                </figure><!-- .media-left -->

                <div class="media-content">

					<?php
					$comment_author_url = get_comment_author_url( $comment );
					$comment_author     = get_comment_author( $comment );

					$post_author    = '';
					$by_post_author = twentytwenty_is_comment_by_post_author( $comment );

					if ( $by_post_author ) {
						$post_author = ' <span class="by-post-author tag">' . __( 'Post Author', 'Reepulse' ) . '</span>';
					}

					printf(
						'<p class="strong has-margin-bottom-0"><a href="%1$s">#</a> <span class="fn">%2$s</span>%3$s</p>',
						esc_url( get_comment_link( $comment, $args ) ),
						! empty( $comment_author_url ) ? esc_html( $comment_author ) : sprintf( '<a href="%s" rel="external nofollow" class="url">%s</a>', $comment_author_url, $comment_author ),
						$post_author
					);

					comment_text();

					if ( '0' === $comment->comment_approved ): ?>
                        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'Reepulse' ); ?></p>
					<?php endif; ?>

                    <small class="comment-metadata">
						<?php

						$comment_reply_link = get_comment_reply_link(
							array_merge(
								$args,
								array(
									'add_below' => 'div-comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
									'before'    => '<span class="comment-reply">',
									'after'     => '</span>',
								)
							)
						);
						/* Translators: 1 = comment date, 2 = comment time */
						$comment_timestamp = sprintf( __( '%1$s at %2$s', 'Reepulse' ), get_comment_date( '', $comment ), get_comment_time() );
						?>
                        <small>
                            <time datetime="<?php comment_time( 'c' ); ?>"
                                  title="<?php echo esc_attr( $comment_timestamp ); ?>">
								<?php echo esc_html( $comment_timestamp ); ?>
                            </time>
                        </small>
                        <p>

							<?php
							if ( get_edit_comment_link() ) {
								echo '<a class="comment-edit-link" href="' . esc_url( get_edit_comment_link() ) . '">' . __( 'Edit', 'Reepulse' ) . '</a> <span aria-hidden="true">&bull;</span> ';
							}

							if ( $comment_reply_link ) {
								echo '' . $comment_reply_link;
							}
							?>
                        </p>

                    </small><!-- .comment-metadata -->

                </div><!-- .media-content -->

            </article><!-- .comment-body -->

			<?php
		}
	}
}
