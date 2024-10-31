<?php
if(!class_exists('MwbBasicframeworkAdminSettings')){
	 class MwbBasicframeworkAdminSettings{
	 	
	 	protected $loader;
	 	
	 	public function __construct(){
	 		
	 		self::loadDependencies();
	 	}
	 	
	 	public function loadDependencies(){
	 		add_menu_page('mwb_qr_code_generator', __('MWB Qr Code Settings','qrcode_generator'), 'manage_options', 'mwb_qr_code_generator',array($this,'mwb_plugi_name_settings'));
	 	}
	 	
	 	public function mwb_plugi_name_settings(){
	 		require_once MWB_ADMIN_PATH.'partials/qr_code_generator-admin-display.php';
	 	}
	 	
	 }
}
new MwbBasicframeworkAdminSettings;