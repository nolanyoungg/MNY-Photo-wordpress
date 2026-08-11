<?php
/**
 * Widget sidebar.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside class="sidebar" aria-label="<?php esc_attr_e( 'Supporting content', 'nolan-young-theme-template-99-master' ); ?>">
	<div class="sidebar__header">
		<div>
			<p class="eyebrow"><?php esc_html_e( 'Explore further', 'nolan-young-theme-template-99-master' ); ?></p>
			<strong><?php esc_html_e( 'Supporting routes', 'nolan-young-theme-template-99-master' ); ?></strong>
		</div>
		<span aria-hidden="true">↘</span>
	</div>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
