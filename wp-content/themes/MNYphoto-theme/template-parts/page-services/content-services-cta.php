<?php
/**
 * Services consultation and project-fit CTA.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section section--cool">
	<div class="content-wrap">
		<div class="services-conversion" data-reveal>
			<div class="services-conversion__signal">
				<span>
					<i aria-hidden="true"></i>
					<?php esc_html_e( 'Consultation availability', 'nolan-young-theme-template-99-master' ); ?>
				</span>
				<strong><?php esc_html_e( 'Select Q4 starts', 'nolan-young-theme-template-99-master' ); ?></strong>
			</div>
			<div class="services-conversion__content">
				<p class="eyebrow"><?php esc_html_e( 'A useful first step', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Bring the brief behind the brief.', 'nolan-young-theme-template-99-master' ); ?></h2>
				<p><?php esc_html_e( 'Share what is changing, where momentum is blocked, and what a better outcome needs to make possible.', 'nolan-young-theme-template-99-master' ); ?></p>
			</div>
			<div class="services-conversion__action">
				<?php nytt99_button( __( 'Discuss the challenge', 'nolan-young-theme-template-99-master' ) ); ?>
				<a class="text-link" href="<?php echo esc_url( nytt99_page_url( 'work' ) ); ?>">
					<?php esc_html_e( 'See related outcomes', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true">↗</span>
				</a>
			</div>
		</div>
	</div>
</section>
