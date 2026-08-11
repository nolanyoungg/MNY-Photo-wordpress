<?php
/**
 * Contact next-step process.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$steps = array(
	array( '01', 'Context review', 'A senior lead reads the brief, identifies the consequential unknowns, and prepares a focused response.', 'Brief annotated' ),
	array( '02', 'Fit session', 'A 30-minute working conversation tests the problem, desired outcome, decision owners, and constraints.', 'Signal clarified' ),
	array( '03', 'Recommended move', 'You receive an engagement shape with the right sequence, roles, artifacts, and decision point.', 'Path proposed' ),
	array( '04', 'Confident start', 'If the fit is right, we align the working team and begin with evidence instead of kickoff theater.', 'Work activated' ),
);
?>
<section class="section section--cream contact-next">
	<div class="content-wrap">
		<header class="section-heading section-heading--split" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'After you make contact', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'From first signal to a confident start.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p><?php esc_html_e( 'The process is intentionally lightweight, but every step produces something useful—even if we decide not to work together.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>
		<ol class="contact-next__timeline">
			<?php foreach ( $steps as $index => $step ) : ?>
				<li data-reveal>
					<div class="contact-next__marker">
						<span><?php echo esc_html( $step[0] ); ?></span>
						<?php if ( count( $steps ) - 1 !== $index ) : ?>
							<i aria-hidden="true"></i>
						<?php endif; ?>
					</div>
					<article>
						<header>
							<small><?php echo esc_html( $step[3] ); ?></small>
							<span aria-hidden="true">↗</span>
						</header>
						<h3><?php echo esc_html( $step[1] ); ?></h3>
						<p><?php echo esc_html( $step[2] ); ?></p>
					</article>
				</li>
			<?php endforeach; ?>
		</ol>
		<div class="contact-next__promise" data-reveal>
			<strong><?php esc_html_e( 'Our promise', 'nolan-young-theme-template-99-master' ); ?></strong>
			<p><?php esc_html_e( 'If another specialist, sequence, or starting point would serve you better, we will say so clearly.', 'nolan-young-theme-template-99-master' ); ?></p>
		</div>
	</div>
</section>
