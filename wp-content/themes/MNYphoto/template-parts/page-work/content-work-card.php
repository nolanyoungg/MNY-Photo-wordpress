<?php
/** A full-image link enhanced to a dialog. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$category = $args['category'];
?>
<article class="photo-card" data-category="<?php echo esc_attr( $category['id'] ); ?>" <?php if ( ! empty( $args['hidden'] ) ) : ?>hidden<?php endif; ?>>
<a href="<?php echo esc_url( mnyphoto_full_photo( $category['id'] ) ); ?>" data-photo="<?php echo esc_attr( $category['id'] ); ?>" data-title="<?php echo esc_attr( $category['story'] ); ?>" data-caption="<?php echo esc_attr( $category['name'] . ( mnyphoto_is_example( $category['id'] ) ? ' · ' . __( 'AI-generated illustration', 'mnyphoto-theme' ) : '' ) ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Open %s', 'mnyphoto-theme' ), $category['story'] ) ); ?>"><div class="photo-image"><?php mnyphoto_image( $category['id'] ); ?></div><div class="photo-meta"><h3><?php echo esc_html( $category['story'] ); ?></h3><p><?php echo esc_html( $category['name'] ); ?> ↗</p></div></a></article>
