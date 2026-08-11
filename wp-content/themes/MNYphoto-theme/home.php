<?php
get_header();
?>
<main id="content">
	<?php get_template_part( 'template-parts/page-blog/content', 'blog-hero' ); ?>
	<?php get_template_part( 'template-parts/page-blog/content', 'blog-page-grid' ); ?>
	<?php get_template_part( 'template-parts/page-blog/content', 'blog-cta-bottom' ); ?>
</main>
<?php get_footer();
