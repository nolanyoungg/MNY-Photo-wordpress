<?php
/**
 * Front-page five-practice Services showcase.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$mega_menu_data  = nytt99_mega_menu_data();
$service_items   = $mega_menu_data['services']['items'] ?? array();
$service_visuals = array(
	'web'       => 'device-system.svg',
	'plugin'    => 'case-study-interface.svg',
	'seo'       => 'demand-signal-chart.svg',
	'analytics' => 'dashboard-grid.svg',
	'ai'        => 'team-network.svg',
);
?>
<section id="selected-work" class="service-showcase" data-home-chapter>
	<div class="content-wrap">
		<header class="service-showcase__header" data-reveal>
			<h2><?php esc_html_e( 'Services', 'nolan-young-theme-template-99-master' ); ?></h2>
		</header>

		<div class="service-showcase__grid">
			<?php foreach ( $service_items as $index => $service ) : ?>
				<?php
				$visual_key  = $service['visual'] ?? '';
				$visual_file = $service_visuals[ $visual_key ] ?? 'device-system.svg';
				$image_url   = get_theme_file_uri( 'dist/images/' . $visual_file );
				$link_label  = sprintf(
					/* translators: %s: service title. */
					__( 'Explore %s', 'nolan-young-theme-template-99-master' ),
					$service['title']
				);
				?>
				<article class="service-showcase__card service-showcase__card--<?php echo esc_attr( $visual_key ); ?>" data-reveal>
					<a class="service-showcase__media" href="<?php echo esc_url( $service['url'] ); ?>" aria-label="<?php echo esc_attr( $link_label ); ?>">
						<span class="service-showcase__media-number" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
						<img src="<?php echo esc_url( $image_url ); ?>" alt="" loading="lazy" decoding="async">
					</a>

					<div class="service-showcase__copy">
						<h3><?php echo esc_html( $service['title'] ); ?></h3>
						<p><?php echo esc_html( $service['description'] ); ?></p>
						<a class="service-showcase__link" href="<?php echo esc_url( $service['url'] ); ?>">
							<span><?php echo esc_html( $link_label ); ?></span>
							<i aria-hidden="true"></i>
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
