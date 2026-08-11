<?php
/**
 * PPC implementation timeline.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$weeks = array(
	array( 'Week 01', 'Diagnose', 'Align the growth target, audience signals, analytics, creative, and current landing journey.', array( 'Signal audit', 'Journey map' ), 'Decision frame' ),
	array( 'Weeks 02–03', 'Design', 'Build the message system, conversion experience, measurement plan, and prioritized test backlog.', array( 'Page prototype', 'Event model' ), 'Experience approved' ),
	array( 'Weeks 04–05', 'Launch', 'Release the first experience, verify signal quality, and establish the operating dashboard.', array( 'Live journey', 'Quality dashboard' ), 'Signal verified' ),
	array( 'Week 06+', 'Optimize', 'Prioritize evidence-led tests and compound learning across media, experience, and sales.', array( 'Test readout', 'Learning library' ), 'System compounding' ),
);
?>
<section class="section section--cream ppc-timeline">
	<div class="content-wrap">
		<header class="section-heading section-heading--split" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Six-week activation path', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'From fragmented signals to a live learning system.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p><?php esc_html_e( 'A clear sequence gets the first high-value experience live quickly without confusing speed with skipped thinking.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>
		<ol class="ppc-timeline__track">
			<?php foreach ( $weeks as $index => $week ) : ?>
				<li data-reveal>
					<div class="ppc-timeline__rail">
						<span><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<?php if ( count( $weeks ) - 1 !== $index ) : ?>
							<i aria-hidden="true"></i>
						<?php endif; ?>
					</div>
					<article>
						<header>
							<small><?php echo esc_html( $week[0] ); ?></small>
							<strong><?php echo esc_html( $week[4] ); ?></strong>
						</header>
						<h3><?php echo esc_html( $week[1] ); ?></h3>
						<p><?php echo esc_html( $week[2] ); ?></p>
						<ul>
							<?php foreach ( $week[3] as $artifact ) : ?>
								<li><?php echo esc_html( $artifact ); ?></li>
							<?php endforeach; ?>
						</ul>
					</article>
				</li>
			<?php endforeach; ?>
		</ol>
		<div class="ppc-timeline__handoff" data-reveal>
			<span><?php esc_html_e( 'Built to transfer', 'nolan-young-theme-template-99-master' ); ?></span>
			<p><?php esc_html_e( 'Your team leaves with the system, working artifacts, decision logic, and a repeatable optimization rhythm.', 'nolan-young-theme-template-99-master' ); ?></p>
		</div>
	</div>
</section>
