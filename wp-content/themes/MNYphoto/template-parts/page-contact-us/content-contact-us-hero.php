<?php
/**
 * Contact page hero.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$admin_email = antispambot( get_option( 'admin_email' ) );
?>
<section class="contact-hero">
	<div class="content-wrap contact-hero__layout">
		<div class="contact-hero__content" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Senior team / direct response', 'nolan-young-theme-template-99-master' ); ?></p>
			<h1><?php esc_html_e( 'Bring us the problem behind the brief.', 'nolan-young-theme-template-99-master' ); ?></h1>
			<p class="hero__lede">
				<?php esc_html_e( 'Share the pressure, the people affected, and the outcome that matters. We will respond with a point of view and a practical next move—not an automated sales sequence.', 'nolan-young-theme-template-99-master' ); ?>
			</p>
			<div class="button-row">
				<a class="button button--primary" href="#project-brief">
					<?php esc_html_e( 'Shape the brief', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true">↓</span>
				</a>
				<a class="button button--quiet" href="mailto:<?php echo esc_attr( $admin_email ); ?>">
					<?php esc_html_e( 'Email directly', 'nolan-young-theme-template-99-master' ); ?>
				</a>
			</div>
			<ul class="contact-hero__proof" aria-label="<?php esc_attr_e( 'What to expect', 'nolan-young-theme-template-99-master' ); ?>">
				<li><strong><?php esc_html_e( 'Human', 'nolan-young-theme-template-99-master' ); ?></strong><span><?php esc_html_e( 'Senior review', 'nolan-young-theme-template-99-master' ); ?></span></li>
				<li><strong><?php esc_html_e( 'Useful', 'nolan-young-theme-template-99-master' ); ?></strong><span><?php esc_html_e( 'A clear response', 'nolan-young-theme-template-99-master' ); ?></span></li>
				<li><strong><?php esc_html_e( 'Private', 'nolan-young-theme-template-99-master' ); ?></strong><span><?php esc_html_e( 'No mailing list', 'nolan-young-theme-template-99-master' ); ?></span></li>
			</ul>
		</div>

		<aside class="contact-desk" data-reveal aria-label="<?php esc_attr_e( 'Project availability overview', 'nolan-young-theme-template-99-master' ); ?>">
			<header class="contact-desk__header">
				<div>
					<span class="availability-dot" aria-hidden="true"></span>
					<strong><?php esc_html_e( 'Studio desk', 'nolan-young-theme-template-99-master' ); ?></strong>
				</div>
				<small><?php esc_html_e( 'NY / 09:42', 'nolan-young-theme-template-99-master' ); ?></small>
			</header>
			<div class="contact-desk__signal">
				<p><?php esc_html_e( 'Next discovery window', 'nolan-young-theme-template-99-master' ); ?></p>
				<strong><?php esc_html_e( 'Now booking', 'nolan-young-theme-template-99-master' ); ?></strong>
				<span><?php esc_html_e( 'Two focused engagements available', 'nolan-young-theme-template-99-master' ); ?></span>
			</div>
			<div class="contact-desk__route" aria-hidden="true">
				<span>01</span>
				<i></i>
				<span>02</span>
				<i></i>
				<span>03</span>
			</div>
			<dl class="contact-desk__facts">
				<div>
					<dt><?php esc_html_e( 'Typical response', 'nolan-young-theme-template-99-master' ); ?></dt>
					<dd><?php esc_html_e( 'Within 2 business days', 'nolan-young-theme-template-99-master' ); ?></dd>
				</div>
				<div>
					<dt><?php esc_html_e( 'Best fit', 'nolan-young-theme-template-99-master' ); ?></dt>
					<dd><?php esc_html_e( 'Complex digital change', 'nolan-young-theme-template-99-master' ); ?></dd>
				</div>
				<div>
					<dt><?php esc_html_e( 'First conversation', 'nolan-young-theme-template-99-master' ); ?></dt>
					<dd><?php esc_html_e( '30 focused minutes', 'nolan-young-theme-template-99-master' ); ?></dd>
				</div>
			</dl>
			<footer class="contact-desk__footer">
				<span><?php esc_html_e( 'No pitch deck required', 'nolan-young-theme-template-99-master' ); ?></span>
				<i aria-hidden="true">↗</i>
			</footer>
		</aside>
	</div>
</section>
