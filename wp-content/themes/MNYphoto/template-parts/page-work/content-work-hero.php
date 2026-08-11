<?php
/**
 * Work page hero.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="hero hero--work">
	<div class="content-wrap work-hero">
		<div class="work-hero__content" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Selected work / measurable change', 'nolan-young-theme-template-99-master' ); ?></p>
			<h1><?php esc_html_e( 'Digital work built to move the business forward.', 'nolan-young-theme-template-99-master' ); ?></h1>
			<p class="hero__lede"><?php esc_html_e( 'Explore fictional enterprise transformations that connect customer insight, decisive design, and durable technology.', 'nolan-young-theme-template-99-master' ); ?></p>
			<div class="button-row">
				<a class="button button--quiet" href="#project-library"><span><?php esc_html_e( 'Explore the work', 'nolan-young-theme-template-99-master' ); ?></span><span aria-hidden="true">↓</span></a>
				<a class="text-link" href="<?php echo esc_url( nytt99_page_url( 'contact-us' ) ); ?>"><?php esc_html_e( 'Start a project', 'nolan-young-theme-template-99-master' ); ?><span aria-hidden="true">↗</span></a>
			</div>
			<div class="work-hero__scope"><span><?php esc_html_e( 'Strategy', 'nolan-young-theme-template-99-master' ); ?></span><span><?php esc_html_e( 'Experience', 'nolan-young-theme-template-99-master' ); ?></span><span><?php esc_html_e( 'Platform', 'nolan-young-theme-template-99-master' ); ?></span></div>
		</div>
		<div class="case-preview" data-reveal>
			<div class="case-preview__topline">
				<span><?php esc_html_e( 'Flagship case', 'nolan-young-theme-template-99-master' ); ?></span>
				<span class="status-pill"><?php esc_html_e( 'Platform live', 'nolan-young-theme-template-99-master' ); ?></span>
			</div>
			<div class="case-preview__interface" aria-hidden="true">
				<aside><span></span><span></span><span></span></aside>
				<div><span></span><span></span><span></span><strong>4.8×</strong></div>
			</div>
			<h2><?php esc_html_e( 'A unified commerce system for a global operator.', 'nolan-young-theme-template-99-master' ); ?></h2>
			<p><?php esc_html_e( 'One customer model, twelve markets, and a controlled publishing system.', 'nolan-young-theme-template-99-master' ); ?></p>
			<div class="metric-row">
				<div><strong data-metric="42" data-suffix="%">42%</strong><span><?php esc_html_e( 'faster journeys', 'nolan-young-theme-template-99-master' ); ?></span></div>
				<div><strong data-metric="31" data-suffix="%">31%</strong><span><?php esc_html_e( 'conversion lift', 'nolan-young-theme-template-99-master' ); ?></span></div>
				<div><strong data-metric="18" data-suffix=" wk">18 wk</strong><span><?php esc_html_e( 'to launch', 'nolan-young-theme-template-99-master' ); ?></span></div>
			</div>
		</div>
	</div>
</section>
