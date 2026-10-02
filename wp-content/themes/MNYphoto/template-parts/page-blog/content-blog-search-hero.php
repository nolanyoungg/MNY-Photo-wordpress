<?php
/** Photography presentation. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<div class="shell page-heading"><p class="eyebrow"><?php esc_html_e( 'FIND A LITTLE INSPIRATION', 'mnyphoto-theme' ); ?></p><h1><?php esc_html_e( 'Let’s look into it.', 'mnyphoto-theme' ); ?></h1><?php if ( get_search_query() ) : ?><p><?php echo esc_html( sprintf( __( 'Results for “%s”', 'mnyphoto-theme' ), get_search_query() ) ); ?></p><?php endif; ?></div><div class="shell"><?php get_search_form(); ?></div>