<?php
/**
 * Native primary navigation and enterprise mega panels.
 *
 * @package NolanYoungThemeTemplate99Master
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return the assigned primary menu's top-level URLs when available.
 *
 * @return array<string, string>
 */
function nytt99_primary_menu_urls() {
	$urls      = array();
	$locations = get_nav_menu_locations();

	if ( empty( $locations['primary'] ) ) {
		return $urls;
	}

	$items = wp_get_nav_menu_items( $locations['primary'] );
	if ( ! is_array( $items ) ) {
		return $urls;
	}

	foreach ( $items as $item ) {
		if ( 0 !== (int) $item->menu_item_parent ) {
			continue;
		}

		$key          = sanitize_title( wp_strip_all_tags( (string) $item->title ) );
		$urls[ $key ] = (string) $item->url;
	}

	return $urls;
}

/**
 * Resolve a primary navigation URL from the assigned menu or a safe fallback.
 *
 * @param string $key      Menu key.
 * @param string $fallback Fallback relative path.
 * @return string
 */
function nytt99_primary_menu_url( $key, $fallback ) {
	$urls = nytt99_primary_menu_urls();

	if ( isset( $urls[ $key ] ) ) {
		return $urls[ $key ];
	}

	return home_url( $fallback );
}

/**
 * Return concise descriptions for every specialist service capability.
 *
 * The keys intentionally match the URL fragments used by both the mega-menu
 * and the Services page capability directory.
 *
 * @return array<string, string>
 */
function nytt99_service_capability_summaries() {
	return array(
		'wordpress-development'          => __( 'Custom themes, block systems, publishing workflows, and enterprise WordPress platforms built for long-term ownership.', 'nolan-young-theme-template-99-master' ),
		'custom-web-applications'         => __( 'Purpose-built browser applications that turn complex business rules into fast, dependable user experiences.', 'nolan-young-theme-template-99-master' ),
		'headless-platforms'              => __( 'Decoupled content platforms that deliver structured content securely across websites, applications, and channels.', 'nolan-young-theme-template-99-master' ),
		'react-interfaces'                => __( 'Accessible, component-driven React experiences engineered for speed, clarity, and maintainable product delivery.', 'nolan-young-theme-template-99-master' ),
		'shopify-development'             => __( 'Conversion-aware Shopify storefronts, theme systems, integrations, and operational improvements for growing commerce teams.', 'nolan-young-theme-template-99-master' ),
		'enterprise-migrations'           => __( 'Controlled migrations that protect content, search equity, integrations, permissions, and business continuity.', 'nolan-young-theme-template-99-master' ),
		'custom-business-plugins'         => __( 'Focused WordPress extensions that encode unique workflows and business rules without unnecessary third-party weight.', 'nolan-young-theme-template-99-master' ),
		'seo-plugins'                     => __( 'Search-focused extensions for metadata, structured content, indexation controls, and editorial quality assurance.', 'nolan-young-theme-template-99-master' ),
		'forms-and-workflow-plugins'      => __( 'Reliable form, approval, notification, and data-routing systems shaped around the way teams actually operate.', 'nolan-young-theme-template-99-master' ),
		'navigation-and-menu-plugins'     => __( 'Flexible navigation systems for complex information architectures, personalized pathways, and accessible mega-menus.', 'nolan-young-theme-template-99-master' ),
		'api-integrations'                => __( 'Resilient connections between WordPress and the CRM, commerce, identity, analytics, and operational systems around it.', 'nolan-young-theme-template-99-master' ),
		'woocommerce-extensions'         => __( 'Custom WooCommerce capabilities for purchasing rules, subscriptions, fulfillment, pricing, and customer operations.', 'nolan-young-theme-template-99-master' ),
		'technical-seo'                   => __( 'Audits and engineering improvements for crawlability, rendering, performance, indexation, and search-platform health.', 'nolan-young-theme-template-99-master' ),
		'content-architecture'            => __( 'Search-informed content models, taxonomies, internal linking, and publishing structures that scale coherently.', 'nolan-young-theme-template-99-master' ),
		'local-search'                    => __( 'Location architecture, local landing experiences, listings consistency, and measurement for geographically focused demand.', 'nolan-young-theme-template-99-master' ),
		'schema-systems'                  => __( 'Maintainable structured-data systems that help search platforms understand entities, services, products, and evidence.', 'nolan-young-theme-template-99-master' ),
		'conversion-optimization'         => __( 'Evidence-led experiments that improve landing-page clarity, qualified actions, and the value created by organic traffic.', 'nolan-young-theme-template-99-master' ),
		'search-performance-reporting'   => __( 'Decision-ready reporting that connects rankings and visibility with qualified demand, conversions, and business outcomes.', 'nolan-young-theme-template-99-master' ),
		'ga4-implementation'              => __( 'Governed GA4 measurement plans, event models, configuration, validation, and documentation teams can trust.', 'nolan-young-theme-template-99-master' ),
		'tag-management'                 => __( 'Controlled tag-manager architecture that improves data quality, consent handling, deployment safety, and maintainability.', 'nolan-young-theme-template-99-master' ),
		'executive-dashboards'           => __( 'Focused dashboards that translate delivery, customer, marketing, and commercial signals into useful leadership decisions.', 'nolan-young-theme-template-99-master' ),
		'conversion-tracking'            => __( 'End-to-end measurement of meaningful actions across campaigns, platforms, forms, commerce, and customer journeys.', 'nolan-young-theme-template-99-master' ),
		'customer-journey-analysis'      => __( 'Behavior analysis that reveals where users hesitate, abandon, succeed, and create value across connected touchpoints.', 'nolan-young-theme-template-99-master' ),
		'data-quality-audits'             => __( 'Systematic audits that identify missing, duplicated, inconsistent, or misleading data before it drives decisions.', 'nolan-young-theme-template-99-master' ),
		'ai-assistants'                   => __( 'Task-focused assistants grounded in approved knowledge, clear workflows, human review, and measurable usefulness.', 'nolan-young-theme-template-99-master' ),
		'workflow-automation'             => __( 'Responsible automations that remove repetitive coordination while preserving approvals, visibility, and exception handling.', 'nolan-young-theme-template-99-master' ),
		'retrieval-systems'               => __( 'Search and retrieval pipelines that connect language models to governed organizational knowledge and current evidence.', 'nolan-young-theme-template-99-master' ),
		'content-intelligence'            => __( 'AI-assisted systems for classification, enrichment, quality review, reuse, and content operations at scale.', 'nolan-young-theme-template-99-master' ),
		'model-integrations'              => __( 'Provider-aware model integrations with evaluation, fallback behavior, observability, cost controls, and secure boundaries.', 'nolan-young-theme-template-99-master' ),
		'responsible-ai-guardrails'       => __( 'Practical safeguards for privacy, permissions, evaluation, disclosure, human oversight, and acceptable use.', 'nolan-young-theme-template-99-master' ),
	);
}

