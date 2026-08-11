<?php
/**
 * Services engagement comparison.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$models = array(
	array( __( 'Diagnostic', 'nolan-young-theme-template-99-master' ), __( '2–3 weeks', 'nolan-young-theme-template-99-master' ), __( 'One high-value decision', 'nolan-young-theme-template-99-master' ), __( 'Evidence review, stakeholder sessions, opportunity map, and prioritized next steps.', 'nolan-young-theme-template-99-master' ) ),
	array( __( 'Delivery sprint', 'nolan-young-theme-template-99-master' ), __( '6–10 weeks', 'nolan-young-theme-template-99-master' ), __( 'One focused release', 'nolan-young-theme-template-99-master' ), __( 'A complete cross-functional team delivering a product, service, or platform release.', 'nolan-young-theme-template-99-master' ) ),
	array( __( 'Strategic partnership', 'nolan-young-theme-template-99-master' ), __( 'Quarterly', 'nolan-young-theme-template-99-master' ), __( 'A shared transformation roadmap', 'nolan-young-theme-template-99-master' ), __( 'Ongoing planning, delivery, optimization, and internal capability support.', 'nolan-young-theme-template-99-master' ) ),
);
?>
<section class="section section--cool">
	<div class="content-wrap engagement-models">
		<header class="section__heading" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Flexible engagement', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'The right level of support for the decision ahead.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p class="section__lede"><?php esc_html_e( 'Start focused, scale when the evidence supports it, and keep ownership and decision rights visible throughout.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>
		<div class="engagement-models__table" data-reveal>
			<div class="engagement-models__labels">
				<span><?php esc_html_e( 'Model', 'nolan-young-theme-template-99-master' ); ?></span>
				<span><?php esc_html_e( 'Cadence', 'nolan-young-theme-template-99-master' ); ?></span>
				<span><?php esc_html_e( 'Best for', 'nolan-young-theme-template-99-master' ); ?></span>
				<span><?php esc_html_e( 'What it includes', 'nolan-young-theme-template-99-master' ); ?></span>
			</div>
			<?php foreach ( $models as $index => $model ) : ?>
				<article>
					<span><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
					<h3><?php echo esc_html( $model[0] ); ?></h3>
					<strong><?php echo esc_html( $model[1] ); ?></strong>
					<p><?php echo esc_html( $model[2] ); ?></p>
					<p><?php echo esc_html( $model[3] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="engagement-models__note" data-reveal>
			<span><?php esc_html_e( 'Not sure where to start?', 'nolan-young-theme-template-99-master' ); ?></span>
			<strong><?php esc_html_e( 'Most complex programs begin with the diagnostic.', 'nolan-young-theme-template-99-master' ); ?></strong>
			<a class="text-link" href="<?php echo esc_url( nytt99_page_url( 'contact-us' ) ); ?>">
				<?php esc_html_e( 'Discuss the entry point', 'nolan-young-theme-template-99-master' ); ?>
				<span aria-hidden="true">→</span>
			</a>
		</div>
	</div>
</section>
