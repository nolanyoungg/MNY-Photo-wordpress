<?php
/** Photography presentation. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<div class="shell page-heading article-heading"><p class="eyebrow"><?php echo esc_html( get_the_date() ); ?> / <?php esc_html_e( 'MNY PHOTO BLOG', 'mnyphoto-theme' ); ?></p><h1><?php the_title(); ?></h1></div><div class="shell article-hero-photo"><?php mnyphoto_post_image( get_the_ID(), 'eager' ); ?></div>