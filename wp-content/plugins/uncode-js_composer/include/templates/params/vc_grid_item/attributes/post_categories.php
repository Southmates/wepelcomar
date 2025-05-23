<?php
/**
 * Post categories shortcode grid builder template.
 *
 * @var WPBakeryShortCode_Vc_Gitem_Post_Categories $vc_btn
 * @var WP_Post $post
 * @var $atts
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_Vc_Gitem_Post_Categories' );

$categories = get_the_category();

$separator = '';
$css_class = [ 'vc_gitem-post-data' ];
$css_class[] = vc_shortcode_custom_css_class( $atts['css'] );
$css_class[] = $atts['el_class'];
$css_class[] = 'vc_gitem-post-data-source-post_categories';
$css_class[] = 'vc_grid-filter vc_clearfix';
$css_class[] = 'vc_grid-filter vc_clearfix';
$style = trim( str_replace( ',', 'comma', $atts['category_style'] ) );
$css_class[] = 'vc_grid-filter-' . esc_attr( $style );
$css_class[] = 'vc_grid-filter-size-' . esc_attr( $atts['category_size'] );
$css_class[] = 'vc_grid-filter-' . esc_attr( $atts['alignment'] );
$css_class[] = 'vc_grid-filter-' . esc_attr( $atts['alignment'] );
if ( ! empty( $style ) && 'none' !== $style ) {
	$css_class[] = 'vc_grid-filter-color-' . esc_attr( $atts['category_color'] );
}

$output = '<div class="' . esc_attr( implode( ' ', array_filter( $css_class ) ) ) . '">';
$data = [];
if ( ! empty( $categories ) ) {
	foreach ( $categories as $category ) {
		$category_link = '';
		if ( ! empty( $atts['link'] ) ) {
			$category_link = 'href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . sprintf( esc_attr__( 'View all posts in %s', 'js_composer' ), $category->name ) . '"';
		}

		$wrapper = '<div class="vc_grid-filter-item vc_gitem-post-category-name">';
		$content = esc_html( $category->name );
		if ( ! empty( $category_link ) ) {
			$content = '<span class="vc_gitem-post-category-name"><a ' . $category_link . ' class="vc_gitem-link">' . $content . '</a></span>';
		} else {
			$content = '<span class="vc_gitem-post-category-name">' . $content . '</span>';
		}
		$wrapper_end = '</div>';
		$data[] = $wrapper . $content . $wrapper_end;
	}
}
if ( empty( $atts['category_style'] ) || ' ' === $atts['category_style'] || ', ' === $atts['category_style'] ) {
	$separator = $atts['category_style'];
}
$output .= implode( $separator, $data );
$output .= '</div>';

return $output;
