<?php
/**
 * About operating and collaboration model.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$operating_phases = array(
	array( '01', __( 'Frame', 'nolan-young-theme-template-99-master' ), __( 'Context and decision', 'nolan-young-theme-template-99-master' ) ),
	array( '02', __( 'Focus', 'nolan-young-theme-template-99-master' ), __( 'Direction and priorities', 'nolan-young-theme-template-99-master' ) ),
	array( '03', __( 'Make', 'nolan-young-theme-template-99-master' ), __( 'Prototype and evidence', 'nolan-young-theme-template-99-master' ) ),
	array( '04', __( 'Build', 'nolan-young-theme-template-99-master' ), __( 'System and release', 'nolan-young-theme-template-99-master' ) ),
	array( '05', __( 'Improve', 'nolan-young-theme-template-99-master' ), __( 'Measurement and ownership', 'nolan-young-theme-template-99-master' ) ),
);
?>
<section id="approach" class="section section--navy">
	<div class="content-wrap operating-system">
		<header class="operating-system__heading" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Operating model', 'nolan-young-theme-template-99-master' ); ?></p>
			<h2><?php esc_html_e( 'Fewer handovers. Better decisions.', 'nolan-young-theme-template-99-master' ); ?></h2>
			<p><?php esc_html_e( 'The same senior team frames, prototypes, builds, tests, and improves the work while decision rights remain explicit.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>
		<div class="operating-system__map" data-reveal>
			<div class="operating-system__topline">
				<span><?php esc_html_e( 'Connected delivery path', 'nolan-young-theme-template-99-master' ); ?></span>
				<span><?php esc_html_e( 'One team / one evidence base', 'nolan-young-theme-template-99-master' ); ?></span>
			</div>
			<ol>
				<?php foreach ( $operating_phases as $phase ) : ?>
					<li><span><?php echo esc_html( $phase[0] ); ?></span><i aria-hidden="true"></i><strong><?php echo esc_html( $phase[1] ); ?></strong><small><?php echo esc_html( $phase[2] ); ?></small></li>
				<?php endforeach; ?>
			</ol>
			<div class="operating-system__rhythm">
				<div><span><?php esc_html_e( 'Weekly', 'nolan-young-theme-template-99-master' ); ?></span><strong><?php esc_html_e( 'Working review', 'nolan-young-theme-template-99-master' ); ?></strong></div>
				<div><span><?php esc_html_e( 'At each gate', 'nolan-young-theme-template-99-master' ); ?></span><strong><?php esc_html_e( 'Evidence and decision', 'nolan-young-theme-template-99-master' ); ?></strong></div>
				<div><span><?php esc_html_e( 'At handover', 'nolan-young-theme-template-99-master' ); ?></span><strong><?php esc_html_e( 'Ownership transfer', 'nolan-young-theme-template-99-master' ); ?></strong></div>
			</div>
		</div>
	</div>
</section>
