<?php
/**
 * Project brief submission handling.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

/**
 * Process the public project brief form and email the site administrator.
 *
 * @return void
 */
function nytt99_handle_project_brief() {
	check_admin_referer( 'nytt99_project_brief', 'nytt99_project_brief_nonce' );

	$redirect = mnyphoto_url( 'contact' ) . '#project-brief';
	$website  = isset( $_POST['project_website'] ) ? sanitize_text_field( wp_unslash( $_POST['project_website'] ) ) : '';

	if ( $website ) {
		wp_safe_redirect( add_query_arg( 'brief', 'sent', $redirect ) );
		exit;
	}

	$name       = isset( $_POST['project_name'] ) ? sanitize_text_field( wp_unslash( $_POST['project_name'] ) ) : '';
	$email      = isset( $_POST['project_email'] ) ? sanitize_email( wp_unslash( $_POST['project_email'] ) ) : '';
	$context    = isset( $_POST['project_context'] ) ? sanitize_textarea_field( wp_unslash( $_POST['project_context'] ) ) : '';
	$timing     = isset( $_POST['project_timing'] ) ? sanitize_text_field( wp_unslash( $_POST['project_timing'] ) ) : '';
	$location = isset( $_POST['project_location'] ) ? sanitize_text_field( wp_unslash( $_POST['project_location'] ) ) : '';
	$areas      = isset( $_POST['project_area'] ) && is_array( $_POST['project_area'] )
		? array_map( 'sanitize_text_field', wp_unslash( $_POST['project_area'] ) )
		: array();

	$category = count( $areas ) === 1 ? mnyphoto_category( $areas[0] ) : null;
	$date_valid = ! $timing;
	if ( $timing && preg_match( '/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $timing, $date_parts ) ) {
		$date_valid = checkdate( (int) $date_parts[2], (int) $date_parts[3], (int) $date_parts[1] );
	}
	if ( ! $name || ! is_email( $email ) || ! $context || ! $category || ! $date_valid || strlen( $name ) > 600 || strlen( $context ) > 20000 ) {
		wp_safe_redirect( add_query_arg( 'brief', 'invalid', $redirect ) );
		exit;
	}

	$subject = sprintf( __( 'New photography inquiry from %s', 'mnyphoto-theme' ), $name );
	$message = implode(
		"\n\n",
		array(
			sprintf( __( 'Name: %s', 'mnyphoto-theme' ), $name ),
			sprintf( __( 'Email: %s', 'mnyphoto-theme' ), $email ),
			sprintf( __( 'Photography: %s', 'mnyphoto-theme' ), $category['name'] ),
			sprintf( __( 'Timing: %s', 'mnyphoto-theme' ), $timing ? $timing : __( 'Not specified', 'mnyphoto-theme' ) ),
			sprintf( __( 'Location: %s', 'mnyphoto-theme' ), $location ? $location : __( 'Not specified', 'mnyphoto-theme' ) ),
			__( 'Inquiry:', 'mnyphoto-theme' ) . "\n" . $context,
		)
	);
	$sent    = wp_mail(
		get_option( 'admin_email' ),
		$subject,
		$message,
		array( sprintf( 'Reply-To: %s', $email ) )
	);

	wp_safe_redirect( add_query_arg( 'brief', $sent ? 'sent' : 'error', $redirect ) );
	exit;
}
add_action( 'admin_post_nopriv_nytt99_project_brief', 'nytt99_handle_project_brief' );
add_action( 'admin_post_nytt99_project_brief', 'nytt99_handle_project_brief' );
