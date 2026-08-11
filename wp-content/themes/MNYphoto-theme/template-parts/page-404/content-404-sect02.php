<?php
/**
 * 404 latest resources.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$resource_query = new WP_Query(
	array(
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);
?>
<section class="section recovery-journal">
	<div class="content-wrap">
		<header class="section-heading section-heading--split" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'A better next click', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Continue with a recent idea.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</div>
			<a class="text-link" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">
				<?php esc_html_e( 'View the full journal', 'nolan-young-theme-template-99-master' ); ?>
				<span aria-hidden="true">→</span>
			</a>
		</header>
		<?php if ( $resource_query->have_posts() ) : ?>
			<div class="recovery-journal__grid">
				<?php while ( $resource_query->have_posts() ) : ?>
					<?php
					$resource_query->the_post();
					$category      = nytt99_primary_category( get_the_ID() );
					$category_name = $category instanceof WP_Term ? $category->name : __( 'Journal', 'nolan-young-theme-template-99-master' );
					?>
					<article class="recovery-article" data-reveal>
						<a class="recovery-article__visual" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium_large' ); ?>
							<?php else : ?>
								<span><i></i><i></i><i></i></span>
							<?php endif; ?>
						</a>
						<div class="recovery-article__body">
							<div class="recovery-article__meta">
								<span><?php echo esc_html( $category_name ); ?></span>
								<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
							</div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
							<a class="text-link" href="<?php the_permalink(); ?>">
								<?php esc_html_e( 'Read article', 'nolan-young-theme-template-99-master' ); ?>
								<span aria-hidden="true">→</span>
							</a>
						</div>
					</article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<div class="recovery-journal__empty" data-reveal>
				<span>JOURNAL / 00</span>
				<div>
					<h3><?php esc_html_e( 'The journal is being prepared.', 'nolan-young-theme-template-99-master' ); ?></h3>
					<p><?php esc_html_e( 'Published WordPress posts will appear here automatically. Use the verified routes above in the meantime.', 'nolan-young-theme-template-99-master' ); ?></p>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
