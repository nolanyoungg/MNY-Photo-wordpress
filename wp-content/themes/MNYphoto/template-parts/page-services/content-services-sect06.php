<?php
/** Photography category 6. @package MNYphoto */
defined( 'ABSPATH' ) || exit;
$categories = mnyphoto_categories();
get_template_part( 'template-parts/page-services/content', 'services-category', array( 'category' => $categories[5], 'index' => 5 ) );
