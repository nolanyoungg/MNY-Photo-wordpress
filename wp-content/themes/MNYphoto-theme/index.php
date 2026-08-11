<?php get_header(); ?>
<main id="content" class="archive-view wrap">
	<header class="archive-header"><p class="eyebrow"><?php esc_html_e( 'Stories & observations', 'mnyphoto-theme' ); ?></p><h1><?php esc_html_e( 'The journal', 'mnyphoto-theme' ); ?></h1></header>
	<div class="journal-grid">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); mnyphoto_post_card( get_the_ID() ); endwhile; else : ?>
			<p><?php esc_html_e( 'No stories have been published yet.', 'mnyphoto-theme' ); ?></p>
		<?php endif; ?>
	</div>
	<?php the_posts_pagination(); ?>
</main>
<?php get_footer(); ?>
