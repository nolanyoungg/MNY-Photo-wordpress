<?php
/**
 * PPC campaign solution stack.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$layers = array(
	array( '01', 'Intent architecture', 'Map audience pressure, query language, offer logic, and decision-stage evidence.', array( 'Audience signal map', 'Offer hierarchy', 'Message continuity' ), 'Clarity' ),
	array( '02', 'Conversion experience', 'Design fast, accessible landing paths with a coherent narrative and deliberate actions.', array( 'Page system', 'Proof architecture', 'Interaction model' ), 'Confidence' ),
	array( '03', 'Measurement design', 'Connect media, behavior, CRM, and qualified pipeline signals to one operating view.', array( 'Event model', 'Quality scoring', 'Decision dashboard' ), 'Truth' ),
	array( '04', 'Optimization rhythm', 'Run focused experiments, capture learning, and feed results back into media and sales.', array( 'Test backlog', 'Weekly readout', 'Learning library' ), 'Momentum' ),
);
?>
<section class="section ppc-system">
	<div class="content-wrap ppc-system__layout">
		<header class="ppc-system__intro" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'One connected demand system', 'nolan-young-theme-template-99-master' ); ?></p>
			<h2><?php esc_html_e( 'Four layers. One commercial signal.', 'nolan-young-theme-template-99-master' ); ?></h2>
			<p><?php esc_html_e( 'The campaign, experience, measurement, and operating rhythm are designed together—not passed between isolated teams after the important decisions have already been made.', 'nolan-young-theme-template-99-master' ); ?></p>
			<div class="ppc-system__key">
				<span><?php esc_html_e( 'Input', 'nolan-young-theme-template-99-master' ); ?></span>
				<i></i>
				<span><?php esc_html_e( 'System', 'nolan-young-theme-template-99-master' ); ?></span>
				<i></i>
				<span><?php esc_html_e( 'Learning', 'nolan-young-theme-template-99-master' ); ?></span>
			</div>
		</header>
		<ol class="ppc-stack">
			<?php foreach ( $layers as $layer ) : ?>
				<li data-reveal>
					<header>
						<span><?php echo esc_html( $layer[0] ); ?></span>
						<small><?php echo esc_html( $layer[4] ); ?></small>
					</header>
					<div class="ppc-stack__content">
						<h3><?php echo esc_html( $layer[1] ); ?></h3>
						<p><?php echo esc_html( $layer[2] ); ?></p>
					</div>
					<ul>
						<?php foreach ( $layer[3] as $artifact ) : ?>
							<li><?php echo esc_html( $artifact ); ?></li>
						<?php endforeach; ?>
					</ul>
					<div class="ppc-stack__signal" aria-hidden="true">
						<i></i><i></i><i></i>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
