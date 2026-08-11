<?php
get_header();
?>
<main id="content">
	<?php get_template_part( 'template-parts/page-front-page/content', 'front-page-hero' ); ?>
	<?php get_template_part( 'template-parts/page-front-page/content', 'front-page-services' ); ?>
	<?php get_template_part( 'template-parts/page-front-page/content', 'front-page-work' ); ?>
	<?php get_template_part( 'template-parts/page-front-page/content', 'front-page-process' ); ?>
	<?php get_template_part( 'template-parts/page-front-page/content', 'front-page-cta' ); ?>
</main>
<?php
get_footer();
