<?php
/**
 * Project brief form.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

$brief_status = isset( $_GET['brief'] ) ? sanitize_key( wp_unslash( $_GET['brief'] ) ) : '';
$brief_status = in_array( $brief_status, array( 'sent', 'invalid', 'error' ), true ) ? $brief_status : '';
?>
<section class="section contact-brief" id="project-brief">
	<div class="content-wrap contact-brief__layout">
		<aside class="contact-brief__intro" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Project signal / 01', 'nolan-young-theme-template-99-master' ); ?></p>
			<h2><?php esc_html_e( 'Give the first conversation an intelligent starting point.', 'nolan-young-theme-template-99-master' ); ?></h2>
			<p><?php esc_html_e( 'A useful brief is not a list of deliverables. It explains what is changing, why it matters now, and what a better future must enable.', 'nolan-young-theme-template-99-master' ); ?></p>
			<ol class="brief-checklist">
				<li>
					<span>01</span>
					<div>
						<strong><?php esc_html_e( 'Outcome', 'nolan-young-theme-template-99-master' ); ?></strong>
						<small><?php esc_html_e( 'What must become possible?', 'nolan-young-theme-template-99-master' ); ?></small>
					</div>
				</li>
				<li>
					<span>02</span>
					<div>
						<strong><?php esc_html_e( 'Pressure', 'nolan-young-theme-template-99-master' ); ?></strong>
						<small><?php esc_html_e( 'What is creating urgency?', 'nolan-young-theme-template-99-master' ); ?></small>
					</div>
				</li>
				<li>
					<span>03</span>
					<div>
						<strong><?php esc_html_e( 'Decision', 'nolan-young-theme-template-99-master' ); ?></strong>
						<small><?php esc_html_e( 'Who needs confidence?', 'nolan-young-theme-template-99-master' ); ?></small>
					</div>
				</li>
			</ol>
			<div class="contact-brief__privacy">
				<span aria-hidden="true">◎</span>
				<p><?php esc_html_e( 'Your brief is sent directly to the site administrator and is used only to respond to this enquiry.', 'nolan-young-theme-template-99-master' ); ?></p>
			</div>
		</aside>

		<form class="project-brief-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" aria-label="<?php esc_attr_e( 'Project brief', 'nolan-young-theme-template-99-master' ); ?>" aria-describedby="project-brief-note" data-reveal>
			<input type="hidden" name="action" value="nytt99_project_brief">
			<?php wp_nonce_field( 'nytt99_project_brief', 'nytt99_project_brief_nonce' ); ?>
			<label class="project-brief-form__website" aria-hidden="true">
				<span><?php esc_html_e( 'Website', 'nolan-young-theme-template-99-master' ); ?></span>
				<input type="text" name="project_website" tabindex="-1" autocomplete="off">
			</label>
			<?php if ( $brief_status ) : ?>
				<p class="project-brief-form__notice project-brief-form__notice--<?php echo esc_attr( $brief_status ); ?>" role="<?php echo esc_attr( 'sent' === $brief_status ? 'status' : 'alert' ); ?>" tabindex="-1" data-form-notice>
					<?php
					if ( 'sent' === $brief_status ) {
						esc_html_e( 'Thank you. Your project brief has been sent.', 'nolan-young-theme-template-99-master' );
					} elseif ( 'invalid' === $brief_status ) {
						esc_html_e( 'Please provide your name, a valid email address, and project context.', 'nolan-young-theme-template-99-master' );
					} else {
						esc_html_e( 'The brief could not be sent. Please use the email option instead.', 'nolan-young-theme-template-99-master' );
					}
					?>
				</p>
			<?php endif; ?>
			<header class="project-brief-form__header">
				<div>
					<span><?php esc_html_e( '01 / Project context', 'nolan-young-theme-template-99-master' ); ?></span>
					<strong><?php esc_html_e( 'Confidential working brief', 'nolan-young-theme-template-99-master' ); ?></strong>
				</div>
				<em><?php esc_html_e( 'Secure enquiry', 'nolan-young-theme-template-99-master' ); ?></em>
			</header>
			<div class="project-brief-form__body">
				<div class="field-grid">
					<label>
						<span><?php esc_html_e( 'Your name', 'nolan-young-theme-template-99-master' ); ?></span>
						<input type="text" name="project_name" autocomplete="name" required placeholder="<?php esc_attr_e( 'Name', 'nolan-young-theme-template-99-master' ); ?>">
					</label>
					<label>
						<span><?php esc_html_e( 'Work email', 'nolan-young-theme-template-99-master' ); ?></span>
						<input type="email" name="project_email" autocomplete="email" required placeholder="<?php esc_attr_e( 'you@company.com', 'nolan-young-theme-template-99-master' ); ?>">
					</label>
				</div>
				<label>
					<span><?php esc_html_e( 'What needs to change?', 'nolan-young-theme-template-99-master' ); ?></span>
					<textarea name="project_context" rows="5" required placeholder="<?php esc_attr_e( 'Describe the opportunity, the pressure, and the result that would matter…', 'nolan-young-theme-template-99-master' ); ?>"></textarea>
				</label>
				<fieldset>
					<legend><?php esc_html_e( 'Where is the strongest pressure?', 'nolan-young-theme-template-99-master' ); ?></legend>
					<div class="choice-grid">
						<label>
							<input type="checkbox" name="project_area[]" value="strategy">
							<span><strong><?php esc_html_e( 'Strategy', 'nolan-young-theme-template-99-master' ); ?></strong><small><?php esc_html_e( 'Direction and alignment', 'nolan-young-theme-template-99-master' ); ?></small></span>
						</label>
						<label>
							<input type="checkbox" name="project_area[]" value="experience">
							<span><strong><?php esc_html_e( 'Experience', 'nolan-young-theme-template-99-master' ); ?></strong><small><?php esc_html_e( 'Customer and employee journeys', 'nolan-young-theme-template-99-master' ); ?></small></span>
						</label>
						<label>
							<input type="checkbox" name="project_area[]" value="platform">
							<span><strong><?php esc_html_e( 'Platform', 'nolan-young-theme-template-99-master' ); ?></strong><small><?php esc_html_e( 'Technology and operations', 'nolan-young-theme-template-99-master' ); ?></small></span>
						</label>
						<label>
							<input type="checkbox" name="project_area[]" value="growth">
							<span><strong><?php esc_html_e( 'Growth', 'nolan-young-theme-template-99-master' ); ?></strong><small><?php esc_html_e( 'Demand and conversion', 'nolan-young-theme-template-99-master' ); ?></small></span>
						</label>
					</div>
				</fieldset>
				<div class="field-grid">
					<label>
						<span><?php esc_html_e( 'Useful timing', 'nolan-young-theme-template-99-master' ); ?></span>
						<select name="project_timing">
							<option value=""><?php esc_html_e( 'Select a planning window', 'nolan-young-theme-template-99-master' ); ?></option>
							<option value="now"><?php esc_html_e( 'Within 30 days', 'nolan-young-theme-template-99-master' ); ?></option>
							<option value="quarter"><?php esc_html_e( 'This quarter', 'nolan-young-theme-template-99-master' ); ?></option>
							<option value="exploring"><?php esc_html_e( 'Exploring the opportunity', 'nolan-young-theme-template-99-master' ); ?></option>
						</select>
					</label>
					<label>
						<span><?php esc_html_e( 'Investment signal', 'nolan-young-theme-template-99-master' ); ?></span>
						<select name="project_investment">
							<option value=""><?php esc_html_e( 'Select a working range', 'nolan-young-theme-template-99-master' ); ?></option>
							<option value="focused"><?php esc_html_e( 'Focused engagement', 'nolan-young-theme-template-99-master' ); ?></option>
							<option value="program"><?php esc_html_e( 'Transformation program', 'nolan-young-theme-template-99-master' ); ?></option>
							<option value="unknown"><?php esc_html_e( 'Needs definition', 'nolan-young-theme-template-99-master' ); ?></option>
						</select>
					</label>
				</div>
			</div>
			<footer class="project-brief-form__footer">
				<p id="project-brief-note"><?php esc_html_e( 'Required fields are your name, email address, and project context.', 'nolan-young-theme-template-99-master' ); ?></p>
				<button class="button button--primary" type="submit" aria-describedby="project-brief-note">
					<?php esc_html_e( 'Send project brief', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true">→</span>
				</button>
			</footer>
		</form>
	</div>
</section>
