<?php
/** One native menu destination. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$key = $args['key'];
$has_panel = in_array( $key, array( 'services', 'blog' ), true );
?>
<?php if ( $has_panel ) : ?><div class="nav-group" data-nav-group="<?php echo esc_attr( $key ); ?>"><div class="nav-row"><?php endif; ?>
<a href="<?php echo esc_url( $args['url'] ); ?>" <?php if ( $args['current'] ) : ?>aria-current="page"<?php endif; ?>><?php echo esc_html( $args['label'] ); ?></a>
<?php if ( $has_panel ) : ?>
	<button type="button" class="nav-toggle" aria-label="<?php echo esc_attr( sprintf( __( '%s menu', 'mnyphoto-theme' ), $args['label'] ) ); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr( $key . '-menu' ); ?>" data-menu="<?php echo esc_attr( $key ); ?>"><span class="nav-toggle-label" aria-hidden="true"><?php echo esc_html( $args['label'] ); ?></span><svg class="nav-chevron" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m5 8 7 7 7-7" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" /></svg></button></div>
	<?php if ( 'services' === $key ) { get_template_part( 'template-parts/page-shared/content', 'shared-services-menu' ); } else { get_template_part( 'template-parts/page-shared/content', 'shared-blog-menu' ); } ?>
</div>
<?php endif; ?>
