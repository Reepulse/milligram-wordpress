<?php

/**
 * Display the content from the static page
 */
if ( ! is_home() && is_front_page() && have_posts() ) {
	the_post();
	the_content();
}

if ( is_front_page() && is_home() || is_home() && ! is_front_page() ) {
	if ( have_posts() ) {

		$i = 0;
		echo '<div class="row is-flex">';

		while ( have_posts() ) {
			if ( $i !== 0 && ( $i % 3 ) === 0 ) {
				echo '</div><div class="has-margin-top-3 row is-flex">';
			}
			$i ++;
			the_post();

			get_template_part( 'template-parts/entry/entry-article' );
		}

		echo '</div>';

		get_template_part( 'template-parts/pagination' );
	}
} /**
 * Display the last articles
 */
elseif ( is_home() && ! is_front_page() || (bool) get_theme_mod( 'homepage_last_posts', true ) ) {

	$recent_posts = get_the_last_posts();

	if ( $recent_posts ) {

		echo '<h2 class="title has-text-weight-light has-margin-bottom-0">' . __( 'Nos derniers articles', 'Reepulse' ) . '</h2>';
		echo '<div class="row is-flex">';

		foreach ( $recent_posts as $index => $post ) {

			if ( $index !== 0 && ( $index % 3 ) === 0 ) {
				echo '</div><div class="has-margin-top-3 row is-flex">';
			}

			setup_postdata( $post );
			get_template_part( 'template-parts/entry/entry-article' );
		}

		wp_reset_postdata();

		echo '</div>';
	}

	wp_reset_query();
}
