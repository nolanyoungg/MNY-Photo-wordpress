<?php
/**
 * Journal index hero and featured article.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$featured_id   = nytt99_featured_post_id();
$featured_post = $featured_id ? get_post( $featured_id ) : null;
$categories    = get_categories(
	array(
		'number'  => 6,
		'orderby' => 'count',
		'order'   => 'DESC',
	)
);
?>
<section class="journal-hero">
	<div class="content-wrap">
		<header class="journal-hero__heading" data-reveal>
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Nolan Young Journal', 'nolan-young-theme-template-99-master' ); ?></p>
				<h1><?php esc_html_e( 'Useful thinking for consequential digital work.', 'nolan-young-theme-template-99-master' ); ?></h1>
			</div>
			<div class="journal-hero__introduction">
				<span class="journal-hero__issue"><?php echo esc_html( gmdate( 'Y' ) ); ?> / <?php echo esc_html( gmdate( 'm' ) ); ?></span>
				<p><?php esc_html_e( 'Field notes on strategy, experience, engineering, and the operating decisions that connect them.', 'nolan-young-theme-template-99-master' ); ?></p>
			</div>
		</header>

		<?php if ( $featured_post instanceof WP_Post ) : ?>
			<?php
			$GLOBALS['post'] = $featured_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			setup_postdata( $featured_post );
			?>
			<article class="journal-feature" data-reveal>
				<a class="journal-feature__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read %s', 'nolan-young-theme-template-99-master' ), get_the_title() ) ); ?>">
					<?php nytt99_editorial_visual( get_the_ID(), 'large', 'journal-feature__visual' ); ?>
					<span class="journal-feature__media-label"><?php esc_html_e( 'Featured perspective', 'nolan-young-theme-template-99-master' ); ?></span>
				</a>
				<div class="journal-feature__content">
					<div class="journal-feature__topline">
						<span><?php esc_html_e( 'Editor’s selection', 'nolan-young-theme-template-99-master' ); ?></span>
						<span><?php echo esc_html( sprintf( '%02d', nytt99_reading_time() ) ); ?> <?php esc_html_e( 'min', 'nolan-young-theme-template-99-master' ); ?></span>
					</div>
					<?php
					$featured_category = nytt99_primary_category();
					if ( $featured_category ) :
						?>
						<a class="journal-feature__category" href="<?php echo esc_url( get_category_link( $featured_category ) ); ?>"><?php echo esc_html( $featured_category->name ); ?></a>
					<?php endif; ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="journal-feature__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
					<?php nytt99_post_meta(); ?>
					<a class="text-link" href="<?php the_permalink(); ?>">
						<?php esc_html_e( 'Read the complete perspective', 'nolan-young-theme-template-99-master' ); ?>
						<span aria-hidden="true">→</span>
					</a>
				</div>
			</article>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<div class="journal-feature journal-feature--empty" data-reveal>
				<div class="journal-feature__media"><?php nytt99_editorial_visual( 1, 'large', 'journal-feature__visual' ); ?></div>
				<div class="journal-feature__content">
					<p class="eyebrow"><?php esc_html_e( 'Editorial system ready', 'nolan-young-theme-template-99-master' ); ?></p>
					<h2><?php esc_html_e( 'The first published post will lead the journal.', 'nolan-young-theme-template-99-master' ); ?></h2>
					<p><?php esc_html_e( 'Publish a WordPress post and this area will automatically display its title, excerpt, category, metadata, and featured image.', 'nolan-young-theme-template-99-master' ); ?></p>
				</div>
			</div>
		<?php endif; ?>

		<div class="journal-controls" data-reveal>
			<form class="journal-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label for="journal-search"><?php esc_html_e( 'Search the journal', 'nolan-young-theme-template-99-master' ); ?></label>
				<div>
					<input id="journal-search" type="search" name="s" placeholder="<?php esc_attr_e( 'Search by topic or question', 'nolan-young-theme-template-99-master' ); ?>">
					<input type="hidden" name="post_type" value="post">
					<button type="submit">
						<span><?php esc_html_e( 'Search', 'nolan-young-theme-template-99-master' ); ?></span>
						<span aria-hidden="true">→</span>
					</button>
				</div>
			</form>
			<nav class="journal-topics" aria-label="<?php esc_attr_e( 'Journal topics', 'nolan-young-theme-template-99-master' ); ?>">
				<span><?php esc_html_e( 'Browse topics', 'nolan-young-theme-template-99-master' ); ?></span>
				<ul>
					<li><a class="is-current" href="#latest"><?php esc_html_e( 'All thinking', 'nolan-young-theme-template-99-master' ); ?></a></li>
					<?php foreach ( $categories as $category ) : ?>
						<li><a href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</nav>
		</div>
	</div>
</section>
