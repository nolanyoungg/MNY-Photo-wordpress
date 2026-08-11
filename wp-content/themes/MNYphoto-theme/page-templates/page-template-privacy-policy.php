<?php /* Template Name: Privacy Policy */ get_header(); ?>
<main id="content" class="standard-page wrap">
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class( 'prose-page privacy-page' ); ?>><header class="prose-page__header"><p class="eyebrow"><?php esc_html_e( 'Your information', 'mnyphoto-theme' ); ?></p><h1><?php the_title(); ?></h1><p><?php esc_html_e( 'This page is managed in the WordPress editor so the studio can publish the policy that matches its actual services and integrations.', 'mnyphoto-theme' ); ?></p></header><div class="entry-content"><?php the_content(); ?></div></article>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
