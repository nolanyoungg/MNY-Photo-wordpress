<?php
/** Photography category 1. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$categories = mnyphoto_categories();
get_template_part( 'template-parts/page-services/content', 'services-category', array( 'category' => $categories[0], 'index' => 0 ) );
