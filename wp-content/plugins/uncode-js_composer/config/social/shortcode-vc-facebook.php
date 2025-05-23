<?php
/**
 * Configuration file for [vc_facebook] shortcode of 'Facebook Like' element.
 *
 * @see https://kb.wpbakery.com/docs/inner-api/vc_map/ for more detailed information about element attributes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return [
	'name' => esc_html__( 'Facebook Like', 'js_composer' ),
	'base' => 'vc_facebook',
	'icon' => 'icon-wpb-balloon-facebook-left',
	'element_default_class' => 'wpb_content_element',
	'category' => esc_html__( 'Social', 'js_composer' ),
	'description' => esc_html__( 'Facebook "Like" button', 'js_composer' ),
	'params' => [
		[
			'type' => 'dropdown',
			'heading' => esc_html__( 'Button type', 'js_composer' ),
			'param_name' => 'type',
			'admin_label' => true,
			'value' => [
				esc_html__( 'Horizontal', 'js_composer' ) => 'standard',
				esc_html__( 'Horizontal with count', 'js_composer' ) => 'button_count',
				esc_html__( 'Vertical with count', 'js_composer' ) => 'box_count',
			],
			'description' => esc_html__( 'Select button type.', 'js_composer' ),
		],
		vc_map_add_css_animation(),
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
		[
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'js_composer' ),
			'value' => [
				'margin-bottom' => '35px',
			],
		],
	],
];
