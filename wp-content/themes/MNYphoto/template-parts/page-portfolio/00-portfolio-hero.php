<?php
/** Approved vertical portfolio gallery. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$mnyphoto_columns = array(
	array( 'portraits', 'landscapes', 'pets' ),
	array( 'family', 'events', 'homes' ),
	array( 'pets', 'portraits', 'landscapes' ),
	array( 'homes', 'family', 'events' ),
	array( 'landscapes', 'pets', 'portraits' ),
);
?>
<section class="portfolio-hero" aria-labelledby="portfolio-title" data-portfolio-hero>
	<div class="portfolio-motion-board" aria-hidden="true">
		<?php foreach ( $mnyphoto_columns as $mnyphoto_index => $mnyphoto_column ) : ?>
			<div class="portfolio-lane" data-portfolio-lane data-speed="<?php echo esc_attr( $mnyphoto_index % 2 ? '-25' : '29' ); ?>">
				<div class="portfolio-track"><div class="portfolio-group">
					<?php foreach ( $mnyphoto_column as $mnyphoto_id ) : ?>
						<div class="portfolio-tile" data-subject="<?php echo esc_attr( $mnyphoto_id ); ?>"><?php mnyphoto_image( $mnyphoto_id, 'eager', '', '(max-width: 600px) 34vw, (max-width: 800px) 25vw, 20vw' ); ?></div>
					<?php endforeach; ?>
				</div></div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="portfolio-hero-shade" aria-hidden="true"></div>
	<div class="portfolio-hero-copy">
		<h1 id="portfolio-title"><?php echo wp_kses_post( __( 'A life full<br>of good things.', 'mnyphoto-theme' ) ); ?></h1>
		<p><?php esc_html_e( 'Six collections. A thousand reasons to remember.', 'mnyphoto-theme' ); ?></p>
		<a href="#collections"><?php esc_html_e( 'Explore the portfolio', 'mnyphoto-theme' ); ?> <span aria-hidden="true">↓</span></a>
	</div>
	<button class="portfolio-motion-toggle" type="button" aria-label="<?php esc_attr_e( 'Pause moving photographs', 'mnyphoto-theme' ); ?>" aria-pressed="false" data-portfolio-pause data-pause-label="<?php esc_attr_e( 'Pause moving photographs', 'mnyphoto-theme' ); ?>" data-play-label="<?php esc_attr_e( 'Play moving photographs', 'mnyphoto-theme' ); ?>" hidden><span aria-hidden="true">Ⅱ</span></button>
</section>
