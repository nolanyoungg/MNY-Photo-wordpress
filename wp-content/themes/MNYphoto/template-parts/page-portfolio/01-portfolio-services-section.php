<?php
/** Six approved portfolio collections. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$mnyphoto_collections = mnyphoto_portfolio_collections();
?>
<section class="portfolio-collection-intro portfolio-shell" id="collections" aria-labelledby="collections-title">
	<div><p><?php esc_html_e( 'The portfolio', 'mnyphoto-theme' ); ?></p><h2 id="collections-title"><?php esc_html_e( 'Find what feels like you.', 'mnyphoto-theme' ); ?></h2></div>
	<nav aria-label="<?php esc_attr_e( 'Photography collections', 'mnyphoto-theme' ); ?>">
		<?php foreach ( $mnyphoto_collections as $mnyphoto_category ) : ?><a href="#<?php echo esc_attr( $mnyphoto_category['id'] ); ?>"><?php echo esc_html( $mnyphoto_category['name'] ); ?></a><?php endforeach; ?>
	</nav>
</section>
<div class="portfolio-collections portfolio-shell">
	<?php foreach ( $mnyphoto_collections as $mnyphoto_category ) : ?>
		<section class="portfolio-collection" id="<?php echo esc_attr( $mnyphoto_category['id'] ); ?>" aria-labelledby="heading-<?php echo esc_attr( $mnyphoto_category['id'] ); ?>" data-subject="<?php echo esc_attr( $mnyphoto_category['id'] ); ?>">
			<figure class="photo-card"><a class="portfolio-photo" href="<?php echo esc_url( mnyphoto_full_photo( $mnyphoto_category['id'] ) ); ?>" data-photo="<?php echo esc_attr( $mnyphoto_category['id'] ); ?>" data-title="<?php echo esc_attr( $mnyphoto_category['name'] ); ?>" data-caption="<?php echo esc_attr( mnyphoto_is_example( $mnyphoto_category['id'] ) ? __( 'AI-generated design example, not MNY Photo client work.', 'mnyphoto-theme' ) : $mnyphoto_category['full'] ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View complete %s photograph', 'mnyphoto-theme' ), $mnyphoto_category['name'] ) ); ?>">
				<?php mnyphoto_image( $mnyphoto_category['id'], 'lazy', '', '(max-width: 600px) calc(100vw - 40px), (max-width: 800px) 50vw, 60vw' ); ?><span><?php esc_html_e( 'View full photograph', 'mnyphoto-theme' ); ?></span>
			</a></figure>
			<div class="portfolio-collection-copy"><h2 id="heading-<?php echo esc_attr( $mnyphoto_category['id'] ); ?>"><?php echo esc_html( $mnyphoto_category['name'] ); ?></h2><p class="portfolio-collection-title"><?php echo esc_html( $mnyphoto_category['portfolio_title'] ); ?></p><p class="portfolio-description"><?php echo esc_html( $mnyphoto_category['portfolio_description'] ); ?></p><p class="portfolio-scope"><?php echo esc_html( $mnyphoto_category['portfolio_scope'] ); ?></p><a href="#contact" data-portfolio-plan="<?php echo esc_attr( $mnyphoto_category['id'] ); ?>"><?php esc_html_e( 'Plan a session', 'mnyphoto-theme' ); ?></a></div>
		</section>
	<?php endforeach; ?>
</div>
