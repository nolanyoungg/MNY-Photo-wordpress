<?php
/**
 * Front-page atelier hero.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$practices = nytt99_mega_menu_data()['services']['items'];
?>
<section class="atelier-hero" data-home-editorial data-home-hero>
	<div class="atelier-hero__mesh" aria-hidden="true"></div>
	<div class="content-wrap atelier-hero__shell">
		<div class="atelier-hero__topline"><span><?php esc_html_e( 'Independent digital practice', 'nolan-young-theme-template-99-master' ); ?></span><span><?php esc_html_e( 'New York / Working everywhere', 'nolan-young-theme-template-99-master' ); ?></span></div>
		<div class="atelier-hero__layout">
			<div class="atelier-hero__copy" data-reveal>
				<p class="eyebrow"><?php esc_html_e( 'Strategy, experience, and engineering', 'nolan-young-theme-template-99-master' ); ?></p>
				<h1><?php esc_html_e( 'Complex digital work.', 'nolan-young-theme-template-99-master' ); ?><strong><?php esc_html_e( 'Clearly made.', 'nolan-young-theme-template-99-master' ); ?></strong></h1>
				<p><?php esc_html_e( 'We design and build the websites, products, search systems, intelligence layers, and AI tools that help ambitious teams make a meaningful next move.', 'nolan-young-theme-template-99-master' ); ?></p>
				<div class="atelier-hero__actions">
					<a class="atelier-button" href="<?php echo esc_url( nytt99_page_url( 'contact-us' ) . '#project-brief' ); ?>"><?php esc_html_e( 'Begin a project', 'nolan-young-theme-template-99-master' ); ?><span aria-hidden="true">&rarr;</span></a>
					<a class="atelier-link" href="<?php echo esc_url( nytt99_page_url( 'work' ) ); ?>"><?php esc_html_e( 'Explore selected work', 'nolan-young-theme-template-99-master' ); ?></a>
				</div>
			</div>

			<div class="network-globe" data-home-sculpture data-reveal aria-hidden="true">
				<div class="network-globe__topline"><span><i></i>GLOBAL DIGITAL NETWORK</span><strong>LIVE / CONNECTED</strong></div>
				<div class="network-globe__scene">
					<div class="network-globe__halo"></div>
					<div class="network-globe__sphere">
						<div class="network-globe__surface"><i></i><i></i><i></i><i></i><i></i></div>
						<div class="network-globe__latitude network-globe__latitude--one"></div>
						<div class="network-globe__latitude network-globe__latitude--two"></div>
						<div class="network-globe__latitude network-globe__latitude--three"></div>
						<div class="network-globe__longitude network-globe__longitude--one"></div>
						<div class="network-globe__longitude network-globe__longitude--two"></div>
						<div class="network-globe__longitude network-globe__longitude--three"></div>
						<span class="network-globe__pulse network-globe__pulse--one"></span>
						<span class="network-globe__pulse network-globe__pulse--two"></span>
						<span class="network-globe__pulse network-globe__pulse--three"></span>
					</div>
					<div class="network-globe__orbit"><i></i></div>
					<svg class="network-globe__routes" viewBox="0 0 600 600" focusable="false">
						<path d="M102 352 C196 142 399 122 508 260" />
						<path d="M110 236 C238 442 412 460 508 326" />
						<path d="M184 84 C356 184 420 334 374 520" />
					</svg>
					<?php foreach ( $practices as $index => $practice ) : ?>
						<div class="network-globe__practice network-globe__practice--<?php echo esc_attr( $index + 1 ); ?>"><span><?php echo esc_html( $practice['code'] ); ?></span><strong><?php echo esc_html( $practice['signal'] ); ?></strong></div>
					<?php endforeach; ?>
					<div class="network-globe__core"><small>NY</small><strong>CONNECTED</strong></div>
				</div>
				<div class="network-globe__readout"><span>ONE PRACTICE</span><strong>FIVE SPECIALIST SYSTEMS</strong></div>
				<div class="network-globe__coordinates"><span>40.7128° N</span><span>74.0060° W</span></div>
			</div>
		</div>
		<nav class="atelier-hero__practices" aria-label="<?php esc_attr_e( 'Our practices', 'nolan-young-theme-template-99-master' ); ?>">
			<?php foreach ( $practices as $practice ) : ?><a href="<?php echo esc_url( $practice['url'] ); ?>"><span><?php echo esc_html( $practice['code'] ); ?></span><?php echo esc_html( $practice['title'] ); ?></a><?php endforeach; ?>
		</nav>
	</div>
</section>
