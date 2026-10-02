<?php
/** Six collections in a four-panel moving gallery. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$order = array( 'pets', 'portraits', 'landscapes', 'homes', 'family', 'events' );
$titles = array( 'pets' => __( 'A little wild.', 'mnyphoto-theme' ), 'portraits' => __( 'A new chapter.', 'mnyphoto-theme' ), 'landscapes' => __( 'A wider view.', 'mnyphoto-theme' ), 'homes' => __( 'A sense of home.', 'mnyphoto-theme' ), 'family' => __( 'Always together.', 'mnyphoto-theme' ), 'events' => __( 'In good company.', 'mnyphoto-theme' ) );
?>
<section class="hero" aria-label="<?php esc_attr_e( 'Featured photography', 'mnyphoto-theme' ); ?>" aria-roledescription="carousel">
 <h1 class="sr-only"><?php esc_html_e( 'Your world, in focus. Photography by MNY Photo.', 'mnyphoto-theme' ); ?></h1>
 <div class="hero-gallery" id="hero-gallery"><div class="hero-track" id="hero-track">
 <?php foreach ( $order as $index => $id ) : $category = mnyphoto_category( $id ); ?>
 <figure class="hero-frame" data-slide="<?php echo esc_attr( $id ); ?>" data-name="<?php echo esc_attr( $category['heroName'] ?? $category['name'] ); ?>" role="group" aria-roledescription="slide" aria-label="<?php echo esc_attr( sprintf( __( '%1$d of 6: %2$s', 'mnyphoto-theme' ), $index + 1, $category['full'] ) ); ?>">
 <?php mnyphoto_image( $id, $index < 4 ? 'eager' : 'lazy', '', '(max-width: 560px) 100vw, (max-width: 900px) 50vw, 25vw' ); ?>
 <figcaption><span class="photo-index"><?php echo esc_html( sprintf( '%02d.', $index + 1 ) ); ?></span><h2><?php echo esc_html( $titles[ $id ] ); ?></h2><p class="eyebrow"><?php echo esc_html( 'homes' === $id ? $category['name'] : $category['full'] ); ?></p><a href="<?php echo esc_url( add_query_arg( 'collection', $id, mnyphoto_url( 'portfolio' ) ) ); ?>" class="image-link" aria-label="<?php echo esc_attr( sprintf( __( 'Explore %s', 'mnyphoto-theme' ), $category['full'] ) ); ?>">↗</a></figcaption>
 </figure>
 <?php endforeach; ?>
 </div></div>
 <div class="hero-bottom"><div class="hero-signature"><span class="eyebrow"><?php esc_html_e( 'YOUR WORLD, IN FOCUS.', 'mnyphoto-theme' ); ?></span><span class="hero-current"><span id="hero-count">01 / 06</span><span id="hero-word"><?php esc_html_e( 'Pets', 'mnyphoto-theme' ); ?></span></span></div>
 <div class="hero-categories" id="hero-categories" role="group" aria-label="<?php esc_attr_e( 'Choose first featured photograph', 'mnyphoto-theme' ); ?>">
 <?php foreach ( $order as $index => $id ) : $category = mnyphoto_category( $id ); ?><button type="button" data-hero-category="<?php echo esc_attr( $index ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Start gallery with %s', 'mnyphoto-theme' ), $category['name'] ) ); ?>" aria-pressed="<?php echo 0 === $index ? 'true' : 'false'; ?>"><span class="sr-only"><?php echo esc_html( $category['name'] ); ?></span></button><?php endforeach; ?>
 </div><div class="gallery-controls"><button type="button" id="hero-previous" aria-label="<?php esc_attr_e( 'Previous featured photograph', 'mnyphoto-theme' ); ?>">←</button><button type="button" id="hero-pause" data-play-label="<?php esc_attr_e( 'Play moving gallery', 'mnyphoto-theme' ); ?>" data-pause-label="<?php esc_attr_e( 'Pause moving gallery', 'mnyphoto-theme' ); ?>" aria-label="<?php esc_attr_e( 'Pause moving gallery', 'mnyphoto-theme' ); ?>"><span aria-hidden="true">Ⅱ</span></button><button type="button" id="hero-next" aria-label="<?php esc_attr_e( 'Next featured photograph', 'mnyphoto-theme' ); ?>">→</button></div></div><span class="sr-only" id="hero-announcement" role="status"></span>
</section>
