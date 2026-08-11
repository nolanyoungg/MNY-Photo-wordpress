<?php
/**
 * Work page call to action.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section section--cream">
	<div class="content-wrap">
		<div class="work-conversion" data-reveal>
			<div class="work-conversion__index">W / 01</div>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Your next case starts here', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Bring us the business problem that refuses to stay simple.', 'nolan-young-theme-template-99-master' ); ?></h2>
				<p><?php esc_html_e( 'We will help frame the right move, assemble the right team, and define a credible first release.', 'nolan-young-theme-template-99-master' ); ?></p>
			</div>
			<div class="work-conversion__action">
				<span>
					<i aria-hidden="true"></i>
					<?php esc_html_e( 'Select engagements available', 'nolan-young-theme-template-99-master' ); ?>
				</span>
				<a class="button button--primary" href="<?php echo esc_url( nytt99_page_url( 'contact-us' ) ); ?>">
					<?php esc_html_e( 'Discuss the opportunity', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true">→</span>
				</a>
			</div>
		</div>
	</div>
</section>
