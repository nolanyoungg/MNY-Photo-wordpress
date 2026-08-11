<?php
/**
 * Search results template.
 *
 * @package NolanYoungThemeTemplate99Master
 */

global $wp_query;

$result_count = isset( $wp_query->found_posts ) ? (int) $wp_query->found_posts : 0;
$search_term  = get_search_query();

get_header();
?>
<main id="content">
	<header class="search-hero">
		<div class="content-wrap search-hero__layout">
			<div class="search-hero__content" data-reveal>
				<p class="eyebrow"><?php esc_html_e( 'Site search / live index', 'nolan-young-theme-template-99-master' ); ?></p>
				<h1>
					<?php
					printf(
						/* translators: %s: search query. */
						esc_html__( 'Results for “%s”', 'nolan-young-theme-template-99-master' ),
						esc_html( $search_term )
					);
					?>
				</h1>
				<p class="hero__lede">
					<?php
					printf(
						/* translators: %s: number of search results. */
						esc_html( _n( '%s matching route across the site.', '%s matching routes across the site.', $result_count, 'nolan-young-theme-template-99-master' ) ),
						esc_html( number_format_i18n( $result_count ) )
					);
					?>
				</p>
				<?php get_search_form(); ?>
			</div>
			<aside class="search-index" data-reveal aria-label="<?php esc_attr_e( 'Search index summary', 'nolan-young-theme-template-99-master' ); ?>">
				<header>
					<span><?php esc_html_e( 'Index scan', 'nolan-young-theme-template-99-master' ); ?></span>
					<small><?php esc_html_e( 'Complete', 'nolan-young-theme-template-99-master' ); ?></small>
				</header>
				<div class="search-index__query">
					<span><?php esc_html_e( 'Query', 'nolan-young-theme-template-99-master' ); ?></span>
					<strong><?php echo esc_html( $search_term ? $search_term : __( 'All content', 'nolan-young-theme-template-99-master' ) ); ?></strong>
				</div>
				<div class="search-index__bar" aria-hidden="true"><i style="--value: 100%;"></i></div>
				<dl>
					<div><dt><?php esc_html_e( 'Matches', 'nolan-young-theme-template-99-master' ); ?></dt><dd><?php echo esc_html( number_format_i18n( $result_count ) ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Content types', 'nolan-young-theme-template-99-master' ); ?></dt><dd><?php esc_html_e( 'Pages + posts', 'nolan-young-theme-template-99-master' ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Order', 'nolan-young-theme-template-99-master' ); ?></dt><dd><?php esc_html_e( 'Relevance', 'nolan-young-theme-template-99-master' ); ?></dd></div>
				</dl>
			</aside>
		</div>
	</header>
	<section class="section search-collection">
		<div class="content-wrap">
			<?php if ( have_posts() ) : ?>
				<div class="search-collection__toolbar" data-reveal>
					<span><?php esc_html_e( 'Matching content', 'nolan-young-theme-template-99-master' ); ?></span>
					<strong><?php echo esc_html( number_format_i18n( $result_count ) ); ?></strong>
				</div>
				<div class="search-result-list">
					<?php $result_index = 0; ?>
					<?php while ( have_posts() ) : ?>
						<?php
						the_post();
						++$result_index;
						$post_type_object = get_post_type_object( get_post_type() );
						$type_label       = $post_type_object ? $post_type_object->labels->singular_name : __( 'Content', 'nolan-young-theme-template-99-master' );
						?>
						<article <?php post_class( 'search-result-card' ); ?> data-reveal>
							<div class="search-result-card__index"><?php echo esc_html( str_pad( (string) $result_index, 2, '0', STR_PAD_LEFT ) ); ?></div>
							<div class="search-result-card__content">
								<div class="search-result-card__meta">
									<span><?php echo esc_html( $type_label ); ?></span>
									<time datetime="<?php echo esc_attr( get_the_modified_date( DATE_W3C ) ); ?>">
										<?php
										printf(
											/* translators: %s: modified date. */
											esc_html__( 'Updated %s', 'nolan-young-theme-template-99-master' ),
											esc_html( get_the_modified_date( 'M j, Y' ) )
										);
										?>
									</time>
								</div>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?></p>
							</div>
							<a class="search-result-card__link" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View %s', 'nolan-young-theme-template-99-master' ), get_the_title() ) ); ?>">
								<span><?php esc_html_e( 'Open', 'nolan-young-theme-template-99-master' ); ?></span>
								<i aria-hidden="true">→</i>
							</a>
						</article>
					<?php endwhile; ?>
				</div>
				<nav class="pagination-wrap" aria-label="<?php esc_attr_e( 'Search result pages', 'nolan-young-theme-template-99-master' ); ?>">
					<?php nytt99_pagination(); ?>
				</nav>
			<?php else : ?>
				<div class="search-empty" data-reveal>
					<div class="search-empty__code" aria-hidden="true"><span>SEARCH</span><strong>00</strong></div>
					<div>
						<p class="eyebrow"><?php esc_html_e( 'No exact match', 'nolan-young-theme-template-99-master' ); ?></p>
						<h2><?php esc_html_e( 'Try the language behind the question.', 'nolan-young-theme-template-99-master' ); ?></h2>
						<p><?php esc_html_e( 'Use a broader term, search for a capability, or return to the main destinations.', 'nolan-young-theme-template-99-master' ); ?></p>
					</div>
					<a class="button button--quiet" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return home', 'nolan-young-theme-template-99-master' ); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
