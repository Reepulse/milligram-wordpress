<?php get_header(); ?>

    <div class="is-page container">
		<?php
		the_post();
		get_template_part( 'template-parts/content/content-page' ); ?>
    </div><!-- .is-page -->

<?php get_footer(); ?>