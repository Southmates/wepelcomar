<?php
/**
 * The template for displaying [vc_pinterest] shortcode output of 'Pinterest' element.
 *
 * This template can be overridden by copying it to yourtheme/vc_templates/vc_pinterest.php.
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
 * @var $type
 * @var $annotation // TODO: check why annotation doesn't set before
 * @var $css
 * @var $css_animation
 * @var $el_class
 * @var $el_id
 * Shortcode class
 * @var WPBakeryShortCode_Vc_Pinterest $this
 */
$type = $annotation = $css = $el_class = $el_id = $css_animation = '';
global $post;
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$url = rawurlencode( get_permalink() );
if ( has_post_thumbnail() ) {
	$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
	$media = ( is_array( $img_url ) ) ? '&amp;media=' . rawurlencode( $img_url[0] ) : '';
} else {
	$media = '';
}
$excerpt = is_object( $post ) && isset( $post->post_excerpt ) ? $post->post_excerpt : '';
$description = ( '' !== $excerpt ) ? '&amp;description=' . rawurlencode( wp_strip_all_tags( $excerpt ) ) : '';

$el_class = isset( $el_class ) ? $el_class : '';
$element_class = empty( $this->settings['element_default_class'] ) ? '' : $this->settings['element_default_class'];
$class_to_filter = 'wpb_pinterest wpb_content_element wpb_pinterest_type_' . $type;
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . ' ' . esc_attr( $element_class ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$wrapper_attributes = [];
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output .= '<div class="' . esc_attr( $css_class ) . '" ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<a href="https://pinterest.com/pin/create/button/?url=' . $url . $media . $description . '" class="pin-it-button" count-layout="' . esc_attr( $type ) . '"><img border="0" src="https://assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';
$output .= '</div>';

return $output;
