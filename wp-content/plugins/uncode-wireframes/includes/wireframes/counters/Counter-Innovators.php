<?php
/**
 * name             - Wireframe title
 * cat_name         - Comma separated list for multiple categories (cat display name)
 * custom_class     - Space separated list for multiple categories (cat ID)
 * dependency       - Array of dependencies
 * is_content_block - (optional) Best in a content block
 *
 * @version  1.0.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$wireframe_categories = UNCDWF_Dynamic::get_wireframe_categories();
$data                 = array();

// Wireframe properties

$data[ 'name' ]             = esc_html__( 'Counter Innovators', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'counters' ];
$data[ 'custom_class' ]     = 'counters';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'counters/Counter-Innovators.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_section back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" content_parallax="0" uncode_shortcode_id="149433" back_color_type="uncode-palette"][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" content_parallax="0" uncode_shortcode_id="767575" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="197315"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="9/12" uncode_shortcode_id="352205"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="386333"]Medium headline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="967487" text_color_type="uncode-solid" text_color_solid="rgba(255,255,255,0.5)" heading_custom_size="clamp(24px,5vw,50px)"]Change the color to match your brand[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="3/12" uncode_shortcode_id="109638"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="2" medium_visibility="yes" mobile_visibility="yes"][vc_separator sep_color="" uncode_shortcode_id="132615"][vc_empty_space empty_h="2" medium_visibility="yes" mobile_visibility="yes"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="5" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="202552"][vc_column_inner column_width_percent="100" position_horizontal="left" position_vertical="bottom" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/2" uncode_shortcode_id="103498"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="101060"]✳︎ Long headline on two lines to turn your visitors into users[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_horizontal="left" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="108292"][uncode_counter value="500" prefix="$" counter_color="" size="custom" height="fontheight-179065" uncode_shortcode_id="129066" suffix="+" heading_custom_size="clamp(75px,8vw,125px)"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" uncode_shortcode_id="352234"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_empty_space empty_h="2"][vc_separator sep_color=",Default"][uncode_counter value="20" counter_color="" size="custom" height="fontheight-179065" uncode_shortcode_id="147059" suffix="+" heading_custom_size="clamp(75px,8vw,125px)"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" uncode_shortcode_id="917114"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][/vc_section]
';

// Check if this wireframe is for a content block
if ( $data[ 'is_content_block' ] && ! $is_content_block ) {
	$data[ 'custom_class' ] .= ' for-content-blocks';
}

// Check if this wireframe requires a plugin
foreach ( $data[ 'dependency' ]  as $dependency ) {
	if ( ! UNCDWF_Dynamic::has_dependency( $dependency ) ) {
		$data[ 'custom_class' ] .= ' has-dependency needs-' . $dependency;
	}
}

vc_add_default_templates( $data );
