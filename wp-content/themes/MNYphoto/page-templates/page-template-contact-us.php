<?php
/** Template Name: Contact Us
 * Template Post Type: page
 * @package MNYphoto */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" tabindex="-1">
<?php get_template_part( 'template-parts/page-contact-us/content', 'contact-us-hero' ); ?>
<div class="shell contact-layout">
<?php get_template_part( 'template-parts/page-contact-us/content', 'contact-us-sect01' ); ?>
<?php get_template_part( 'template-parts/page-contact-us/content', 'contact-us-sect02' ); ?>
</div>
<?php mnyphoto_editor_content(); ?>
</main>
<?php get_footer(); ?>
