<?php
/**
 * Services engagement FAQ.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$questions = array(
	array( __( 'How does an engagement begin?', 'nolan-young-theme-template-99-master' ), __( 'With a focused conversation, a short evidence review, and a shared view of the first useful decision. The initial scope is deliberately small enough to validate before larger delivery begins.', 'nolan-young-theme-template-99-master' ) ),
	array( __( 'Can the team work alongside internal specialists?', 'nolan-young-theme-template-99-master' ), __( 'Yes. Responsibilities, decision rights, working rhythms, and handoffs are made explicit from the beginning so internal expertise remains central.', 'nolan-young-theme-template-99-master' ) ),
	array( __( 'Can strategy continue through implementation?', 'nolan-young-theme-template-99-master' ), __( 'Yes. The connected model supports research, design, WordPress engineering, launch, measurement, and improvement without replacing the team at each stage.', 'nolan-young-theme-template-99-master' ) ),
	array( __( 'What does success measurement include?', 'nolan-young-theme-template-99-master' ), __( 'A focused set of adoption, completion, quality, and operational measures tied to the original business objective and observable after launch.', 'nolan-young-theme-template-99-master' ) ),
	array( __( 'What is needed from our organization?', 'nolan-young-theme-template-99-master' ), __( 'Access to the right decision-makers, representative users or evidence, timely feedback, and a shared willingness to keep constraints and tradeoffs visible.', 'nolan-young-theme-template-99-master' ) ),
);
?>
<section class="section section--cream">
	<div class="content-wrap services-faq">
		<header class="services-faq__intro" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Practical answers', 'nolan-young-theme-template-99-master' ); ?></p>
			<h2><?php esc_html_e( 'Know what the engagement will feel like.', 'nolan-young-theme-template-99-master' ); ?></h2>
			<p><?php esc_html_e( 'Clear expectations are part of the delivery system. These are the questions teams usually need answered before work begins.', 'nolan-young-theme-template-99-master' ); ?></p>
			<div><span><?php esc_html_e( 'Response time', 'nolan-young-theme-template-99-master' ); ?></span><strong><?php esc_html_e( 'Usually within two working days', 'nolan-young-theme-template-99-master' ); ?></strong></div>
		</header>
		<div class="faq-list" data-reveal>
			<?php foreach ( $questions as $index => $question ) : ?>
				<details <?php echo 0 === $index ? 'open' : ''; ?>>
					<summary>
						<span><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
						<?php echo esc_html( $question[0] ); ?>
					</summary>
					<p><?php echo esc_html( $question[1] ); ?></p>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
