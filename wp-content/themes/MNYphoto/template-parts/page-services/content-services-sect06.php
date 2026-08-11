<?php
/**
 * Services specialist capability directory.
 *
 * This section is the canonical destination for the detailed capability links
 * exposed by the Services mega-menu.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$mega_menu_data = nytt99_mega_menu_data();
$practices      = $mega_menu_data['services']['items'];
?>
<section id="specialist-capabilities" class="section section--navy service-directory">
	<div class="content-wrap">
		<header class="section__heading service-directory__intro" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Specialist capability directory', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Five practices. Thirty focused ways to move.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p class="section__lede"><?php esc_html_e( 'Start with the capability that matches the immediate pressure. Each one can stand alone or connect into a larger delivery system.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>

		<nav class="service-directory__nav" aria-label="<?php esc_attr_e( 'Specialist service practices', 'nolan-young-theme-template-99-master' ); ?>" data-reveal>
			<?php foreach ( $practices as $practice_index => $practice ) : ?>
				<a href="#<?php echo esc_attr( sanitize_title( $practice['title'] ) ); ?>">
					<span><?php echo esc_html( sprintf( '%02d', $practice_index + 1 ) ); ?></span>
					<?php echo esc_html( $practice['title'] ); ?>
				</a>
			<?php endforeach; ?>
		</nav>

		<div class="service-directory__practices">
			<?php foreach ( $practices as $practice_index => $practice ) : ?>
				<section id="<?php echo esc_attr( sanitize_title( $practice['title'] ) ); ?>" class="service-practice" data-reveal>
					<span id="service-<?php echo esc_attr( $practice_index + 1 ); ?>" class="service-practice__legacy-anchor" aria-hidden="true"></span>
					<header class="service-practice__header">
						<div class="service-practice__identity">
							<span><?php echo esc_html( sprintf( '%02d', $practice_index + 1 ) ); ?></span>
							<strong><?php echo esc_html( $practice['code'] ); ?></strong>
						</div>
						<div>
							<p class="eyebrow"><?php echo esc_html( $practice['signal'] ); ?></p>
							<h3><?php echo esc_html( $practice['title'] ); ?></h3>
							<p><?php echo esc_html( $practice['description'] ); ?></p>
						</div>
						<div class="service-practice__metric">
							<strong><?php echo esc_html( $practice['stat'] ); ?></strong>
							<span><?php echo esc_html( $practice['stat_label'] ); ?></span>
						</div>
					</header>

					<div class="service-practice__capabilities">
						<?php foreach ( $practice['links'] as $capability_index => $capability ) : ?>
							<article id="<?php echo esc_attr( $capability['slug'] ); ?>" class="service-capability">
								<header>
									<span><?php echo esc_html( sprintf( '%02d', $capability_index + 1 ) ); ?></span>
									<span><?php echo esc_html( $practice['code'] . '.' . ( $capability_index + 1 ) ); ?></span>
								</header>
								<h4><?php echo esc_html( $capability['label'] ); ?></h4>
								<p><?php echo esc_html( $capability['summary'] ); ?></p>
								<footer>
									<span><?php esc_html_e( 'Specialist capability', 'nolan-young-theme-template-99-master' ); ?></span>
									<span aria-hidden="true">&#8599;</span>
								</footer>
							</article>
						<?php endforeach; ?>
					</div>
				</section>
			<?php endforeach; ?>
		</div>
	</div>
</section>
