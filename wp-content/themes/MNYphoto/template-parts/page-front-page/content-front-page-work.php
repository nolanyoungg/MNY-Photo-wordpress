<?php
/** Selected photographs in an asymmetric portfolio spread. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<section class="home-work shell home-section" id="home-selected" aria-labelledby="home-selected-title">
 <div class="home-section-label"><p class="eyebrow"><?php esc_html_e( 'SELECTED FRAMES', 'mnyphoto-theme' ); ?></p><span aria-hidden="true">03 — 05</span></div>
 <div class="home-section-heading"><h2 id="home-selected-title"><?php esc_html_e( 'A closer look.', 'mnyphoto-theme' ); ?></h2><a class="home-text-link" href="<?php echo esc_url( mnyphoto_url( 'portfolio' ) ); ?>"><?php esc_html_e( 'The full portfolio', 'mnyphoto-theme' ); ?><span aria-hidden="true">↗</span></a></div>
 <div class="home-work-grid">
  <?php foreach ( array( 'portraits', 'landscapes', 'homes' ) as $collection_id ) { get_template_part( 'template-parts/page-work/content', 'work-card', array( 'category' => mnyphoto_category( $collection_id ) ) ); } ?>
 </div>
 <div class="home-work-foot"><p><?php esc_html_e( 'Different subjects. The same attention to what makes them extraordinary.', 'mnyphoto-theme' ); ?></p><span class="eyebrow"><?php esc_html_e( 'PEOPLE / PLACES / PERSPECTIVE', 'mnyphoto-theme' ); ?></span></div>
</section>