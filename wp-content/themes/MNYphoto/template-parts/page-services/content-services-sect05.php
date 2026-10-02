<?php
/** Photography category 5. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$categories = mnyphoto_categories();
get_template_part( 'template-parts/page-services/content', 'services-category', array( 'category' => $categories[4], 'index' => 4 ) );
