<?php
/** Filterable six-collection portfolio. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$filter = isset( $_GET['collection'] ) && is_string( $_GET['collection'] ) ? sanitize_key( wp_unslash( $_GET['collection'] ) ) : 'all';
$filter = mnyphoto_category( $filter ) ? $filter : 'all';
$filters = array_merge( array( array( 'id' => 'all', 'name' => __( 'All photographs', 'mnyphoto-theme' ) ) ), mnyphoto_categories() );
?>
<div class="shell"><nav class="portfolio-filters" id="portfolio-filters" aria-label="<?php esc_attr_e( 'Filter portfolio', 'mnyphoto-theme' ); ?>">
<?php foreach ( $filters as $category ) : ?><a href="<?php echo esc_url( add_query_arg( 'collection', $category['id'], mnyphoto_url( 'portfolio' ) ) ); ?>" data-filter="<?php echo esc_attr( $category['id'] ); ?>" <?php if ( $filter === $category['id'] ) : ?>aria-current="true"<?php endif; ?>><?php echo esc_html( $category['name'] ); ?></a><?php endforeach; ?>
</nav><?php if ( mnyphoto_has_examples() ) : ?><p class="small-note"><?php esc_html_e( 'AI-generated photographs illustrate our six photography collections. They are not client sessions.', 'mnyphoto-theme' ); ?></p><?php endif; ?>
<div class="portfolio-grid" id="portfolio-grid"><?php foreach ( mnyphoto_categories() as $category ) { get_template_part( 'template-parts/page-work/content', 'work-card', array( 'category' => $category, 'hidden' => 'all' !== $filter && $filter !== $category['id'] ) ); } ?></div><p id="portfolio-status" class="small-note" role="status"></p></div><div class="section-spacer"></div>
