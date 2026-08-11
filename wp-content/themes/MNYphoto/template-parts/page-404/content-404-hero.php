<?php
/**
 * 404 recovery hero.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="error-hero">
	<div class="content-wrap error-hero__layout">
		<div class="error-hero__content" data-reveal>
			<p class="eyebrow"><?php esc_html_e( '404 / Route unavailable', 'nolan-young-theme-template-99-master' ); ?></p>
			<h1><?php esc_html_e( 'Wrong turn. Strong recovery.', 'nolan-young-theme-template-99-master' ); ?></h1>
			<p class="hero__lede"><?php esc_html_e( 'The page may have moved, the address may be incomplete, or the idea may now live somewhere more useful. Search the site or choose a verified route below.', 'nolan-young-theme-template-99-master' ); ?></p>
			<div class="error-hero__search">
				<span><?php esc_html_e( 'Search the site', 'nolan-young-theme-template-99-master' ); ?></span>
				<?php get_search_form(); ?>
			</div>
			<div class="error-hero__quick">
				<span><?php esc_html_e( 'Quick route', 'nolan-young-theme-template-99-master' ); ?></span>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'nolan-young-theme-template-99-master' ); ?></a>
				<a href="<?php echo esc_url( nytt99_page_url( 'services' ) ); ?>"><?php esc_html_e( 'Services', 'nolan-young-theme-template-99-master' ); ?></a>
				<a href="<?php echo esc_url( nytt99_page_url( 'contact-us' ) ); ?>"><?php esc_html_e( 'Contact', 'nolan-young-theme-template-99-master' ); ?></a>
			</div>
		</div>
		<div class="route-console" data-reveal role="img" aria-label="<?php esc_attr_e( 'Illustrative route recovery interface', 'nolan-young-theme-template-99-master' ); ?>">
			<header>
				<div><i></i><i></i><i></i></div>
				<span>route-recovery.log</span>
				<small><?php esc_html_e( 'System ready', 'nolan-young-theme-template-99-master' ); ?></small>
			</header>
			<div class="route-console__code">
				<span>ERROR_CODE</span>
				<strong>404</strong>
				<p><i>requested_route</i><b>unavailable</b></p>
				<p><i>recovery_index</i><b>04 destinations</b></p>
				<p><i>search_status</i><b>ready</b></p>
			</div>
			<div class="route-console__map">
				<div class="is-missing"><span>?</span><small><?php esc_html_e( 'Missing', 'nolan-young-theme-template-99-master' ); ?></small></div>
				<i></i>
				<div><span>01</span><small><?php esc_html_e( 'Home', 'nolan-young-theme-template-99-master' ); ?></small></div>
				<i></i>
				<div><span>02</span><small><?php esc_html_e( 'Explore', 'nolan-young-theme-template-99-master' ); ?></small></div>
			</div>
			<footer>
				<span><?php esc_html_e( 'Recovery status', 'nolan-young-theme-template-99-master' ); ?></span>
				<strong><?php esc_html_e( 'Routes verified', 'nolan-young-theme-template-99-master' ); ?></strong>
			</footer>
		</div>
	</div>
</section>
