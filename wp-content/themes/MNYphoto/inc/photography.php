<?php
/** Photography content and media helpers. @package MNYphoto */
defined( 'ABSPATH' ) || exit;

function mnyphoto_categories() {
	return array( array(
		'id' => 'pets',
		'name' => __( 'Pets', 'mnyphoto-theme' ),
		'full' => __( 'Pet photography', 'mnyphoto-theme' ),
		'word' => 'unleashed.',
		'title' => __( 'Big personality.<br>Four little paws.', 'mnyphoto-theme' ),
		'story' => __( 'A very good day', 'mnyphoto-theme' ),
		'description' => __( 'The curious looks, the goofy grin, the one-of-a-kind personality. Photographs of your favorite animal, just as they are.', 'mnyphoto-theme' ),
		'short' => __( 'Big personalities. Very good company.', 'mnyphoto-theme' ),
		'capabilities' => array( __( 'Pet portraits', 'mnyphoto-theme' ), __( 'Outdoor pet sessions', 'mnyphoto-theme' ), __( 'Pets with their people', 'mnyphoto-theme' ) ),
		'alt' => __( 'A golden retriever running through a meadow of small white wildflowers', 'mnyphoto-theme' )
	), array(
		'id' => 'portraits',
		'name' => __( 'Portraits', 'mnyphoto-theme' ),
		'full' => __( 'Portrait photography', 'mnyphoto-theme' ),
		'word' => 'celebrated.',
		'title' => __( 'Your next chapter.<br>Your kind of portrait.', 'mnyphoto-theme' ),
		'story' => __( 'Here’s to what comes next', 'mnyphoto-theme' ),
		'description' => __( 'A new chapter or simply a moment for yourself. Natural portraits with room for your personality and a little guidance along the way.', 'mnyphoto-theme' ),
		'short' => __( 'Graduates, seniors, kids & individual portraits.', 'mnyphoto-theme' ),
		'capabilities' => array( __( 'College graduation', 'mnyphoto-theme' ), __( 'High school seniors', 'mnyphoto-theme' ), __( 'Kids’ portraits', 'mnyphoto-theme' ), __( 'Individual & self-portrait sessions', 'mnyphoto-theme' ) ),
		'alt' => __( 'An adult college graduate smiling in a navy cap and gown on a leafy university campus', 'mnyphoto-theme' )
	), array(
		'id' => 'family',
		'name' => __( 'Family', 'mnyphoto-theme' ),
		'full' => __( 'Family photography', 'mnyphoto-theme' ),
		'word' => 'together.',
		'title' => __( 'Your people.<br>Your kind of perfect.', 'mnyphoto-theme' ),
		'story' => __( 'All of us, right here', 'mnyphoto-theme' ),
		'description' => __( 'The way you laugh together. The familiar hands to hold. A thoughtful record of your family, in this chapter of your lives.', 'mnyphoto-theme' ),
		'short' => __( 'Your favorite people, all in one frame.', 'mnyphoto-theme' ),
		'capabilities' => array( __( 'Family sessions', 'mnyphoto-theme' ), __( 'Generational portraits', 'mnyphoto-theme' ), __( 'Everyday family moments', 'mnyphoto-theme' ) ),
		'alt' => __( 'Two parents and their two children walking together along a sunlit meadow path', 'mnyphoto-theme' )
	), array(
		'id' => 'homes',
		'name' => __( 'Homes & real estate', 'mnyphoto-theme' ),
		'heroName' => __( 'Homes', 'mnyphoto-theme' ),
		'full' => __( 'Homes & real estate photography', 'mnyphoto-theme' ),
		'word' => 'welcoming.',
		'title' => __( 'A sense of place.<br>A place to call home.', 'mnyphoto-theme' ),
		'story' => __( 'A welcome worth remembering', 'mnyphoto-theme' ),
		'description' => __( 'A clear, considered view of a property. Photographs that help buyers, renters, and homeowners see the space, the light, and the details.', 'mnyphoto-theme' ),
		'short' => __( 'Homes, listings, interiors & exteriors.', 'mnyphoto-theme' ),
		'capabilities' => array( __( 'Homes for sale', 'mnyphoto-theme' ), __( 'Rental properties', 'mnyphoto-theme' ), __( 'Interior photography', 'mnyphoto-theme' ), __( 'Exterior photography', 'mnyphoto-theme' ) ),
		'alt' => __( 'A white two-story house with dark windows, a wooden front door, a porch, and a landscaped front lawn', 'mnyphoto-theme' )
	), array(
		'id' => 'events',
		'name' => __( 'Events', 'mnyphoto-theme' ),
		'full' => __( 'Event photography', 'mnyphoto-theme' ),
		'word' => 'happening.',
		'title' => __( 'Good company.<br>Great memories.', 'mnyphoto-theme' ),
		'story' => __( 'An evening to remember', 'mnyphoto-theme' ),
		'description' => __( 'The energy in the room and the small moments around it. Candid photographs of the people and details that make your event yours.', 'mnyphoto-theme' ),
		'short' => __( 'Gatherings, celebrations & shared moments.', 'mnyphoto-theme' ),
		'capabilities' => array( __( 'Community gatherings', 'mnyphoto-theme' ), __( 'Celebrations', 'mnyphoto-theme' ), __( 'School & business events', 'mnyphoto-theme' ) ),
		'alt' => __( 'Guests laughing together around a garden dinner table beneath warm string lights', 'mnyphoto-theme' )
	), array(
		'id' => 'landscapes',
		'name' => __( 'Landscapes', 'mnyphoto-theme' ),
		'full' => __( 'Landscape photography', 'mnyphoto-theme' ),
		'word' => 'wide open.',
		'title' => __( 'A little perspective.<br>A lot of possibility.', 'mnyphoto-theme' ),
		'story' => __( 'Before the world wakes up', 'mnyphoto-theme' ),
		'description' => __( 'The quiet, the scale, the light. Photographs of outdoor places that make you stop for a moment and look a little longer.', 'mnyphoto-theme' ),
		'short' => __( 'Open spaces. New perspectives.', 'mnyphoto-theme' ),
		'capabilities' => array( __( 'Natural scenery', 'mnyphoto-theme' ), __( 'Outdoor locations', 'mnyphoto-theme' ), __( 'Seasonal landscapes', 'mnyphoto-theme' ) ),
		'alt' => __( 'A still mountain lake reflecting misty forest ridges and a soft sunrise', 'mnyphoto-theme' )
	) );
}


