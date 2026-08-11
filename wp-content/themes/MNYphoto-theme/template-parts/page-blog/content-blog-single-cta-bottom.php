<?php
/**
 * Single article contextual call to action.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$category = nytt99_primary_category();
?>
<section class="section article-conversion">
	<div class="content-wrap">
		<div class="article-conversion__panel" data-reveal>
			<div class="article-conversion__context">
				<span><?php esc_html_e( 'Apply the perspective', 'nolan-young-theme-template-99-master' ); ?></span>
				<strong><?php echo esc_html( $category ? $category->name : __( 'Focused working session', 'nolan-young-theme-template-99-master' ) ); ?></strong>
			</div>
			<div class="article-conversion__content">
				<h2><?php esc_html_e( 'Turn the useful idea into a responsible first move.', 'nolan-young-theme-template-99-master' ); ?></h2>
				<p><?php esc_html_e( 'Bring the context, the constraint, and the decision your team needs to make. We will help structure what should happen next.', 'nolan-young-theme-template-99-master' ); ?></p>
			</div>
			<div class="article-conversion__actions">
				<a class="button" href="<?php echo esc_url( nytt99_page_url( 'contact-us' ) ); ?>">
					<span><?php esc_html_e( 'Book a working session', 'nolan-young-theme-template-99-master' ); ?></span>
					<span aria-hidden="true">→</span>
				</a>
				<a class="text-link" href="<?php echo esc_url( nytt99_page_url( 'services' ) ); ?>">
					<?php esc_html_e( 'See how we can help', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true">↗</span>
				</a>
			</div>
		</div>
	</div>
</section>
