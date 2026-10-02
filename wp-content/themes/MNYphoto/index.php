<?php
/** @package MNYphoto */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" tabindex="-1">
<?php get_template_part( 'template-parts/page-blog/content', 'blog-hero' ); ?>
<?php get_template_part( 'template-parts/page-blog/content', 'blog-page-grid' ); ?>
</main>
<?php get_footer(); ?>
