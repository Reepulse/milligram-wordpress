<?php

$recent_posts = get_the_last_posts( 3 );

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
