<?php
/** Template Name: Portrait Campaign
 * Template Post Type: page
 * @package MNYphoto */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" tabindex="-1">
<?php get_template_part( 'template-parts/page-ppc-lp-2026/content', 'ppc-lp-2026-hero' ); ?>
<?php get_template_part( 'template-parts/page-ppc-lp-2026/content', 'ppc-lp-2026-sect01' ); ?>
<?php get_template_part( 'template-parts/page-ppc-lp-2026/content', 'ppc-lp-2026-sect02' ); ?>
<?php mnyphoto_editor_content(); ?>
</main>
<?php get_footer(); ?>
