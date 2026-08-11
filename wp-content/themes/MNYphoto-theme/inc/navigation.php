<?php
/** Primary navigation and rich mega panels. */

function mnyphoto_primary_menu_fallback() {
	$items = array(
		__( 'Home', 'mnyphoto-theme' )     => home_url( '/' ),
		__( 'Work', 'mnyphoto-theme' )     => mnyphoto_page_url( 'work' ),
		__( 'About', 'mnyphoto-theme' )    => mnyphoto_page_url( 'about-us' ),
	);
	echo '<ul class="menu site-nav__links">';
	foreach ( $items as $label => $url ) {
		echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}

function mnyphoto_render_services_panel() {
	$services = mnyphoto_get_services();
	?>
	<div class="mega-panel service-mega" id="services-mega" data-mega-panel="services" aria-label="<?php esc_attr_e( 'Services', 'mnyphoto-theme' ); ?>">
		<div class="service-mega__selector">
			<p class="mega-panel__eyebrow"><?php esc_html_e( 'Five connected practices', 'mnyphoto-theme' ); ?></p>
			<?php foreach ( $services as $slug => $service ) : ?>
				<div class="service-option-wrap">
					<button class="service-option<?php echo 'portrait' === $slug ? ' is-active' : ''; ?>" type="button" data-service="<?php echo esc_attr( $slug ); ?>" aria-controls="service-stage-<?php echo esc_attr( $slug ); ?>">
						<span class="service-option__number"><?php echo esc_html( $service['number'] ); ?></span>
						<span><strong><?php echo esc_html( $service['title'] ); ?></strong><small><?php echo esc_html( $service['label'] ); ?></small></span>
						<span aria-hidden="true">↗</span>
					</button>
					<div class="service-option__mobile-detail">
						<p><?php echo esc_html( $service['description'] ); ?></p>
						<ul>
							<?php foreach ( $service['capabilities'] as $capability_id => $capability ) : ?>
								<li><a href="<?php echo esc_url( mnyphoto_page_url( 'services' ) . '#' . $capability_id ); ?>"><?php echo esc_html( $capability ); ?></a></li>
							<?php endforeach; ?>
						</ul>
						<a class="service-option__mobile-cta" href="<?php echo esc_url( $service['url'] ); ?>"><?php esc_html_e( 'Explore this practice', 'mnyphoto-theme' ); ?></a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="service-stage" aria-live="polite">
			<div class="service-stage__canvas" aria-hidden="true"><span class="service-stage__orbit"></span><span class="service-stage__scan"></span></div>
			<?php foreach ( $services as $slug => $service ) : ?>
				<section class="service-stage__content" id="service-stage-<?php echo esc_attr( $slug ); ?>" data-service-stage="<?php echo esc_attr( $slug ); ?>"<?php echo 'portrait' === $slug ? '' : ' hidden'; ?>>
					<p class="eyebrow"><?php echo esc_html( $service['label'] ); ?></p>
					<h2><?php echo esc_html( $service['title'] ); ?></h2>
					<p><?php echo esc_html( $service['description'] ); ?></p>
					<p class="service-stage__metric"><?php echo esc_html( $service['metric'] ); ?></p>
					<ul class="service-stage__capabilities">
						<?php foreach ( $service['capabilities'] as $capability_id => $capability ) : ?>
							<li><a href="<?php echo esc_url( mnyphoto_page_url( 'services' ) . '#' . $capability_id ); ?>"><?php echo esc_html( $capability ); ?></a></li>
						<?php endforeach; ?>
					</ul>
					<a class="text-link" href="<?php echo esc_url( $service['url'] ); ?>"><?php esc_html_e( 'View practice', 'mnyphoto-theme' ); ?> <span aria-hidden="true">→</span></a>
				</section>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

function mnyphoto_render_blog_panel() {
	$query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 4, 'post_status' => 'publish', 'no_found_rows' => true, 'ignore_sticky_posts' => true ) );
	?>
	<div class="mega-panel blog-mega" id="blog-mega" data-mega-panel="blog" aria-label="<?php esc_attr_e( 'Journal', 'mnyphoto-theme' ); ?>">
		<div class="blog-mega__heading">
			<div><p class="eyebrow"><?php esc_html_e( 'Field notes', 'mnyphoto-theme' ); ?></p><h2><?php esc_html_e( 'The journal', 'mnyphoto-theme' ); ?></h2></div>
			<a class="text-link" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: mnyphoto_page_url( 'blog' ) ); ?>"><?php esc_html_e( 'View all stories', 'mnyphoto-theme' ); ?> →</a>
		</div>
		<div class="blog-mega__grid count-<?php echo esc_attr( max( 1, $query->post_count ) ); ?>">
			<?php if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php mnyphoto_post_card( get_the_ID() ); ?>
				<?php endwhile; ?>
			<?php else : ?>
				<div class="journal-card journal-card--empty"><div class="journal-card__placeholder"><span>MNY</span></div><div class="journal-card__body"><p class="journal-card__meta"><?php esc_html_e( 'Studio journal', 'mnyphoto-theme' ); ?></p><h3><?php esc_html_e( 'The first field note is being framed.', 'mnyphoto-theme' ); ?></h3><p><?php esc_html_e( 'Published WordPress posts will appear here automatically.', 'mnyphoto-theme' ); ?></p></div></div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
	<?php
}

function mnyphoto_render_primary_navigation() {
	?>
	<nav class="site-nav" id="site-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'mnyphoto-theme' ); ?>">
		<div class="site-nav__managed">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu site-nav__links', 'fallback_cb' => 'mnyphoto_primary_menu_fallback', 'depth' => 2 ) ); ?>
		</div>
		<div class="site-nav__showpieces">
			<button class="site-nav__trigger" type="button" data-mega-trigger="services" aria-expanded="false" aria-controls="services-mega"><?php esc_html_e( 'Services', 'mnyphoto-theme' ); ?><span aria-hidden="true">＋</span></button>
			<button class="site-nav__trigger" type="button" data-mega-trigger="blog" aria-expanded="false" aria-controls="blog-mega"><?php esc_html_e( 'Journal', 'mnyphoto-theme' ); ?><span aria-hidden="true">＋</span></button>
		</div>
		<a class="button button--small site-nav__cta" href="<?php echo esc_url( mnyphoto_page_url( 'contact-us' ) ); ?>"><?php esc_html_e( 'Book a project', 'mnyphoto-theme' ); ?></a>
		<?php mnyphoto_render_services_panel(); ?>
		<?php mnyphoto_render_blog_panel(); ?>
	</nav>
	<?php
}
