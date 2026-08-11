<?php get_header(); ?>
<main id="content" class="archive-view wrap">
	<header class="archive-header"><p class="eyebrow"><?php esc_html_e( 'Search the studio', 'mnyphoto-theme' ); ?></p><h1><?php echo esc_html( sprintf( __( 'Results for “%s”', 'mnyphoto-theme' ), get_search_query() ) ); ?></h1><?php get_search_form(); ?></header>
	<div class="journal-grid"><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); mnyphoto_post_card( get_the_ID() ); endwhile; else : ?><div class="empty-state"><h2><?php esc_html_e( 'Nothing matched that phrase.', 'mnyphoto-theme' ); ?></h2><p><?php esc_html_e( 'Try a broader search or return to the portfolio.', 'mnyphoto-theme' ); ?></p></div><?php endif; ?></div>
	<?php the_posts_pagination(); ?>
</main>
<?php get_footer(); ?>
