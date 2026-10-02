<?php
/** An immersive family photograph and the studio's approach. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<section class="home-approach" id="home-approach" aria-labelledby="home-approach-title">
 <div class="home-approach-scene">
  <div class="home-approach-image"><?php mnyphoto_image( 'family', 'lazy', '', '100vw' ); ?></div>
  <div class="shell home-approach-overlay"><div class="home-section-label"><p class="eyebrow"><?php esc_html_e( 'THE APPROACH', 'mnyphoto-theme' ); ?></p><span aria-hidden="true">04 — 05</span></div><h2 id="home-approach-title"><?php esc_html_e( 'Nothing forced.', 'mnyphoto-theme' ); ?><br><?php esc_html_e( 'Everything felt.', 'mnyphoto-theme' ); ?></h2><p><?php esc_html_e( 'The best part of the photograph is you.', 'mnyphoto-theme' ); ?></p></div>
 </div>
 <div class="shell home-approach-bottom"><h3><?php esc_html_e( 'A little guidance.', 'mnyphoto-theme' ); ?><br><?php esc_html_e( 'Room to be yourself.', 'mnyphoto-theme' ); ?></h3><div><p><?php esc_html_e( 'You don’t need to know how to pose or have every detail figured out. We’ll find the light, make a little space, and let the moments happen.', 'mnyphoto-theme' ); ?></p><a class="home-text-link" href="<?php echo esc_url( mnyphoto_url( 'contact' ) ); ?>"><?php esc_html_e( 'Let’s make a plan', 'mnyphoto-theme' ); ?><span aria-hidden="true">↗</span></a></div></div>
</section>