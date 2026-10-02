<?php
/** Photography services selector and preview stage. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<div class="dropdown services-dropdown" id="services-menu" hidden><div class="dropdown-inner shell">
	<div class="service-options"><p class="eyebrow"><?php esc_html_e( 'SIX WAYS TO SEE YOUR WORLD', 'mnyphoto-theme' ); ?></p><div id="service-options">
	<?php foreach ( mnyphoto_categories() as $index => $category ) : ?>
		<div class="service-option<?php echo 0 === $index ? ' active' : ''; ?>" data-service="<?php echo esc_attr( $category['id'] ); ?>">
			<a href="<?php echo esc_url( mnyphoto_url( 'services' ) . '#service-' . $category['id'] ); ?>"><span class="number"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span><?php echo esc_html( $category['name'] ); ?><span class="arrow" aria-hidden="true">↗</span></a>
			<div class="service-mobile-detail"><p><?php echo esc_html( $category['description'] ); ?></p><ul><?php foreach ( $category['capabilities'] as $cap_index => $capability ) : ?><li><a href="<?php echo esc_url( mnyphoto_capability_url( $category, $cap_index ) ); ?>"><?php echo esc_html( $capability ); ?></a></li><?php endforeach; ?></ul></div>
		</div>
	<?php endforeach; ?>
	</div><a class="inline-link menu-all" href="<?php echo esc_url( mnyphoto_url( 'services' ) ); ?>"><?php esc_html_e( 'Explore all services', 'mnyphoto-theme' ); ?> ↗</a></div>
	<div id="service-stage">
	<?php foreach ( mnyphoto_categories() as $index => $category ) : ?>
		<div class="service-stage" data-service-stage="<?php echo esc_attr( $category['id'] ); ?>" <?php if ( $index ) : ?>hidden<?php endif; ?>><div class="stage-photo"><?php mnyphoto_image( $category['id'] ); ?></div><div class="stage-copy"><span class="eyebrow"><?php esc_html_e( 'IN THE FRAME', 'mnyphoto-theme' ); ?></span><h3><?php echo esc_html( $category['name'] ); ?></h3><p><?php echo esc_html( $category['description'] ); ?></p><ul><?php foreach ( $category['capabilities'] as $cap_index => $capability ) : ?><li><a href="<?php echo esc_url( mnyphoto_capability_url( $category, $cap_index ) ); ?>"><?php echo esc_html( $capability ); ?></a></li><?php endforeach; ?></ul><a class="inline-link" href="<?php echo esc_url( mnyphoto_url( 'services' ) . '#service-' . $category['id'] ); ?>"><?php esc_html_e( 'Explore', 'mnyphoto-theme' ); ?> ↗</a></div></div>
	<?php endforeach; ?>
	</div>
</div></div>
