<?php
/** Template Name: Services
 * Template Post Type: page
 * @package MNYphoto */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" tabindex="-1">
<?php get_template_part( 'template-parts/page-services/content', 'services-hero' ); ?>
<div class="shell service-directory">
<?php get_template_part( 'template-parts/page-services/content', 'services-sect01' ); ?>
<?php get_template_part( 'template-parts/page-services/content', 'services-sect02' ); ?>
<?php get_template_part( 'template-parts/page-services/content', 'services-sect03' ); ?>
<?php get_template_part( 'template-parts/page-services/content', 'services-sect04' ); ?>
<?php get_template_part( 'template-parts/page-services/content', 'services-sect05' ); ?>
<?php get_template_part( 'template-parts/page-services/content', 'services-sect06' ); ?>
</div>
<?php get_template_part( 'template-parts/page-services/content', 'services-faq' ); ?>
<?php mnyphoto_editor_content(); ?>
</main>
<?php get_footer(); ?>
