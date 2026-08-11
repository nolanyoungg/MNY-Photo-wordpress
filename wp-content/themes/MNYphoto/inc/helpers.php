<?php
/**
 * Reusable presentation helpers.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

function nytt99_asset_url( $path ) {
	return esc_url( get_theme_file_uri( '/dist/' . ltrim( $path, '/' ) ) );
}

/**
 * Resolve a published page permalink by path with a stable home URL fallback.
 *
 * @param string $path Page path.
 * @return string
 */
function nytt99_page_url( $path ) {
	$page = get_page_by_path( trim( $path, '/' ) );

	if ( $page instanceof WP_Post && 'publish' === $page->post_status ) {
		return get_permalink( $page );
	}

	return home_url( '/' . trim( $path, '/' ) . '/' );
}

function nytt99_section_intro( $eyebrow, $title, $copy = '' ) {
	?>
	<header class="section__intro">
		<p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h2><?php echo esc_html( $title ); ?></h2>
		<?php if ( $copy ) : ?>
			<p class="section__lede"><?php echo esc_html( $copy ); ?></p>
		<?php endif; ?>
	</header>
	<?php
}

function nytt99_button( $label = 'Start a project', $url = '' ) {
	$url = $url ? $url : home_url( '/contact-us/' );
	printf( '<a class="button" href="%1$s"><span>%2$s</span><span aria-hidden="true">→</span></a>', esc_url( $url ), esc_html( $label ) );
}

/**
 * Estimate a post's reading time.
 *
 * @param int $post_id Optional post ID.
 * @return int
 */
function nytt99_reading_time( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );
	$words   = str_word_count( wp_strip_all_tags( strip_shortcodes( (string) $content ) ) );

	return max( 1, (int) ceil( $words / 220 ) );
}

/**
 * Return the first category for a post.
 *
 * @param int $post_id Optional post ID.
 * @return WP_Term|null
 */
function nytt99_primary_category( $post_id = 0 ) {
	$categories = get_the_category( $post_id ? $post_id : get_the_ID() );

	return $categories ? $categories[0] : null;
}

/**
 * Return the featured post ID used by the journal hero.
 *
 * @return int
 */
function nytt99_featured_post_id() {
	$sticky_posts = get_option( 'sticky_posts', array() );
	$query_args   = array(
		'fields'                 => 'ids',
		'posts_per_page'         => 1,
		'post_status'            => 'publish',
		'ignore_sticky_posts'    => true,
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	);

	if ( $sticky_posts ) {
		$query_args['post__in'] = array_map( 'absint', $sticky_posts );
		$query_args['orderby']  = 'post__in';
	}

	$featured = get_posts( $query_args );

	return $featured ? (int) $featured[0] : 0;
}

/**
 * Render a featured image or a deterministic editorial fallback.
 *
 * @param int    $post_id Post ID.
 * @param string $size    WordPress image size.
 * @param string $class   Additional wrapper class.
 * @return void
 */
function nytt99_editorial_visual( $post_id, $size = 'large', $class = '' ) {
	$class_name = trim( 'editorial-visual ' . $class );

	if ( has_post_thumbnail( $post_id ) ) {
		echo '<span class="' . esc_attr( $class_name ) . '">';
		echo get_the_post_thumbnail( $post_id, $size ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</span>';
		return;
	}

	$variant = ( absint( $post_id ) % 3 ) + 1;
	?>
	<span class="<?php echo esc_attr( $class_name . ' editorial-visual--fallback editorial-visual--' . $variant ); ?>" aria-hidden="true">
		<span class="editorial-visual__index"><?php echo esc_html( sprintf( '%02d', $variant ) ); ?></span>
		<span class="editorial-visual__axis"></span>
		<span class="editorial-visual__block editorial-visual__block--one"></span>
		<span class="editorial-visual__block editorial-visual__block--two"></span>
		<span class="editorial-visual__block editorial-visual__block--three"></span>
	</span>
	<?php
}
