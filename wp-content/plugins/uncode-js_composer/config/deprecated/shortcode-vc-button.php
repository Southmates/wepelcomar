<?php
/**
 * Configuration file for [vc_button] shortcode of 'Old Button' element.
 *
 * @see https://kb.wpbakery.com/docs/inner-api/vc_map/ for more detailed information about element attributes.
 * @depreacted 4.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$colors_arr = vc_colors_arr();
$size_arr = vc_size_arr();
$icons_arr = vc_icons_arr();
return [
	'name' => esc_html__( 'Old Button', 'js_composer' ) . ' 1',
	'base' => 'vc_button',
	'icon' => 'icon-wpb-ui-button',
	'category' => esc_html__( 'Content', 'js_composer' ),
	'deprecated' => '4.5',
	'content_element' => false,
	'description' => esc_html__( 'Eye catching button', 'js_composer' ),
	'params' => [
		[
			'type' => 'textfield',
			'heading' => esc_html__( 'Text', 'js_composer' ),
			'holder' => 'button',
			'class' => 'wpb_button',
			'param_name' => 'title',
			'value' => esc_html__( 'Text on the button', 'js_composer' ),
			'description' => esc_html__( 'Enter text on the button.', 'js_composer' ),
		],
		[
			'type' => 'href',
			'heading' => esc_html__( 'URL (Link)', 'js_composer' ),
			'param_name' => 'href',
			'description' => esc_html__( 'Enter button link.', 'js_composer' ),
		],
		[
			'type' => 'dropdown',
			'heading' => esc_html__( 'Target', 'js_composer' ),
			'param_name' => 'target',
			'value' => vc_target_param_list(),
			'dependency' => [
				'element' => 'href',
				'not_empty' => true,
				'callback' => 'vc_button_param_target_callback',
			],
		],
		[
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'js_composer' ),
			'param_name' => 'color',
			'value' => $colors_arr,
			'description' => esc_html__( 'Select button color.', 'js_composer' ),
			'param_holder_class' => 'vc_colored-dropdown',
		],
		[
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon',
			'value' => $icons_arr,
			'description' => esc_html__( 'Select icon to display on button.', 'js_composer' ),
		],
		[
			'type' => 'dropdown',
			'heading' => esc_html__( 'Size', 'js_composer' ),
			'param_name' => 'size',
			'value' => $size_arr,
			'description' => esc_html__( 'Select button size.', 'js_composer' ),
		],
		[
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		],
	],
	'js_view' => 'VcButtonView',
];
