<?php
/**
 * The template for displaying [vc_googleplus] shortcode output of 'Google+ Button' element.
 *
 * This template can be overridden by copying it to yourtheme/vc_templates/vc_googleplus.php
 *
 * @see https://kb.wpbakery.com/docs/developers-how-tos/change-shortcodes-html-output
 *
 * @depecated
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $type
 * @var $el_class
 * @var $el_id
 * @var $annotation
 * @var $widget_width
 * @var $css
 * @var $css_animation
 * Shortcode class
 * @var WPBakeryShortCode_Vc_GooglePlus $this
 */
$type = $annotation = $widget_width = $css = $el_class = $el_id = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( empty( $annotation ) ) {
	$annotation = 'bubble';
}
$params = '';
$params .= ( '' !== $type ) ? ' size="' . esc_attr( $type ) . '"' : '';
$params .= ( '' !== $annotation ) ? ' annotation="' . esc_attr( $annotation ) . '"' : '';

if ( empty( $type ) ) {
	$type = 'standard';
}
if ( 'inline' === $annotation && strlen( $widget_width ) > 0 ) {
	$params .= ' width="' . (int) $widget_width . '"';
}

$class_to_filter = 'wpb_googleplus wpb_content_element wpb_googleplus_type_' . $type . ' vc_googleplus-annotation-' . $annotation . $this->getCSSAnimation( $css_animation ) . $this->getExtraClass( $el_class );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$wrapper_attributes = [];
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output = '<div class="' . esc_attr( $css_class ) . '" ' . implode( ' ', $wrapper_attributes ) . '><g:plusone' . $params . '></g:plusone></div>';

return $output;
