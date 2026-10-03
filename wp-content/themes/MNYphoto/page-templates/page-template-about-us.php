<?php
/** Template Name: About Us
 * Template Post Type: page
 * @package MNYphoto */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" tabindex="-1">
<div class="mny-about-061">
<?php get_template_part( 'template-parts/page-about-us/00-about-us-hero' ); ?>
<?php get_template_part( 'template-parts/page-about-us/02-about-us-meet-the-team' ); ?>
<?php get_template_part( 'template-parts/page-about-us/03-about-us-photo-cycle' ); ?>
<?php get_template_part( 'template-parts/page-about-us/04-about-us-our-story' ); ?>
</div>
<?php mnyphoto_editor_content(); ?>
</main>
<?php get_footer(); ?>
