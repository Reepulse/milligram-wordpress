<?php
/**
 * The template for displaying Author info
 *
 * @package WordPress
 * @subpackage RePulse
 * @since 1.0.0
 */

if ( (bool) get_the_author_meta( 'description' ) && (bool) get_theme_mod( 'single_author_bio', true ) ) : ?>
    <div class="box author-box">
        <article class="has-text-centered">
            <div>
                <figure class="image is-64x64">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 160, '', '', array( 'class' => 'is-circle' ) ); ?>
                </figure>
            </div>
            <div class="media-content-center">
                <div class="content has-padding-bottom-1">
                    <p class="h3 has-text-weight-bold has-margin-bottom-0"><?php echo esc_html( get_the_author() ); ?></p>
                    <div class="author-description">
						<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
                        <a class="author-link"
                           href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
                           rel="author">
							<?php _e( 'View Archive <span aria-hidden="true">&rarr;</span>', 'Reepulse' ); ?>
                        </a>
                    </div>
                </div>
                <nav class="level is-mobile">
                    <div class="level-left">
                        <a class="level-item" aria-label="reply">
				            <span class="icon is-small">
				              <i class="fas fa-reply" aria-hidden="true"></i>
				            </span>
                        </a>
                    </div>
                </nav>
            </div>
        </article>
    </div><!-- .author-box -->
<?php endif; ?>
