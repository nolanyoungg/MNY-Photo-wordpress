<?php
/**
 * PPC audience problems and business impact.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$problems = array(
	array( '01', 'Message discontinuity', 'The media promise and landing-page story drift apart, creating doubt at the most expensive moment.', 'High bounce', 'Intent is lost' ),
	array( '02', 'Evidence arrives too late', 'Proof sits below the decision point while buyers are still deciding whether the offer is credible for them.', 'Weak progression', 'Confidence is lost' ),
	array( '03', 'Signal without meaning', 'Channel, page, CRM, and sales feedback never become one trustworthy view of qualified demand.', 'Flat performance', 'Learning is lost' ),
);
?>
<section class="section section--cream ppc-problems">
	<div class="content-wrap">
		<header class="section-heading section-heading--split" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'The expensive space after the click', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Media cannot rescue a disconnected buying journey.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p><?php esc_html_e( 'The real waste usually begins after acquisition: unclear value, generic evidence, slow experiences, and measurement that rewards activity instead of opportunity.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>
		<div class="ppc-problem-grid">
			<?php foreach ( $problems as $problem ) : ?>
				<article class="ppc-problem" data-reveal>
					<header>
						<span><?php echo esc_html( $problem[0] ); ?></span>
						<small><?php echo esc_html( $problem[3] ); ?></small>
					</header>
					<div class="ppc-problem__visual" aria-hidden="true">
						<span></span><span></span><span></span>
						<i></i>
					</div>
					<h3><?php echo esc_html( $problem[1] ); ?></h3>
					<p><?php echo esc_html( $problem[2] ); ?></p>
					<footer>
						<span><?php esc_html_e( 'Business effect', 'nolan-young-theme-template-99-master' ); ?></span>
						<strong><?php echo esc_html( $problem[4] ); ?></strong>
					</footer>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="ppc-problems__equation" data-reveal>
			<div><span><?php esc_html_e( 'Paid intent', 'nolan-young-theme-template-99-master' ); ?></span><strong><?php esc_html_e( 'Expensive', 'nolan-young-theme-template-99-master' ); ?></strong></div>
			<i aria-hidden="true">×</i>
			<div><span><?php esc_html_e( 'Disconnected journey', 'nolan-young-theme-template-99-master' ); ?></span><strong><?php esc_html_e( 'Uncertain', 'nolan-young-theme-template-99-master' ); ?></strong></div>
			<i aria-hidden="true">=</i>
			<div><span><?php esc_html_e( 'Commercial signal', 'nolan-young-theme-template-99-master' ); ?></span><strong><?php esc_html_e( 'Unreliable', 'nolan-young-theme-template-99-master' ); ?></strong></div>
		</div>
	</div>
</section>
