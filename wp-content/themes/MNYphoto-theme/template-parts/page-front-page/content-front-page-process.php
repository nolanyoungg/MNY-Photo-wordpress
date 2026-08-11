<?php
/**
 * Front-page connected delivery roadmap.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$phases = array(
	array(
		'verb'     => __( 'Frame', 'nolan-young-theme-template-99-master' ),
		'title'    => __( 'Find the decision beneath the request.', 'nolan-young-theme-template-99-master' ),
		'copy'     => __( 'Align the pressure, evidence, constraints, and definition of useful change before prescribing a solution.', 'nolan-young-theme-template-99-master' ),
		'artifact' => __( 'Decision brief', 'nolan-young-theme-template-99-master' ),
		'signal'   => __( 'Shared direction', 'nolan-young-theme-template-99-master' ),
	),
	array(
		'verb'     => __( 'Shape', 'nolan-young-theme-template-99-master' ),
		'title'    => __( 'Make the direction tangible early.', 'nolan-young-theme-template-99-master' ),
		'copy'     => __( 'Prototype the connected experience, challenge assumptions, and resolve the risks that matter most.', 'nolan-young-theme-template-99-master' ),
		'artifact' => __( 'Validated prototype', 'nolan-young-theme-template-99-master' ),
		'signal'   => __( 'Tested intent', 'nolan-young-theme-template-99-master' ),
	),
	array(
		'verb'     => __( 'Build', 'nolan-young-theme-template-99-master' ),
		'title'    => __( 'Turn clarity into an owned system.', 'nolan-young-theme-template-99-master' ),
		'copy'     => __( 'Deliver with accessibility, performance, quality, and long-term stewardship designed into the work.', 'nolan-young-theme-template-99-master' ),
		'artifact' => __( 'Production system', 'nolan-young-theme-template-99-master' ),
		'signal'   => __( 'Confident release', 'nolan-young-theme-template-99-master' ),
	),
	array(
		'verb'     => __( 'Evolve', 'nolan-young-theme-template-99-master' ),
		'title'    => __( 'Keep the next move evidence-led.', 'nolan-young-theme-template-99-master' ),
		'copy'     => __( 'Observe real use, remove friction, and give the team a dependable rhythm for continuous improvement.', 'nolan-young-theme-template-99-master' ),
		'artifact' => __( 'Improvement rhythm', 'nolan-young-theme-template-99-master' ),
		'signal'   => __( 'Durable momentum', 'nolan-young-theme-template-99-master' ),
	),
);
?>
<section id="delivery-process" class="delivery-sequence section" data-home-chapter>
	<div class="delivery-sequence__mesh" aria-hidden="true"></div>
	<div class="content-wrap">
		<header class="delivery-heading" data-reveal>
			<div class="delivery-heading__meta">
				<span>04 / <?php esc_html_e( 'Delivery system', 'nolan-young-theme-template-99-master' ); ?></span>
				<strong><?php esc_html_e( 'Four inspectable phases / No black box', 'nolan-young-theme-template-99-master' ); ?></strong>
			</div>
			<div class="delivery-heading__copy">
				<h2><?php esc_html_e( 'Clarity moves forward. Ownership stays with you.', 'nolan-young-theme-template-99-master' ); ?></h2>
				<p><?php esc_html_e( 'Each phase resolves a different kind of uncertainty and leaves behind something useful your team can inspect, question, and carry into the next decision.', 'nolan-young-theme-template-99-master' ); ?></p>
			</div>
		</header>

		<ol class="delivery-sequence__track">
			<?php foreach ( $phases as $index => $phase ) : ?>
				<li class="delivery-step<?php echo 0 === $index ? ' is-current' : ''; ?>" data-home-process-step data-reveal>
					<header class="delivery-step__topline">
						<span><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
						<strong><?php echo esc_html( $phase['verb'] ); ?></strong>
						<i aria-hidden="true"></i>
					</header>

					<div class="delivery-step__copy">
						<h3><?php echo esc_html( $phase['title'] ); ?></h3>
						<p><?php echo esc_html( $phase['copy'] ); ?></p>
					</div>

					<div class="delivery-step__artifact">
						<div class="delivery-step__artifact-visual" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></div>
						<div>
							<span><?php esc_html_e( 'Leaves behind', 'nolan-young-theme-template-99-master' ); ?></span>
							<strong><?php echo esc_html( $phase['artifact'] ); ?></strong>
						</div>
					</div>

					<footer class="delivery-step__footer">
						<span><?php echo esc_html( $phase['signal'] ); ?></span>
						<i aria-hidden="true">&rarr;</i>
					</footer>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
