<?php
get_header();
?>
<main id="content">
	<?php get_template_part( 'template-parts/page-blog/content', 'blog-single-hero' ); ?>
	<?php get_template_part( 'template-parts/page-blog/content', 'blog-single-page' ); ?>
	<?php get_template_part( 'template-parts/page-blog/content', 'blog-single-next-blog' ); ?>
	<?php get_template_part( 'template-parts/page-blog/content', 'blog-single-cta-bottom' ); ?>
</main>
<?php get_footer();
