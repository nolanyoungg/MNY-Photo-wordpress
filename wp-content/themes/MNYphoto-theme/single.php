<?php get_header(); ?>
<main id="content" class="single-journal">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'template-parts/page-blog/content', 'blog-single-hero' ); ?>
		<?php get_template_part( 'template-parts/page-blog/content', 'blog-single-page' ); ?>
		<?php get_template_part( 'template-parts/page-blog/content', 'blog-single-next-blog' ); ?>
		<?php get_template_part( 'template-parts/page-blog/content', 'blog-single-cta-bottom' ); ?>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