/**
 * Return rich mega-menu content.
 *
 * @return array<string, array<string, mixed>>
 */
function nytt99_mega_menu_data() {
	$data = array(
		'services' => array(
			'label'       => __( 'Services', 'nolan-young-theme-template-99-master' ),
			'eyebrow'     => __( 'Enterprise capabilities', 'nolan-young-theme-template-99-master' ),
			'heading'     => __( 'Build the system behind better growth.', 'nolan-young-theme-template-99-master' ),
			'description' => __( 'Strategy, experience, engineering, and long-term stewardship connected as one practical delivery system.', 'nolan-young-theme-template-99-master' ),
			'url'         => nytt99_primary_menu_url( 'services', '/services/' ),
			'metric'      => __( 'Five specialist development practices', 'nolan-young-theme-template-99-master' ),
			'items'       => array(
				array(
					'title'       => __( 'Website Development', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'High-performance digital platforms engineered around the way your organization actually works.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/services/#service-1' ),
					'links'       => array( __( 'WordPress development', 'nolan-young-theme-template-99-master' ), __( 'Custom web applications', 'nolan-young-theme-template-99-master' ), __( 'Headless platforms', 'nolan-young-theme-template-99-master' ), __( 'React interfaces', 'nolan-young-theme-template-99-master' ), __( 'Shopify development', 'nolan-young-theme-template-99-master' ), __( 'Enterprise migrations', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'WEB',
					'visual'      => 'web',
					'signal'      => __( 'Experience layer', 'nolan-young-theme-template-99-master' ),
					'stat'        => '06',
					'stat_label'  => __( 'delivery paths', 'nolan-young-theme-template-99-master' ),
				),
				array(
					'title'       => __( 'Plugin Development', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'Purpose-built WordPress functionality without the weight, risk, or compromises of generic plugins.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/services/#service-2' ),
					'links'       => array( __( 'Custom business plugins', 'nolan-young-theme-template-99-master' ), __( 'SEO plugins', 'nolan-young-theme-template-99-master' ), __( 'Forms and workflow plugins', 'nolan-young-theme-template-99-master' ), __( 'Navigation and menu plugins', 'nolan-young-theme-template-99-master' ), __( 'API integrations', 'nolan-young-theme-template-99-master' ), __( 'WooCommerce extensions', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'PLG',
					'visual'      => 'plugin',
					'signal'      => __( 'Capability layer', 'nolan-young-theme-template-99-master' ),
					'stat'        => '06',
					'stat_label'  => __( 'extension systems', 'nolan-young-theme-template-99-master' ),
				),
				array(
					'title'       => __( 'SEO & Search Growth', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'Technical and editorial search systems designed to build compounding visibility and qualified demand.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/services/#service-3' ),
					'links'       => array( __( 'Technical SEO', 'nolan-young-theme-template-99-master' ), __( 'Content architecture', 'nolan-young-theme-template-99-master' ), __( 'Local search', 'nolan-young-theme-template-99-master' ), __( 'Schema systems', 'nolan-young-theme-template-99-master' ), __( 'Conversion optimization', 'nolan-young-theme-template-99-master' ), __( 'Search performance reporting', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'SEO',
					'visual'      => 'seo',
					'signal'      => __( 'Discovery layer', 'nolan-young-theme-template-99-master' ),
					'stat'        => '+42%',
					'stat_label'  => __( 'visibility signal', 'nolan-young-theme-template-99-master' ),
				),
				array(
					'title'       => __( 'Analytics & Intelligence', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'Measurement systems that turn fragmented activity into trustworthy evidence and clearer decisions.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/services/#service-4' ),
					'links'       => array( __( 'GA4 implementation', 'nolan-young-theme-template-99-master' ), __( 'Tag management', 'nolan-young-theme-template-99-master' ), __( 'Executive dashboards', 'nolan-young-theme-template-99-master' ), __( 'Conversion tracking', 'nolan-young-theme-template-99-master' ), __( 'Customer journey analysis', 'nolan-young-theme-template-99-master' ), __( 'Data quality audits', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'DATA',
					'visual'      => 'analytics',
					'signal'      => __( 'Evidence layer', 'nolan-young-theme-template-99-master' ),
					'stat'        => '24/7',
					'stat_label'  => __( 'decision visibility', 'nolan-young-theme-template-99-master' ),
				),
				array(
					'title'       => __( 'AI Development', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'Useful AI products and automations grounded in your workflows, data, safeguards, and customer needs.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/services/#service-5' ),
					'links'       => array( __( 'AI assistants', 'nolan-young-theme-template-99-master' ), __( 'Workflow automation', 'nolan-young-theme-template-99-master' ), __( 'Retrieval systems', 'nolan-young-theme-template-99-master' ), __( 'Content intelligence', 'nolan-young-theme-template-99-master' ), __( 'Model integrations', 'nolan-young-theme-template-99-master' ), __( 'Responsible AI guardrails', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'AI',
					'visual'      => 'ai',
					'signal'      => __( 'Intelligence layer', 'nolan-young-theme-template-99-master' ),
					'stat'        => '05',
					'stat_label'  => __( 'connected agents', 'nolan-young-theme-template-99-master' ),
				),
			),
		),
		'about'    => array(
			'label'       => __( 'About', 'nolan-young-theme-template-99-master' ),
			'eyebrow'     => __( 'How the team works', 'nolan-young-theme-template-99-master' ),
			'heading'     => __( 'Senior thinking, close collaboration.', 'nolan-young-theme-template-99-master' ),
			'description' => __( 'Meet the people, principles, and experiments behind careful enterprise delivery.', 'nolan-young-theme-template-99-master' ),
			'url'         => nytt99_primary_menu_url( 'about', '/about-us/' ),
			'metric'      => __( 'One team from strategy through launch', 'nolan-young-theme-template-99-master' ),
			'items'       => array(
				array(
					'title'       => __( 'About Us', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'The story, values, and approach behind the work.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/about-us/#story' ),
					'links'       => array( __( 'Our story', 'nolan-young-theme-template-99-master' ), __( 'Values', 'nolan-young-theme-template-99-master' ), __( 'Approach', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'A1',
				),
				array(
					'title'       => __( 'Meet the Team', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'Leadership, design, and engineering working as one unit.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/about-us/#team' ),
					'links'       => array( __( 'Leadership', 'nolan-young-theme-template-99-master' ), __( 'Design', 'nolan-young-theme-template-99-master' ), __( 'Engineering', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'A2',
				),
				array(
					'title'       => __( 'Careers', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'A collaborative environment for thoughtful, standards-based work.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/about-us/#careers' ),
					'links'       => array( __( 'Open roles', 'nolan-young-theme-template-99-master' ), __( 'Culture', 'nolan-young-theme-template-99-master' ), __( 'Benefits', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'A3',
				),
				array(
					'title'       => __( 'Future Work', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'Research and experiments shaping the next delivery capability.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/about-us/#future' ),
					'links'       => array( __( 'Research', 'nolan-young-theme-template-99-master' ), __( 'Experiments', 'nolan-young-theme-template-99-master' ), __( 'Roadmap', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'A4',
				),
			),
		),
		'work'     => array(
			'label'       => __( 'Work', 'nolan-young-theme-template-99-master' ),
			'eyebrow'     => __( 'Selected systems', 'nolan-young-theme-template-99-master' ),
			'heading'     => __( 'See what changed—not just what shipped.', 'nolan-young-theme-template-99-master' ),
			'description' => __( 'Explore the websites, plugins, AI agents, business workflows, and engineering projects behind the practice.', 'nolan-young-theme-template-99-master' ),
			'url'         => nytt99_primary_menu_url( 'work', '/work/' ),
			'metric'      => __( 'Five ways to inspect the work', 'nolan-young-theme-template-99-master' ),
			'items'       => array(
				array(
					'title'       => __( 'Website Showcases', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'High-performance publishing, commerce, and customer platforms designed as complete digital systems.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/work/#project-library' ),
					'links'       => array( __( 'Enterprise WordPress', 'nolan-young-theme-template-99-master' ), __( 'Commerce experiences', 'nolan-young-theme-template-99-master' ), __( 'Headless platforms', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'WEB',
					'visual'      => 'website',
				),
				array(
					'title'       => __( 'Plugin Projects', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'Purpose-built WordPress extensions that turn unique rules and workflows into dependable tools.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/work/#portfolio-results' ),
					'links'       => array( __( 'Custom plugins', 'nolan-young-theme-template-99-master' ), __( 'Workflow extensions', 'nolan-young-theme-template-99-master' ), __( 'API integrations', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'PLG',
					'visual'      => 'plugin',
				),
				array(
					'title'       => __( 'AI Agent Setups', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'Grounded assistants and agent toolchains with clear permissions, evaluation, and human oversight.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/services/#ai-assistants' ),
					'links'       => array( __( 'Knowledge assistants', 'nolan-young-theme-template-99-master' ), __( 'Agent toolchains', 'nolan-young-theme-template-99-master' ), __( 'Human review systems', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'AGT',
					'visual'      => 'agent',
				),
				array(
					'title'       => __( 'AI Business Workflows', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'Connected automations that remove repetitive coordination while keeping decisions visible and owned.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/services/#workflow-automation' ),
					'links'       => array( __( 'Operations automation', 'nolan-young-theme-template-99-master' ), __( 'Content intelligence', 'nolan-young-theme-template-99-master' ), __( 'Decision support', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'FLOW',
					'visual'      => 'workflow',
				),
				array(
					'title'       => __( 'GitHub Projects', 'nolan-young-theme-template-99-master' ),
					'description' => __( 'Open experiments, reference implementations, and engineering notes built in public.', 'nolan-young-theme-template-99-master' ),
					'url'         => home_url( '/work/#project-library' ),
					'links'       => array( __( 'Open-source experiments', 'nolan-young-theme-template-99-master' ), __( 'Reference builds', 'nolan-young-theme-template-99-master' ), __( 'Engineering notes', 'nolan-young-theme-template-99-master' ) ),
					'code'        => 'GH',
					'visual'      => 'github',
				),
			),
		),
	);

	$capability_summaries = nytt99_service_capability_summaries();

	foreach ( $data['services']['items'] as &$service ) {
		$service['url'] = home_url( '/services/#' . sanitize_title( $service['title'] ) );

		foreach ( $service['links'] as &$capability_label ) {
			$slug             = sanitize_title( $capability_label );
			$capability_label = array(
				'label'   => $capability_label,
				'slug'    => $slug,
				'url'     => home_url( '/services/#' . $slug ),
				'summary' => isset( $capability_summaries[ $slug ] ) ? $capability_summaries[ $slug ] : '',
			);
		}
		unset( $capability_label );
	}
	unset( $service );

	return $data;
}

/**
 * Render the interactive Services mega-menu content.
 *
 * @param array<string, mixed> $data Services panel data.
 * @return void
 */
function nytt99_render_services_mega_content( $data ) {
	$first = $data['items'][0];
	?>
	<div class="services-mega content-wrap">
		<section class="services-mega__menu" aria-labelledby="services-mega-heading">
			<header class="services-mega__heading">
				<div>
					<p class="eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
					<h2 id="services-mega-heading"><?php esc_html_e( 'Choose what to build next.', 'nolan-young-theme-template-99-master' ); ?></h2>
				</div>
				<span><?php echo esc_html( sprintf( '%02d', count( $data['items'] ) ) ); ?> <?php esc_html_e( 'practices', 'nolan-young-theme-template-99-master' ); ?></span>
			</header>
			<div class="services-mega__options">
				<?php foreach ( $data['items'] as $index => $item ) : ?>
					<a
						class="service-option<?php echo 0 === $index ? ' is-active' : ''; ?>"
						href="<?php echo esc_url( $item['url'] ); ?>"
						data-mega-option
						data-title="<?php echo esc_attr( $item['title'] ); ?>"
						data-description="<?php echo esc_attr( $item['description'] ); ?>"
						data-code="<?php echo esc_attr( $item['code'] ); ?>"
						data-links="<?php echo esc_attr( wp_json_encode( $item['links'] ) ); ?>"
						data-signal="<?php echo esc_attr( $item['signal'] ); ?>"
						data-stat="<?php echo esc_attr( $item['stat'] ); ?>"
						data-stat-label="<?php echo esc_attr( $item['stat_label'] ); ?>"
						data-visual="<?php echo esc_attr( $item['visual'] ); ?>"
					>
						<span class="service-option__number"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
						<span class="service-option__copy">
							<strong><?php echo esc_html( $item['title'] ); ?></strong>
							<small><?php echo esc_html( $item['signal'] ); ?></small>
						</span>
						<span class="service-option__arrow" aria-hidden="true">&#8599;</span>
						<span class="service-option__mobile-details">
							<span class="service-option__mobile-description"><?php echo esc_html( $item['description'] ); ?></span>
							<span class="service-option__mobile-label"><?php esc_html_e( 'Included capabilities', 'nolan-young-theme-template-99-master' ); ?></span>
							<span class="service-option__mobile-capabilities">
								<?php foreach ( $item['links'] as $link_index => $link ) : ?>
									<span><b><?php echo esc_html( sprintf( '%02d', $link_index + 1 ) ); ?></b><?php echo esc_html( $link['label'] ); ?></span>
								<?php endforeach; ?>
							</span>
							<span class="service-option__mobile-cta">
								<span><?php esc_html_e( 'Explore this practice', 'nolan-young-theme-template-99-master' ); ?></span>
								<span aria-hidden="true">&#8594;</span>
							</span>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
		</section>

		<aside class="service-stage" data-mega-feature data-service-visual="<?php echo esc_attr( $first['visual'] ); ?>">
			<div class="service-stage__topline">
				<span><?php esc_html_e( 'Interactive capability system', 'nolan-young-theme-template-99-master' ); ?></span>
				<span><i></i><?php esc_html_e( 'Live', 'nolan-young-theme-template-99-master' ); ?></span>
			</div>
			<div class="service-stage__canvas" aria-hidden="true">
				<span class="service-stage__code" data-mega-code><?php echo esc_html( $first['code'] ); ?></span>
				<span class="service-stage__signal" data-mega-signal><?php echo esc_html( $first['signal'] ); ?></span>
				<div class="service-stage__orbit">
					<i></i><i></i><i></i><i></i><i></i>
					<span><b>NY</b><small><?php esc_html_e( 'system', 'nolan-young-theme-template-99-master' ); ?></small></span>
				</div>
				<div class="service-stage__bars"><i></i><i></i><i></i><i></i><i></i><i></i></div>
				<span class="service-stage__coordinate">40.7128&deg; N&nbsp;&nbsp; / &nbsp;&nbsp;74.0060&deg; W</span>
			</div>
			<div class="service-stage__content" aria-live="polite">
				<div class="service-stage__title-row">
					<div>
						<p><?php esc_html_e( 'Selected practice', 'nolan-young-theme-template-99-master' ); ?></p>
						<h3 data-mega-title><?php echo esc_html( $first['title'] ); ?></h3>
					</div>
					<div class="service-stage__stat">
						<strong data-mega-stat><?php echo esc_html( $first['stat'] ); ?></strong>
						<span data-mega-stat-label><?php echo esc_html( $first['stat_label'] ); ?></span>
					</div>
				</div>
				<p class="service-stage__description" data-mega-description><?php echo esc_html( $first['description'] ); ?></p>
				<ul class="service-stage__capabilities" data-mega-links>
					<?php foreach ( $first['links'] as $index => $link ) : ?>
						<li style="--capability-index: <?php echo esc_attr( $index ); ?>">
							<a href="<?php echo esc_url( $link['url'] ); ?>">
								<span><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
								<span><?php echo esc_html( $link['label'] ); ?></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
				<a class="service-stage__link" href="<?php echo esc_url( $first['url'] ); ?>" data-mega-feature-link>
					<span><?php esc_html_e( 'Explore this practice', 'nolan-young-theme-template-99-master' ); ?></span>
					<span aria-hidden="true">&#8594;</span>
				</a>
			</div>
		</aside>
	</div>
	<?php
}

/**
 * Render the Work mega-menu as a focused project index and live showcase.
 *
 * @param array<string, mixed> $data Work panel data.
 * @return void
 */
function nytt99_render_work_mega_content( $data ) {
	$first = $data['items'][0];
	?>
	<div class="work-mega content-wrap">
		<section class="work-mega__index" aria-labelledby="work-mega-heading">
			<header class="work-mega__heading">
				<div>
					<p class="eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
					<h2 id="work-mega-heading"><?php esc_html_e( 'Inspect what we build.', 'nolan-young-theme-template-99-master' ); ?></h2>
				</div>
				<span><?php echo esc_html( sprintf( '%02d', count( $data['items'] ) ) ); ?> <?php esc_html_e( 'project tracks', 'nolan-young-theme-template-99-master' ); ?></span>
			</header>
			<div class="work-mega__options">
				<?php foreach ( $data['items'] as $index => $item ) : ?>
					<a
						class="work-option<?php echo 0 === $index ? ' is-active' : ''; ?>"
						href="<?php echo esc_url( $item['url'] ); ?>"
						data-mega-option
						data-title="<?php echo esc_attr( $item['title'] ); ?>"
						data-description="<?php echo esc_attr( $item['description'] ); ?>"
						data-code="<?php echo esc_attr( $item['code'] ); ?>"
						data-links="<?php echo esc_attr( wp_json_encode( $item['links'] ) ); ?>"
						data-visual="<?php echo esc_attr( $item['visual'] ); ?>"
						data-position="<?php echo esc_attr( sprintf( '%02d / %02d', $index + 1, count( $data['items'] ) ) ); ?>"
					>
						<span class="work-option__number"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
						<span class="work-option__copy">
							<strong><?php echo esc_html( $item['title'] ); ?></strong>
							<small><?php echo esc_html( $item['description'] ); ?></small>
							<span class="work-option__tags"><?php echo esc_html( implode( ' / ', $item['links'] ) ); ?></span>
						</span>
						<span class="work-option__arrow" aria-hidden="true">&#8599;</span>
					</a>
				<?php endforeach; ?>
			</div>
		</section>

		<aside class="work-lab" data-mega-feature data-work-visual="<?php echo esc_attr( $first['visual'] ); ?>">
			<div class="work-lab__topline">
				<span><?php esc_html_e( 'Artifact viewer / selected work', 'nolan-young-theme-template-99-master' ); ?></span>
				<span><i></i><b data-mega-code><?php echo esc_html( $first['code'] ); ?></b><?php esc_html_e( 'Live', 'nolan-young-theme-template-99-master' ); ?></span>
			</div>
			<div class="work-lab__canvas" aria-hidden="true">
				<div class="work-artifact work-artifact--website">
					<div class="work-site-frame">
						<div class="work-site-frame__bar"><span><i></i><i></i><i></i></span><b>experience.system</b><em>Live</em></div>
						<div class="work-site-frame__body">
							<div class="work-site-frame__rail"><i></i><i></i><i></i><i></i></div>
							<div class="work-site-frame__page"><small>Digital platform</small><strong>Clarity at every layer.</strong><span></span><div><i></i><i></i><i></i></div></div>
						</div>
					</div>
					<span class="work-artifact__label">01 / Experience system</span>
				</div>

				<div class="work-artifact work-artifact--plugin">
					<div class="work-plugin-map">
						<span class="work-plugin-map__port work-plugin-map__port--one">Hook / input</span>
						<span class="work-plugin-map__port work-plugin-map__port--two">API / sync</span>
						<span class="work-plugin-map__port work-plugin-map__port--three">Admin / control</span>
						<span class="work-plugin-map__port work-plugin-map__port--four">Output / action</span>
						<div class="work-plugin-map__core"><span>NY</span><strong>Plugin</strong><small>Purpose-built core</small></div>
					</div>
					<span class="work-artifact__label">02 / Extension architecture</span>
				</div>

				<div class="work-artifact work-artifact--agent">
					<div class="work-agent-map">
						<i class="work-agent-map__ring"></i><i class="work-agent-map__ring"></i>
						<div class="work-agent-map__core"><small>Grounded</small><strong>AI</strong><span>Agent</span></div>
						<span class="work-agent-map__node work-agent-map__node--one"><i></i>Knowledge</span>
						<span class="work-agent-map__node work-agent-map__node--two"><i></i>Tools</span>
						<span class="work-agent-map__node work-agent-map__node--three"><i></i>Evaluation</span>
						<span class="work-agent-map__node work-agent-map__node--four"><i></i>Human review</span>
					</div>
					<span class="work-artifact__label">03 / Governed agent network</span>
				</div>

				<div class="work-artifact work-artifact--workflow">
					<div class="work-flow-map">
						<div><span>01</span><strong>Intake</strong><small>Signal received</small></div><i></i>
						<div><span>02</span><strong>Classify</strong><small>Context applied</small></div><i></i>
						<div><span>03</span><strong>Act</strong><small>Workflow runs</small></div><i></i>
						<div><span>04</span><strong>Verify</strong><small>Owner reviews</small></div>
					</div>
					<span class="work-artifact__label">04 / Business workflow</span>
				</div>

				<div class="work-artifact work-artifact--github">
					<div class="work-repo-frame">
						<div class="work-repo-frame__bar"><strong>NY / reference-build</strong><span>main</span></div>
						<div class="work-repo-frame__body">
							<div class="work-repo-frame__tree"><span>src</span><span>components</span><span>tests</span><span>README.md</span></div>
							<div class="work-repo-frame__code"><i></i><i></i><i></i><i></i><i></i><i></i><b>Ready to inspect</b></div>
						</div>
					</div>
					<span class="work-artifact__label">05 / Open engineering</span>
				</div>

				<span class="work-lab__coordinate">NY / ARTIFACT 01&ndash;05</span>
			</div>
			<div class="work-lab__content" aria-live="polite">
				<p class="eyebrow"><?php esc_html_e( 'Current project track', 'nolan-young-theme-template-99-master' ); ?></p>
				<div class="work-lab__title-row">
					<h3 data-mega-title><?php echo esc_html( $first['title'] ); ?></h3>
					<span data-mega-position><?php esc_html_e( '01 / 05', 'nolan-young-theme-template-99-master' ); ?></span>
				</div>
				<p data-mega-description><?php echo esc_html( $first['description'] ); ?></p>
				<ul data-mega-links>
					<?php foreach ( $first['links'] as $link ) : ?>
						<li><?php echo esc_html( $link ); ?></li>
					<?php endforeach; ?>
				</ul>
				<a class="work-lab__link" href="<?php echo esc_url( $first['url'] ); ?>" data-mega-feature-link>
					<span><?php esc_html_e( 'Explore this work', 'nolan-young-theme-template-99-master' ); ?></span>
					<span aria-hidden="true">&#8594;</span>
				</a>
			</div>
		</aside>
	</div>
	<?php
}

/**
 * Render a rich full-width mega panel.
 *
 * @param string               $key  Panel key.
 * @param array<string, mixed> $data Panel data.
 * @return void
 */
function nytt99_render_mega_panel( $key, $data ) {
	$panel_id = 'nytt99-mega-' . sanitize_html_class( $key );
	$first    = $data['items'][0];
	?>
	<li class="site-menu__item site-menu__item--mega" data-mega-item>
		<button
			class="site-menu__trigger"
			type="button"
			aria-expanded="false"
			aria-controls="<?php echo esc_attr( $panel_id ); ?>"
			data-mega-trigger
		>
			<span><?php echo esc_html( $data['label'] ); ?></span>
			<svg viewBox="0 0 12 12" aria-hidden="true"><path d="M2 4.25 6 8l4-3.75"/></svg>
		</button>
		<div id="<?php echo esc_attr( $panel_id ); ?>" class="mega-panel mega-panel--<?php echo esc_attr( sanitize_html_class( $key ) ); ?>" data-mega-panel>
			<div class="mega-panel__context content-wrap">
				<div>
					<strong><?php echo esc_html( $data['label'] ); ?></strong>
					<span><?php echo esc_html( $data['metric'] ); ?></span>
				</div>
				<a href="<?php echo esc_url( $data['url'] ); ?>">
					<?php esc_html_e( 'Explore the complete practice', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true"> ↗</span>
				</a>
			</div>
			<?php if ( 'services' === $key ) : ?>
				<?php nytt99_render_services_mega_content( $data ); ?>
			<?php elseif ( 'work' === $key ) : ?>
				<?php nytt99_render_work_mega_content( $data ); ?>
			<?php else : ?>
			<div class="mega-panel__inner content-wrap">
				<div class="mega-panel__intro">
					<span class="mega-panel__index" aria-hidden="true"><?php echo esc_html( strtoupper( substr( $key, 0, 1 ) ) ); ?></span>
					<p class="eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
					<h2><?php echo esc_html( $data['heading'] ); ?></h2>
					<p><?php echo esc_html( $data['description'] ); ?></p>
					<a class="text-link" href="<?php echo esc_url( $data['url'] ); ?>">
						<?php esc_html_e( 'View overview', 'nolan-young-theme-template-99-master' ); ?>
						<span aria-hidden="true">→</span>
					</a>
				</div>
				<div class="mega-panel__options" aria-label="<?php echo esc_attr( $data['label'] ); ?>">
					<span class="mega-panel__rail-label"><?php esc_html_e( 'Choose a direction', 'nolan-young-theme-template-99-master' ); ?></span>
					<?php foreach ( $data['items'] as $index => $item ) : ?>
						<a
							class="mega-option<?php echo 0 === $index ? ' is-active' : ''; ?>"
							href="<?php echo esc_url( $item['url'] ); ?>"
							data-mega-option
							data-title="<?php echo esc_attr( $item['title'] ); ?>"
							data-description="<?php echo esc_attr( $item['description'] ); ?>"
							data-code="<?php echo esc_attr( $item['code'] ); ?>"
							data-links="<?php echo esc_attr( wp_json_encode( $item['links'] ) ); ?>"
						>
							<span class="mega-option__code"><?php echo esc_html( $item['code'] ); ?></span>
							<span><strong><?php echo esc_html( $item['title'] ); ?></strong><small><?php echo esc_html( $item['description'] ); ?></small></span>
							<span aria-hidden="true">↗</span>
						</a>
					<?php endforeach; ?>
				</div>
				<aside class="mega-feature" data-mega-feature>
					<div class="mega-feature__top">
						<span><?php esc_html_e( 'Live capability view', 'nolan-young-theme-template-99-master' ); ?></span>
						<span><?php esc_html_e( 'Available', 'nolan-young-theme-template-99-master' ); ?></span>
					</div>
					<div class="mega-feature__visual" aria-hidden="true">
						<span data-mega-code><?php echo esc_html( $first['code'] ); ?></span>
						<div class="mega-feature__diagram"><i></i><i></i><i></i><i></i></div>
					</div>
					<div class="mega-feature__details">
						<p class="eyebrow"><?php echo esc_html( $data['metric'] ); ?></p>
						<h3 data-mega-title><?php echo esc_html( $first['title'] ); ?></h3>
						<span aria-hidden="true">↗</span>
						<p data-mega-description><?php echo esc_html( $first['description'] ); ?></p>
						<ul data-mega-links>
							<?php foreach ( $first['links'] as $link ) : ?>
								<li><?php echo esc_html( $link ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</aside>
			</div>
			<?php endif; ?>
			<div class="mega-panel__utility content-wrap">
				<a href="<?php echo esc_url( nytt99_primary_menu_url( 'work', '/work/' ) ); ?>">
					<span><?php esc_html_e( 'See the evidence in our work', 'nolan-young-theme-template-99-master' ); ?></span>
					<span aria-hidden="true">→</span>
				</a>
				<a href="<?php echo esc_url( nytt99_primary_menu_url( 'blog', '/journal/' ) ); ?>">
					<span><?php esc_html_e( 'Read the latest field notes', 'nolan-young-theme-template-99-master' ); ?></span>
					<span aria-hidden="true">→</span>
				</a>
				<a href="<?php echo esc_url( nytt99_page_url( 'contact-us' ) ); ?>">
					<span><?php esc_html_e( 'Discuss the right first move', 'nolan-young-theme-template-99-master' ); ?></span>
					<span aria-hidden="true">→</span>
				</a>
			</div>
		</div>
	</li>
	<?php
}

/**
 * Render the live-post Blog mega panel.
 *
 * @return void
 */
function nytt99_render_blog_panel() {
	$posts = new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 4,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
	?>
	<li class="site-menu__item site-menu__item--mega" data-mega-item>
		<button class="site-menu__trigger" type="button" aria-expanded="false" aria-controls="nytt99-mega-blog" data-mega-trigger>
			<span><?php esc_html_e( 'Blog', 'nolan-young-theme-template-99-master' ); ?></span>
			<svg viewBox="0 0 12 12" aria-hidden="true"><path d="M2 4.25 6 8l4-3.75"/></svg>
		</button>
		<div id="nytt99-mega-blog" class="mega-panel mega-panel--blog" data-mega-panel>
			<div class="mega-panel__context content-wrap">
				<div>
					<strong><?php esc_html_e( 'Journal', 'nolan-young-theme-template-99-master' ); ?></strong>
					<span><?php esc_html_e( 'Strategy, experience, engineering, and operations', 'nolan-young-theme-template-99-master' ); ?></span>
				</div>
				<a href="<?php echo esc_url( nytt99_primary_menu_url( 'blog', '/journal/' ) ); ?>">
					<?php esc_html_e( 'Open the editorial index', 'nolan-young-theme-template-99-master' ); ?>
					<span aria-hidden="true"> ↗</span>
				</a>
			</div>
			<div class="mega-panel__blog content-wrap">
				<header>
					<div>
						<p class="eyebrow"><?php esc_html_e( 'Latest intelligence', 'nolan-young-theme-template-99-master' ); ?></p>
						<h2><?php esc_html_e( 'Ideas for teams building what comes next.', 'nolan-young-theme-template-99-master' ); ?></h2>
					</div>
					<a class="text-link" href="<?php echo esc_url( nytt99_primary_menu_url( 'blog', '/journal/' ) ); ?>">
						<?php esc_html_e( 'View all articles', 'nolan-young-theme-template-99-master' ); ?> <span aria-hidden="true">→</span>
					</a>
				</header>
				<div class="mega-blog-grid">
					<?php if ( $posts->have_posts() ) : ?>
						<?php while ( $posts->have_posts() ) : ?>
							<?php
							$posts->the_post();
							$categories    = get_the_category();
							$category_name = ! empty( $categories ) ? $categories[0]->name : __( 'Perspective', 'nolan-young-theme-template-99-master' );
							$reading_time  = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) );
							$card_number   = sprintf( '%02d', $posts->current_post + 1 );
							?>
							<article class="mega-blog-card">
								<a href="<?php the_permalink(); ?>">
									<span class="mega-blog-card__visual">
										<?php if ( has_post_thumbnail() ) : ?>
											<?php the_post_thumbnail( 'medium' ); ?>
										<?php else : ?>
											<span class="mega-blog-card__pattern" aria-hidden="true"><i></i><i></i><i></i></span>
										<?php endif; ?>
										<span class="mega-blog-card__visual-number" aria-hidden="true"><?php echo esc_html( $card_number ); ?></span>
										<span class="mega-blog-card__visual-label"><?php echo esc_html( $category_name ); ?></span>
									</span>
									<span class="mega-blog-card__meta">
										<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
										<span><?php echo esc_html( sprintf( _n( '%d min read', '%d min read', $reading_time, 'nolan-young-theme-template-99-master' ), $reading_time ) ); ?></span>
									</span>
									<h3><?php the_title(); ?></h3>
									<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
									<span class="text-link">
										<span><?php esc_html_e( 'Read article', 'nolan-young-theme-template-99-master' ); ?></span>
										<span aria-hidden="true">&#8594;</span>
									</span>
								</a>
							</article>
						<?php endwhile; ?>
					<?php else : ?>
						<article class="mega-blog-card mega-blog-card--empty">
							<span class="mega-blog-card__visual" aria-hidden="true">01</span>
							<p class="eyebrow"><?php esc_html_e( 'Journal', 'nolan-young-theme-template-99-master' ); ?></p>
							<h3><?php esc_html_e( 'Publish the first insight to populate this live panel.', 'nolan-young-theme-template-99-master' ); ?></h3>
						</article>
					<?php endif; ?>
				</div>
			</div>
			<div class="mega-panel__utility content-wrap">
				<a href="<?php echo esc_url( home_url( '/?s=strategy' ) ); ?>">
					<span><?php esc_html_e( 'Explore strategy', 'nolan-young-theme-template-99-master' ); ?></span>
					<span aria-hidden="true">→</span>
				</a>
				<a href="<?php echo esc_url( home_url( '/?s=wordpress' ) ); ?>">
					<span><?php esc_html_e( 'Explore WordPress', 'nolan-young-theme-template-99-master' ); ?></span>
					<span aria-hidden="true">→</span>
				</a>
				<a href="<?php echo esc_url( nytt99_page_url( 'contact-us' ) ); ?>">
					<span><?php esc_html_e( 'Turn an idea into a working session', 'nolan-young-theme-template-99-master' ); ?></span>
					<span aria-hidden="true">→</span>
				</a>
			</div>
		</div>
	</li>
	<?php
	wp_reset_postdata();
}

/**
 * Render a complete menu when no primary WordPress menu is assigned.
 *
 * The enhanced mega menu is intentionally separate from this native tree. This
 * fallback guarantees that every destination remains reachable without
 * JavaScript and before an editor assigns a menu.
 *
 * @param array<string, mixed> $args WordPress menu arguments.
 * @return void
 */
function nytt99_primary_menu_fallback( $args = array() ) {
	$menu_class = isset( $args['menu_class'] ) ? (string) $args['menu_class'] : 'site-menu site-menu--native';
	?>
	<ul class="<?php echo esc_attr( $menu_class ); ?>">
		<li class="menu-item menu-item-has-children">
			<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'nolan-young-theme-template-99-master' ); ?></a>
			<ul class="sub-menu">
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/services/#service-1' ) ); ?>"><?php esc_html_e( 'Service 1', 'nolan-young-theme-template-99-master' ); ?></a></li>
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/services/#service-2' ) ); ?>"><?php esc_html_e( 'Service 2', 'nolan-young-theme-template-99-master' ); ?></a></li>
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/services/#service-3' ) ); ?>"><?php esc_html_e( 'Service 3', 'nolan-young-theme-template-99-master' ); ?></a></li>
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/services/#service-4' ) ); ?>"><?php esc_html_e( 'Service 4', 'nolan-young-theme-template-99-master' ); ?></a></li>
			</ul>
		</li>
		<li class="menu-item menu-item-has-children">
			<a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>"><?php esc_html_e( 'About', 'nolan-young-theme-template-99-master' ); ?></a>
			<ul class="sub-menu">
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/about-us/#story' ) ); ?>"><?php esc_html_e( 'About Us', 'nolan-young-theme-template-99-master' ); ?></a></li>
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/about-us/#team' ) ); ?>"><?php esc_html_e( 'Meet the Team', 'nolan-young-theme-template-99-master' ); ?></a></li>
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/about-us/#careers' ) ); ?>"><?php esc_html_e( 'Careers', 'nolan-young-theme-template-99-master' ); ?></a></li>
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/about-us/#future' ) ); ?>"><?php esc_html_e( 'Future Work', 'nolan-young-theme-template-99-master' ); ?></a></li>
			</ul>
		</li>
		<li class="menu-item menu-item-has-children">
			<a href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'Work', 'nolan-young-theme-template-99-master' ); ?></a>
			<ul class="sub-menu">
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/work/#flagship-case' ) ); ?>"><?php esc_html_e( 'Flagship Case', 'nolan-young-theme-template-99-master' ); ?></a></li>
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/work/#project-library' ) ); ?>"><?php esc_html_e( 'Project Library', 'nolan-young-theme-template-99-master' ); ?></a></li>
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/work/#portfolio-results' ) ); ?>"><?php esc_html_e( 'Results', 'nolan-young-theme-template-99-master' ); ?></a></li>
			</ul>
		</li>
		<li class="menu-item menu-item-has-children">
			<a href="<?php echo esc_url( home_url( '/journal/' ) ); ?>"><?php esc_html_e( 'Blog', 'nolan-young-theme-template-99-master' ); ?></a>
			<ul class="sub-menu">
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/journal/' ) ); ?>"><?php esc_html_e( 'Latest articles', 'nolan-young-theme-template-99-master' ); ?></a></li>
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/?s=strategy' ) ); ?>"><?php esc_html_e( 'Strategy', 'nolan-young-theme-template-99-master' ); ?></a></li>
				<li class="menu-item"><a href="<?php echo esc_url( home_url( '/?s=wordpress' ) ); ?>"><?php esc_html_e( 'WordPress', 'nolan-young-theme-template-99-master' ); ?></a></li>
			</ul>
		</li>
	</ul>
	<?php
}

/**
 * Render primary navigation.
 *
 * @return void
 */
function nytt99_primary_navigation() {
	$data = nytt99_mega_menu_data();
	?>
	<nav id="site-navigation" class="site-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'nolan-young-theme-template-99-master' ); ?>">
		<ul class="site-menu site-menu--enhanced">
			<?php nytt99_render_mega_panel( 'services', $data['services'] ); ?>
			<?php nytt99_render_mega_panel( 'about', $data['about'] ); ?>
			<?php nytt99_render_mega_panel( 'work', $data['work'] ); ?>
			<?php nytt99_render_blog_panel(); ?>
		</ul>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'site-menu site-menu--native',
				'depth'          => 2,
				'fallback_cb'    => 'nytt99_primary_menu_fallback',
				'walker'         => new Walker_Nav_Menu(),
			)
		);
		?>
	</nav>
	<div class="mega-overlay" data-mega-overlay aria-hidden="true"></div>
	<?php
}
