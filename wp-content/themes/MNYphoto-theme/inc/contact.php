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

	$redirect = nytt99_page_url( 'contact-us' ) . '#project-brief';
	$website  = isset( $_POST['project_website'] ) ? sanitize_text_field( wp_unslash( $_POST['project_website'] ) ) : '';

	if ( $website ) {
		wp_safe_redirect( add_query_arg( 'brief', 'sent', $redirect ) );
		exit;
	}

	$name       = isset( $_POST['project_name'] ) ? sanitize_text_field( wp_unslash( $_POST['project_name'] ) ) : '';
	$email      = isset( $_POST['project_email'] ) ? sanitize_email( wp_unslash( $_POST['project_email'] ) ) : '';
	$context    = isset( $_POST['project_context'] ) ? sanitize_textarea_field( wp_unslash( $_POST['project_context'] ) ) : '';
	$timing     = isset( $_POST['project_timing'] ) ? sanitize_text_field( wp_unslash( $_POST['project_timing'] ) ) : '';
	$investment = isset( $_POST['project_investment'] ) ? sanitize_text_field( wp_unslash( $_POST['project_investment'] ) ) : '';
	$areas      = isset( $_POST['project_area'] ) && is_array( $_POST['project_area'] )
		? array_map( 'sanitize_text_field', wp_unslash( $_POST['project_area'] ) )
		: array();

	if ( ! $name || ! is_email( $email ) || ! $context ) {
		wp_safe_redirect( add_query_arg( 'brief', 'invalid', $redirect ) );
		exit;
	}

	$subject = sprintf( __( 'New project brief from %s', 'nolan-young-theme-template-99-master' ), $name );
	$message = implode(
		"\n\n",
		array(
			sprintf( __( 'Name: %s', 'nolan-young-theme-template-99-master' ), $name ),
			sprintf( __( 'Email: %s', 'nolan-young-theme-template-99-master' ), $email ),
			sprintf( __( 'Pressure areas: %s', 'nolan-young-theme-template-99-master' ), $areas ? implode( ', ', $areas ) : __( 'Not specified', 'nolan-young-theme-template-99-master' ) ),
			sprintf( __( 'Timing: %s', 'nolan-young-theme-template-99-master' ), $timing ? $timing : __( 'Not specified', 'nolan-young-theme-template-99-master' ) ),
			sprintf( __( 'Investment: %s', 'nolan-young-theme-template-99-master' ), $investment ? $investment : __( 'Not specified', 'nolan-young-theme-template-99-master' ) ),
			__( 'Project context:', 'nolan-young-theme-template-99-master' ) . "\n" . $context,
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
