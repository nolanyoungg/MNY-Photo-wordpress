<?php
/** Theme presentation settings. */

function mnyphoto_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'mnyphoto_studio',
		array( 'title' => __( 'MNY Photo studio details', 'mnyphoto-theme' ), 'priority' => 35 )
	);
	$settings = array(
		'mnyphoto_contact_email' => array( 'label' => __( 'Contact email', 'mnyphoto-theme' ), 'default' => get_option( 'admin_email' ), 'sanitize' => 'sanitize_email', 'type' => 'email' ),
		'mnyphoto_location'      => array( 'label' => __( 'Availability line', 'mnyphoto-theme' ), 'default' => __( 'Available for commissions worldwide', 'mnyphoto-theme' ), 'sanitize' => 'sanitize_text_field', 'type' => 'text' ),
		'mnyphoto_instagram'     => array( 'label' => __( 'Instagram URL', 'mnyphoto-theme' ), 'default' => '', 'sanitize' => 'esc_url_raw', 'type' => 'url' ),
		'mnyphoto_linkedin'      => array( 'label' => __( 'LinkedIn URL', 'mnyphoto-theme' ), 'default' => '', 'sanitize' => 'esc_url_raw', 'type' => 'url' ),
	);
	foreach ( $settings as $id => $setting ) {
		$wp_customize->add_setting( $id, array( 'default' => $setting['default'], 'sanitize_callback' => $setting['sanitize'], 'transport' => 'refresh' ) );
		$wp_customize->add_control( $id, array( 'label' => $setting['label'], 'section' => 'mnyphoto_studio', 'type' => $setting['type'] ) );
	}
}
add_action( 'customize_register', 'mnyphoto_customize_register' );
