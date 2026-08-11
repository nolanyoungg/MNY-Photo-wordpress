<?php
$mnyphoto_home_work = array(
	array( 'editorial-arcade.webp', __( 'Editorial portrait', 'mnyphoto-theme' ), __( 'Two people moving through a monochrome Florentine arcade.', 'mnyphoto-theme' ), 'portrait' ),
	array( 'sugarcane-still-life.webp', __( 'Commercial still life', 'mnyphoto-theme' ), __( 'Three glasses of fresh sugarcane juice on a wood table.', 'mnyphoto-theme' ), 'square' ),
	array( 'cards-overhead.webp', __( 'Lifestyle story', 'mnyphoto-theme' ), __( 'Hands sharing a card game, photographed from above.', 'mnyphoto-theme' ), 'landscape' ),
);
?>
<section class="home-work section-pad section-dark">
	<div class="wrap">
		<?php mnyphoto_section_intro( __( 'Selected frames', 'mnyphoto-theme' ), __( 'Images that hold attention, then reveal the story.', 'mnyphoto-theme' ) ); ?>
		<div class="editorial-grid">
			<?php foreach ( $mnyphoto_home_work as $index => $item ) : ?>
				<figure class="editorial-tile editorial-tile--<?php echo esc_attr( $item[3] ); ?> reveal" data-modal-image="<?php echo esc_url( get_theme_file_uri( 'dist/img/' . $item[0] ) ); ?>" data-modal-alt="<?php echo esc_attr( $item[2] ); ?>" tabindex="0" role="button" aria-label="<?php echo esc_attr( sprintf( __( 'Enlarge %s', 'mnyphoto-theme' ), $item[1] ) ); ?>">
					<?php echo mnyphoto_image( $item[0], $item[2] ); ?>
					<figcaption><span>0<?php echo esc_html( $index + 1 ); ?></span><strong><?php echo esc_html( $item[1] ); ?></strong></figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
		<a class="text-link text-link--light" href="<?php echo esc_url( mnyphoto_page_url( 'work' ) ); ?>"><?php esc_html_e( 'Enter the portfolio', 'mnyphoto-theme' ); ?> →</a>
	</div>
	<div class="image-modal" data-image-modal hidden role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Image preview', 'mnyphoto-theme' ); ?>"><button type="button" class="image-modal__close" data-modal-close aria-label="<?php esc_attr_e( 'Close image preview', 'mnyphoto-theme' ); ?>">×</button><img alt=""></div>
</section>
