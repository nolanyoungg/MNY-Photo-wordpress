<section class="home-services section-pad" id="services-overview">
	<div class="wrap">
		<?php mnyphoto_section_intro( __( 'The studio', 'mnyphoto-theme' ), __( 'One visual partner, from first thought to final master.', 'mnyphoto-theme' ), __( 'Each practice can stand alone or combine into a complete image system.', 'mnyphoto-theme' ) ); ?>
		<div class="service-list">
			<?php foreach ( mnyphoto_get_services() as $service ) : ?>
				<a class="service-line reveal" href="<?php echo esc_url( $service['url'] ); ?>"><span><?php echo esc_html( $service['number'] ); ?></span><h3><?php echo esc_html( $service['title'] ); ?></h3><p><?php echo esc_html( $service['label'] ); ?></p><span aria-hidden="true">↗</span></a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
