<?php
/** Site identity, including the core custom-logo setting. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
if ( has_custom_logo() ) { the_custom_logo(); } else {
?>
<a class="wordmark" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'MNY Photo home', 'mnyphoto-theme' ); ?>" rel="home">MNY<span class="logo-dot" aria-hidden="true"></span><small>PHOTO</small></a>
<?php } ?>
