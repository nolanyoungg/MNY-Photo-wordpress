<?php
/**
 * Final WordPress template fallback.
 *
 * @package NolanYoungThemeTemplate99Master
 */

get_header();
?>
<main id="content">
	<header class="index-hero">
		<div class="content-wrap index-hero__layout">
			<div data-reveal>
				<p class="eyebrow"><?php esc_html_e( 'Site index / latest content', 'nolan-young-theme-template-99-master' ); ?></p>
				<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
				<p class="hero__lede"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
			</div>
			<div class="index-hero__map" data-reveal aria-hidden="true">
				<header><span><?php esc_html_e( 'Content index', 'nolan-young-theme-template-99-master' ); ?></span><small><?php esc_html_e( 'Auto / WP', 'nolan-young-theme-template-99-master' ); ?></small></header>
				<div><i></i><i></i><i></i><i></i></div>
				<footer><span><?php esc_html_e( 'Latest', 'nolan-young-theme-template-99-master' ); ?></span><span><?php esc_html_e( 'Published', 'nolan-young-theme-template-99-master' ); ?></span><span><?php esc_html_e( 'Available', 'nolan-young-theme-template-99-master' ); ?></span></footer>
			</div>
		</div>
	</header>
	<section class="section collection">
		<div class="content-wrap">
			<div class="collection__toolbar" data-reveal>
				<div>
					<span><?php esc_html_e( 'Content stream', 'nolan-young-theme-template-99-master' ); ?></span>
					<strong><?php esc_html_e( 'The latest published routes', 'nolan-young-theme-template-99-master' ); ?></strong>
				</div>
			</div>
			<?php if ( have_posts() ) : ?>
				<div class="collection-grid">
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
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
									<span><?php echo esc_html( get_post_type() ); ?></span>
									<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
								</div>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
								<footer>
									<span><?php esc_html_e( 'Published route', 'nolan-young-theme-template-99-master' ); ?></span>
									<a class="text-link" href="<?php the_permalink(); ?>">
										<?php esc_html_e( 'Open content', 'nolan-young-theme-template-99-master' ); ?>
										<span aria-hidden="true">→</span>
									</a>
								</footer>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
				<nav class="pagination-wrap" aria-label="<?php esc_attr_e( 'Content pages', 'nolan-young-theme-template-99-master' ); ?>">
					<?php nytt99_pagination(); ?>
				</nav>
			<?php else : ?>
				<div class="collection-empty" data-reveal>
					<span>00</span>
					<div>
						<h2><?php esc_html_e( 'Nothing has been published yet.', 'nolan-young-theme-template-99-master' ); ?></h2>
						<p><?php esc_html_e( 'New WordPress content will appear here automatically.', 'nolan-young-theme-template-99-master' ); ?></p>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
