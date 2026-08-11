<?php
/**
 * Services connected delivery workspace.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$service_tracks = array(
	array( '01', __( 'Strategy and direction', 'nolan-young-theme-template-99-master' ), __( 'Create a direction people can use.', 'nolan-young-theme-template-99-master' ), __( 'Research, stakeholder alignment, service framing, roadmap design, and measurable success criteria.', 'nolan-young-theme-template-99-master' ), __( '2–4 weeks', 'nolan-young-theme-template-99-master' ), __( 'Decision-ready roadmap', 'nolan-young-theme-template-99-master' ), array( __( 'Research', 'nolan-young-theme-template-99-master' ), __( 'Opportunity framing', 'nolan-young-theme-template-99-master' ), __( 'Roadmaps', 'nolan-young-theme-template-99-master' ) ) ),
	array( '02', __( 'Experience transformation', 'nolan-young-theme-template-99-master' ), __( 'Make complex journeys feel simple.', 'nolan-young-theme-template-99-master' ), __( 'Journey mapping, content architecture, interaction design, usability testing, and accessibility improvement.', 'nolan-young-theme-template-99-master' ), __( '4–8 weeks', 'nolan-young-theme-template-99-master' ), __( 'Validated experience system', 'nolan-young-theme-template-99-master' ), array( __( 'UX audits', 'nolan-young-theme-template-99-master' ), __( 'Prototypes', 'nolan-young-theme-template-99-master' ), __( 'Accessibility', 'nolan-young-theme-template-99-master' ) ) ),
	array( '03', __( 'WordPress engineering', 'nolan-young-theme-template-99-master' ), __( 'Build a platform the team can trust.', 'nolan-young-theme-template-99-master' ), __( 'Custom WordPress engineering, integrations, component systems, testing, and controlled release workflows.', 'nolan-young-theme-template-99-master' ), __( '6–12 weeks', 'nolan-young-theme-template-99-master' ), __( 'Maintainable production platform', 'nolan-young-theme-template-99-master' ), array( __( 'WordPress', 'nolan-young-theme-template-99-master' ), __( 'APIs', 'nolan-young-theme-template-99-master' ), __( 'Release systems', 'nolan-young-theme-template-99-master' ) ) ),
	array( '04', __( 'Technical stewardship', 'nolan-young-theme-template-99-master' ), __( 'Keep improving after launch.', 'nolan-young-theme-template-99-master' ), __( 'Performance, maintenance, observability, security support, experimentation, and capability transfer.', 'nolan-young-theme-template-99-master' ), __( 'Quarterly', 'nolan-young-theme-template-99-master' ), __( 'Controlled improvement rhythm', 'nolan-young-theme-template-99-master' ), array( __( 'Performance', 'nolan-young-theme-template-99-master' ), __( 'Maintenance', 'nolan-young-theme-template-99-master' ), __( 'Support', 'nolan-young-theme-template-99-master' ) ) ),
);
?>
<section id="capabilities" class="section section--cream">
	<div class="content-wrap">
		<header class="section__heading" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Connected delivery model', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Turn specialist work into one complete system.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p class="section__lede"><?php esc_html_e( 'The five specialist practices connect through four delivery lenses: direction, experience, engineering, and long-term stewardship.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>
		<div class="service-tabs" data-reveal>
			<div class="service-tabs__controls" role="tablist" aria-label="<?php esc_attr_e( 'Connected delivery tracks', 'nolan-young-theme-template-99-master' ); ?>">
				<?php foreach ( $service_tracks as $index => $track ) : ?>
					<button
						id="service-tab-<?php echo esc_attr( $track[0] ); ?>"
						role="tab"
						aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
						aria-controls="service-panel-<?php echo esc_attr( $track[0] ); ?>"
						tabindex="<?php echo 0 === $index ? '0' : '-1'; ?>"
					>
						<span><?php echo esc_html( $track[0] ); ?></span>
						<strong><?php echo esc_html( $track[1] ); ?></strong>
						<i aria-hidden="true">↗</i>
					</button>
				<?php endforeach; ?>
			</div>
			<div class="service-tabs__panels">
				<?php foreach ( $service_tracks as $index => $track ) : ?>
					<article
						id="service-panel-<?php echo esc_attr( $track[0] ); ?>"
						class="service-tabs__panel"
						role="tabpanel"
						aria-labelledby="service-tab-<?php echo esc_attr( $track[0] ); ?>"
					>
						<div class="service-tabs__panel-top">
							<span><?php esc_html_e( 'Delivery track', 'nolan-young-theme-template-99-master' ); ?></span>
							<span><?php echo esc_html( $track[0] ); ?> / 04</span>
						</div>
						<div class="service-tabs__panel-main">
							<div>
								<p class="eyebrow"><?php echo esc_html( $track[1] ); ?></p>
								<h3><?php echo esc_html( $track[2] ); ?></h3>
								<p><?php echo esc_html( $track[3] ); ?></p>
							</div>
							<div class="service-tabs__panel-diagram" aria-hidden="true"><i></i><i></i><i></i></div>
						</div>
						<dl>
							<div>
								<dt><?php esc_html_e( 'Typical duration', 'nolan-young-theme-template-99-master' ); ?></dt>
								<dd><?php echo esc_html( $track[4] ); ?></dd>
							</div>
							<div>
								<dt><?php esc_html_e( 'Primary outcome', 'nolan-young-theme-template-99-master' ); ?></dt>
								<dd><?php echo esc_html( $track[5] ); ?></dd>
							</div>
						</dl>
						<ul>
							<?php foreach ( $track[6] as $capability ) : ?>
								<li><?php echo esc_html( $capability ); ?></li>
							<?php endforeach; ?>
						</ul>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
