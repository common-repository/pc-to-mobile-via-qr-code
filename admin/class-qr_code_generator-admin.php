<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    qrcode_generator
 * @subpackage qrcode_generator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    qrcode_generator
 * @subpackage qrcode_generator/admin
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class qrcode_generator_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $qrcode_generator    The ID of this plugin.
	 */
	private $qrcode_generator;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $qrcode_generator       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $qrcode_generator, $version ) {

		$this->qrcode_generator = $qrcode_generator;
		$this->version = $version;
		
		if(!defined('MWB_ADMIN_PATH')){
			define('MWB_ADMIN_PATH', plugin_dir_path( __FILE__ ));
		}

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in qrcode_generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The qrcode_generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$screen = get_current_screen();
			
		if(isset($screen->id))
		{
			$pagescreen = $screen->id;
			if($pagescreen == 'toplevel_page_mwb_qr_code_generator')
			{
				wp_enqueue_style( 'mwb_qbg_select_two', plugin_dir_url( __FILE__ ) . 'css/mwb_qbg_select_two.css', array(), $this->version, 'all' );
			}
		}
		wp_enqueue_style( $this->qrcode_generator, plugin_dir_url( __FILE__ ) . 'css/qr_code_generator-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in qrcode_generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The qrcode_generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$screen = get_current_screen();
		if(isset($screen->id))
		{
			$pagescreen = $screen->id;
			if($pagescreen == 'toplevel_page_mwb_qr_code_generator')
			{	
		        wp_enqueue_script('mwb_qbg_select_two', plugin_dir_url( __FILE__ ) . 'js/mwb_qbg_select_two.js', array( 'jquery' ), $this->version, false );
		    }
		}

		wp_enqueue_script( $this->qrcode_generator, plugin_dir_url( __FILE__ ) . 'js/qr_code_generator-admin.js', array( 'jquery' ), $this->version, false );


	}
	
	/**
	 * Register the menu and submenus for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function admin_menus(){
		require_once 'settings/class-qr_code_generator-settings.php';
	}

}
