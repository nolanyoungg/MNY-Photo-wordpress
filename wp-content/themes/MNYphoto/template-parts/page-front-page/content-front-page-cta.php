<?php
/**
 * Front-page compact project invitation.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;
?>
<section id="start-project" class="project-ribbon" data-home-chapter>
	<div class="content-wrap">
		<div class="project-ribbon__inner" data-reveal>
			<div class="project-ribbon__signal" aria-hidden="true"><i></i><i></i><i></i></div>

			<header class="project-ribbon__copy">
				<p><?php esc_html_e( 'Ready when you are', 'nolan-young-theme-template-99-master' ); ?></p>
				<h2><?php esc_html_e( 'Bring the hard problem. Leave with a clearer first move.', 'nolan-young-theme-template-99-master' ); ?></h2>
			</header>

			<p class="project-ribbon__note"><?php esc_html_e( 'No polished brief required. Start with what is unresolved.', 'nolan-young-theme-template-99-master' ); ?></p>

			<a class="project-ribbon__action" href="<?php echo esc_url( nytt99_page_url( 'contact-us' ) . '#project-brief' ); ?>">
				<span><?php esc_html_e( 'Start a project', 'nolan-young-theme-template-99-master' ); ?></span>
				<i aria-hidden="true">&rarr;</i>
			</a>
		</div>
	</div>
</section>
