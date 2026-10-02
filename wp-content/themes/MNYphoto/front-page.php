<?php
/** @package MNYphoto */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" tabindex="-1">
<?php get_template_part( 'template-parts/page-front-page/content', 'front-page-hero' ); ?>
<?php get_template_part( 'template-parts/page-front-page/content', 'front-page-introduction' ); ?>
<?php get_template_part( 'template-parts/page-front-page/content', 'front-page-services' ); ?>
<?php get_template_part( 'template-parts/page-front-page/content', 'front-page-work' ); ?>
<?php get_template_part( 'template-parts/page-front-page/content', 'front-page-approach' ); ?>
<?php get_template_part( 'template-parts/page-front-page/content', 'front-page-process' ); ?>
<?php get_template_part( 'template-parts/page-front-page/content', 'front-page-blog' ); ?>
<?php mnyphoto_editor_content(); ?>
</main>
<?php get_footer(); ?>
