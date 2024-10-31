<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://makewebbetter.com/
 * @since             1.0.0
 * @package           pc-to-mobile-via-qr -code
 *
 * @wordpress-plugin
 * Plugin Name:       pc to mobile via qr code
 * Plugin URI:        makewebbetter.com/pc-to-mobile-via-qr-code
 * Description:       This is a bridge between Desktop and Mobile. You can share page's link to others through QR Code.
 * Version:           2.0.1
 * Author:            makewebbetter
 * Author Email:      webmaster@makewebbetter.com
 * Author URI:        http://makewebbetter.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       qrcode_generator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-qr_and_barcode_generator-activator.php
 */
function activate_qrcode_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-qr_code_generator-activator.php';
	qrcode_generator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-qr_and_barcode_generator-deactivator.php
 */
function deactivate_qrcode_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-qr_code_generator-deactivator.php';
	qrcode_generator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_qrcode_generator' );
register_deactivation_hook( __FILE__, 'deactivate_qrcode_generator' );

/**
 * Add settings link on plugin page
 * @name mwb_qbg_admin_settings()
 * @author makewebbetter<webmaster@makewebbetter.com>
 * @link http://www.makewebbetter.com/
 */
function mwb_qbg_admin_settings($actions, $plugin_file) {
	static $plugin;
	if (! isset ( $plugin )) {

		$plugin = plugin_basename ( __FILE__ );
	}
	if ($plugin == $plugin_file) {
		$settings = array (
				'settings' => '<a href="' . home_url ( '/wp-admin/admin.php?page=mwb_qr_code_generator' ) . '">' . __ ( 'Settings', 'qr_and_barcode_generator' ) . '</a>',
		);
		$actions = array_merge ( $settings, $actions );
	}
	return $actions;
}

// Discontinue notice.
add_action( 'after_plugin_row_' . plugin_basename( __FILE__ ), 'mwb_qcg_add_discontinue_notice', 0, 3 );

/**
 * Begins execution of the plugin.
 *
 * @param mixed $plugin_file The plugin file name.
 * @param mixed $plugin_data The plugin file data.
 * @param mixed $status      The plugin file status.
 * @since 1.0.0
 */
function mwb_qcg_add_discontinue_notice( $plugin_file, $plugin_data, $status ) {
	include_once plugin_dir_path( __FILE__ ) . 'extra-templates/makewebetter-plugin-discontinue-notice.html';
}


//add link for settings
add_filter ( 'plugin_action_links','mwb_qbg_admin_settings', 10, 5 );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-qr_code_generator.php';
require plugin_dir_path( __FILE__ ) . 'Qrcode/qrlib.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-qr_code_widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_qrcode_generator() {

	$plugin = new qrcode_generator();
	$plugin->run();

	define('MWB_QBG_DIRPATH', plugin_dir_path( __FILE__ ));
	define('MWB_QBG_URL', plugin_dir_url( __FILE__ ));
	define('MWB_QBG_HOME_URL', home_url());

}

run_qrcode_generator();
