<?php
/**
 * Adjacent and related journal articles.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$current_id    = get_the_ID();
$previous_post = get_previous_post();
$next_post     = get_next_post();
$category_ids  = wp_get_post_categories( $current_id );
$related_args  = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 3,
	'post__not_in'        => array( $current_id ),
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
);

if ( $category_ids ) {
	$related_args['category__in'] = $category_ids;
}

$related = new WP_Query( $related_args );
?>
<section class="section section--cream related-journal" id="related-reading">
	<div class="content-wrap">
		<nav class="article-adjacent" aria-label="<?php esc_attr_e( 'Previous and next articles', 'nolan-young-theme-template-99-master' ); ?>" data-reveal>
			<?php if ( $previous_post ) : ?>
				<a href="<?php echo esc_url( get_permalink( $previous_post ) ); ?>">
					<span><?php esc_html_e( 'Previous perspective', 'nolan-young-theme-template-99-master' ); ?></span>
					<strong><?php echo esc_html( get_the_title( $previous_post ) ); ?></strong>
					<i aria-hidden="true">←</i>
				</a>
			<?php else : ?>
				<span class="article-adjacent__empty">
					<span><?php esc_html_e( 'Previous perspective', 'nolan-young-theme-template-99-master' ); ?></span>
					<strong><?php esc_html_e( 'You are at the beginning of this journal sequence.', 'nolan-young-theme-template-99-master' ); ?></strong>
				</span>
			<?php endif; ?>

			<?php if ( $next_post ) : ?>
				<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
					<span><?php esc_html_e( 'Next perspective', 'nolan-young-theme-template-99-master' ); ?></span>
					<strong><?php echo esc_html( get_the_title( $next_post ) ); ?></strong>
					<i aria-hidden="true">→</i>
				</a>
			<?php else : ?>
				<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/journal/' ) ); ?>">
					<span><?php esc_html_e( 'Editorial index', 'nolan-young-theme-template-99-master' ); ?></span>
					<strong><?php esc_html_e( 'Return to every published perspective.', 'nolan-young-theme-template-99-master' ); ?></strong>
					<i aria-hidden="true">→</i>
				</a>
			<?php endif; ?>
		</nav>

		<?php if ( $related->have_posts() ) : ?>
			<header class="related-journal__heading" data-reveal>
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Continue the thread', 'nolan-young-theme-template-99-master' ); ?></p>
					<h2><?php esc_html_e( 'Related perspectives selected by topic.', 'nolan-young-theme-template-99-master' ); ?></h2>
				</div>
				<a class="text-link" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/journal/' ) ); ?>">
					<?php esc_html_e( 'Open the journal', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true">→</span>
				</a>
			</header>
			<div class="related-journal__grid">
				<?php while ( $related->have_posts() ) : ?>
					<?php $related->the_post(); ?>
					<article class="related-card" data-reveal>
						<a class="related-card__visual" href="<?php the_permalink(); ?>">
							<?php nytt99_editorial_visual( get_the_ID(), 'medium_large' ); ?>
						</a>
						<div>
							<?php nytt99_post_meta(); ?>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
							<a class="text-link" href="<?php the_permalink(); ?>">
								<?php esc_html_e( 'Read article', 'nolan-young-theme-template-99-master' ); ?>
								<span aria-hidden="true">↗</span>
							</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
</section>
