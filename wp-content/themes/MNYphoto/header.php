<?php
/**
 * Shared site header.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'nolan-young-theme-template-99-master' ); ?></a>
<header class="site-header" data-site-header>
	<div class="content-wrap site-header__inner">
		<div class="site-brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="brand__mark" aria-hidden="true"><?php echo esc_html( strtoupper( substr( get_bloginfo( 'name' ), 0, 1 ) ) ); ?></span>
					<span class="brand__name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				</a>
			<?php endif; ?>
		</div>
		<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-navigation" data-nav-toggle>
			<span class="screen-reader-text"><?php esc_html_e( 'Toggle menu', 'nolan-young-theme-template-99-master' ); ?></span>
			<span></span><span></span>
		</button>
		<?php nytt99_primary_navigation(); ?>
		<a class="header-btn-cta" href="<?php echo esc_url( nytt99_page_url( 'contact-us' ) ); ?>">
			<span><?php esc_html_e( 'Contact Us', 'nolan-young-theme-template-99-master' ); ?></span>
			<span aria-hidden="true">&rarr;</span>
		</a>
	</div>
</header>
