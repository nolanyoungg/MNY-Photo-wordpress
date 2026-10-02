<?php
/** Approved gradient Contact Us selector. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$mnyphoto_collections = mnyphoto_portfolio_collections();
?>
<section class="session-picker" id="contact" aria-labelledby="session-heading">
	<div class="portfolio-shell session-inner">
		<div class="session-heading"><div><p class="session-eyebrow"><?php esc_html_e( 'Your next chapter', 'mnyphoto-theme' ); ?></p><h2 id="session-heading"><?php esc_html_e( 'Contact Us', 'mnyphoto-theme' ); ?></h2></div><p><?php esc_html_e( 'A familiar face. A favorite place. A moment worth keeping. Choose a collection and let’s start there.', 'mnyphoto-theme' ); ?></p></div>
		<div class="session-layout">
			<fieldset class="session-choices"><legend><?php esc_html_e( 'What are we photographing?', 'mnyphoto-theme' ); ?></legend>
				<?php foreach ( $mnyphoto_collections as $mnyphoto_index => $mnyphoto_category ) : ?>
					<label class="session-choice" for="session-<?php echo esc_attr( $mnyphoto_category['id'] ); ?>"><input type="radio" id="session-<?php echo esc_attr( $mnyphoto_category['id'] ); ?>" name="photography-session" value="<?php echo esc_attr( $mnyphoto_category['id'] ); ?>" aria-controls="session-preview-<?php echo esc_attr( $mnyphoto_category['id'] ); ?>" <?php checked( 0, $mnyphoto_index ); ?>><span class="session-number" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $mnyphoto_index + 1 ) ); ?></span><span class="session-name"><?php echo esc_html( $mnyphoto_category['name'] ); ?></span><span class="session-arrow" aria-hidden="true">↗</span></label>
				<?php endforeach; ?>
			</fieldset>
			<div class="session-previews">
				<?php foreach ( $mnyphoto_collections as $mnyphoto_category ) : ?>
					<article class="session-panel" id="session-preview-<?php echo esc_attr( $mnyphoto_category['id'] ); ?>" aria-labelledby="session-title-<?php echo esc_attr( $mnyphoto_category['id'] ); ?>" data-subject="<?php echo esc_attr( $mnyphoto_category['id'] ); ?>">
						<figure class="session-image"><?php mnyphoto_image( $mnyphoto_category['id'] ); ?><figcaption><?php echo esc_html( $mnyphoto_category['name'] ); ?></figcaption></figure>
						<div class="session-details"><h3 id="session-title-<?php echo esc_attr( $mnyphoto_category['id'] ); ?>"><?php echo esc_html( $mnyphoto_category['portfolio_title'] ); ?></h3><p><?php echo esc_html( $mnyphoto_category['portfolio_prompt'] ); ?></p><p class="session-scope"><?php echo esc_html( $mnyphoto_category['portfolio_scope'] ); ?></p><div class="session-actions"><a class="button" href="<?php echo esc_url( add_query_arg( 'category', $mnyphoto_category['id'], mnyphoto_url( 'contact' ) ) ); ?>"><?php echo esc_html( $mnyphoto_category['portfolio_invitation'] ); ?><span aria-hidden="true">↗</span></a><a class="session-back" href="#<?php echo esc_attr( $mnyphoto_category['id'] ); ?>"><?php esc_html_e( 'Explore the collection', 'mnyphoto-theme' ); ?> <span aria-hidden="true">↑</span></a></div></div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
