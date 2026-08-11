<?php
/**
 * Theme registration and WordPress supports.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

function nytt99_setup() {
	load_theme_textdomain( 'nolan-young-theme-template-99-master', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 64,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus(
		array(
			'primary' => __( 'Primary navigation', 'nolan-young-theme-template-99-master' ),
			'footer'  => __( 'Footer navigation', 'nolan-young-theme-template-99-master' ),
		)
	);
}
add_action( 'after_setup_theme', 'nytt99_setup' );

function nytt99_register_sidebar() {
	register_sidebar(
		array(
			'name'          => __( 'Blog sidebar', 'nolan-young-theme-template-99-master' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<section class="widget">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nytt99_register_sidebar' );

/**
 * Determine whether WordPress is resolving the theme's page-less Services URL.
 *
 * The fallback keeps the theme's documented /services/ destination functional
 * in a clean install before an editor creates and assigns a Services page.
 * A real published page always takes precedence.
 *
 * @return bool
 */
function nytt99_is_virtual_services_request() {
	if ( is_admin() || ! is_404() ) {
		return false;
	}

	$request_path = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) : '';
	$home_path    = wp_parse_url( home_url( '/' ), PHP_URL_PATH );
	$request_path = trim( (string) $request_path, '/' );
	$home_path    = trim( (string) $home_path, '/' );

	if ( $home_path && 0 === strpos( $request_path, $home_path . '/' ) ) {
		$request_path = substr( $request_path, strlen( $home_path ) + 1 );
	}

	return 'services' === trim( $request_path, '/' );
}

/**
 * Serve the Services page template when a clean install has no Services page.
 *
 * @param string $template Resolved WordPress template path.
 * @return string
 */
function nytt99_services_template_fallback( $template ) {
	if ( ! nytt99_is_virtual_services_request() ) {
		return $template;
	}

	global $wp_query;
	$wp_query->is_404 = false;
	$GLOBALS['nytt99_virtual_services_request'] = true;
	status_header( 200 );

	return get_theme_file_path( '/page-templates/page-template-services.php' );
}
add_filter( 'template_include', 'nytt99_services_template_fallback', 99 );

/**
 * Provide an accurate title for the page-less Services fallback route.
 *
 * @param string $title Existing document title.
 * @return string
 */
function nytt99_services_fallback_title( $title ) {
	if ( ! empty( $GLOBALS['nytt99_virtual_services_request'] ) || nytt99_is_virtual_services_request() ) {
		return sprintf(
			/* translators: %s is the site name. */
			__( 'Services – %s', 'nolan-young-theme-template-99-master' ),
			get_bloginfo( 'name' )
		);
	}

	return $title;
}
add_filter( 'pre_get_document_title', 'nytt99_services_fallback_title' );

/**
 * Return the current clean-install route relative to the WordPress home path.
 *
 * @return string
 */
function nytt99_virtual_request_path() {
	$request_path = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) : '';
	$home_path    = trim( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ), '/' );
	$request_path = trim( (string) $request_path, '/' );

	if ( $home_path && 0 === strpos( $request_path, $home_path . '/' ) ) {
		$request_path = substr( $request_path, strlen( $home_path ) + 1 );
	}

	return trim( $request_path, '/' );
}

/**
 * Serve the theme's documented showcase routes before matching Pages exist.
 * Published WordPress pages always win because this runs only on a 404 request.
 *
 * @param string $template Resolved WordPress template path.
 * @return string
 */
function nytt99_showcase_route_fallback( $template ) {
	if ( is_admin() || ! is_404() ) {
		return $template;
	}

	$routes = array(
		'about-us'    => '/page-templates/page-template-about-us.php',
		'work'        => '/page-templates/page-template-work.php',
		'contact-us'  => '/page-templates/page-template-contact-us.php',
		'ppc-lp-2026' => '/page-templates/page-template-ppc-lp-2026.php',
		'journal'     => '/home.php',
		'blog'        => '/home.php',
	);
	$route  = nytt99_virtual_request_path();

	if ( ! isset( $routes[ $route ] ) ) {
		return $template;
	}

	global $wp_query, $wp_the_query;
	if ( in_array( $route, array( 'journal', 'blog' ), true ) ) {
		$wp_query     = new WP_Query(
			array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => (int) get_option( 'posts_per_page', 10 ),
				'paged'          => max( 1, get_query_var( 'paged' ) ),
			)
		);
		$wp_the_query = $wp_query;
		$wp_query->is_home = true;
	}

	$wp_query->is_404 = false;
	$GLOBALS['nytt99_virtual_showcase_route'] = $route;
	status_header( 200 );

	return get_theme_file_path( $routes[ $route ] );
}
add_filter( 'template_include', 'nytt99_showcase_route_fallback', 98 );

/**
 * Give virtual showcase routes accurate browser titles.
 *
 * @param string $title Existing document title.
 * @return string
 */
function nytt99_showcase_fallback_title( $title ) {
	if ( empty( $GLOBALS['nytt99_virtual_showcase_route'] ) ) {
		return $title;
	}

	$route = $GLOBALS['nytt99_virtual_showcase_route'];
	$names = array(
		'about-us'    => __( 'About Us', 'nolan-young-theme-template-99-master' ),
		'work'        => __( 'Work', 'nolan-young-theme-template-99-master' ),
		'contact-us'  => __( 'Contact Us', 'nolan-young-theme-template-99-master' ),
		'ppc-lp-2026' => __( 'PPC Landing Page', 'nolan-young-theme-template-99-master' ),
		'journal'     => __( 'Journal', 'nolan-young-theme-template-99-master' ),
		'blog'        => __( 'Journal', 'nolan-young-theme-template-99-master' ),
	);

	if ( isset( $names[ $route ] ) ) {
		return sprintf( '%1$s – %2$s', $names[ $route ], get_bloginfo( 'name' ) );
	}

	return $title;
}
add_filter( 'pre_get_document_title', 'nytt99_showcase_fallback_title', 20 );
