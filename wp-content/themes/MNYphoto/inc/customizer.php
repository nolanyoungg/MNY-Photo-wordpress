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
			'default'           => '',
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

/** Replace each illustrative collection image with a Media Library attachment. */
function mnyphoto_customize_photography( $customize ) {
	$customize->add_section( 'mnyphoto_photography', array( 'title' => __( 'Photography collections', 'mnyphoto-theme' ), 'description' => __( 'Choose your own photograph for each collection. The approved AI-generated examples are used until a photograph is selected.', 'mnyphoto-theme' ) ) );
	$customize->add_setting( 'mnyphoto_show_legacy_content', array( 'default' => false, 'sanitize_callback' => 'rest_sanitize_boolean' ) );
	$customize->add_control( 'mnyphoto_show_legacy_content', array( 'type' => 'checkbox', 'section' => 'mnyphoto_photography', 'label' => __( 'Append content from legacy page layouts', 'mnyphoto-theme' ), 'description' => __( 'Older page content stays saved in WordPress. Enable this to display it below the photography sections.', 'mnyphoto-theme' ) ) );
	foreach ( mnyphoto_categories() as $category ) {
		$id = 'mnyphoto_image_' . $category['id'];
		$customize->add_setting( $id, array( 'default' => 0, 'sanitize_callback' => 'absint' ) );
		$customize->add_control( new WP_Customize_Media_Control( $customize, $id, array( 'label' => $category['name'], 'section' => 'mnyphoto_photography', 'mime_type' => 'image' ) ) );
	}
}
add_action( 'customize_register', 'mnyphoto_customize_photography' );
