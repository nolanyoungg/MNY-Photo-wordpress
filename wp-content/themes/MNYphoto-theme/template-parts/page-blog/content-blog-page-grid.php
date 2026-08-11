<?php
/**
 * Journal index WordPress loop.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$featured_id = nytt99_featured_post_id();
$card_index  = 0;
$shown_posts = 0;
?>
<section class="section journal-index" id="latest">
	<div class="content-wrap">
		<header class="section-heading section-heading--split" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Latest thinking', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Ideas designed to survive contact with the work.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<p><?php esc_html_e( 'Every article is pulled from the live WordPress journal and organized to make the next useful perspective easy to find.', 'nolan-young-theme-template-99-master' ); ?></p>
		</header>

		<div class="journal-index__layout">
			<aside class="journal-index__rail" data-reveal>
				<span class="journal-index__rail-label"><?php esc_html_e( 'Editorial index', 'nolan-young-theme-template-99-master' ); ?></span>
				<strong><?php echo esc_html( wp_count_posts()->publish ); ?></strong>
				<p><?php esc_html_e( 'Published perspectives across strategy, experience, engineering, and operations.', 'nolan-young-theme-template-99-master' ); ?></p>
				<a class="text-link" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/journal/' ) ); ?>">
					<?php esc_html_e( 'View the complete archive', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true">→</span>
				</a>
			</aside>

			<div class="journal-index__content">
				<?php if ( have_posts() ) : ?>
					<div class="post-grid">
						<?php while ( have_posts() ) : ?>
							<?php
							the_post();
							if ( $featured_id === get_the_ID() && ! is_paged() ) {
								continue;
							}
							++$card_index;
							++$shown_posts;
							$card_class = 1 === $card_index ? 'post-card post-card--lead' : 'post-card';
							$category   = nytt99_primary_category();
							?>
							<article <?php post_class( $card_class ); ?> data-reveal>
								<a class="post-card__visual" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read %s', 'nolan-young-theme-template-99-master' ), get_the_title() ) ); ?>">
									<?php nytt99_editorial_visual( get_the_ID(), 1 === $card_index ? 'large' : 'medium_large' ); ?>
									<span class="post-card__number" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $card_index ) ); ?></span>
								</a>
								<div class="post-card__body">
									<div class="post-card__topline">
										<?php if ( $category ) : ?>
											<a href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
										<?php else : ?>
											<span><?php esc_html_e( 'Perspective', 'nolan-young-theme-template-99-master' ); ?></span>
										<?php endif; ?>
										<span><?php echo esc_html( nytt99_reading_time() ); ?> <?php esc_html_e( 'min', 'nolan-young-theme-template-99-master' ); ?></span>
									</div>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
									<footer>
										<div>
											<span><?php echo esc_html( get_the_author() ); ?></span>
											<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
										</div>
										<a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Continue reading %s', 'nolan-young-theme-template-99-master' ), get_the_title() ) ); ?>">
											<span aria-hidden="true">↗</span>
										</a>
									</footer>
								</div>
							</article>
						<?php endwhile; ?>
					</div>

					<?php if ( $shown_posts ) : ?>
						<div class="pagination-wrap"><?php nytt99_pagination(); ?></div>
					<?php else : ?>
						<div class="empty-state">
							<h3><?php esc_html_e( 'The featured perspective is the only article published so far.', 'nolan-young-theme-template-99-master' ); ?></h3>
							<p><?php esc_html_e( 'The next WordPress post will automatically join the editorial index.', 'nolan-young-theme-template-99-master' ); ?></p>
						</div>
					<?php endif; ?>
				<?php else : ?>
					<div class="empty-state" data-reveal>
						<h3><?php esc_html_e( 'The editorial system is ready for its first article.', 'nolan-young-theme-template-99-master' ); ?></h3>
						<p><?php esc_html_e( 'Publish a WordPress post and it will appear here automatically.', 'nolan-young-theme-template-99-master' ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
