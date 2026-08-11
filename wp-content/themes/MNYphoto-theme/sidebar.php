<aside class="sidebar" aria-label="<?php esc_attr_e( 'Journal sidebar', 'mnyphoto-theme' ); ?>">
	<?php if ( is_active_sidebar( 'journal-sidebar' ) ) : dynamic_sidebar( 'journal-sidebar' ); else : ?>
		<section class="sidebar-widget"><h2 class="sidebar-widget__title"><?php esc_html_e( 'Explore the archive', 'mnyphoto-theme' ); ?></h2><?php get_search_form(); ?></section>
	<?php endif; ?>
</aside>
