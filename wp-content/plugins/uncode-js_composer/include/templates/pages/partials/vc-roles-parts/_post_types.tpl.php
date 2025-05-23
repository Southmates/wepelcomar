<?php
/**
 * Post types part template.
 *
 * @var string $part
 * @var string $role
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
vc_include_template( 'pages/partials/vc-roles-parts/_part.tpl.php', [
	'part' => $part,
	'role' => $role,
	'params_prefix' => 'vc_roles[' . $role . '][' . $part . ']',
	'controller' => vc_role_access()->who( $role )->part( $part ),
	'custom_value' => 'custom',

	'capabilities' => $vc_role->getPostTypes(),
	'options' => [
		[ true, esc_html__( 'Pages only', 'js_composer' ) ],
		[ 'custom', esc_html__( 'Custom', 'js_composer' ) ],
		[ false, esc_html__( 'Disabled', 'js_composer' ) ],
	],
	'main_label' => esc_html__( 'Post types', 'js_composer' ),
	'custom_label' => esc_html__( 'Post types', 'js_composer' ),
	'description' => esc_html__( 'Enable WPBakery Page Builder for pages, posts and custom post types. Note: By default WPBakery Page Builder is available for pages only.', 'js_composer' ),
] );
