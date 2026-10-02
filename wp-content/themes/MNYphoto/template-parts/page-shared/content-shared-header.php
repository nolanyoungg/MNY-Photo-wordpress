<?php
/** Photography header. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<header class="site-header" data-site-header>
	<div class="header-inner shell">
		<?php get_template_part( 'template-parts/page-shared/content', 'shared-brand' ); ?>
		<nav class="main-nav" id="main-nav" aria-label="<?php esc_attr_e( 'Main navigation', 'mnyphoto-theme' ); ?>"><?php mnyphoto_primary_navigation(); ?></nav>
		<a href="<?php echo esc_url( mnyphoto_url( 'contact' ) ); ?>" class="contact-button header-btn-cta"><?php esc_html_e( 'Contact Us', 'mnyphoto-theme' ); ?> <span aria-hidden="true">↗</span></a>
		<button class="mobile-toggle" type="button" aria-label="<?php esc_attr_e( 'Open main menu', 'mnyphoto-theme' ); ?>" aria-controls="main-nav" aria-expanded="false"><span class="menu-lines" aria-hidden="true"></span><span class="mobile-label"><?php esc_html_e( 'Menu', 'mnyphoto-theme' ); ?></span></button>
	</div>
</header>
