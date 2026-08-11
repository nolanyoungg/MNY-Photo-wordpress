<?php
/** Front-end assets. */

function mnyphoto_enqueue_assets() {
	$css_path = get_theme_file_path( 'dist/css/bundle.css' );
	$js_path  = get_theme_file_path( 'dist/js/bundle.js' );
	wp_enqueue_style( 'mnyphoto-style', get_theme_file_uri( 'dist/css/bundle.css' ), array(), file_exists( $css_path ) ? (string) filemtime( $css_path ) : MNYPHOTO_VERSION );
	wp_enqueue_script( 'mnyphoto-script', get_theme_file_uri( 'dist/js/bundle.js' ), array(), file_exists( $js_path ) ? (string) filemtime( $js_path ) : MNYPHOTO_VERSION, true );
	wp_script_add_data( 'mnyphoto-script', 'strategy', 'defer' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mnyphoto_enqueue_assets' );
