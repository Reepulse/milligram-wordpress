<?php

$has_social_menu = has_nav_menu( 'social' );

$has_sidebar_1 = is_active_sidebar( 'sidebar-footer-1' );
$has_sidebar_2 = is_active_sidebar( 'sidebar-footer-2' );
$has_sidebar_3 = is_active_sidebar( 'sidebar-footer-3' );
$has_sidebar_4 = is_active_sidebar( 'sidebar-footer-4' );

// Only output the container if there are elements to display.
if ( $has_social_menu || $has_sidebar_1 || $has_sidebar_2 || $has_sidebar_3 || $has_sidebar_4 ) { ?>

    <div class="footer-nav-widgets-wrapper header-footer-group">

        <div class="footer-inner section-inner">

            <aside class="footer-widgets-outer-wrapper" role="complementary">

                <div class="footer-widgets-wrapper container">

                    <div class="footer-widgets row is-light">

                        <div class="column">
							<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
							<?php if ( $has_social_menu ): ?>
                                <ul class="social-menu footer-social reset-list-style social-icons fill-children-current-color">

									<?php
									wp_nav_menu(
										array(
											'theme_location'  => 'social',
											'container'       => '',
											'container_class' => '',
											'items_wrap'      => '%3$s',
											'menu_id'         => '',
											'menu_class'      => '',
											'depth'           => 1,
											'link_before'     => '<span class="screen-reader-text">',
											'link_after'      => '</span>',
											'fallback_cb'     => '',
										)
									);
									?>

                                </ul>
							<?php endif; ?>
                        </div>
                        <div class="column">
							<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
                        </div>
                        <div class="column">
							<?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
                        </div>
                        <div class="column">
							<?php dynamic_sidebar( 'sidebar-footer-4' ); ?>
                        </div>

                    </div>

                </div>

            </aside>

        </div>

    </div>

<?php } ?>
