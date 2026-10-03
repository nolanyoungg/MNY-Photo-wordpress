<?php
/** S061 / S010 moving photo album. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$mnyphoto_shots = array( 'family', 'pets', 'landscapes', 'portraits', 'family', 'landscapes', 'pets', 'portraits' );
$mnyphoto_examples = false;
foreach ( array_unique( $mnyphoto_shots ) as $mnyphoto_category_id ) {
	$mnyphoto_examples = $mnyphoto_examples || mnyphoto_is_example( $mnyphoto_category_id );
}
?>
<div class="part-photos">
	<section class="photo-section" aria-labelledby="mny061-photos-title">
		<div class="photo-heading container">
			<div>
				<h2 id="mny061-photos-title"><?php esc_html_e( 'The moments around the photographs.', 'mnyphoto-theme' ); ?></h2>
				<p><?php esc_html_e( 'People, pets, places, and everything in between.', 'mnyphoto-theme' ); ?></p>
			</div>
			<div class="motion-controls">
				<button class="pause" type="button" aria-pressed="false" aria-controls="mny061-photo-strip" data-pause-label="<?php esc_attr_e( 'Pause photos', 'mnyphoto-theme' ); ?>" data-play-label="<?php esc_attr_e( 'Play photos', 'mnyphoto-theme' ); ?>"><?php esc_html_e( 'Pause photos', 'mnyphoto-theme' ); ?></button>
			</div>
		</div>
		<div class="strip" id="mny061-photo-strip" tabindex="0" role="region" aria-label="<?php esc_attr_e( 'Our world in photographs', 'mnyphoto-theme' ); ?>">
			<div class="track">
				<?php for ( $mnyphoto_copy = 0; $mnyphoto_copy < 2; $mnyphoto_copy++ ) : ?>
					<div class="photo-group<?php echo $mnyphoto_copy ? ' duplicate' : ''; ?>"<?php if ( $mnyphoto_copy ) : ?> aria-hidden="true" inert<?php endif; ?>>
						<?php foreach ( $mnyphoto_shots as $mnyphoto_category_id ) : ?>
							<figure class="shot"><?php mnyphoto_image( $mnyphoto_category_id, 'lazy', '', '(max-width: 800px) 200px, 285px' ); ?></figure>
						<?php endforeach; ?>
					</div>
				<?php endfor; ?>
			</div>
		</div>
		<?php if ( $mnyphoto_examples ) : ?>
			<p class="photo-note"><?php esc_html_e( 'Includes AI-generated photo references, shown to demonstrate the layout and movement. Replace with MNY photographs.', 'mnyphoto-theme' ); ?></p>
		<?php endif; ?>
	</section>
</div>
