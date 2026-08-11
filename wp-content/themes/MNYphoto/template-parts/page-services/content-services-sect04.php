<?php
/**
 * Services technology and assurance system.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$assurances = array(
	array( '01', __( 'Accessible', 'nolan-young-theme-template-99-master' ), __( 'WCAG-aware patterns, semantic foundations, and verified keyboard paths.', 'nolan-young-theme-template-99-master' ), 'AA' ),
	array( '02', __( 'Performant', 'nolan-young-theme-template-99-master' ), __( 'Lean assets, measurable budgets, and user-centered performance targets.', 'nolan-young-theme-template-99-master' ), '<2.5s' ),
	array( '03', __( 'Integrated', 'nolan-young-theme-template-99-master' ), __( 'Explicit contracts and graceful failure between essential systems.', 'nolan-young-theme-template-99-master' ), 'API' ),
	array( '04', __( 'Observable', 'nolan-young-theme-template-99-master' ), __( 'Signals that support useful operational and product decisions.', 'nolan-young-theme-template-99-master' ), '24/7' ),
	array( '05', __( 'Maintainable', 'nolan-young-theme-template-99-master' ), __( 'Documented systems, controlled releases, and ownership your team can sustain.', 'nolan-young-theme-template-99-master' ), 'OWN' ),
	array( '06', __( 'Supported', 'nolan-young-theme-template-99-master' ), __( 'Clear escalation, response expectations, and improvement planning after launch.', 'nolan-young-theme-template-99-master' ), 'SLA' ),
);
?>
<section class="section section--navy">
	<div class="content-wrap assurance-system">
		<header class="section__heading" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Quality built in', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Every interaction should pull its weight.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p class="section__lede"><?php esc_html_e( 'The platform is treated as an operating system: usable, observable, maintainable, and ready to evolve.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>
		<div class="assurance-system__grid" data-reveal>
			<?php foreach ( $assurances as $assurance ) : ?>
				<article>
					<div>
						<span><?php echo esc_html( $assurance[0] ); ?></span>
						<strong><?php echo esc_html( $assurance[3] ); ?></strong>
					</div>
					<h3><?php echo esc_html( $assurance[1] ); ?></h3>
					<p><?php echo esc_html( $assurance[2] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
		<footer class="assurance-system__footer" data-reveal>
			<span><?php esc_html_e( 'Delivery standard', 'nolan-young-theme-template-99-master' ); ?></span>
			<strong><?php esc_html_e( 'Accessibility, performance, testing, and documentation are release criteria—not optional extras.', 'nolan-young-theme-template-99-master' ); ?></strong>
		</footer>
	</div>
</section>
