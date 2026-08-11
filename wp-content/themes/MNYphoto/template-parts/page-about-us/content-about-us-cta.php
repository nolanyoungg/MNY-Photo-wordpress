<?php
/**
 * About partnership CTA.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section section--cream">
	<div class="content-wrap">
		<div class="about-conversion" data-reveal>
			<div class="about-conversion__index">A / 01</div>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Work with the team', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Good work starts with a precise question.', 'nolan-young-theme-template-99-master' ); ?></h2>
				<p><?php esc_html_e( 'Share the change your organization is navigating and where better momentum would matter most.', 'nolan-young-theme-template-99-master' ); ?></p>
			</div>
			<div class="about-conversion__fit">
				<span><?php esc_html_e( 'Strongest fit', 'nolan-young-theme-template-99-master' ); ?></span>
				<ul>
					<li><?php esc_html_e( 'Complex decision', 'nolan-young-theme-template-99-master' ); ?></li>
					<li><?php esc_html_e( 'Cross-functional delivery', 'nolan-young-theme-template-99-master' ); ?></li>
					<li><?php esc_html_e( 'Long-term ownership', 'nolan-young-theme-template-99-master' ); ?></li>
				</ul>
			</div>
			<div class="about-conversion__action">
				<?php nytt99_button( __( 'Start the conversation', 'nolan-young-theme-template-99-master' ) ); ?>
				<a class="text-link" href="<?php echo esc_url( nytt99_page_url( 'work' ) ); ?>">
					<?php esc_html_e( 'Review the evidence', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true">↗</span>
				</a>
			</div>
		</div>
	</div>
</section>
