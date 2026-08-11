<?php $mnyphoto_search_id = wp_unique_id( 'mnyphoto-search-' ); ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $mnyphoto_search_id ); ?>"><?php esc_html_e( 'Search', 'mnyphoto-theme' ); ?></label>
	<div><input type="search" id="<?php echo esc_attr( $mnyphoto_search_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search stories…', 'placeholder', 'mnyphoto-theme' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s"><button type="submit"><?php esc_html_e( 'Search', 'mnyphoto-theme' ); ?></button></div>
</form>
