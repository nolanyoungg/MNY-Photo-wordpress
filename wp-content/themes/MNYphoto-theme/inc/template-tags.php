<?php
/**
 * Template tags for posts and archive views.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

function nytt99_footer_menu_fallback() {
	?>
	<ul class="site-footer__links">
		<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'nolan-young-theme-template-99-master' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>"><?php esc_html_e( 'About', 'nolan-young-theme-template-99-master' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'Work', 'nolan-young-theme-template-99-master' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/journal/' ) ); ?>"><?php esc_html_e( 'Blog', 'nolan-young-theme-template-99-master' ); ?></a></li>
	</ul>
	<?php
}

function nytt99_post_meta() {
	$category     = nytt99_primary_category();
	$reading_time = nytt99_reading_time();
	?>
	<p class="post-meta">
		<?php if ( $category ) : ?>
			<a href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
			<span aria-hidden="true">·</span>
		<?php endif; ?>
		<span><?php echo esc_html( get_the_date() ); ?></span>
		<span aria-hidden="true">·</span>
		<span>
			<?php
			printf(
				esc_html( _n( '%d min read', '%d min read', $reading_time, 'nolan-young-theme-template-99-master' ) ),
				esc_html( $reading_time )
			);
			?>
		</span>
	</p>
	<?php
}

function nytt99_pagination() {
	the_posts_pagination(
		array(
			'mid_size'  => 1,
			'prev_text' => __( 'Previous', 'nolan-young-theme-template-99-master' ),
			'next_text' => __( 'Next', 'nolan-young-theme-template-99-master' ),
		)
	);
}
