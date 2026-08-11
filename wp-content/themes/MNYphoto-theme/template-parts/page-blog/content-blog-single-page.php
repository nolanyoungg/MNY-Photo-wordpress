<?php
/**
 * Single journal article content and reading utilities.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$permalink  = get_permalink();
$title      = get_the_title();
$author_id  = (int) get_the_author_meta( 'ID' );
$author_bio = get_the_author_meta( 'description' );
?>
<section class="article-section">
	<div class="content-wrap article-shell">
		<aside class="article-contents" aria-label="<?php esc_attr_e( 'Article contents', 'nolan-young-theme-template-99-master' ); ?>" data-reveal>
			<div class="article-contents__sticky">
				<p class="article-utility-label"><?php esc_html_e( 'In this article', 'nolan-young-theme-template-99-master' ); ?></p>
				<nav data-article-toc>
					<a class="is-active" href="#article-content"><?php esc_html_e( 'Article introduction', 'nolan-young-theme-template-99-master' ); ?></a>
				</nav>
				<div class="article-contents__progress">
					<span><?php esc_html_e( 'Reading progress', 'nolan-young-theme-template-99-master' ); ?></span>
					<i aria-hidden="true"></i>
				</div>
			</div>
		</aside>

		<article id="article-content" <?php post_class( 'article-content entry-content' ); ?> data-reveal>
			<?php if ( has_excerpt() ) : ?>
				<p class="article-content__lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>

			<?php the_content(); ?>

			<?php
			wp_link_pages(
				array(
					'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Article pages', 'nolan-young-theme-template-99-master' ) . '">' . esc_html__( 'Pages:', 'nolan-young-theme-template-99-master' ),
					'after'  => '</nav>',
				)
			);
			?>

			<footer class="article-author">
				<?php echo get_avatar( $author_id, 72 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<div>
					<span><?php esc_html_e( 'Written by', 'nolan-young-theme-template-99-master' ); ?></span>
					<h2><?php echo esc_html( get_the_author() ); ?></h2>
					<p>
						<?php
						echo esc_html(
							$author_bio
								? $author_bio
								: __( 'Strategy, design, and engineering perspectives from the team behind the work.', 'nolan-young-theme-template-99-master' )
						);
						?>
					</p>
				</div>
			</footer>
		</article>

		<aside class="article-share" aria-label="<?php esc_attr_e( 'Share this article', 'nolan-young-theme-template-99-master' ); ?>" data-reveal>
			<div class="article-share__sticky">
				<p class="article-utility-label"><?php esc_html_e( 'Share', 'nolan-young-theme-template-99-master' ); ?></p>
				<a href="<?php echo esc_url( 'https://www.linkedin.com/sharing/share-offsite/?url=' . rawurlencode( $permalink ) ); ?>" rel="noopener noreferrer">
					<span><?php esc_html_e( 'LinkedIn', 'nolan-young-theme-template-99-master' ); ?></span>
					<span aria-hidden="true">↗</span>
				</a>
				<a href="<?php echo esc_url( 'mailto:?subject=' . rawurlencode( $title ) . '&body=' . rawurlencode( $permalink ) ); ?>">
					<span><?php esc_html_e( 'Email', 'nolan-young-theme-template-99-master' ); ?></span>
					<span aria-hidden="true">↗</span>
				</a>
				<a href="<?php echo esc_url( $permalink ); ?>" data-copy-link>
					<span><?php esc_html_e( 'Copy link', 'nolan-young-theme-template-99-master' ); ?></span>
					<span aria-hidden="true">+</span>
				</a>
			</div>
		</aside>
	</div>

	<div id="article-discussion" class="content-wrap article-discussion">
		<?php comments_template(); ?>
	</div>
</section>
