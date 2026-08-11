<?php
/** Site header. */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mnyphoto-theme' ); ?></a>
<header class="site-header" data-site-header>
	<div class="site-header__inner">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="wordmark" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( sprintf( __( '%s home', 'mnyphoto-theme' ), get_bloginfo( 'name' ) ) ); ?>">
					<span>MNY</span><small>Photo</small>
				</a>
			<?php endif; ?>
		</div>
		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-navigation">
			<span class="menu-toggle__label"><?php esc_html_e( 'Menu', 'mnyphoto-theme' ); ?></span><span class="menu-toggle__icon" aria-hidden="true"></span>
		</button>
		<?php mnyphoto_render_primary_navigation(); ?>
	</div>
</header>
