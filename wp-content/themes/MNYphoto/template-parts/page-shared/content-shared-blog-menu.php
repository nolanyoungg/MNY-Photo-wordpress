<?php
/** Recent published posts, including sparse-content states. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$posts = mnyphoto_recent_posts();
?>
<div class="dropdown blog-dropdown" id="blog-menu" hidden><div class="shell"><div class="dropdown-heading"><p class="eyebrow"><?php esc_html_e( 'NOTES FROM BEHIND THE CAMERA', 'mnyphoto-theme' ); ?></p><a href="<?php echo esc_url( mnyphoto_url( 'blog' ) ); ?>" class="inline-link"><?php esc_html_e( 'All stories', 'mnyphoto-theme' ); ?> ↗</a></div><div class="blog-menu-grid" style="--post-count:<?php echo esc_attr( max( 1, count( $posts ) ) ); ?>">
<?php foreach ( $posts as $story ) { get_template_part( 'template-parts/page-blog/content', 'blog-card', array( 'post_id' => $story->ID ) ); } ?>
<?php if ( ! $posts ) : ?><p><?php esc_html_e( 'New stories are on their way. Explore the portfolio in the meantime.', 'mnyphoto-theme' ); ?> <a class="inline-link" href="<?php echo esc_url( mnyphoto_url( 'portfolio' ) ); ?>"><?php esc_html_e( 'View portfolio', 'mnyphoto-theme' ); ?> ↗</a></p><?php endif; ?>
</div></div></div>
