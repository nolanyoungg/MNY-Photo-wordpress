<?php
/**
 * Capability to outcome matrix.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$rows = array(
	array( 'Positioning and portfolio strategy', 'Leadership alignment', 'A clear investment story', 'Decision brief' ),
	array( 'Experience and service design', 'Lower customer friction', 'Higher task completion', 'Validated journey' ),
	array( 'Design systems and platforms', 'Faster coordinated delivery', 'Consistent global quality', 'Component system' ),
	array( 'Measurement and optimization', 'Evidence-led decisions', 'Compounding performance', 'Improvement scorecard' ),
);
?>
<section class="section">
	<div class="content-wrap">
		<header class="section-heading" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Capability to outcome', 'nolan-young-theme-template-99-master' ); ?></p>
			<h2><?php esc_html_e( 'Every deliverable has a job beyond looking finished.', 'nolan-young-theme-template-99-master' ); ?></h2>
		</header>
		<div class="outcome-matrix" data-reveal>
			<div class="outcome-matrix__header"><span><?php esc_html_e( 'Capability', 'nolan-young-theme-template-99-master' ); ?></span><span><?php esc_html_e( 'Operational value', 'nolan-young-theme-template-99-master' ); ?></span><span><?php esc_html_e( 'Business signal', 'nolan-young-theme-template-99-master' ); ?></span><span><?php esc_html_e( 'Evidence artifact', 'nolan-young-theme-template-99-master' ); ?></span></div>
			<?php foreach ( $rows as $row ) : ?>
				<div class="outcome-matrix__row">
					<strong><?php echo esc_html( $row[0] ); ?></strong>
					<span><?php echo esc_html( $row[1] ); ?></span>
					<span><?php echo esc_html( $row[2] ); ?></span>
					<span><?php echo esc_html( $row[3] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
