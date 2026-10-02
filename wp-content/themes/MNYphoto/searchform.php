<?php
/** Photography presentation. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<?php $search_id = wp_unique_id( 'photo-search-' ); ?><form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>"><label class="sr-only" for="<?php echo esc_attr( $search_id ); ?>"><?php esc_html_e( 'Search the site', 'mnyphoto-theme' ); ?></label><input type="search" id="<?php echo esc_attr( $search_id ); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Try pets, graduation, or home', 'mnyphoto-theme' ); ?>"><button class="button" type="submit"><?php esc_html_e( 'Search', 'mnyphoto-theme' ); ?> ↗</button></form>