<?php get_header(); ?>

<div class="is-archive container"><?php

	if ( have_posts() ) {

		echo '<div class="row is-flex">';

		$i = 0;

		while ( have_posts() ) {
			$i ++;
			if ( $i > 1 ) {
				echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			the_post();

			get_template_part( 'template-parts/entry/entry-article' );

		}
		echo '</div>';
	}

	?>

</div><!-- .is-archive -->

<?php get_footer(); ?>
