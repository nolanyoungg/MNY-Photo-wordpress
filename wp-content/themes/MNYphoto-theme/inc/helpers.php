<?php
/** Shared presentation helpers. */

function mnyphoto_page_url( $slug = '' ) {
	$page = $slug ? get_page_by_path( sanitize_title( $slug ) ) : null;
	return $page instanceof WP_Post ? get_permalink( $page ) : home_url( $slug ? '/' . trim( $slug, '/' ) . '/' : '/' );
}

function mnyphoto_image_dimensions( $filename ) {
	$dimensions = array(
		'editorial-arcade.webp'      => array( 1024, 1536 ),
		'cards-overhead.webp'        => array( 1536, 864 ),
		'crowd-at-sunset.webp'       => array( 1536, 1024 ),
		'sugarcane-still-life.webp'  => array( 1536, 1536 ),
		'coastal-panorama.webp'      => array( 1536, 1157 ),
		'cathedral-tower.webp'       => array( 1156, 1536 ),
		'ginger-lily.webp'           => array( 1152, 1536 ),
		'photo-of-rock.webp'         => array( 1200, 800 ),
	);
	return isset( $dimensions[ $filename ] ) ? $dimensions[ $filename ] : array( 1200, 800 );
}

function mnyphoto_image( $filename, $alt, $class = '', $loading = 'lazy', $fetchpriority = 'auto' ) {
	list( $width, $height ) = mnyphoto_image_dimensions( $filename );
	$attributes = array(
		'src'      => get_theme_file_uri( 'dist/img/' . $filename ),
		'alt'      => $alt,
		'width'    => $width,
		'height'   => $height,
		'class'    => $class,
		'decoding' => 'async',
	);
	if ( 'eager' === $loading ) {
		$attributes['loading']       = 'eager';
		$attributes['fetchpriority'] = $fetchpriority;
	} else {
		$attributes['loading'] = 'lazy';
	}

	$markup = '<img';
	foreach ( $attributes as $name => $value ) {
		$markup .= sprintf( ' %s="%s"', esc_attr( $name ), esc_attr( $value ) );
	}
	return $markup . '>';
}

function mnyphoto_section_intro( $eyebrow, $title, $copy = '' ) {
	?>
	<header class="section-intro reveal">
		<p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h2><?php echo esc_html( $title ); ?></h2>
		<?php if ( $copy ) : ?>
			<p class="section-intro__copy"><?php echo esc_html( $copy ); ?></p>
		<?php endif; ?>
	</header>
	<?php
}

function mnyphoto_reading_time( $post_id = 0 ) {
	$post_id = $post_id ? absint( $post_id ) : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );
	$words   = str_word_count( wp_strip_all_tags( $content ) );
	return max( 1, (int) ceil( $words / 220 ) );
}

