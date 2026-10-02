<?php
/** blog photography section. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<section class="section pale"><div class="shell"><div class="section-heading"><div><p class="eyebrow"><?php esc_html_e( 'ON THE BLOG', 'mnyphoto-theme' ); ?></p><h2><?php esc_html_e( 'Good things to', 'mnyphoto-theme' ); ?> <em><?php esc_html_e( 'know.', 'mnyphoto-theme' ); ?></em></h2></div><a href="<?php echo esc_url( mnyphoto_url( 'blog' ) ); ?>" class="inline-link"><?php esc_html_e( 'More from the blog', 'mnyphoto-theme' ); ?> <span aria-hidden="true">↗</span></a></div><div class="post-grid"><?php $stories = mnyphoto_recent_posts(); foreach ( $stories as $story ) { get_template_part( 'template-parts/page-blog/content', 'blog-card', array( 'post_id' => $story->ID ) ); } if ( ! $stories ) { ?><p><?php esc_html_e( 'New stories are on their way. Take a look through the portfolio while we get the next one ready.', 'mnyphoto-theme' ); ?></p><?php } ?></div></div></section>
