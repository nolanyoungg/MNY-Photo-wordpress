<?php
/** Photography presentation. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<?php $post_id = nytt99_featured_post_id(); if ( $post_id ) : ?>
<div class="shell"><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="featured-post"><div class="featured-post-image"><?php mnyphoto_post_image( $post_id, 'eager' ); ?></div><div><span class="tag"><?php echo esc_html( get_the_date( '', $post_id ) ); ?></span><h2><?php echo esc_html( get_the_title( $post_id ) ); ?></h2><p><?php echo esc_html( wp_trim_words( get_the_excerpt( $post_id ), 32 ) ); ?></p><span class="inline-link"><?php esc_html_e( 'Read the story', 'mnyphoto-theme' ); ?> ↗</span></div></a></div>
<?php endif; ?>