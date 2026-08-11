<?php
/**
 * Filterable work library.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$projects = array(
	array( 'Northline', 'A self-service customer portal that turned complex support into clear next actions.', 'Experience', 'experience', '−26%', 'support demand' ),
	array( 'Helio Grid', 'A decision platform that makes operational risk visible across distributed teams.', 'Platform', 'platform', '3.2×', 'faster analysis' ),
	array( 'Oak & Field', 'A portfolio strategy and identity system built for an expanding product family.', 'Strategy', 'strategy', '+38%', 'qualified demand' ),
	array( 'Atlas Health', 'An accessible care-navigation experience designed around real patient pressure.', 'Experience', 'experience', 'AA', 'accessibility' ),
	array( 'Common Thread', 'A composable publishing system supporting twelve markets from one core.', 'Platform', 'platform', '12', 'markets unified' ),
	array( 'Brightway', 'A category narrative and launch system that made a technical offer easy to buy.', 'Strategy', 'strategy', '9 wk', 'launch runway' ),
);
?>
<section class="section" id="project-library">
	<div class="content-wrap">
		<header class="section-heading section-heading--split" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Project library', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Different problems. The same standard of clarity.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p><?php esc_html_e( 'Filter this fictional portfolio by the capability that led the engagement.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>
		<div class="work-filter" role="group" aria-label="<?php esc_attr_e( 'Filter projects', 'nolan-young-theme-template-99-master' ); ?>" data-work-filters>
			<button class="is-active" type="button" aria-pressed="true" data-work-filter="all"><?php esc_html_e( 'All work', 'nolan-young-theme-template-99-master' ); ?></button>
			<button type="button" aria-pressed="false" data-work-filter="strategy"><?php esc_html_e( 'Strategy', 'nolan-young-theme-template-99-master' ); ?></button>
			<button type="button" aria-pressed="false" data-work-filter="experience"><?php esc_html_e( 'Experience', 'nolan-young-theme-template-99-master' ); ?></button>
			<button type="button" aria-pressed="false" data-work-filter="platform"><?php esc_html_e( 'Platform', 'nolan-young-theme-template-99-master' ); ?></button>
		</div>
		<div class="project-grid">
			<?php foreach ( $projects as $index => $project ) : ?>
				<article class="project-card" data-project-category="<?php echo esc_attr( $project[3] ); ?>" data-reveal>
					<div class="project-card__visual project-card__visual--<?php echo esc_attr( $project[3] ); ?>" aria-hidden="true">
						<span><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
						<i></i><i></i><i></i>
					</div>
					<div class="project-card__body">
						<div class="project-card__topline"><span><?php echo esc_html( $project[2] ); ?></span><span><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?> / 06</span></div>
						<h3><?php echo esc_html( $project[0] ); ?></h3>
						<p><?php echo esc_html( $project[1] ); ?></p>
						<div class="project-card__result"><div><strong><?php echo esc_html( $project[4] ); ?></strong><span><?php echo esc_html( $project[5] ); ?></span></div><span class="project-card__status"><?php esc_html_e( 'Project snapshot', 'nolan-young-theme-template-99-master' ); ?></span></div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<p class="work-filter__empty" data-work-empty aria-live="polite" hidden><?php esc_html_e( 'No projects match this filter.', 'nolan-young-theme-template-99-master' ); ?></p>
	</div>
</section>
