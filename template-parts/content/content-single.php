<div class="row">

    <article <?php post_class( 'column column-66 post' ); ?> id="post-<?php the_ID(); ?>">

        <div class="post-inner">
            <div class="entry-content">
				<?php the_content(); ?>
            </div><!-- .entry-content -->
        </div><!-- .post-inner -->


        <div class="section-inner">
			<?php get_template_part( 'template-parts/navigation' ); ?>
			<?php get_template_part( 'template-parts/entry/entry-author-bio' ); ?>
        </div><!-- .section-inner -->

		<?php

		if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
			?>
            <div class="comments-wrapper section-inner">
				<?php comments_template(); ?>
            </div><!-- .comments-wrapper -->
			<?php
		}
		?>
	</article><!-- .post -->


	<?php if  ( is_active_sidebar( 'sidebar-single' ) ) :  ?>
		<aside id="widget" class="widget-single column column-33 ">
			<div class="sticky">
				<?php dynamic_sidebar( 'sidebar-single' ); ?>
			</div>
		</aside><!-- widget-single -->
	<?php endif; ?>
</div><!-- .row -->
