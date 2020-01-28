<?php get_header(); ?>

    <div class="is-single container<?php if ( is_active_sidebar( 'sidebar-single' ) )
		echo ' container-hd' ?>">
		<?php
		the_post();
		get_template_part( 'template-parts/content/content-single' ); ?>
    </div><!-- .is-single -->

<?php get_footer(); ?>