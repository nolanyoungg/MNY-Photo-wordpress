<?php
/** S061 / S008 team. Portraits and biographies await approved content. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$mnyphoto_people = array(
	array(
		'id' => 'maria', 'name' => __( 'Maria', 'mnyphoto-theme' ),
		'portrait' => __( 'Reserved space for an approved portrait of Maria', 'mnyphoto-theme' ),
		'placeholder' => __( 'Maria’s portrait goes here', 'mnyphoto-theme' ),
		'role' => __( 'Role to be added', 'mnyphoto-theme' ),
		'bio' => __( 'Add Maria’s role and a short introduction in her own words.', 'mnyphoto-theme' ),
		'more' => __( 'A little more about Maria', 'mnyphoto-theme' ),
		'details' => __( 'Space for Maria’s approved biography, favorite moments, and personal details.', 'mnyphoto-theme' ),
	),
	array(
		'id' => 'nolan', 'name' => __( 'Nolan', 'mnyphoto-theme' ),
		'portrait' => __( 'Reserved space for an approved portrait of Nolan', 'mnyphoto-theme' ),
		'placeholder' => __( 'Nolan’s portrait goes here', 'mnyphoto-theme' ),
		'role' => __( 'Role to be added', 'mnyphoto-theme' ),
		'bio' => __( 'Add Nolan’s role and a short introduction in his own words.', 'mnyphoto-theme' ),
		'more' => __( 'A little more about Nolan', 'mnyphoto-theme' ),
		'details' => __( 'Space for Nolan’s approved biography, favorite moments, and personal details.', 'mnyphoto-theme' ),
	),
	array(
		'id' => 'rock', 'name' => __( 'Rock', 'mnyphoto-theme' ),
		'portrait' => __( 'Reserved space for an approved portrait of Rock', 'mnyphoto-theme' ),
		'placeholder' => __( 'Rock’s portrait goes here', 'mnyphoto-theme' ),
		'role' => __( 'The dog', 'mnyphoto-theme' ),
		'bio' => __( 'Add a favorite photo of Rock and a little about his personality.', 'mnyphoto-theme' ),
		'more' => __( 'A little more about Rock', 'mnyphoto-theme' ),
		'details' => __( 'Space for Rock’s approved biography, favorite moments, and personal details.', 'mnyphoto-theme' ),
	),
);
?>
<div class="part-team">
	<section class="team-section container" id="mny061-team" aria-labelledby="mny061-team-title">
		<div class="section-head">
			<span class="tag"><?php esc_html_e( 'The names behind the photographs', 'mnyphoto-theme' ); ?></span>
			<h2 id="mny061-team-title"><?php esc_html_e( 'Meet the Team', 'mnyphoto-theme' ); ?></h2>
			<p><?php esc_html_e( 'Two people. One very good dog.', 'mnyphoto-theme' ); ?><br><?php esc_html_e( 'Get to know Maria, Nolan, and Rock.', 'mnyphoto-theme' ); ?></p>
		</div>
		<div class="people">
			<?php foreach ( $mnyphoto_people as $mnyphoto_person ) : ?>
				<article class="person" id="mny061-<?php echo esc_attr( $mnyphoto_person['id'] ); ?>">
					<div class="portrait" role="img" aria-label="<?php echo esc_attr( $mnyphoto_person['portrait'] ); ?>">
						<span class="frame-label">MNY / <?php echo esc_html( $mnyphoto_person['name'] ); ?></span>
						<svg viewBox="0 0 200 210" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2.5">
							<?php if ( 'rock' === $mnyphoto_person['id'] ) : ?>
								<path d="M57 91 34 42l39 17q27-15 54 0l39-17-23 49v47q-43 58-86 0Z"/><circle cx="80" cy="108" r="3"/><circle cx="120" cy="108" r="3"/><path d="m89 131 11 9 11-9Z"/>
							<?php else : ?>
								<circle cx="100" cy="74" r="32"/><path d="M38 185v-24c0-40 124-40 124 0v24Z"/>
							<?php endif; ?>
						</svg>
						<span class="placeholder"><?php echo esc_html( $mnyphoto_person['placeholder'] ); ?></span>
					</div>
					<div class="person-body">
						<h3><?php echo esc_html( $mnyphoto_person['name'] ); ?><?php if ( 'rock' === $mnyphoto_person['id'] ) : ?> <small><?php esc_html_e( '(the dog)', 'mnyphoto-theme' ); ?></small><?php endif; ?></h3>
						<p class="role"><?php echo esc_html( $mnyphoto_person['role'] ); ?></p>
						<p class="bio"><?php echo esc_html( $mnyphoto_person['bio'] ); ?></p>
						<details class="bio-details">
							<summary><?php echo esc_html( $mnyphoto_person['more'] ); ?></summary>
							<p><?php echo esc_html( $mnyphoto_person['details'] ); ?></p>
						</details>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<p class="team-note"><?php esc_html_e( 'Portrait spaces and biographies are placeholders. Add approved photographs and introductions for Maria, Nolan, and Rock.', 'mnyphoto-theme' ); ?></p>
	</section>
</div>
