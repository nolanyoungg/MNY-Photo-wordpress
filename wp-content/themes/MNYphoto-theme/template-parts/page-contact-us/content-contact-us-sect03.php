<?php
/**
 * Contact coverage and availability.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section section--navy contact-coverage">
	<div class="content-wrap contact-coverage__layout">
		<div class="contact-coverage__content" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Distributed studio / close collaboration', 'nolan-young-theme-template-99-master' ); ?></p>
			<h2><?php esc_html_e( 'Built for deep work across locations.', 'nolan-young-theme-template-99-master' ); ?></h2>
			<p><?php esc_html_e( 'We organize the cadence around decisions: concentrated working sessions when alignment matters, visible asynchronous progress between them, and onsite moments when the room changes the result.', 'nolan-young-theme-template-99-master' ); ?></p>
			<div class="contact-coverage__status">
				<span class="availability-dot" aria-hidden="true"></span>
				<div>
					<strong><?php esc_html_e( 'Eastern-time core', 'nolan-young-theme-template-99-master' ); ?></strong>
					<small><?php esc_html_e( 'Flexible overlap for North America and Europe', 'nolan-young-theme-template-99-master' ); ?></small>
				</div>
			</div>
		</div>
		<div class="coverage-map" data-reveal role="img" aria-label="<?php esc_attr_e( 'Illustrative collaboration network connecting New York, Austin, London, and Berlin', 'nolan-young-theme-template-99-master' ); ?>">
			<div class="coverage-map__grid" aria-hidden="true"></div>
			<svg viewBox="0 0 760 360" aria-hidden="true" focusable="false">
				<path d="M90 230C194 208 219 115 350 168S530 101 674 142" />
				<path d="M90 230C230 282 392 275 674 142" />
				<circle cx="90" cy="230" r="9" />
				<circle cx="350" cy="168" r="9" />
				<circle cx="526" cy="137" r="9" />
				<circle cx="674" cy="142" r="9" />
			</svg>
			<span class="coverage-map__label coverage-map__label--ny"><?php esc_html_e( 'New York', 'nolan-young-theme-template-99-master' ); ?></span>
			<span class="coverage-map__label coverage-map__label--tx"><?php esc_html_e( 'Austin', 'nolan-young-theme-template-99-master' ); ?></span>
			<span class="coverage-map__label coverage-map__label--uk"><?php esc_html_e( 'London', 'nolan-young-theme-template-99-master' ); ?></span>
			<span class="coverage-map__label coverage-map__label--de"><?php esc_html_e( 'Berlin', 'nolan-young-theme-template-99-master' ); ?></span>
			<footer>
				<span><?php esc_html_e( 'Collaboration window', 'nolan-young-theme-template-99-master' ); ?></span>
				<strong><?php esc_html_e( '14:00–18:00 UTC', 'nolan-young-theme-template-99-master' ); ?></strong>
				<small><?php esc_html_e( 'Core overlap', 'nolan-young-theme-template-99-master' ); ?></small>
			</footer>
		</div>
		<dl class="coverage-facts" data-reveal>
			<div>
				<dt><?php esc_html_e( 'Coverage', 'nolan-young-theme-template-99-master' ); ?></dt>
				<dd><?php esc_html_e( 'North America + Europe', 'nolan-young-theme-template-99-master' ); ?></dd>
				<span><?php esc_html_e( 'Other regions by project', 'nolan-young-theme-template-99-master' ); ?></span>
			</div>
			<div>
				<dt><?php esc_html_e( 'Working rhythm', 'nolan-young-theme-template-99-master' ); ?></dt>
				<dd><?php esc_html_e( 'Focused + asynchronous', 'nolan-young-theme-template-99-master' ); ?></dd>
				<span><?php esc_html_e( 'No calendar theater', 'nolan-young-theme-template-99-master' ); ?></span>
			</div>
			<div>
				<dt><?php esc_html_e( 'Response standard', 'nolan-young-theme-template-99-master' ); ?></dt>
				<dd><?php esc_html_e( 'Two business days', 'nolan-young-theme-template-99-master' ); ?></dd>
				<span><?php esc_html_e( 'Usually sooner', 'nolan-young-theme-template-99-master' ); ?></span>
			</div>
			<div>
				<dt><?php esc_html_e( 'Engagement mode', 'nolan-young-theme-template-99-master' ); ?></dt>
				<dd><?php esc_html_e( 'Remote + key onsite', 'nolan-young-theme-template-99-master' ); ?></dd>
				<span><?php esc_html_e( 'Designed around the work', 'nolan-young-theme-template-99-master' ); ?></span>
			</div>
		</dl>
	</div>
</section>
