<?php
/**
 * Contact channels and project-fit routes.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$routes = array(
	array(
		'01',
		'Build something consequential',
		'A new platform, service, product, or brand system needs senior alignment before delivery accelerates.',
		array( 'New proposition', 'Multi-team roadmap', 'Enterprise launch' ),
		'Transformation',
	),
	array(
		'02',
		'Fix a system under pressure',
		'Experience debt, fragmented technology, or declining performance is blocking customers and internal teams.',
		array( 'Experience recovery', 'Platform modernization', 'Conversion pressure' ),
		'Recovery',
	),
	array(
		'03',
		'Make a difficult decision',
		'A consequential choice needs outside evidence, a sharper frame, and an executable recommendation.',
		array( 'Executive advisory', 'Opportunity sprint', 'Independent review' ),
		'Decision',
	),
);
?>
<section class="section section--cream contact-routes">
	<div class="content-wrap">
		<header class="section-heading section-heading--split" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Choose your starting signal', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Three routes. One senior team.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p><?php esc_html_e( 'You do not need a finished scope. Select the situation that feels closest and we will help frame the actual work.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>
		<div class="contact-route-grid">
			<?php foreach ( $routes as $route ) : ?>
				<article class="contact-route" data-reveal>
					<header>
						<span><?php echo esc_html( $route[0] ); ?></span>
						<small><?php echo esc_html( $route[4] ); ?></small>
					</header>
					<div class="contact-route__diagram" aria-hidden="true">
						<i></i><i></i><i></i>
					</div>
					<h3><?php echo esc_html( $route[1] ); ?></h3>
					<p><?php echo esc_html( $route[2] ); ?></p>
					<ul>
						<?php foreach ( $route[3] as $signal ) : ?>
							<li><?php echo esc_html( $signal ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="text-link" href="#project-brief">
						<?php esc_html_e( 'Start with this route', 'nolan-young-theme-template-99-master' ); ?>
						<span aria-hidden="true">→</span>
					</a>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="contact-routes__note" data-reveal>
			<span><?php esc_html_e( 'Not sure?', 'nolan-young-theme-template-99-master' ); ?></span>
			<p><?php esc_html_e( 'That is useful information too. Describe the tension and we will help identify the right first move.', 'nolan-young-theme-template-99-master' ); ?></p>
		</div>
	</div>
</section>
