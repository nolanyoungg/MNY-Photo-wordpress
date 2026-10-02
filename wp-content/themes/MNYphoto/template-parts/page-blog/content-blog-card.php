<?php
/** Photography presentation. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<?php $post_id = absint( $args['post_id'] ); $category = nytt99_primary_category( $post_id ); ?>
<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="post-card"><div class="post-image"><?php mnyphoto_post_image( $post_id ); ?></div><div class="post-copy"><span class="tag"><?php echo esc_html( $category ? $category->name : __( 'From the blog', 'mnyphoto-theme' ) ); ?></span><h3><?php echo esc_html( get_the_title( $post_id ) ); ?></h3><p class="post-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $post_id ), 24 ) ); ?></p><span class="inline-link"><?php esc_html_e( 'Read story', 'mnyphoto-theme' ); ?> ↗</span></div></a>