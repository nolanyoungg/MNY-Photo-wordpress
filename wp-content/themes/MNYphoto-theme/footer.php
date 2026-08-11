<?php
/**
 * Shared site footer.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$contact_email    = sanitize_email( get_theme_mod( 'nytt99_email', get_option( 'admin_email' ) ) );
$footer_services = nytt99_mega_menu_data()['services']['items'];
$privacy_url    = get_privacy_policy_url();
$latest_post   = get_posts(
	array(
		'post_type'              => 'post',
		'post_status'            => 'publish',
		'posts_per_page'         => 1,
		'ignore_sticky_posts'    => true,
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
	)
);
?>
<footer id="site-footer" class="site-footer">
	<section class="site-footer__conversion">
		<div class="content-wrap site-footer__conversion-inner">
			<div class="site-footer__conversion-status">
				<span><i aria-hidden="true"></i><?php esc_html_e( 'Project availability', 'nolan-young-theme-template-99-master' ); ?></span>
				<strong><?php esc_html_e( 'Limited senior-team capacity', 'nolan-young-theme-template-99-master' ); ?></strong>
			</div>
			<div class="site-footer__conversion-content">
				<p class="eyebrow"><?php esc_html_e( 'Make the next decision useful', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Turn complexity into clear forward motion.', 'nolan-young-theme-template-99-master' ); ?></h2>
				<p><?php esc_html_e( 'Bring the business challenge. Leave the first conversation with a sharper direction and a practical path to delivery.', 'nolan-young-theme-template-99-master' ); ?></p>
			</div>
			<div class="site-footer__conversion-action">
				<?php nytt99_button( __( 'Start the conversation', 'nolan-young-theme-template-99-master' ) ); ?>
				<a class="text-link" href="<?php echo esc_url( nytt99_page_url( 'services' ) ); ?>">
					<?php esc_html_e( 'Review project fit', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true">↗</span>
				</a>
			</div>
		</div>
	</section>

	<div class="site-footer__main">
		<div class="content-wrap">
			<div class="site-footer__masthead">
				<div class="site-footer__identity">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a class="brand brand--footer" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<span class="brand__mark" aria-hidden="true"><?php echo esc_html( strtoupper( substr( get_bloginfo( 'name' ), 0, 1 ) ) ); ?></span>
							<span class="brand__name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
						</a>
					<?php endif; ?>
					<p><?php echo esc_html( get_bloginfo( 'description' ) ?: __( 'Enterprise strategy, experience, and engineering for teams moving important work forward.', 'nolan-young-theme-template-99-master' ) ); ?></p>
				</div>
				<?php if ( $latest_post ) : ?>
					<a class="site-footer__insight" href="<?php echo esc_url( get_permalink( $latest_post[0] ) ); ?>">
						<span><?php esc_html_e( 'Latest perspective', 'nolan-young-theme-template-99-master' ); ?></span>
						<strong><?php echo esc_html( get_the_title( $latest_post[0] ) ); ?></strong>
						<i aria-hidden="true">↗</i>
					</a>
				<?php endif; ?>
			</div>

			<div class="site-footer__grid">
				<div>
					<p class="site-footer__label"><?php esc_html_e( 'Navigate', 'nolan-young-theme-template-99-master' ); ?></p>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => 'site-footer__links',
							'fallback_cb'    => 'nytt99_footer_menu_fallback',
							'depth'          => 1,
						)
					);
					?>
				</div>
				<div>
					<p class="site-footer__label"><?php esc_html_e( 'Capabilities', 'nolan-young-theme-template-99-master' ); ?></p>
					<ul class="site-footer__links">
						<?php foreach ( $footer_services as $footer_service ) : ?>
							<li><a href="<?php echo esc_url( $footer_service['url'] ); ?>"><?php echo esc_html( $footer_service['title'] ); ?><span aria-hidden="true">↗</span></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div>
					<p class="site-footer__label"><?php esc_html_e( 'Resources', 'nolan-young-theme-template-99-master' ); ?></p>
					<ul class="site-footer__links">
						<li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/journal/' ) ); ?>"><?php esc_html_e( 'Journal', 'nolan-young-theme-template-99-master' ); ?><span aria-hidden="true">↗</span></a></li>
						<li><a href="<?php echo esc_url( nytt99_page_url( 'work' ) ); ?>"><?php esc_html_e( 'Case studies', 'nolan-young-theme-template-99-master' ); ?><span aria-hidden="true">↗</span></a></li>
						<li><a href="<?php echo esc_url( nytt99_page_url( 'about-us' ) . '#future' ); ?>"><?php esc_html_e( 'Future work', 'nolan-young-theme-template-99-master' ); ?><span aria-hidden="true">↗</span></a></li>
					</ul>
				</div>
				<div>
					<p class="site-footer__label"><?php esc_html_e( 'Contact', 'nolan-young-theme-template-99-master' ); ?></p>
					<ul class="site-footer__links">
						<li><a href="mailto:<?php echo esc_attr( antispambot( $contact_email ) ); ?>"><?php esc_html_e( 'Email the studio', 'nolan-young-theme-template-99-master' ); ?><span aria-hidden="true">↗</span></a></li>
						<li><a href="<?php echo esc_url( nytt99_page_url( 'contact-us' ) ); ?>"><?php esc_html_e( 'Project enquiry', 'nolan-young-theme-template-99-master' ); ?><span aria-hidden="true">↗</span></a></li>
					</ul>
				</div>
			</div>

			<div class="site-footer__base">
				<p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>.</p>
				<div>
					<?php if ( $privacy_url ) : ?>
						<a href="<?php echo esc_url( $privacy_url ); ?>"><?php esc_html_e( 'Privacy', 'nolan-young-theme-template-99-master' ); ?></a>
					<?php endif; ?>
					<span><?php esc_html_e( 'Strategy · Experience · Engineering', 'nolan-young-theme-template-99-master' ); ?></span>
				</div>
				<a class="site-footer__top" href="#content"><?php esc_html_e( 'Back to top', 'nolan-young-theme-template-99-master' ); ?><span aria-hidden="true">↑</span></a>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
