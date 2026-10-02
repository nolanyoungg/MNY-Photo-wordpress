<?php
/** Photography presentation. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
?>
<div class="shell section collection-results">
<?php if ( have_posts() ) : ?><div class="post-grid"><?php while ( have_posts() ) { the_post(); get_template_part( 'template-parts/page-blog/content', 'blog-card', array( 'post_id' => get_the_ID() ) ); } ?></div><?php the_posts_pagination(); ?>
<?php else : ?><h2><?php esc_html_e( 'Nothing here just yet.', 'mnyphoto-theme' ); ?></h2><p class="small-note"><?php esc_html_e( 'Try another search, or explore the photography collections.', 'mnyphoto-theme' ); ?></p><a class="inline-link" href="<?php echo esc_url( mnyphoto_url( 'portfolio' ) ); ?>"><?php esc_html_e( 'View portfolio', 'mnyphoto-theme' ); ?> ↗</a><?php endif; ?>
</div>