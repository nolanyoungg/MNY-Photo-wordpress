<?php get_header(); ?>
<main id="content" class="standard-page wrap">
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class( 'prose-page' ); ?>>
			<header class="prose-page__header"><p class="eyebrow"><?php esc_html_e( 'MNY Photo', 'mnyphoto-theme' ); ?></p><h1><?php the_title(); ?></h1></header>
			<div class="entry-content"><?php the_content(); wp_link_pages(); ?></div>
		</article>
		<?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
