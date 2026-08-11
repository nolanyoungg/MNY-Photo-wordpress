<?php
/**
 * PPC objection FAQ.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$questions = array(
	array( 'Do we need to replace our media agency?', 'No. This engagement can strengthen the strategy, landing experience, measurement, and learning system while your existing media partner continues operating campaigns.' ),
	array( 'Can this work with our current analytics stack?', 'Usually. We begin with the tools and governance already in place, then recommend only the changes required to create a trustworthy decision signal.' ),
	array( 'How quickly can a new landing experience launch?', 'A focused first experience can often launch in four to six weeks, depending on approvals, integrations, content readiness, and compliance requirements.' ),
	array( 'Is this only for large media budgets?', 'No. The system is valuable wherever expensive demand, a complex offer, and slow learning make every acquisition decision consequential.' ),
	array( 'Will our internal team be able to operate it?', 'Yes. Operating ownership, documentation, decision criteria, and working rituals are designed into the engagement from the start.' ),
);
?>
<section class="section ppc-faq">
	<div class="content-wrap ppc-faq__layout">
		<header class="ppc-faq__intro" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Questions before investment', 'nolan-young-theme-template-99-master' ); ?></p>
			<h2><?php esc_html_e( 'Resolve the practical objections early.', 'nolan-young-theme-template-99-master' ); ?></h2>
			<p><?php esc_html_e( 'The system is designed to work with the people, platforms, and partners you already have wherever that is the smarter move.', 'nolan-young-theme-template-99-master' ); ?></p>
			<div class="ppc-faq__signal">
				<span><?php esc_html_e( 'Integration posture', 'nolan-young-theme-template-99-master' ); ?></span>
				<strong><?php esc_html_e( 'Additive by default', 'nolan-young-theme-template-99-master' ); ?></strong>
				<i></i>
			</div>
		</header>
		<div class="accordion ppc-faq__accordion" data-accordion data-reveal>
			<?php foreach ( $questions as $index => $question ) : ?>
				<div class="accordion__item">
					<h3>
						<button type="button" aria-expanded="false" aria-controls="ppc-answer-<?php echo esc_attr( (string) $index ); ?>">
							<small><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></small>
							<span><?php echo esc_html( $question[0] ); ?></span>
							<i aria-hidden="true">+</i>
						</button>
					</h3>
					<div id="ppc-answer-<?php echo esc_attr( (string) $index ); ?>" class="accordion__panel">
						<p><?php echo esc_html( $question[1] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
