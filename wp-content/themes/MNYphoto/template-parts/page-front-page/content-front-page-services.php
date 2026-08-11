<?php
/**
 * Front-page connected-practice spectrum.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$practices = nytt99_mega_menu_data()['services']['items'];
?>
<section id="home-services" class="practice-gallery section" data-home-chapter>
	<div class="practice-gallery__glow" aria-hidden="true"></div>
	<div class="content-wrap">
		<header class="practice-gallery__intro" data-reveal>
			<div class="practice-gallery__meta">
				<span>02 / <?php esc_html_e( 'Connected capabilities', 'nolan-young-theme-template-99-master' ); ?></span>
				<span><?php echo esc_html( sprintf( '%02d', count( $practices ) ) ); ?> <?php esc_html_e( 'specialist practices', 'nolan-young-theme-template-99-master' ); ?></span>
			</div>
			<div class="practice-gallery__intro-copy">
				<h2><?php esc_html_e( 'One digital practice. Every layer connected.', 'nolan-young-theme-template-99-master' ); ?></h2>
				<div>
					<p><?php esc_html_e( 'Build the experience, extend the platform, earn discovery, understand performance, and apply intelligence without creating another disconnected system.', 'nolan-young-theme-template-99-master' ); ?></p>
					<span><?php esc_html_e( 'Strategy through stewardship', 'nolan-young-theme-template-99-master' ); ?></span>
				</div>
			</div>
		</header>

		<div class="practice-spectrum">
			<?php foreach ( $practices as $index => $practice ) : ?>
				<article class="service-bento service-bento--<?php echo esc_attr( $practice['visual'] ); ?>" data-reveal>
					<div class="service-bento__wash" aria-hidden="true"></div>
					<header class="service-bento__header">
						<span><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?> / <?php echo esc_html( $practice['signal'] ); ?></span>
						<strong><?php echo esc_html( $practice['code'] ); ?></strong>
					</header>

					<div class="service-bento__body">
						<div class="service-bento__copy">
							<h3><a href="<?php echo esc_url( $practice['url'] ); ?>"><?php echo esc_html( $practice['title'] ); ?></a></h3>
							<p><?php echo esc_html( $practice['description'] ); ?></p>
						</div>

						<div class="service-bento__art" aria-hidden="true">
							<span><?php echo esc_html( $practice['code'] ); ?></span>
							<div><i></i><i></i><i></i><i></i><i></i></div>
						</div>
					</div>

					<div class="service-bento__capabilities">
						<span><?php esc_html_e( 'Selected capabilities', 'nolan-young-theme-template-99-master' ); ?></span>
						<ul>
							<?php foreach ( array_slice( $practice['links'], 0, 4 ) as $capability_index => $capability ) : ?>
								<li>
									<a href="<?php echo esc_url( $capability['url'] ); ?>">
										<span><?php echo esc_html( sprintf( '%02d', $capability_index + 1 ) ); ?></span>
										<strong><?php echo esc_html( $capability['label'] ); ?></strong>
										<i aria-hidden="true">&nearr;</i>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>

					<a class="service-bento__footer" href="<?php echo esc_url( $practice['url'] ); ?>">
						<span><?php echo esc_html( sprintf( __( 'Explore %s', 'nolan-young-theme-template-99-master' ), $practice['title'] ) ); ?></span>
						<span aria-hidden="true">&rarr;</span>
					</a>
				</article>
			<?php endforeach; ?>
		</div>

		<a class="practice-gallery__directory" href="<?php echo esc_url( nytt99_page_url( 'services' ) ); ?>">
			<span>
				<small><?php esc_html_e( 'All five practices. Thirty detailed capabilities.', 'nolan-young-theme-template-99-master' ); ?></small>
				<strong><?php esc_html_e( 'Open the complete services directory', 'nolan-young-theme-template-99-master' ); ?></strong>
			</span>
			<i aria-hidden="true">&rarr;</i>
		</a>
	</div>
</section>
