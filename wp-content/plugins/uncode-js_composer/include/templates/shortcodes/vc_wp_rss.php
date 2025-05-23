<?php
/**
 * The template for displaying [vc_wp_rss] shortcode output of 'WP RSS' element.
 *
 * This template can be overridden by copying it to yourtheme/vc_templates/vc_wp_rss.php.
 *
 * @see https://kb.wpbakery.com/docs/developers-how-tos/change-shortcodes-html-output
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $title
 * @var $url
 * @var $items
 * @var $options
 * @var $el_class
 * @var $el_id
 * Shortcode class
 * @var WPBakeryShortCode_Vc_Wp_Rss $this
 */
$title = $url = $items = $options = $el_class = $el_id = '';

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts['url'] = html_entity_decode( $atts['url'], ENT_QUOTES ); // fix #2034.
extract( $atts );

if ( '' === $url ) {
	return;
}

$options = explode( ',', $options );
if ( in_array( 'show_summary', $options, true ) ) {
	$atts['show_summary'] = true;
}
if ( in_array( 'show_author', $options, true ) ) {
	$atts['show_author'] = true;
}
if ( in_array( 'show_date', $options, true ) ) {
	$atts['show_date'] = true;
}

$el_class = $this->getExtraClass( $el_class );
$wrapper_attributes = [];
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output = '<div ' . implode( ' ', $wrapper_attributes ) . ' class="vc_wp_rss wpb_content_element' . esc_attr( $el_class ) . '">';
$type = 'WP_Widget_RSS';
$args = [];
global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget.
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();

	$output .= '</div>';

	return $output;
}