/** Approved portfolio copy, with the shared categories and editor-selected media. */
function mnyphoto_portfolio_collections() {
	$copy = array(
		'pets' => array(
			__( 'A little wild. Entirely themselves.', 'mnyphoto-theme' ),
			__( 'Unhurried pet portraits with room for the head tilts, happy sprints, and familiar expressions.', 'mnyphoto-theme' ),
			__( 'Pet portraits, outdoor sessions, and pets with their people.', 'mnyphoto-theme' ),
			__( 'Their favorite place, their favorite person, and a little room to play.', 'mnyphoto-theme' ),
			__( 'Plan a pet session', 'mnyphoto-theme' ),
		),
		'portraits' => array(
			__( 'Your next chapter, in the frame.', 'mnyphoto-theme' ),
			__( 'Natural portraits for a milestone, a new beginning, or simply a moment for yourself.', 'mnyphoto-theme' ),
			__( 'College graduation, high school seniors, kids, and individual or self-portrait sessions.', 'mnyphoto-theme' ),
			__( 'A graduation, a milestone, or simply a photograph that feels like you.', 'mnyphoto-theme' ),
			__( 'Plan a portrait session', 'mnyphoto-theme' ),
		),
		'family' => array(
			__( 'The people who make it yours.', 'mnyphoto-theme' ),
			__( 'The closeness, the laughter, and the little things you’ll want to remember about this season together.', 'mnyphoto-theme' ),
			__( 'Family sessions, generational portraits, and everyday moments.', 'mnyphoto-theme' ),
			__( 'Bring your people. We’ll start with what makes this season yours.', 'mnyphoto-theme' ),
			__( 'Plan a family session', 'mnyphoto-theme' ),
		),
		'homes' => array(
			__( 'Make a place feel possible.', 'mnyphoto-theme' ),
			__( 'A clear, thoughtful view of the space, its light, and the details that make a first impression.', 'mnyphoto-theme' ),
			__( 'Homes for sale, rentals, interiors, and exteriors.', 'mnyphoto-theme' ),
			__( 'Show the light, the space, and the details that make a place feel like home.', 'mnyphoto-theme' ),
			__( 'Let’s photograph your property', 'mnyphoto-theme' ),
		),
		'events' => array(
			__( 'Be there. Keep the feeling.', 'mnyphoto-theme' ),
			__( 'Candid photographs of the people, atmosphere, and exchanges that bring a gathering to life.', 'mnyphoto-theme' ),
			__( 'Celebrations, community gatherings, and school or business events.', 'mnyphoto-theme' ),
			__( 'Tell us what’s happening, who’s coming, and what you want to remember.', 'mnyphoto-theme' ),
			__( 'Tell us about your event', 'mnyphoto-theme' ),
		),
		'landscapes' => array(
			__( 'A reason to look a little longer.', 'mnyphoto-theme' ),
			__( 'Open spaces, changing skies, and the quiet details of a place worth remembering.', 'mnyphoto-theme' ),
			__( 'Natural scenery, outdoor locations, and seasonal landscapes.', 'mnyphoto-theme' ),
			__( 'A favorite view, a meaningful location, or a place you’d love to explore.', 'mnyphoto-theme' ),
			__( 'Let’s talk landscapes', 'mnyphoto-theme' ),
		),
	);
	$categories = mnyphoto_categories();
	foreach ( $categories as &$category ) {
		$values = $copy[ $category['id'] ];
		$category['portfolio_title'] = $values[0];
		$category['portfolio_description'] = $values[1];
		$category['portfolio_scope'] = $values[2];
		$category['portfolio_prompt'] = $values[3];
		$category['portfolio_invitation'] = $values[4];
	}
	unset( $category );
	return $categories;
}

