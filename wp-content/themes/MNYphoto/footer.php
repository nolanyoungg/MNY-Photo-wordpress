<?php
/** Shared invitation, footer and gallery dialog. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
if ( empty( $args['mnyphoto_skip_cta'] ) && ! is_page_template( 'page-templates/page-template-contact-us.php' ) && 'contact-us' !== ( $GLOBALS['nytt99_virtual_showcase_route'] ?? '' ) ) {
 get_template_part( 'template-parts/page-shared/content', 'shared-cta' );
}
get_template_part( 'template-parts/page-shared/content', 'shared-footer' );
get_template_part( 'template-parts/page-work/content', 'work-viewer' );
wp_footer();
?>
</body>
</html>
