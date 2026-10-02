<?php
/** Native menu destinations with photography dropdowns. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
function mnyphoto_nav_key( $title, $url ) {
 $label = sanitize_title( $title );
 $path = basename( untrailingslashit( (string) wp_parse_url( $url, PHP_URL_PATH ) ) );
 $groups = array( 'services' => array( 'services' ), 'about' => array( 'about', 'about-us' ), 'portfolio' => array( 'work', 'portfolio' ), 'blog' => array( 'blog', 'journal', 'resources' ) );
 foreach ( $groups as $key => $aliases ) {
  if ( in_array( $label, $aliases, true ) || in_array( $path, $aliases, true ) ) { return $key; }
 }
 return '';
}
function mnyphoto_nav_item( $key, $label, $url, $current = false ) {
 if ( 'portfolio' === $key ) { $label = __( 'Portfolio', 'mnyphoto-theme' ); }
 get_template_part( 'template-parts/page-shared/content', 'shared-nav-item', array( 'key' => $key, 'label' => $label, 'url' => $url, 'current' => $current ) );
}
class MNYPHOTO_Nav_Walker extends Walker_Nav_Menu {
 public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
  $item = $data_object;
  ob_start();
  mnyphoto_nav_item( mnyphoto_nav_key( $item->title, $item->url ), $item->title, $item->url, ! empty( $item->current ) );
  $output .= ob_get_clean();
 }
 public function end_el( &$output, $data_object, $depth = 0, $args = null ) {} // Each part closes itself.
}
function mnyphoto_nav_fallback() {
 $labels = array( 'services' => __( 'Services', 'mnyphoto-theme' ), 'about' => __( 'About', 'mnyphoto-theme' ), 'portfolio' => __( 'Portfolio', 'mnyphoto-theme' ), 'blog' => __( 'Blog', 'mnyphoto-theme' ) );
 foreach ( $labels as $key => $label ) { mnyphoto_nav_item( $key, $label, mnyphoto_url( $key ) ); }
}
function mnyphoto_primary_navigation() {
 wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s', 'depth' => 1, 'walker' => new MNYPHOTO_Nav_Walker(), 'fallback_cb' => 'mnyphoto_nav_fallback' ) );
}
function mnyphoto_menu_label( $title, $item, $args ) {
 if ( isset( $args->theme_location ) && in_array( $args->theme_location, array( 'primary', 'footer' ), true ) && 'portfolio' === mnyphoto_nav_key( $title, $item->url ) ) { return __( 'Portfolio', 'mnyphoto-theme' ); }
 return $title;
}
add_filter( 'nav_menu_item_title', 'mnyphoto_menu_label', 10, 3 );