/** Resolve existing assignments without renaming pages or slugs. */
function mnyphoto_page_templates() {
	return array(
		'services' => array( 'page-templates/page-template-services.php', 'page-templates/template-what-we-do.php' ),
		'about' => array( 'page-templates/page-template-about-us.php', 'page-templates/template-who-we-are.php' ),
		'portfolio' => array( 'page-templates/page-template-work.php', 'page-templates/template-our-work.php' ),
		'contact' => array( 'page-templates/page-template-contact-us.php', 'page-templates/template-contact.php' ),
		'privacy' => array( 'page-templates/page-template-privacy-policy.php', 'page-templates/template-policy.php' ),
		'campaign' => array( 'page-templates/page-template-ppc-lp-2026.php' ),
	);
}

/** Honor prior theme assignments while composing the new template parts. */
function mnyphoto_legacy_page_template( $template ) {
	if ( ! is_page() ) { return $template; }
	$assigned = get_page_template_slug( get_queried_object_id() );
	foreach ( mnyphoto_page_templates() as $templates ) {
		if ( in_array( $assigned, array_slice( $templates, 1 ), true ) ) {
			return get_theme_file_path( '/' . $templates[0] );
		}
	}
	return $template;
}
add_filter( 'template_include', 'mnyphoto_legacy_page_template', 90 );

function mnyphoto_url( $key ) {
	static $urls = array();
	if ( isset( $urls[ $key ] ) ) { return $urls[ $key ]; }
	if ( 'home' === $key ) { return home_url( '/' ); }
	if ( 'search' === $key ) { return add_query_arg( 's', '', home_url( '/' ) ); }
	if ( 'blog' === $key ) {
		$posts_page = (int) get_option( 'page_for_posts' );
		return $posts_page ? get_permalink( $posts_page ) : nytt99_page_url( 'journal' );
	}
	if ( 'privacy' === $key && get_privacy_policy_url() ) { return get_privacy_policy_url(); }
	$paths = array( 'services' => 'services', 'about' => 'about-us', 'portfolio' => 'work', 'contact' => 'contact-us', 'privacy' => 'privacy-policy', 'campaign' => 'ppc-lp-2026' );
	$path = isset( $paths[ $key ] ) ? $paths[ $key ] : sanitize_title( $key );
	$template_map = mnyphoto_page_templates();
	$templates = $template_map[ $key ] ?? array( 'page-templates/page-template-' . $path . '.php' );
	$pages = get_posts( array( 'post_type' => 'page', 'post_status' => 'publish', 'posts_per_page' => 1, 'fields' => 'ids', 'meta_query' => array( array( 'key' => '_wp_page_template', 'value' => $templates, 'compare' => 'IN' ) ) ) );
	$urls[ $key ] = $pages ? get_permalink( $pages[0] ) : nytt99_page_url( $path );
	return $urls[ $key ];
}

