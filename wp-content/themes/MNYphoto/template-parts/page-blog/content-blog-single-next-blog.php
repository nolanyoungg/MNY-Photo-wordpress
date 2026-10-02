<?php
/** Photography presentation. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<div class="shell section post-navigation-wrap"><?php the_post_navigation(); ?><a class="inline-link" href="<?php echo esc_url( mnyphoto_url( 'blog' ) ); ?>"><?php esc_html_e( 'Back to the blog', 'mnyphoto-theme' ); ?> ↗</a></div>