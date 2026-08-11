<?php
/**
 * Template Name: Work
 *
 * @package NolanYoungThemeTemplate99Master
 */

get_header();
?>
<main id="content">
	<?php get_template_part( 'template-parts/page-work/content', 'work-hero' ); ?>
	<?php get_template_part( 'template-parts/page-work/content', 'work-sect01' ); ?>
	<?php get_template_part( 'template-parts/page-work/content', 'work-sect02' ); ?>
	<?php get_template_part( 'template-parts/page-work/content', 'work-sect03' ); ?>
	<?php get_template_part( 'template-parts/page-work/content', 'work-sect04' ); ?>
	<?php get_template_part( 'template-parts/page-work/content', 'work-sect05' ); ?>
	<?php get_template_part( 'template-parts/page-work/content', 'work-cta' ); ?>
</main>
<?php get_footer();
