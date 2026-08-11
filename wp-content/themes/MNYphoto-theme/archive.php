<?php get_header(); ?>
<main id="content" class="archive-view wrap">
	<header class="archive-header"><p class="eyebrow"><?php esc_html_e( 'Journal archive', 'mnyphoto-theme' ); ?></p><?php the_archive_title( '<h1>', '</h1>' ); ?><?php the_archive_description( '<div class="archive-description">', '</div>' ); ?></header>
	<div class="journal-grid"><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); mnyphoto_post_card( get_the_ID() ); endwhile; else : ?><p><?php esc_html_e( 'No stories were found in this archive.', 'mnyphoto-theme' ); ?></p><?php endif; ?></div>
	<?php the_posts_pagination(); ?>
</main>
<?php get_footer(); ?>
