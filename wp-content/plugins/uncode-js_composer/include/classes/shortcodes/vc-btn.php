<?php
/**
 * Class that handles specific [vc_btn] shortcode.
 *
 * @see js_composer/include/templates/shortcodes/vc_btn.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Class WPBakeryShortCode_Vc_Btn
 *
 * @since 4.5
 */
class WPBakeryShortCode_Vc_Btn extends WPBakeryShortCode {
	/**
	 * Convert old attributes to new attributes.
	 *
	 * @param array $atts
	 * @return mixed
	 */
	public static function convertAttributesToButton3( $atts ) {
		// size btn1 to size btn2.
		$btn1_sizes = [
			'wpb_regularsize',
			'btn-large',
			'btn-small',
			'btn-mini',
		];
		if ( isset( $atts['size'] ) && in_array( $atts['size'], $btn1_sizes, true ) ) {
			$atts['size'] = str_replace( $btn1_sizes, [
				'md',
				'lg',
				'sm',
				'xs',
			], $atts['size'] );
		}

		// Convert Btn1 href+target attributes to Btn2 `link` attribute.
		if ( ! isset( $atts['link'] ) && isset( $atts['href'] ) && strlen( $atts['href'] ) > 0 ) {
			$link = $atts['href'];
			$target = isset( $atts['target'] ) ? $atts['target'] : '';
			$title = isset( $atts['title'] ) ? $atts['title'] : $link;
			$atts['link'] = 'url:' . rawurlencode( $link ) . '|title:' . $title . ( strlen( $target ) > 0 ? '|target:' . rawurlencode( $target ) : '' );
		}

		if ( ( ! isset( $atts['add_icon'] ) || 'true' !== $atts['add_icon'] ) && isset( $atts['icon'] ) && strlen( $atts['icon'] ) > 0 && 'none' !== $atts['icon'] ) {
			// old icon from btn1 is set, let's convert it to new btn.
			$atts['add_icon'] = 'true';
			$atts['icon_type'] = 'pixelicons';
			$atts['icon_align'] = 'right';
			$atts['icon_pixelicons'] = 'vc_pixel_icon vc_pixel_icon-' . str_replace( 'wpb_', '', $atts['icon'] );
		}
		$haystack = [
			'rounded',
			'square',
			'round',
			'outlined',
			'square_outlined',
		];
		if ( isset( $atts['style'] ) && in_array( $atts['style'], $haystack, true ) ) {
			switch ( $atts['style'] ) {
				case 'rounded':
					$atts['style'] = 'flat';
					$atts['shape'] = 'rounded';
					break;
				case 'square':
					$atts['style'] = 'flat';
					$atts['shape'] = 'square';
					break;
				case 'round':
					$atts['style'] = 'flat';
					$atts['shape'] = 'round';
					break;
				case 'outlined':
					$atts['style'] = 'outline';
					break;
				case 'square_outlined':
					$atts['style'] = 'outline';
					$atts['shape'] = 'square';
					break;
			}
		}

		return $atts;
	}

	/**
	 * Title html output.
	 *
	 * @param string $title
	 *
	 * @return string
	 * @since 4.5
	 */
	protected function outputTitle( $title ) {
		$icon = $this->settings( 'icon' );

		return '<h4 class="wpb_element_title"><span class="vc_general vc_element-icon vc_btn3-icon' . ( ! empty( $icon ) ? ' ' . $icon : '' ) . '"></span></h4>';
	}
}
