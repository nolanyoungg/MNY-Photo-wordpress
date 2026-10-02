<?php
/** Preserve authored page content and pagination. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<div class="shell editor-section"><div class="entry-content"><?php echo apply_filters( 'the_content', get_post_field( 'post_content', get_queried_object_id() ) ); // WordPress editor content. ?><?php wp_link_pages(); ?></div></div>
