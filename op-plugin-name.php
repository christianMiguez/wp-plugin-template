<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/orgs/onpointglobal
 * @since             1.0.0
 * @package           Op_Image_Helper
 *
 * @wordpress-plugin
 * Plugin Name:       op-plugin-name
 * Plugin URI:        op-plugin-name
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Onpoint
 * Author URI:        https://github.com/orgs/onpointglobal
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:      op-plugin-name
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'OP_PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The core plugin class that is used to define cdn-specific hooks.,
 */
require plugin_dir_path( __FILE__ ) . 'includes/op-plugin-name-example.php';

/**
 * Define a custom ACF JSON save point
 *
 * @param string $paths original URL.
 */
function op_plugin_name_acf_json_save_point( $paths ) {
	$env = getenv( 'DEV_ACF_SAVE_POINT' );
	if ( 'development' === $env ) {
		$paths = plugin_dir_path( __FILE__ ) . 'acf-json';
	}
	return $paths;
}
add_filter( 'acf/settings/save_json', 'op_plugin_name_acf_json_save_point' );

/**
 * Define a custom ACF JSON load point
 *
 * @param string $paths original URL.
 */
function op_plugin_name_acf_json_load_point( $paths ) {
	$paths[] = plugin_dir_path( __FILE__ ) . 'acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'op_plugin_name_acf_json_load_point' );
/**
 * Register options settings
 */
function op_plugin_name_settings_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		if ( 1 === get_current_blog_id() ) {
			return;
		} else {
			$option_page = acf_add_options_page(
				array(
					'page_title' => __( 'OP Plugin Name Settings' ),
					'menu_title' => __( 'OP Plugin Name' ),
					'menu_slug'  => 'op-plugin-name',
					'capability' => 'edit_posts',
					'redirect'   => false,
					'icon_url'   => 'dashicons-format-generic',
				)
			);
		}
	}
}
add_action( 'acf/init', 'op_plugin_name_settings_page' );
