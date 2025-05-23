<?php
/**
 * Backward compatibility with "Advanced custom fields" WordPress plugin.
 *
 * @see https://wordpress.org/plugins/advanced-custom-fields/
 *
 * @since 4.4 vendors initialization moved to hooks in autoload/vendors.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

add_action( 'acf/init', 'vc_init_vendor_acf' ); // pro version.
add_action( 'acf/register_fields', 'vc_init_vendor_acf' ); // free version.
add_action( 'plugins_loaded', 'vc_init_vendor_acf' );
add_action( 'after_setup_theme', 'vc_init_vendor_acf' ); // for themes.
/**
 * Initialize ACF vendor.
 */
function vc_init_vendor_acf() {
	if ( did_action( 'vc-vendor-acf-load' ) ) {
		return;
	}
	include_once ABSPATH . 'wp-admin/includes/plugin.php'; // Require class-vc-wxr-parser-plugin.php to use is_plugin_active() below.
	if ( class_exists( 'acf' ) || is_plugin_active( 'advanced-custom-fields/acf.php' ) || is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
		require_once vc_path_dir( 'VENDORS_DIR', 'plugins/class-vc-vendor-advanced-custom-fields.php' );
		$vendor = new Vc_Vendor_AdvancedCustomFields();
		add_action( 'vc_after_set_mode', [
			$vendor,
			'load',
		] );
	}
}
