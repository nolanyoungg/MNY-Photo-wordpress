<?php
get_header();
?>
<main id="content">
	<?php get_template_part( 'template-parts/page-404/content', '404-hero' ); ?>
	<?php get_template_part( 'template-parts/page-404/content', '404-sect01' ); ?>
	<?php get_template_part( 'template-parts/page-404/content', '404-sect02' ); ?>
	<?php get_template_part( 'template-parts/page-404/content', '404-cta' ); ?>
</main>
<?php get_footer();
