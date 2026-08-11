<?php
/**
 * Comments and discussion.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<header class="comments-area__header">
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Discussion', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2>
					<?php
					printf(
						/* translators: %s: comment count. */
						esc_html( _nx( 'One response', '%s responses', get_comments_number(), 'comments title', 'nolan-young-theme-template-99-master' ) ),
						esc_html( number_format_i18n( get_comments_number() ) )
					);
					?>
				</h2>
			</div>
			<span><?php esc_html_e( 'Thoughtful contributions welcome', 'nolan-young-theme-template-99-master' ); ?></span>
		</header>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
				)
			);
			?>
		</ol>
		<nav class="comments-navigation" aria-label="<?php esc_attr_e( 'Comment pages', 'nolan-young-theme-template-99-master' ); ?>">
			<?php the_comments_navigation(); ?>
		</nav>
	<?php endif; ?>
	<?php
	if ( ! comments_open() && get_comments_number() ) {
		echo '<p class="comments-closed">' . esc_html__( 'This discussion is now closed.', 'nolan-young-theme-template-99-master' ) . '</p>';
	}
	if ( comments_open() ) {
		comment_form(
			array(
				'class_submit'       => 'button button--primary',
				'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h2>',
			)
		);
	}
	?>
</section>
