<?php
/**
 * Work results dashboard.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;
?>
<section id="portfolio-results" class="section section--navy results-band">
	<div class="content-wrap">
		<header class="section-heading section-heading--split" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Portfolio signal', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Outcomes that survive the launch deck.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p><?php esc_html_e( 'Illustrative metrics show how we frame success: commercially useful, operationally real, and measured over time.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>
		<div class="results-dashboard" data-reveal>
			<div class="metric-card">
				<strong data-metric="34" data-prefix="+" data-suffix="%">+34%</strong>
				<span><?php esc_html_e( 'average conversion lift', 'nolan-young-theme-template-99-master' ); ?></span>
				<i style="--progress: 74%"></i>
			</div>
			<div class="metric-card"><strong data-metric="41" data-suffix="%">41%</strong><span><?php esc_html_e( 'faster publishing', 'nolan-young-theme-template-99-master' ); ?></span><i style="--progress: 82%"></i></div>
			<div class="metric-card"><strong data-metric="97" data-suffix="/100">97/100</strong><span><?php esc_html_e( 'performance score', 'nolan-young-theme-template-99-master' ); ?></span><i style="--progress: 97%"></i></div>
			<div class="metric-card">
				<strong data-metric="12" data-suffix=" wk">12 wk</strong>
				<span><?php esc_html_e( 'median first release', 'nolan-young-theme-template-99-master' ); ?></span>
				<i style="--progress: 64%"></i>
			</div>
		</div>
		<div class="results-dashboard__method" data-reveal>
			<span><?php esc_html_e( 'How outcomes are framed', 'nolan-young-theme-template-99-master' ); ?></span>
			<strong><?php esc_html_e( 'Baseline → intervention → observed change → ownership', 'nolan-young-theme-template-99-master' ); ?></strong>
			<span><?php esc_html_e( 'Illustrative portfolio data', 'nolan-young-theme-template-99-master' ); ?></span>
		</div>
	</div>
</section>
