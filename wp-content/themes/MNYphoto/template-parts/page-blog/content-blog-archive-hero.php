<?php
/** Photography presentation. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<div class="shell page-heading"><p class="eyebrow"><?php esc_html_e( 'FROM THE BLOG', 'mnyphoto-theme' ); ?></p><h1><?php the_archive_title(); ?></h1><?php the_archive_description( '<div class="archive-description">', '</div>' ); ?></div>