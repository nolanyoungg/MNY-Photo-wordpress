<?php
/** work photography section. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<section class="shell section"><div class="section-heading"><div><p class="eyebrow"><?php esc_html_e( 'A FEW FRAMES TO GET YOU STARTED', 'mnyphoto-theme' ); ?></p><h2><?php esc_html_e( 'A world worth', 'mnyphoto-theme' ); ?> <em><?php esc_html_e( 'noticing.', 'mnyphoto-theme' ); ?></em></h2></div><a class="inline-link" href="<?php echo esc_url( mnyphoto_url( 'portfolio' ) ); ?>"><?php esc_html_e( 'See the portfolio', 'mnyphoto-theme' ); ?> <span aria-hidden="true">↗</span></a></div><div class="featured-grid"><?php foreach ( array( 'portraits', 'landscapes' ) as $id ) { get_template_part( 'template-parts/page-work/content', 'work-card', array( 'category' => mnyphoto_category( $id ) ) ); } ?></div></section>
