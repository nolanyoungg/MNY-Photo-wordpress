<?php
/** Site footer. */
$email = get_theme_mod( 'mnyphoto_contact_email', get_option( 'admin_email' ) );
?>
<footer class="site-footer">
	<div class="site-footer__lead wrap">
		<div><p class="eyebrow"><?php esc_html_e( 'Make something worth remembering', 'mnyphoto-theme' ); ?></p><h2><?php esc_html_e( 'Let’s shape the next frame.', 'mnyphoto-theme' ); ?></h2></div>
		<a class="button button--light" href="<?php echo esc_url( mnyphoto_page_url( 'contact-us' ) ); ?>"><?php esc_html_e( 'Start a conversation', 'mnyphoto-theme' ); ?></a>
	</div>
	<div class="site-footer__grid wrap">
		<div class="site-footer__identity">
			<a class="wordmark wordmark--footer" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>MNY</span><small>Photo</small></a>
			<p><?php echo esc_html( get_theme_mod( 'mnyphoto_location', __( 'Available for commissions worldwide', 'mnyphoto-theme' ) ) ); ?></p>
			<?php if ( $email ) : ?><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a><?php endif; ?>
		</div>
		<div>
			<h3><?php esc_html_e( 'Navigate', 'mnyphoto-theme' ); ?></h3>
			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => false, 'depth' => 1 ) ); ?>
			<?php if ( ! has_nav_menu( 'footer' ) ) : ?>
				<ul><li><a href="<?php echo esc_url( mnyphoto_page_url( 'work' ) ); ?>"><?php esc_html_e( 'Work', 'mnyphoto-theme' ); ?></a></li><li><a href="<?php echo esc_url( mnyphoto_page_url( 'about-us' ) ); ?>"><?php esc_html_e( 'About', 'mnyphoto-theme' ); ?></a></li><li><a href="<?php echo esc_url( mnyphoto_page_url( 'contact-us' ) ); ?>"><?php esc_html_e( 'Contact', 'mnyphoto-theme' ); ?></a></li></ul>
			<?php endif; ?>
		</div>
		<div>
			<h3><?php esc_html_e( 'Practices', 'mnyphoto-theme' ); ?></h3>
			<ul><?php foreach ( mnyphoto_get_services() as $service ) : ?><li><a href="<?php echo esc_url( $service['url'] ); ?>"><?php echo esc_html( $service['title'] ); ?></a></li><?php endforeach; ?></ul>
		</div>
		<div class="site-footer__newsletter">
			<h3><?php esc_html_e( 'Studio notes', 'mnyphoto-theme' ); ?></h3>
			<p><?php esc_html_e( 'A presentation-ready newsletter area for your preferred WordPress form provider.', 'mnyphoto-theme' ); ?></p>
			<form class="newsletter-form" action="#" method="post" data-presentation-form>
				<label for="footer-email"><?php esc_html_e( 'Email address', 'mnyphoto-theme' ); ?></label>
				<div><input id="footer-email" name="email" type="email" autocomplete="email" placeholder="you@example.com"><button type="submit"><?php esc_html_e( 'Join', 'mnyphoto-theme' ); ?></button></div>
				<p class="form-note"><?php esc_html_e( 'Preview only — connect a newsletter plugin to accept subscriptions.', 'mnyphoto-theme' ); ?></p>
			</form>
		</div>
	</div>
	<div class="site-footer__base wrap">
		<p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.</p>
		<div class="social-links">
			<?php if ( get_theme_mod( 'mnyphoto_instagram' ) ) : ?><a href="<?php echo esc_url( get_theme_mod( 'mnyphoto_instagram' ) ); ?>" rel="me noopener">Instagram</a><?php endif; ?>
			<?php if ( get_theme_mod( 'mnyphoto_linkedin' ) ) : ?><a href="<?php echo esc_url( get_theme_mod( 'mnyphoto_linkedin' ) ); ?>" rel="me noopener">LinkedIn</a><?php endif; ?>
			<?php if ( get_privacy_policy_url() ) : ?><a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php esc_html_e( 'Privacy', 'mnyphoto-theme' ); ?></a><?php endif; ?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
