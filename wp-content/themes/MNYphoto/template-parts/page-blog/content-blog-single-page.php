<?php
/** Photography presentation. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class( 'article-body entry-content' ); ?>><?php the_content(); ?><?php wp_link_pages(); ?><?php if ( has_tag() ) { the_tags( '<p class="post-tags">', ', ', '</p>' ); } ?><?php edit_post_link(); ?></article><?php if ( comments_open() || get_comments_number() ) : ?><div class="shell comments-wrap"><?php comments_template(); ?></div><?php endif; ?>