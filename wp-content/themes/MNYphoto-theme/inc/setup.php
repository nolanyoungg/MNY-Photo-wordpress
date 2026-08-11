<?php
/** Theme supports and content defaults. */

function mnyphoto_theme_setup() {
	load_theme_textdomain( 'mnyphoto-theme', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'dist/css/bundle.css' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 120,
			'width'       => 360,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	register_nav_menus(
		array(
			'primary' => __( 'Primary navigation', 'mnyphoto-theme' ),
			'footer'  => __( 'Footer navigation', 'mnyphoto-theme' ),
		)
	);
	add_image_size( 'mnyphoto-editorial', 1600, 1200, true );
	add_image_size( 'mnyphoto-portrait', 900, 1200, true );
}
add_action( 'after_setup_theme', 'mnyphoto_theme_setup' );

function mnyphoto_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mnyphoto_content_width', 1280 );
}
add_action( 'after_setup_theme', 'mnyphoto_content_width', 0 );

function mnyphoto_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Journal sidebar', 'mnyphoto-theme' ),
			'id'            => 'journal-sidebar',
			'description'   => __( 'Optional widgets shown beside journal and archive content.', 'mnyphoto-theme' ),
			'before_widget' => '<section id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="sidebar-widget__title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'mnyphoto_widgets_init' );

function mnyphoto_excerpt_length() {
	return 24;
}
add_filter( 'excerpt_length', 'mnyphoto_excerpt_length', 20 );

function mnyphoto_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'mnyphoto_excerpt_more' );
