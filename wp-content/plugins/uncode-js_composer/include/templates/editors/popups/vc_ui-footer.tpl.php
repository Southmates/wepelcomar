<?php
/**
 * UI Footer template.
 *
 * @var array $controls
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<div class="vc_ui-panel-footer-container" data-vc-ui-element="panel-footer">
	<div class="vc_ui-panel-footer">
		<div class="vc_ui-button-group">
			<?php foreach ( $controls as $control ) : ?>
				<?php
				extract( shortcode_atts( [
					'name' => '',
					'label' => '',
					'css_classes' => '',
					'style' => 'default',
					'data_change_status' => '',
					'id' => '',
					'link' => '',
				], (array) $control ) );
				?>
				<span
					class="vc_general vc_ui-button vc_ui-button-<?php echo esc_attr( $style ); ?> vc_ui-button-shape-<?php echo isset( $shape ) ? esc_attr( $shape ) : 'rounded'; ?><?php echo strlen( $css_classes ) > 0 ? ' ' . esc_attr( $css_classes ) : ''; ?>"
					data-vc-ui-element="button-<?php echo esc_attr( $name ); ?>"
					<?php echo ! empty( $data_change_status ) ? 'data-change-status="' . esc_attr( $data_change_status ) . '"' : ''; ?>
					<?php echo ! empty( $id ) ? 'id="' . esc_attr( $id ) . '"' : ''; ?>
					<?php echo ! empty( $link ) ? 'data-button-link="' . esc_url( $link ) . '"' : ''; ?>
					<?php echo 'Insert' === $label ? 'style="display: none;"' : ''; ?>>
					<?php echo esc_html( $label ); ?>
				</span>
			<?php endforeach ?>
		</div>
	</div>
</div>