function mnyphoto_category( $id ) {
	foreach ( mnyphoto_categories() as $category ) {
		if ( $id === $category['id'] ) { return $category; }
	}
	return null;
}

/** Use editor-selected attachments, with the approved generated images as defaults. */
function mnyphoto_image( $id, $loading = 'lazy', $class = '', $sizes = '(max-width: 560px) 100vw, (max-width: 900px) 50vw, 50vw' ) {
	$category = mnyphoto_category( $id );
	if ( ! $category ) { return; }
	$attachment = absint( get_theme_mod( 'mnyphoto_image_' . $id, 0 ) );
	$attrs = array( 'class' => $class, 'loading' => $loading, 'decoding' => 'async', 'sizes' => $sizes );
	if ( 'eager' === $loading ) { $attrs['fetchpriority'] = 'high'; }
	if ( $attachment && wp_attachment_is_image( $attachment ) ) {
		echo wp_get_attachment_image( $attachment, 'large', false, $attrs ); // Core escapes image attributes.
		return;
	}
	$uri = get_theme_file_uri( '/dist/images/photography/' . $id );
	?>
	<img src="<?php echo esc_url( $uri . '.webp' ); ?>" srcset="<?php echo esc_attr( $uri . '-768.webp 768w, ' . $uri . '.webp 1536w' ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>" width="1536" height="1024" alt="<?php echo esc_attr( $category['alt'] ); ?>" class="<?php echo esc_attr( $class ); ?>" loading="<?php echo esc_attr( $loading ); ?>" decoding="async" <?php if ( 'eager' === $loading ) : ?>fetchpriority="high"<?php endif; ?>>
	<?php
}

function mnyphoto_full_photo( $id ) {
	$attachment = absint( get_theme_mod( 'mnyphoto_image_' . $id, 0 ) );
	return ( $attachment ? wp_get_attachment_image_url( $attachment, 'full' ) : false ) ?: get_theme_file_uri( '/dist/images/photography/' . sanitize_key( $id ) . '.webp' );
}

function mnyphoto_is_example( $id ) {
	return ! wp_attachment_is_image( absint( get_theme_mod( 'mnyphoto_image_' . $id, 0 ) ) );
}

function mnyphoto_has_examples() {
	foreach ( mnyphoto_categories() as $category ) {
		if ( mnyphoto_is_example( $category['id'] ) ) { return true; }
	}
	return false;
}

function mnyphoto_capability_url( $category, $index ) {
	return mnyphoto_url( 'services' ) . '#cap-' . $category['id'] . '-' . absint( $index );
}

/** Existing editor content stays available within the new page composition. */
function mnyphoto_editor_content() {
	$assigned = get_page_template_slug( get_queried_object_id() );
	$legacy = 'page-no-title' === $assigned;
	foreach ( mnyphoto_page_templates() as $templates ) {
		$legacy = $legacy || in_array( $assigned, array_slice( $templates, 1 ), true );
	}
	// Retain legacy demo copy in WordPress without appending old site layouts.
	if ( $legacy && ! get_theme_mod( 'mnyphoto_show_legacy_content', false ) ) { return; }
	if ( is_page() && trim( (string) get_post_field( 'post_content', get_queried_object_id() ) ) ) {
		get_template_part( 'template-parts/page-shared/content', 'shared-editor' );
	}
}

function mnyphoto_recent_posts( $count = 3 ) {
	return get_posts( array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => $count, 'ignore_sticky_posts' => true, 'no_found_rows' => true ) );
}

function mnyphoto_post_image( $post_id, $loading = 'lazy' ) {
	if ( has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail( $post_id, 'large', array( 'loading' => $loading ) ); // Core image markup.
	} else {
		// Decorative photography in the absence of a post's own featured image.
		mnyphoto_image( 'pets', $loading );
	}
}

function mnyphoto_body_classes( $classes ) {
	$classes[] = 'mnyphoto-site';
	if ( is_front_page() ) { $classes[] = 'is-home'; }
	if ( is_page_template( mnyphoto_page_templates()['portfolio'] ) || 'work' === ( $GLOBALS['nytt99_virtual_showcase_route'] ?? '' ) ) { $classes[] = 'mnyphoto-portfolio'; }
	return $classes;
}
add_filter( 'body_class', 'mnyphoto_body_classes' );
