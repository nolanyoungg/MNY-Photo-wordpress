<?php
/** Photography presentation. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<div><p class="contact-intro"><?php esc_html_e( 'A milestone, a gathering, a favorite place, or a very good pet. Tell us a little about what you have in mind.', 'mnyphoto-theme' ); ?></p><div class="contact-image"><?php mnyphoto_image( 'pets' ); ?></div><?php $contact_email = sanitize_email( get_theme_mod( 'nytt99_email', '' ) ); if ( $contact_email ) : ?><p class="small-note"><a class="inline-link" href="mailto:<?php echo esc_attr( antispambot( $contact_email ) ); ?>"><?php echo esc_html( antispambot( $contact_email ) ); ?></a></p><?php endif; ?></div>