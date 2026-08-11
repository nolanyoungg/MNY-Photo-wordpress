<?php
/**
 * About operating principles.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$principles = array(
	array( '01', __( 'Clarity', 'nolan-young-theme-template-99-master' ), __( 'Make the decision visible.', 'nolan-young-theme-template-99-master' ), __( 'Name what matters, what is constrained, and what evidence will change the choice.', 'nolan-young-theme-template-99-master' ), __( 'Fewer reversals', 'nolan-young-theme-template-99-master' ) ),
	array( '02', __( 'Utility', 'nolan-young-theme-template-99-master' ), __( 'Make it useful.', 'nolan-young-theme-template-99-master' ), __( 'Every polished idea should help a customer or colleague do something better.', 'nolan-young-theme-template-99-master' ), __( 'Higher adoption', 'nolan-young-theme-template-99-master' ) ),
	array( '03', __( 'Ownership', 'nolan-young-theme-template-99-master' ), __( 'Leave capability behind.', 'nolan-young-theme-template-99-master' ), __( 'The internal team should understand, maintain, and improve the system after handover.', 'nolan-young-theme-template-99-master' ), __( 'Durable autonomy', 'nolan-young-theme-template-99-master' ) ),
	array( '04', __( 'Evidence', 'nolan-young-theme-template-99-master' ), __( 'Test the risky thing first.', 'nolan-young-theme-template-99-master' ), __( 'Early evidence is more valuable than late certainty.', 'nolan-young-theme-template-99-master' ), __( 'Controlled risk', 'nolan-young-theme-template-99-master' ) ),
	array( '05', __( 'Care', 'nolan-young-theme-template-99-master' ), __( 'Details are operational.', 'nolan-young-theme-template-99-master' ), __( 'Accessibility, performance, documentation, and release quality are part of the product.', 'nolan-young-theme-template-99-master' ), __( 'Reliable quality', 'nolan-young-theme-template-99-master' ) ),
);
?>
<section id="values" class="section section--cool">
	<div class="content-wrap principles">
		<header class="section__heading" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Operating principles', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Standards that survive real delivery pressure.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p class="section__lede"><?php esc_html_e( 'Useful principles show up in how evidence is handled, decisions are made, and ownership is transferred.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>
		<div class="principles__grid">
			<?php foreach ( $principles as $index => $principle ) : ?>
				<article class="<?php echo 0 === $index ? 'principle-card principle-card--lead' : 'principle-card'; ?>" data-reveal>
					<header><span><?php echo esc_html( $principle[0] ); ?></span><strong><?php echo esc_html( $principle[1] ); ?></strong></header>
					<h3><?php echo esc_html( $principle[2] ); ?></h3>
					<p><?php echo esc_html( $principle[3] ); ?></p>
					<footer><span><?php esc_html_e( 'What changes', 'nolan-young-theme-template-99-master' ); ?></span><strong><?php echo esc_html( $principle[4] ); ?></strong></footer>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
