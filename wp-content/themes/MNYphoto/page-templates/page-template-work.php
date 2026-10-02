<?php
/** Template Name: Portfolio
 * Template Post Type: page
 * @package MNYphoto */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" tabindex="-1">
<?php get_template_part( 'template-parts/page-work/content', 'work-hero' ); ?>
<?php get_template_part( 'template-parts/page-work/content', 'work-sect01' ); ?>
<?php mnyphoto_editor_content(); ?>
</main>
<?php get_footer(); ?>
