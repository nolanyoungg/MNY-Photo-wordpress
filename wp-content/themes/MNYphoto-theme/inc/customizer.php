<?php
/**
 * Theme Customizer settings.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register Customizer fields owned by this theme.
 *
 * @param WP_Customize_Manager $customize Customizer manager instance.
 * @return void
 */
function nytt99_customize( $customize ) {
	$customize->add_section(
		'nytt99_contact',
		array(
			'title' => __( 'Studio contact details', 'nolan-young-theme-template-99-master' ),
		)
	);

	$customize->add_setting(
		'nytt99_email',
		array(
			'default'           => 'hello@northstar.studio',
			'sanitize_callback' => 'sanitize_email',
		)
	);

	$customize->add_control(
		'nytt99_email',
		array(
			'label'   => __( 'Email address', 'nolan-young-theme-template-99-master' ),
			'section' => 'nytt99_contact',
			'type'    => 'email',
		)
	);
}
add_action( 'customize_register', 'nytt99_customize' );
