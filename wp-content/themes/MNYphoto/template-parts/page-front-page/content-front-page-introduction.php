<?php
/** Studio introduction, composed as an editorial spread. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<section class="home-intro shell home-section" id="home-studio" aria-labelledby="home-studio-title">
 <div class="home-section-label"><p class="eyebrow"><?php esc_html_e( 'MNY PHOTO / THE STUDIO', 'mnyphoto-theme' ); ?></p><span aria-hidden="true">01 — 05</span></div>
 <div class="home-intro-grid">
  <div class="home-intro-copy">
   <h2 id="home-studio-title"><?php esc_html_e( 'Life moves fast.', 'mnyphoto-theme' ); ?><br><span><?php esc_html_e( 'Keep the feeling.', 'mnyphoto-theme' ); ?></span></h2>
   <p class="home-intro-lead"><?php esc_html_e( 'Photographs that bring you back. To your people, your place, and the moments that feel like you.', 'mnyphoto-theme' ); ?></p>
   <p class="home-intro-detail"><?php esc_html_e( 'From a new chapter to an ordinary afternoon, MNY Photo brings a thoughtful eye to the things you want to remember.', 'mnyphoto-theme' ); ?></p>
  </div>
  <figure class="home-intro-photo"><?php mnyphoto_image( 'landscapes', 'lazy', '', '(max-width: 700px) 90vw, 30vw' ); ?><figcaption><span><?php esc_html_e( 'A moment of perspective.', 'mnyphoto-theme' ); ?></span><span aria-hidden="true">↗</span></figcaption></figure>
 </div>
 <div class="home-intro-foot"><p><?php esc_html_e( 'A considered eye. A personal connection.', 'mnyphoto-theme' ); ?></p><a class="home-text-link" href="<?php echo esc_url( mnyphoto_url( 'about' ) ); ?>"><?php esc_html_e( 'Meet MNY Photo', 'mnyphoto-theme' ); ?><span aria-hidden="true">↗</span></a></div>
</section>