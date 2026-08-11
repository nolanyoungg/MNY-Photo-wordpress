<?php
if ( post_password_required() ) return;
?>
<section id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2><?php echo esc_html( sprintf( _n( '%s response', '%s responses', get_comments_number(), 'mnyphoto-theme' ), number_format_i18n( get_comments_number() ) ) ); ?></h2>
		<ol class="comment-list"><?php wp_list_comments( array( 'style' => 'ol', 'short_ping' => true, 'avatar_size' => 56 ) ); ?></ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>
	<?php if ( ! comments_open() && get_comments_number() ) : ?><p><?php esc_html_e( 'Comments are closed.', 'mnyphoto-theme' ); ?></p><?php endif; ?>
	<?php comment_form(); ?>
</section>
