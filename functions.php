<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function Reepulse_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'Reepulse-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 180;
	$logo_height = 60;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true
		)
	);

	add_theme_support( 'title-tag' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	load_theme_textdomain( 'Reepulse' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	$loader = new RePulse_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'Reepulse_theme_support' );

function Reepulse_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<p class="h5 is-white is-uppercase has-text-weight-bold">',
		'after_title'   => '</p>',
		'before_widget' => '<div class="%2$s">',
		'after_widget'  => '</div>',
	);

	for ( $i = 1; $i <= 4; $i ++ ) {
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer #' . $i, 'Reepulse' ),
					'id'          => 'sidebar-footer-' . $i,
					'description' => __( 'Widgets in this area will be displayed in columns.', 'Reepulse' ),
				)
			)
		);
	}

	unset( $shared_args['before_title'] );
	unset( $shared_args['after_title'] );

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Pre-footer', 'Reepulse' ),
				'id'          => 'sidebar-pre-footer',
				'description' => __( 'Widgets will be displayed just before the footer.', 'Reepulse' ),
			)
		)
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'before_title' => '<p class="has-margin-top-3 h4 has-text-grey-dark is-uppercase has-text-weight-bold">',
				'after_title'  => '</p>',
				'name'         => __( 'Single pages', 'Reepulse' ),
				'id'           => 'sidebar-single',
				'description'  => __( 'Widgets in this area will be display next to content in article.', 'Reepulse' ),
			)
		)
	);
}

add_action( 'widgets_init', 'Reepulse_sidebar_registration' );


function Reepulse_widgets_registration() {
	register_widget( 'RePulse_Widget_CTA_Post' );
	register_widget( 'RePulse_Widget_Recent_Posts' );
}

add_action( 'widgets_init', 'Reepulse_widgets_registration' );


/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/menu.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/classes/class-Reepulse-separator-control.php';
require get_template_directory() . '/classes/class-Reepulse-walker-comment.php';
require get_template_directory() . '/classes/class-Reepulse-customize.php';
require get_template_directory() . '/classes/class-Reepulse-walker-menu.php';
require get_template_directory() . '/classes/class-Reepulse-widget-cta-post.php';
require get_template_directory() . '/classes/class-Reepulse-widget-recent-posts.php';
require get_template_directory() . '/classes/class-Reepulse-script-loader.php';

/**
 * Register and Enqueue Styles.
 */
function Reepulse_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'Reepulse-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'Reepulse-style', 'rtl', 'replace' );
}

add_action( 'wp_enqueue_scripts', 'Reepulse_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function Reepulse_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'Reepulse-js', get_template_directory_uri() . '/assets/js/menu.js', array(), $theme_version, false );
	wp_enqueue_script( 'Reepulse-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );

	wp_script_add_data( 'Reepulse-js', 'async', true );
}

add_action( 'wp_enqueue_scripts', 'Reepulse_register_scripts' );

