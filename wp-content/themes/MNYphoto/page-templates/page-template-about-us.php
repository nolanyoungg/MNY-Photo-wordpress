<?php
/** Template Name: About Us
 * Template Post Type: page
 * @package MNYphoto */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" tabindex="-1">
<?php get_template_part( 'template-parts/page-about-us/content', 'about-us-hero' ); ?>
<?php get_template_part( 'template-parts/page-about-us/content', 'about-us-sect01' ); ?>
<?php get_template_part( 'template-parts/page-about-us/content', 'about-us-sect02' ); ?>
<?php mnyphoto_editor_content(); ?>
</main>
<?php get_footer(); ?>
