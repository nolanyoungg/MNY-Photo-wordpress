<?php
/** Six collection links with a photographic preview. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$collections = mnyphoto_categories();
?>
<section class="home-services home-section" id="home-collections" aria-labelledby="home-collections-title" data-home-services>
 <div class="shell">
  <div class="home-section-label"><p class="eyebrow"><?php esc_html_e( 'THE COLLECTIONS', 'mnyphoto-theme' ); ?></p><span aria-hidden="true">02 — 05</span></div>
  <div class="home-section-heading"><h2 id="home-collections-title"><?php esc_html_e( 'Find your frame.', 'mnyphoto-theme' ); ?></h2><p><?php esc_html_e( 'Six ways to tell your story. One thoughtful approach to every photograph.', 'mnyphoto-theme' ); ?></p></div>
  <div class="home-services-grid">
   <div class="home-services-preview" aria-hidden="true">
    <?php foreach ( $collections as $collection_index => $collection ) : ?>
    <figure class="home-service-visual<?php echo 0 === $collection_index ? ' is-current' : ''; ?>" data-home-preview="<?php echo esc_attr( $collection['id'] ); ?>">
     <?php mnyphoto_image( $collection['id'], 'lazy', '', '(max-width: 700px) 90vw, 45vw' ); ?>
     <figcaption><span><?php echo esc_html( sprintf( '%02d / 06', $collection_index + 1 ) ); ?></span><span><?php echo esc_html( $collection['full'] ); ?></span></figcaption>
    </figure>
    <?php endforeach; ?>
   </div>
   <div class="home-service-index">
    <?php foreach ( $collections as $collection_index => $collection ) : ?>
    <a class="home-service-row<?php echo 0 === $collection_index ? ' is-current' : ''; ?>" href="<?php echo esc_url( mnyphoto_url( 'services' ) . '#service-' . $collection['id'] ); ?>" data-home-service="<?php echo esc_attr( $collection['id'] ); ?>">
     <span class="home-service-number" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $collection_index + 1 ) ); ?></span>
     <div><h3><?php echo esc_html( $collection['name'] ); ?></h3><p><?php echo esc_html( $collection['short'] ); ?></p></div><span class="home-service-arrow" aria-hidden="true">↗</span>
    </a>
    <?php endforeach; ?>
   </div>
  </div>
  <div class="home-services-foot"><span><?php esc_html_e( 'Something in mind? Let’s find the right fit.', 'mnyphoto-theme' ); ?></span><a class="home-text-link" href="<?php echo esc_url( mnyphoto_url( 'services' ) ); ?>"><?php esc_html_e( 'Explore all services', 'mnyphoto-theme' ); ?><span aria-hidden="true">↗</span></a></div>
 </div>
</section>