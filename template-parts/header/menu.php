<nav class="navbar is-transparent" role="navigation" aria-label="main navigation">

    <div class="navbar-brand">

		<?php if ( has_custom_logo() ) {
			the_custom_logo();
		} ?>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
           data-target="navbarBasicExample">
            <span aria-hidden="true" class="is-white"></span>
            <span aria-hidden="true" class="is-white"></span>
            <span aria-hidden="true" class="is-white"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">

		<?php
		if ( has_nav_menu( 'primary' ) ) {

			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu'           => '',
					'walker'         => new Mokime_Walker_Nav_Menu(),
					'container'      => false,
					'items_wrap'     => '<div class="navbar-end">%3$s</div><!-- .navbar-end -->',
				)
			);
		}
		?>
    </div><!-- . navbar-menu -->
</nav>
