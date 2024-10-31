<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    pc-to-mobile-via-qr -code
 * @subpackage pc-to-mobile-via-qr -code/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    pc-to-mobile-via-qr -code
 * @subpackage pc-to-mobile-via-qr -code/includes
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class qrcode_generator_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'qrcode_generator',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
