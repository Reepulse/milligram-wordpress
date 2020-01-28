<?php

get_header();

if ( is_home() || is_front_page() ) { ?>
    <div class="is-front-page container">
		<?php get_template_part( 'template-parts/content/content-home' ); ?>
    </div><!-- .is-front-page -->
	<?php
}

get_footer();

