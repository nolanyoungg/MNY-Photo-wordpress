<?php
/** Template Name: Portfolio
 * Template Post Type: page
 * @package MNYphoto */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" class="mny-portfolio" tabindex="-1">
<?php get_template_part( 'template-parts/page-portfolio/00-portfolio-hero' ); ?>
<?php get_template_part( 'template-parts/page-portfolio/01-portfolio-services-section' ); ?>
<?php get_template_part( 'template-parts/page-portfolio/02-portfolio-cta' ); ?>
<?php mnyphoto_editor_content(); ?>
</main>
<?php get_footer( null, array( 'mnyphoto_skip_cta' => true ) ); ?>
