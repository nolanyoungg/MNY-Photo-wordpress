<?php
/** @package MNYphoto */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" tabindex="-1">
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'template-parts/page-blog/content', 'blog-single-hero' ); ?>
<?php get_template_part( 'template-parts/page-blog/content', 'blog-single-page' ); ?>
<?php get_template_part( 'template-parts/page-blog/content', 'blog-single-next-blog' ); ?>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
