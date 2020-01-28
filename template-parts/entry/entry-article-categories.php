<?php

$categories = get_the_category();

if ( $categories ) {
	echo '<div class="tags categories" itemscope itemtype =http://schema.org/CreativeWork>';
}

foreach ( $categories as $category ) {
	$category_link = sprintf(
		'<a href="%1$s" title="%2$s" itemprop="about" class="tag is-light">%3$s</a>',
		esc_url( get_category_link( $category->term_id ) ),
		esc_attr( sprintf( __( 'View all posts in %s', 'Reepulse' ), $category->name ) ),
		esc_html( $category->name )
	);
	echo $category_link;
}

if ( $categories ) {
	echo '</div><!-- .categories -->';
}