function mnyphoto_get_services() {
	$base = mnyphoto_page_url( 'services' );
	return array(
		'portrait' => array(
			'number' => '01', 'title' => __( 'Portrait', 'mnyphoto-theme' ), 'label' => __( 'People & identity', 'mnyphoto-theme' ),
			'description' => __( 'Quietly directed portrait sessions that leave room for personality, presence, and honest gestures.', 'mnyphoto-theme' ),
			'metric' => __( 'From one frame to a full visual library', 'mnyphoto-theme' ), 'url' => $base . '#service-portrait',
			'capabilities' => array( 'executive-portraits' => __( 'Executive portraits', 'mnyphoto-theme' ), 'artist-editorials' => __( 'Artist editorials', 'mnyphoto-theme' ), 'team-libraries' => __( 'Team image libraries', 'mnyphoto-theme' ), 'environmental-portraits' => __( 'Environmental portraits', 'mnyphoto-theme' ), 'personal-branding' => __( 'Personal branding', 'mnyphoto-theme' ), 'casting-direction' => __( 'Casting direction', 'mnyphoto-theme' ) ),
		),
		'commercial' => array(
			'number' => '02', 'title' => __( 'Commercial', 'mnyphoto-theme' ), 'label' => __( 'Brands & products', 'mnyphoto-theme' ),
			'description' => __( 'Concept-led product and campaign imagery built to work across launches, commerce, and editorial channels.', 'mnyphoto-theme' ),
			'metric' => __( 'One production, many useful crops', 'mnyphoto-theme' ), 'url' => $base . '#service-commercial',
			'capabilities' => array( 'campaign-photography' => __( 'Campaign photography', 'mnyphoto-theme' ), 'product-stills' => __( 'Product still life', 'mnyphoto-theme' ), 'ecommerce-sets' => __( 'E-commerce image sets', 'mnyphoto-theme' ), 'food-and-beverage' => __( 'Food and beverage', 'mnyphoto-theme' ), 'hospitality-imagery' => __( 'Hospitality imagery', 'mnyphoto-theme' ), 'usage-planning' => __( 'Usage and crop planning', 'mnyphoto-theme' ) ),
		),
		'editorial' => array(
			'number' => '03', 'title' => __( 'Editorial', 'mnyphoto-theme' ), 'label' => __( 'Stories & publications', 'mnyphoto-theme' ),
			'description' => __( 'Narrative image-making for features, profiles, travel stories, and culturally aware commissions.', 'mnyphoto-theme' ),
			'metric' => __( 'Stories shaped in sequence', 'mnyphoto-theme' ), 'url' => $base . '#service-editorial',
			'capabilities' => array( 'feature-stories' => __( 'Feature stories', 'mnyphoto-theme' ), 'location-essays' => __( 'Location essays', 'mnyphoto-theme' ), 'publication-portraits' => __( 'Publication portraits', 'mnyphoto-theme' ), 'travel-editorials' => __( 'Travel editorials', 'mnyphoto-theme' ), 'behind-the-scenes' => __( 'Behind the scenes', 'mnyphoto-theme' ), 'picture-editing' => __( 'Picture editing', 'mnyphoto-theme' ) ),
		),
		'events' => array(
			'number' => '04', 'title' => __( 'Events', 'mnyphoto-theme' ), 'label' => __( 'People in motion', 'mnyphoto-theme' ),
			'description' => __( 'Observant event coverage with an editorial eye for atmosphere, connection, and decisive moments.', 'mnyphoto-theme' ),
			'metric' => __( 'Fast coverage, considered finish', 'mnyphoto-theme' ), 'url' => $base . '#service-events',
			'capabilities' => array( 'brand-activations' => __( 'Brand activations', 'mnyphoto-theme' ), 'conferences' => __( 'Conferences', 'mnyphoto-theme' ), 'performances' => __( 'Performances', 'mnyphoto-theme' ), 'private-gatherings' => __( 'Private gatherings', 'mnyphoto-theme' ), 'same-day-selects' => __( 'Same-day selects', 'mnyphoto-theme' ), 'event-portraits' => __( 'On-site portraits', 'mnyphoto-theme' ) ),
		),
		'direction' => array(
			'number' => '05', 'title' => __( 'Creative direction', 'mnyphoto-theme' ), 'label' => __( 'Systems & finishing', 'mnyphoto-theme' ),
			'description' => __( 'Visual strategy, production design, and post-production that turn individual shoots into coherent systems.', 'mnyphoto-theme' ),
			'metric' => __( 'From first reference to final master', 'mnyphoto-theme' ), 'url' => $base . '#service-direction',
			'capabilities' => array( 'visual-research' => __( 'Visual research', 'mnyphoto-theme' ), 'art-direction' => __( 'Art direction', 'mnyphoto-theme' ), 'production-design' => __( 'Production design', 'mnyphoto-theme' ), 'location-scouting' => __( 'Location scouting', 'mnyphoto-theme' ), 'retouching' => __( 'Retouching', 'mnyphoto-theme' ), 'color-finishing' => __( 'Color finishing', 'mnyphoto-theme' ) ),
		),
	);
}

function mnyphoto_post_card( $post_id ) {
	$post_id = absint( $post_id );
	?>
	<article <?php post_class( 'journal-card', $post_id ); ?>>
		<a class="journal-card__link" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
			<div class="journal-card__media">
				<?php if ( has_post_thumbnail( $post_id ) ) : ?>
					<?php echo wp_get_attachment_image( get_post_thumbnail_id( $post_id ), 'large', false, array( 'loading' => 'lazy', 'sizes' => '(min-width: 900px) 25vw, 90vw' ) ); ?>
				<?php else : ?>
					<span class="journal-card__placeholder" aria-hidden="true"><span>MNY</span></span>
				<?php endif; ?>
			</div>
			<div class="journal-card__body">
				<p class="journal-card__meta"><?php echo esc_html( get_the_date( '', $post_id ) ); ?> · <?php echo esc_html( sprintf( _n( '%d min read', '%d min read', mnyphoto_reading_time( $post_id ), 'mnyphoto-theme' ), mnyphoto_reading_time( $post_id ) ) ); ?></p>
				<h3><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>
				<p><?php echo esc_html( wp_trim_words( get_the_excerpt( $post_id ), 20 ) ); ?></p>
				<span class="journal-card__footer"><?php esc_html_e( 'Read story', 'mnyphoto-theme' ); ?> <span aria-hidden="true">↗</span></span>
			</div>
		</a>
	</article>
	<?php
}
