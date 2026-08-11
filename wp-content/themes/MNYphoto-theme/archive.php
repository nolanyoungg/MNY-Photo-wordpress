<?php
/**
 * Archive template.
 *
 * @package NolanYoungThemeTemplate99Master
 */

global $wp_query;

$archive_count = isset( $wp_query->found_posts ) ? (int) $wp_query->found_posts : 0;

get_header();
?>
<main id="content">
	<header class="collection-hero">
		<div class="content-wrap collection-hero__layout">
			<div class="collection-hero__content" data-reveal>
				<p class="eyebrow"><?php esc_html_e( 'Journal collection', 'nolan-young-theme-template-99-master' ); ?></p>
				<h1><?php the_archive_title(); ?></h1>
				<?php the_archive_description( '<div class="collection-hero__description">', '</div>' ); ?>
			</div>
			<div class="collection-hero__summary" data-reveal>
				<header>
					<span><?php esc_html_e( 'Collection index', 'nolan-young-theme-template-99-master' ); ?></span>
					<small><?php esc_html_e( 'WordPress archive', 'nolan-young-theme-template-99-master' ); ?></small>
				</header>
				<div>
					<strong><?php echo esc_html( number_format_i18n( $archive_count ) ); ?></strong>
					<span><?php echo esc_html( _n( 'published entry', 'published entries', $archive_count, 'nolan-young-theme-template-99-master' ) ); ?></span>
				</div>
				<footer>
					<span><?php esc_html_e( 'Sorted', 'nolan-young-theme-template-99-master' ); ?></span>
					<strong><?php esc_html_e( 'Newest first', 'nolan-young-theme-template-99-master' ); ?></strong>
				</footer>
			</div>
		</div>
	</header>
	<section class="section collection">
		<div class="content-wrap">
			<div class="collection__toolbar" data-reveal>
				<div>
					<span><?php esc_html_e( 'Browse collection', 'nolan-young-theme-template-99-master' ); ?></span>
					<strong><?php esc_html_e( 'Published thinking and field notes', 'nolan-young-theme-template-99-master' ); ?></strong>
				</div>
				<a class="text-link" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">
					<?php esc_html_e( 'Journal home', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true">→</span>
				</a>
			</div>
			<?php if ( have_posts() ) : ?>
				<div class="collection-grid">
					<?php while ( have_posts() ) : ?>
						<?php
						the_post();
						$category      = nytt99_primary_category( get_the_ID() );
						$category_name = $category instanceof WP_Term ? $category->name : __( 'Journal', 'nolan-young-theme-template-99-master' );
						$reading_time  = nytt99_reading_time( get_the_ID() );
						?>
						<article <?php post_class( 'collection-card' ); ?> data-reveal>
							<a class="collection-card__visual" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'medium_large' ); ?>
								<?php else : ?>
									<span><i></i><i></i><i></i></span>
								<?php endif; ?>
							</a>
							<div class="collection-card__body">
								<div class="collection-card__meta">
									<span><?php echo esc_html( $category_name ); ?></span>
									<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
								</div>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
								<footer>
									<span>
										<?php
										printf(
											/* translators: %s: reading time in minutes. */
											esc_html( _n( '%s minute', '%s minutes', $reading_time, 'nolan-young-theme-template-99-master' ) ),
											esc_html( number_format_i18n( $reading_time ) )
										);
										?>
									</span>
									<a class="text-link" href="<?php the_permalink(); ?>">
										<?php esc_html_e( 'Read article', 'nolan-young-theme-template-99-master' ); ?>
										<span aria-hidden="true">→</span>
									</a>
								</footer>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
				<nav class="pagination-wrap" aria-label="<?php esc_attr_e( 'Archive pages', 'nolan-young-theme-template-99-master' ); ?>">
					<?php nytt99_pagination(); ?>
				</nav>
			<?php else : ?>
				<div class="collection-empty" data-reveal>
					<span>00</span>
					<div>
						<h2><?php esc_html_e( 'No published entries in this collection yet.', 'nolan-young-theme-template-99-master' ); ?></h2>
						<p><?php esc_html_e( 'Return to the journal to explore other topics and recent thinking.', 'nolan-young-theme-template-99-master' ); ?></p>
					</div>
					<a class="button button--quiet" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Open journal', 'nolan-young-theme-template-99-master' ); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
