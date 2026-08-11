<?php
/**
 * Front-end asset loading.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

function nytt99_enqueue_assets() {
	$css_path = get_theme_file_path( '/dist/css/bundle.css' );
	$js_path  = get_theme_file_path( '/dist/js/bundle.js' );

	wp_enqueue_style( 'nytt99-styles', nytt99_asset_url( 'css/bundle.css' ), array(), file_exists( $css_path ) ? (string) filemtime( $css_path ) : '1.0.0' );
	wp_enqueue_script(
		'nytt99-scripts',
		nytt99_asset_url( 'js/bundle.js' ),
		array(),
		file_exists( $js_path ) ? (string) filemtime( $js_path ) : '1.0.0',
		array(
			'in_footer' => false,
			'strategy'  => 'defer',
		)
	);

	wp_add_inline_script(
		'nytt99-scripts',
		"document.documentElement.classList.remove( 'no-js' ); document.documentElement.classList.add( 'js' );",
		'before'
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nytt99_enqueue_assets' );
