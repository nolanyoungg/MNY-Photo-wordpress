<?php
/**
 * 404 help call to action.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section section--cream recovery-help">
	<div class="content-wrap">
		<div class="recovery-help__panel" data-reveal>
			<div class="recovery-help__status" aria-hidden="true">
				<span>HELP</span>
				<strong>?</strong>
			</div>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Still looking?', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Tell us what you expected to find.', 'nolan-young-theme-template-99-master' ); ?></h2>
				<p><?php esc_html_e( 'A person can point you toward the right service, resource, or next conversation.', 'nolan-young-theme-template-99-master' ); ?></p>
			</div>
			<div class="recovery-help__action">
				<span><i class="availability-dot" aria-hidden="true"></i><?php esc_html_e( 'Human response', 'nolan-young-theme-template-99-master' ); ?></span>
				<a class="button button--primary" href="<?php echo esc_url( nytt99_page_url( 'contact-us' ) ); ?>">
					<?php esc_html_e( 'Ask for help', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true">→</span>
				</a>
			</div>
		</div>
	</div>
</section>
