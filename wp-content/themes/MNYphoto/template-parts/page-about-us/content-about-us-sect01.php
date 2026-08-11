<?php
/**
 * About company timeline.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$milestones = array(
	array( '2018', __( 'Independent start', 'nolan-young-theme-template-99-master' ), __( 'A focused design and technology practice begins with one principle: clarity is generous.', 'nolan-young-theme-template-99-master' ), __( 'Design practice established', 'nolan-young-theme-template-99-master' ) ),
	array( '2020', __( 'Connected delivery', 'nolan-young-theme-template-99-master' ), __( 'Strategy and engineering become one visible system instead of separate handoffs.', 'nolan-young-theme-template-99-master' ), __( 'One cross-functional model', 'nolan-young-theme-template-99-master' ) ),
	array( '2023', __( 'Enterprise scale', 'nolan-young-theme-template-99-master' ), __( 'The work expands across complex platforms, regulated teams, and long-lived services.', 'nolan-young-theme-template-99-master' ), __( 'Complex programs supported', 'nolan-young-theme-template-99-master' ) ),
	array( '2026', __( 'Future capability', 'nolan-young-theme-template-99-master' ), __( 'Research, automation, and stronger delivery intelligence shape the next chapter.', 'nolan-young-theme-template-99-master' ), __( 'Research program active', 'nolan-young-theme-template-99-master' ) ),
);
?>
<section id="story" class="section section--cream">
	<div class="content-wrap company-story">
		<header class="section__heading" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'The story so far', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Built around clarity, craft, and operational reality.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p class="section__lede"><?php esc_html_e( 'The practice grew by staying close to the decisions that determine whether enterprise work succeeds after the launch deck.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>
		<div class="company-story__timeline" data-reveal>
			<?php foreach ( $milestones as $index => $milestone ) : ?>
				<article>
					<div><time><?php echo esc_html( $milestone[0] ); ?></time><span><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span></div>
					<h3><?php echo esc_html( $milestone[1] ); ?></h3>
					<p><?php echo esc_html( $milestone[2] ); ?></p>
					<strong><?php echo esc_html( $milestone[3] ); ?></strong>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
