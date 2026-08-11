<?php
/**
 * Default page template.
 *
 * @package NolanYoungThemeTemplate99Master
 */

get_header();
?>
<main id="content">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article <?php post_class( 'default-page' ); ?>>
			<header class="default-page__hero">
				<div class="content-wrap default-page__hero-layout">
					<div data-reveal>
						<p class="eyebrow"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
						<h1><?php the_title(); ?></h1>
						<?php if ( has_excerpt() ) : ?>
							<p class="hero__lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<?php else : ?>
							<p class="hero__lede"><?php esc_html_e( 'A focused page from the current site collection.', 'nolan-young-theme-template-99-master' ); ?></p>
						<?php endif; ?>
					</div>
					<div class="default-page__meta" data-reveal>
						<header>
							<span><?php esc_html_e( 'Page record', 'nolan-young-theme-template-99-master' ); ?></span>
							<small><?php echo esc_html( get_post_status() ); ?></small>
						</header>
						<dl>
							<div>
								<dt><?php esc_html_e( 'Published', 'nolan-young-theme-template-99-master' ); ?></dt>
								<dd><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></dd>
							</div>
							<div>
								<dt><?php esc_html_e( 'Updated', 'nolan-young-theme-template-99-master' ); ?></dt>
								<dd><?php echo esc_html( get_the_modified_date( 'M j, Y' ) ); ?></dd>
							</div>
						</dl>
						<footer>
							<span><?php esc_html_e( 'Canonical route', 'nolan-young-theme-template-99-master' ); ?></span>
							<i aria-hidden="true">↗</i>
						</footer>
					</div>
				</div>
			</header>
			<section class="section default-page__body">
				<div class="content-wrap default-page__layout">
					<aside class="default-page__aside" data-reveal>
						<span><?php esc_html_e( 'On this page', 'nolan-young-theme-template-99-master' ); ?></span>
						<strong><?php the_title(); ?></strong>
						<i></i>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php esc_html_e( 'Return to home', 'nolan-young-theme-template-99-master' ); ?>
							<span aria-hidden="true">→</span>
						</a>
					</aside>
					<div class="entry-content default-page__content" data-reveal>
						<?php the_content(); ?>
						<?php
						wp_link_pages(
							array(
								'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page sections', 'nolan-young-theme-template-99-master' ) . '">',
								'after'  => '</nav>',
							)
						);
						?>
					</div>
				</div>
			</section>
			<?php comments_template(); ?>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
