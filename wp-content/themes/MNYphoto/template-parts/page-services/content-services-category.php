<?php
/** One photography service and its linked session types. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$category = $args['category']; $index = $args['index'];
?>
<article class="service-detail" id="service-<?php echo esc_attr( $category['id'] ); ?>" tabindex="-1"><div class="detail-photo"><?php mnyphoto_image( $category['id'] ); ?></div><div class="detail-copy"><p class="eyebrow"><?php echo esc_html( sprintf( '%02d / %s', $index + 1, $category['full'] ) ); ?></p><h2><?php echo wp_kses( $category['title'], array( 'br' => array() ) ); ?></h2><p><?php echo esc_html( $category['description'] ); ?></p><ul class="capabilities"><?php foreach ( $category['capabilities'] as $cap_index => $capability ) : ?><li id="cap-<?php echo esc_attr( $category['id'] . '-' . $cap_index ); ?>" tabindex="-1"><?php echo esc_html( $capability ); ?></li><?php endforeach; ?></ul><a class="inline-link" href="<?php echo esc_url( add_query_arg( 'category', $category['id'], mnyphoto_url( 'contact' ) ) ); ?>"><?php esc_html_e( 'Let’s talk about your session', 'mnyphoto-theme' ); ?> ↗</a></div></article>
