<?php
/** Photography presentation. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<?php while ( have_posts() ) : the_post(); ?><article <?php post_class(); ?>><div class="shell page-heading"><p class="eyebrow">MNY PHOTO</p><h1><?php the_title(); ?></h1><?php if ( has_excerpt() ) : ?><p><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?></div><div class="article-body entry-content"><?php the_content(); ?><?php wp_link_pages(); ?></div></article><?php if ( comments_open() || get_comments_number() ) : ?><div class="shell comments-wrap"><?php comments_template(); ?></div><?php endif; endwhile; ?>