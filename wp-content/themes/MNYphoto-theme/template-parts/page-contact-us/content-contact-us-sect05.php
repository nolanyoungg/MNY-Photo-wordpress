<?php
/**
 * Contact engagement FAQ.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$questions = array(
	array( 'What makes a project a strong fit?', 'A consequential digital, product, or brand problem with executive attention, measurable customer impact, and a team willing to work across functional boundaries.' ),
	array( 'Can we begin with a smaller engagement?', 'Yes. A focused diagnostic or opportunity sprint can build evidence, align stakeholders, and define the right investment before a larger commitment.' ),
	array( 'Do you work with internal teams and existing partners?', 'Absolutely. We clarify ownership early, work transparently, and strengthen the system around the people already responsible for it.' ),
	array( 'What should we prepare for the first conversation?', 'Bring the business context, what has already been attempted, who needs confidence, and the decision or milestone creating urgency.' ),
	array( 'How soon can a project begin?', 'Timing depends on the team and problem. We keep a limited number of active engagements so senior involvement remains real, and we will give you an honest availability signal immediately.' ),
);
?>
<section class="section contact-faq">
	<div class="content-wrap contact-faq__layout">
		<header class="contact-faq__intro" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Before we talk', 'nolan-young-theme-template-99-master' ); ?></p>
			<h2><?php esc_html_e( 'Clear answers before the first calendar invite.', 'nolan-young-theme-template-99-master' ); ?></h2>
			<p><?php esc_html_e( 'The questions enterprise teams usually ask when they are deciding whether a specialist partner is the right move.', 'nolan-young-theme-template-99-master' ); ?></p>
			<div class="contact-faq__index" aria-hidden="true">
				<span>01</span><i></i><span>05</span>
			</div>
		</header>
		<div class="accordion contact-faq__accordion" data-accordion data-reveal>
			<?php foreach ( $questions as $index => $question ) : ?>
				<div class="accordion__item">
					<h3>
						<button type="button" aria-expanded="false" aria-controls="contact-answer-<?php echo esc_attr( (string) $index ); ?>">
							<small><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></small>
							<span><?php echo esc_html( $question[0] ); ?></span>
							<i aria-hidden="true">+</i>
						</button>
					</h3>
					<div id="contact-answer-<?php echo esc_attr( (string) $index ); ?>" class="accordion__panel">
						<p><?php echo esc_html( $question[1] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
