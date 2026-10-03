<?php
/** Photography header. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<header class="site-header site-header--glass" data-site-header>
	<div class="header-inner shell">
		<?php get_template_part( 'template-parts/page-shared/content', 'shared-brand' ); ?>
		<nav class="main-nav" id="main-nav" aria-label="<?php esc_attr_e( 'Main navigation', 'mnyphoto-theme' ); ?>"><?php mnyphoto_primary_navigation(); ?></nav>
		<a href="<?php echo esc_url( mnyphoto_url( 'contact' ) ); ?>" class="contact-button header-btn-cta">
			<span class="screen-reader-text header-cta-label"><?php esc_html_e( 'Contact Us', 'mnyphoto-theme' ); ?></span>
			<svg class="header-cta-surface" xmlns="http://www.w3.org/2000/svg" width="132" height="44" aria-hidden="true" focusable="false">
				<defs>
					<mask id="mnyphoto-header-contact-cutout" maskUnits="userSpaceOnUse" x="0" y="0" width="100%" height="100%" style="mask-type:luminance">
						<rect width="100%" height="100%" fill="white" />
						<text class="header-cta-mask-label" x="50%" y="50%" dy=".35em" text-anchor="middle" fill="black"><?php esc_html_e( 'Contact Us', 'mnyphoto-theme' ); ?></text>
					</mask>
				</defs>
				<rect width="100%" height="100%" rx="12" fill="white" mask="url(#mnyphoto-header-contact-cutout)" />
			</svg>
		</a>
		<button class="mobile-toggle" type="button" aria-label="<?php esc_attr_e( 'Open main menu', 'mnyphoto-theme' ); ?>" aria-controls="main-nav" aria-expanded="false"><span class="menu-lines" aria-hidden="true"></span><span class="mobile-label"><?php esc_html_e( 'Menu', 'mnyphoto-theme' ); ?></span></button>
	</div>
</header>
