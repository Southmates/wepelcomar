<?php
/**
 * Configuration file for [vc_wp_posts] shortcode of 'WP Recent Posts' element.
 *
 * @see https://kb.wpbakery.com/docs/inner-api/vc_map/ for more detailed information about element attributes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return [
	'name' => 'WP ' . esc_html__( 'Recent Posts' ),
	'base' => 'vc_wp_posts',
	'icon' => 'icon-wpb-wp',
	'category' => esc_html__( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__( 'The most recent posts on your site', 'js_composer' ),
	'params' => [
		[
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' ),
			'value' => esc_html__( 'Recent Posts' ),
		],
		[
			'type' => 'textfield',
			'heading' => esc_html__( 'Number of posts', 'js_composer' ),
			'description' => esc_html__( 'Enter number of posts to display.', 'js_composer' ),
			'param_name' => 'number',
			'value' => 5,
			'admin_label' => true,
		],
		[
			'type' => 'checkbox',
			'heading' => esc_html__( 'Display post date?', 'js_composer' ),
			'param_name' => 'show_date',
			'value' => [ esc_html__( 'Yes', 'js_composer' ) => true ],
			'description' => esc_html__( 'If checked, date will be displayed.', 'js_composer' ),
		],
		[
			'type' => 'el_id',
			'heading' => esc_html__( 'Element ID', 'js_composer' ),
			'param_name' => 'el_id',
			'description' => sprintf( esc_html__( 'Enter element ID (Note: make sure it is unique and valid according to %1$sw3c specification%2$s).', 'js_composer' ), '<a href="https://www.w3schools.com/tags/att_global_id.asp" target="_blank">', '</a>' ),
		],
		[
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		],
	],
];
