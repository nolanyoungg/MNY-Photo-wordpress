<?php
/** services photography section. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<section class="section pale"><div class="shell"><div class="section-heading"><div><p class="eyebrow"><?php esc_html_e( 'FIND YOUR KIND OF PHOTOGRAPHY', 'mnyphoto-theme' ); ?></p><h2><?php esc_html_e( 'What’s in', 'mnyphoto-theme' ); ?> <em><?php esc_html_e( 'your frame?', 'mnyphoto-theme' ); ?></em></h2></div><a href="<?php echo esc_url( mnyphoto_url( 'services' ) ); ?>" class="inline-link"><?php esc_html_e( 'All services', 'mnyphoto-theme' ); ?> <span aria-hidden="true">↗</span></a></div><?php get_template_part( 'template-parts/page-shared/content', 'shared-service-cards' ); ?></div></section>
