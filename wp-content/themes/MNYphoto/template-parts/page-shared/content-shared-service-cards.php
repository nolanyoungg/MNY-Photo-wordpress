<?php
/** Photography presentation. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<div class="service-grid">
<?php foreach ( mnyphoto_categories() as $index => $category ) : ?>
<a class="service-card" href="<?php echo esc_url( mnyphoto_url( 'services' ) . '#service-' . $category['id'] ); ?>"><div class="service-image"><?php mnyphoto_image( $category['id'] ); ?></div><span class="card-number"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span><div class="service-card-heading"><h3><?php echo esc_html( $category['name'] ); ?></h3><span aria-hidden="true">↗</span></div><p><?php echo esc_html( $category['short'] ); ?></p></a>
<?php endforeach; ?>
</div>