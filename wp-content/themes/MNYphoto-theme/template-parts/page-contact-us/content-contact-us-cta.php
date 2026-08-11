<?php
/**
 * Contact direct-contact call to action.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$admin_email = antispambot( get_option( 'admin_email' ) );
?>
<section class="section section--cream contact-conversion">
	<div class="content-wrap">
		<div class="contact-conversion__panel" data-reveal>
			<div class="contact-conversion__index" aria-hidden="true">
				<span>DIRECT</span>
				<strong>↗</strong>
			</div>
			<div class="contact-conversion__content">
				<p class="eyebrow"><?php esc_html_e( 'Prefer a direct note?', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Write to the people who will read the brief.', 'nolan-young-theme-template-99-master' ); ?></h2>
				<p><?php esc_html_e( 'Include the outcome you need, what is making it difficult, and the timing shaping the decision. A senior member of the team will take it from there.', 'nolan-young-theme-template-99-master' ); ?></p>
			</div>
			<div class="contact-conversion__action">
				<span><i class="availability-dot" aria-hidden="true"></i><?php esc_html_e( 'Replies within two business days', 'nolan-young-theme-template-99-master' ); ?></span>
				<a class="button button--primary" href="mailto:<?php echo esc_attr( $admin_email ); ?>">
					<?php esc_html_e( 'Email the studio', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true">↗</span>
				</a>
				<small><?php esc_html_e( 'No automated sequence. No obligation.', 'nolan-young-theme-template-99-master' ); ?></small>
			</div>
		</div>
	</div>
</section>
