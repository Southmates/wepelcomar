<?php

$full_width = $el_width = $el_height = $type = $sep_color = $icon = $icon_position = $border_width = $scroll_top = $link = $css_animation = $animation_delay = $animation_speed = $el_id = $el_class = $align = $inline_css = $desktop_visibility = $medium_visibility = $mobile_visibility = '';

extract(shortcode_atts(array(
	'uncode_shortcode_id' => '',
	'el_width' => '',
	'el_height' => '',
	'type' => '',
	'sep_color' => 'default',
	'sep_color_type' => '',
	'sep_color_solid' => '',
	'icon' => '',
	'icon_position' => 'center',
	'border_width' => '',
	'scroll_top' => '',
	'link' => '',
    'desktop_visibility' => '',
    'medium_visibility' => '',
    'mobile_visibility' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
	'full_width' => '',
	'el_id' => '',
	'el_class' => '',
	'align' => 'align_center',
), $atts));

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$inline_style_css = uncode_get_dynamic_colors_css_from_shortcode( array(
	'type'       => 'vc_separator',
	'id'         => $uncode_shortcode_id,
	'attributes' => array(
		'sep_color'          => $sep_color,
		'sep_color_type'     => $sep_color_type,
		'sep_color_solid'    => $sep_color_solid,
		'sep_color_gradient' => false,
	)
) );

$sep_color = uncode_get_shortcode_color_attribute_value( 'sep_color', $uncode_shortcode_id, $sep_color_type, $sep_color, $sep_color_solid, false );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . $el_class, $this->settings['base'], $atts );
$classes = array();

$div_data = array();
if ($css_animation !== '' && uncode_animations_enabled()) {
	$css_class .= ' ' . $css_animation . ' animate_when_almost_visible';
	if ($animation_delay !== '') {
		$div_data['data-delay'] = $animation_delay;
	}
	if ($animation_speed !== '') {
		$div_data['data-speed'] = $animation_speed;
	}
}

if ( $full_width !== 'yes' ) {
	if ($el_width !== '') {
		$el_width = 'width: ' . $el_width .';';
	}
} else {
	$classes[] = 'full-width-separator';
}
if ($el_height !== '') {
	$el_height = 'border-top-width: ' . $el_height .';';
}
if ($el_width !== '' || $el_height !== '') {
	$inline_css = $el_width . $el_height;
}

if ($type !== '') {
	$classes[] = $type;
}

$link = ( $link == '||' ) ? '' : $link;
$link = vc_build_link( $link );
$a_href = $link['url'];
$a_title = $link['title'];
$a_target = $link['target'];

if ($icon !== '') {
    $classes[] = "divider divider-".$icon_position."-icon";
    $icon_wrapper_class[] = 'divider-icon';
    if ($a_href === '' && $scroll_top !== 'yes') {
    	$icon_wrapper_class[] = 'icon-inactive';
    }

    if ($sep_color === '') {
        $classes[] = 'style-default';
    } else {
        $classes[] = 'border-' . $sep_color . '-color';
        $icon_wrapper_class[] = 'btn-' . $sep_color;
    }
} else {
    if ($sep_color !== '') {
        $classes[] = 'border-' . $sep_color . '-color';
    }
    $classes[] = "separator-no-padding";
}

$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

if ($desktop_visibility === 'yes') {
	$css_class .= ' desktop-hidden';
}
if ($medium_visibility === 'yes') {
	$css_class .= ' tablet-hidden';
}
if ($mobile_visibility === 'yes') {
	$css_class .= ' mobile-hidden';
}

?>
<div class="divider-wrapper<?php echo esc_attr($css_class); ?>" <?php echo implode(' ', $div_data_attributes); ?> <?php echo uncode_switch_stock_string( $el_id ); ?>>
<?php if ($icon === '') : ?>
    <hr class="<?php echo esc_attr(trim(implode(' ' , $classes))); ?>" <?php if ($inline_css !== '') { echo ' style="' . esc_attr($inline_css) .'"'; } ?> />
<?php else : ?>
    <div class="<?php echo esc_attr(trim(implode(' ' , $classes))); ?>"<?php if ($inline_css !== '') { echo ' style="' . esc_attr($inline_css) .'"'; } ?>>
        <?php if ($a_href !== '') { ?>
        <a href="<?php echo esc_url($a_href); ?>" class="custom-link" title="<?php echo esc_attr($a_title); ?>" target="<?php echo esc_attr( trim($a_target) ); ?>">
        <?php } elseif ($scroll_top === 'yes') { ?>
        <a href="#" class="scroll-top">
        <?php } ?>
        <div class="<?php echo esc_attr(implode(' ', $icon_wrapper_class)); ?>">
            <i class="<?php echo esc_attr($icon); ?>"></i>
        </div>
        <?php if ($scroll_top === 'yes' || $a_href !== '') { ?>
        </a>
        <?php } ?>
    </div>
<?php endif; ?>
<?php echo uncode_print_dynamic_inline_style( $inline_style_css ); ?>
</div>
