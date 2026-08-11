<?php
/**
 * Theme bootstrap.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$nytt99_includes = array(
	'/inc/setup.php',
	'/inc/helpers.php',
	'/inc/enqueue.php',
	'/inc/template-tags.php',
	'/inc/customizer.php',
	'/inc/navigation.php',
	'/inc/contact.php',
);

foreach ( $nytt99_includes as $nytt99_include ) {
	require_once get_theme_file_path( $nytt99_include );
}

unset( $nytt99_include, $nytt99_includes );
