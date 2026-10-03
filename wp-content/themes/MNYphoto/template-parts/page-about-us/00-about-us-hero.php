<?php
/** S061 / S017 photo mosaic hero. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<section class="part-hero" aria-labelledby="mny061-title">
	<div class="world dark">
		<div class="shell split">
			<div class="intro">
				<span class="tag"><?php esc_html_e( 'A little about us', 'mnyphoto-theme' ); ?></span>
				<h1 class="headline" id="mny061-title"><?php esc_html_e( 'A little of us.', 'mnyphoto-theme' ); ?><br><?php esc_html_e( 'A lot of life.', 'mnyphoto-theme' ); ?></h1>
				<p class="lead"><?php esc_html_e( 'We’re Maria, Nolan, and Rock. Two people, one very good dog, and a curious way of looking at the world.', 'mnyphoto-theme' ); ?></p>
				<a class="button" href="#mny061-team"><?php esc_html_e( 'Meet the team', 'mnyphoto-theme' ); ?> <span aria-hidden="true">↓</span></a>
			</div>
			<div class="mosaic">
				<?php foreach ( array( 'family', 'pets', 'landscapes' ) as $mnyphoto_category_id ) : ?>
					<figure class="photo">
						<?php mnyphoto_image( $mnyphoto_category_id, 'family' === $mnyphoto_category_id ? 'eager' : 'lazy', '', '(max-width: 900px) 88vw, 45vw' ); ?>
						<?php if ( mnyphoto_is_example( $mnyphoto_category_id ) ) : ?>
							<figcaption><?php esc_html_e( 'AI reference · Not client work', 'mnyphoto-theme' ); ?></figcaption>
						<?php endif; ?>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
