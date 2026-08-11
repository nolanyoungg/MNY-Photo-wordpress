<?php
/**
 * Single journal article hero.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$category     = nytt99_primary_category();
$reading_time = nytt99_reading_time();
$published    = get_the_date( 'U' );
$updated      = get_the_modified_date( 'U' );
$journal_url  = get_permalink( get_option( 'page_for_posts' ) );
$journal_url  = $journal_url ? $journal_url : home_url( '/journal/' );
?>
<div class="reading-progress" aria-hidden="true">
	<span data-reading-progress></span>
	<i></i>
</div>
<section class="single-article-hero">
	<div class="content-wrap">
		<nav class="article-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'nolan-young-theme-template-99-master' ); ?>" data-reveal>
			<a href="<?php echo esc_url( $journal_url ); ?>"><?php esc_html_e( 'Journal', 'nolan-young-theme-template-99-master' ); ?></a>
			<span aria-hidden="true">/</span>
			<?php if ( $category ) : ?>
				<a href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
			<?php else : ?>
				<span><?php esc_html_e( 'Perspective', 'nolan-young-theme-template-99-master' ); ?></span>
			<?php endif; ?>
		</nav>

		<div class="single-article-hero__layout">
			<div class="single-article-hero__content" data-reveal>
				<div class="single-article-hero__topline">
					<span><?php esc_html_e( 'Journal perspective', 'nolan-young-theme-template-99-master' ); ?></span>
					<span><?php echo esc_html( sprintf( '%02d', $reading_time ) ); ?> <?php esc_html_e( 'minute read', 'nolan-young-theme-template-99-master' ); ?></span>
				</div>
				<h1><?php the_title(); ?></h1>
				<p class="single-article-hero__dek">
					<?php
					if ( has_excerpt() ) {
						echo esc_html( get_the_excerpt() );
					} else {
						echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_content() ), 30 ) );
					}
					?>
				</p>
				<div class="single-article-hero__byline">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 52 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<div>
						<strong><?php echo esc_html( get_the_author() ); ?></strong>
						<span>
							<?php
							printf(
								/* translators: %s: publication date. */
								esc_html__( 'Published %s', 'nolan-young-theme-template-99-master' ),
								esc_html( get_the_date() )
							);
							?>
						</span>
					</div>
					<?php if ( $updated > $published + DAY_IN_SECONDS ) : ?>
						<span class="single-article-hero__updated">
							<?php
							printf(
								/* translators: %s: modified date. */
								esc_html__( 'Updated %s', 'nolan-young-theme-template-99-master' ),
								esc_html( get_the_modified_date() )
							);
							?>
						</span>
					<?php endif; ?>
				</div>
			</div>

			<figure class="single-article-hero__media" data-reveal>
				<?php nytt99_editorial_visual( get_the_ID(), 'large', 'single-article-hero__visual' ); ?>
				<figcaption>
					<span><?php echo esc_html( $category ? $category->name : __( 'Perspective', 'nolan-young-theme-template-99-master' ) ); ?></span>
					<span><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></span>
				</figcaption>
			</figure>
		</div>
	</div>
</section>
