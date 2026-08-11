<?php
/**
 * MNY Photo theme bootstrap.
 *
 * @package MNYphoto
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MNYPHOTO_VERSION', '2.0.0' );

$mnyphoto_modules = array(
	'inc/setup.php',
	'inc/helpers.php',
	'inc/navigation.php',
	'inc/enqueue.php',
	'inc/customizer.php',
);

foreach ( $mnyphoto_modules as $mnyphoto_module ) {
	require_once get_theme_file_path( $mnyphoto_module );
}
