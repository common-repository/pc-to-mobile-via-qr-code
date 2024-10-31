<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    pc-to-mobile-via-qr -code
 * @subpackage pc-to-mobile-via-qr -code/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    pc-to-mobile-via-qr -code
 * @subpackage pc-to-mobile-via-qr -code/public
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class qrcode_generator_Public {

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
	 * @param      string    $qrcode_generator       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $qrcode_generator, $version ) {

		$this->qrcode_generator = $qrcode_generator;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->qrcode_generator, plugin_dir_url( __FILE__ ) . 'css/qr_code_generator-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		$mwb_qbg_setting_data = get_option('mwb_qbg_setting_data',array());
		$height = $mwb_qbg_setting_data['mwb_qbg_height'];
		if($height == '')
		{
			$height = 'auto';
		}
		$width = $mwb_qbg_setting_data['mwb_qbg_width'];
		if($width == '')
		{
			$width = 'auto';
		}
		wp_register_script( $this->qrcode_generator, plugin_dir_url( __FILE__ ) . 'js/qr_code_generator-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script($this->qrcode_generator, 'qbg_ajax',array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'page_id' => get_the_ID(),
			'mwb_qbg_above_text' => $mwb_qbg_setting_data['mwb_qbg_above_text'],
			'mwb_qbg_bellow_text' => $mwb_qbg_setting_data['mwb_qbg_bellow_text'],
			'height' => $height,
			'width' => $width,
			));
		wp_enqueue_script($this->qrcode_generator );


	}

	/**
	 * Creating div for showing qr code through the content hook.
	 *
	 * @name mwb_qbg_content_page_link_generator
	 * @author makewebbetter<webmaster@makewebbetter.com>
	 * @link http://www.makewebbetter.com/
	 */ 
	public function mwb_qbg_content_page_link_generator($content)
	{	
		$page_id = get_the_ID();

		$mwb_qbg_setting_data = get_option('mwb_qbg_setting_data',array());
		$mwb_qbg_exclude_category = isset($mwb_qbg_setting_data['mwb_qbg_exclude_category'])?$mwb_qbg_setting_data['mwb_qbg_exclude_category'] : array();
		$mwb_qbg_exclude_product_category = isset($mwb_qbg_setting_data['mwb_qbg_exclude_product_category'])?$mwb_qbg_setting_data['mwb_qbg_exclude_product_category'] : array();
		if(isset($mwb_qbg_setting_data['mwb_qbg_enable']) && $mwb_qbg_setting_data['mwb_qbg_enable'] == 'on')
		{
			$mwb_qbg_post_type = get_post_type($page_id);
			if( $mwb_qbg_post_type == 'post')
			{
				if(isset($mwb_qbg_setting_data['mwb_qbg_display_post']) && $mwb_qbg_setting_data['mwb_qbg_display_post'] == 'on')
				{
					$mwb_qbg_post_category = get_the_category();
					$mwb_qbg_product_category = get_the_terms( get_the_ID(), 'product_cat' );
						// print_r($mwb_qbg_product_category);die;
					if(!in_array($mwb_qbg_post_category[0]->term_id,$mwb_qbg_exclude_category))
					{ 
						if(isset($mwb_qbg_setting_data['mwb_qbg_display_before_content']) && $mwb_qbg_setting_data['mwb_qbg_display_before_content'] == 'on' && isset($mwb_qbg_setting_data['mwb_qbg_display_after_content']) && $mwb_qbg_setting_data['mwb_qbg_display_after_content'])
						{
							if(isset($mwb_qbg_setting_data['mwb_qbg_before_content_position']) && $mwb_qbg_setting_data['mwb_qbg_before_content_position'] == 'left')
							{
								$mwb_qbg_before_content_div = '<div style="text-align:left; with:100%" class="mwb_qbg_image_wrp" ></div>';
							}
							else
							{
								$mwb_qbg_before_content_div = '<div style="text-align:right; with:100%" class="mwb_qbg_image_wrp" ></div>';
							}
							if(isset($mwb_qbg_setting_data['mwb_qbg_after_content_position']) && $mwb_qbg_setting_data['mwb_qbg_after_content_position'] == 'left')
							{
								$mwb_qbg_after_content_div = '<div style="text-align:left; with:100%" class="mwb_qbg_image_wrp" ></div>';
							}
							else
							{
								$mwb_qbg_after_content_div = '<div style="text-align:right; with:100%" class="mwb_qbg_image_wrp" ></div>';
							}
							return $mwb_qbg_before_content_div.$content.$mwb_qbg_after_content_div;	
						}
						elseif (isset($mwb_qbg_setting_data['mwb_qbg_display_before_content']) && $mwb_qbg_setting_data['mwb_qbg_display_before_content'] == 'on')
						{
							if(isset($mwb_qbg_setting_data['mwb_qbg_before_content_position']) && $mwb_qbg_setting_data['mwb_qbg_before_content_position'] == 'left')
							{
								return '<div style="text-align:left; with:100%" class="mwb_qbg_image_wrp" ></div>'.$content;
							}
							else
							{
								return '<div style="text-align:right; with:100%" class="mwb_qbg_image_wrp" ></div>'.$content;
							}	
						}
						elseif (isset($mwb_qbg_setting_data['mwb_qbg_display_after_content']) && $mwb_qbg_setting_data['mwb_qbg_display_after_content'] == 'on') 
						{	
							if(isset($mwb_qbg_setting_data['mwb_qbg_after_content_position']) && $mwb_qbg_setting_data['mwb_qbg_after_content_position'] == 'left')
							{
								return $content.'<div style="text-align:left; with:100%" class="mwb_qbg_image_wrp" ></div>';
							}
							else
							{
								return $content.'<div style="text-align:right; with:100%" class="mwb_qbg_image_wrp" ></div>';
							}	
						}
					}
				}
			}	
			if( $mwb_qbg_post_type == 'product')
			{
				if(isset($mwb_qbg_setting_data['mwb_qbg_display_product']) && $mwb_qbg_setting_data['mwb_qbg_display_product'] == 'on')
				{
					$mwb_qbg_product_category = get_the_terms( get_the_ID(), 'product_cat' );
					if(!in_array($mwb_qbg_product_category[0]->term_id,$mwb_qbg_exclude_product_category))
					{ 
						if(isset($mwb_qbg_setting_data['mwb_qbg_display_before_content']) && $mwb_qbg_setting_data['mwb_qbg_display_before_content'] == 'on' && isset($mwb_qbg_setting_data['mwb_qbg_display_after_content']) && $mwb_qbg_setting_data['mwb_qbg_display_after_content'])
						{
							if(isset($mwb_qbg_setting_data['mwb_qbg_before_content_position']) && $mwb_qbg_setting_data['mwb_qbg_before_content_position'] == 'left')
							{
								$mwb_qbg_before_content_div = '<div style="text-align:left; with:100%" class="mwb_qbg_image_wrp" ></div>';
							}
							else
							{
								$mwb_qbg_before_content_div = '<div style="text-align:right; with:100%" class="mwb_qbg_image_wrp" ></div>';
							}
							if(isset($mwb_qbg_setting_data['mwb_qbg_after_content_position']) && $mwb_qbg_setting_data['mwb_qbg_after_content_position'] == 'left')
							{
								$mwb_qbg_after_content_div = '<div style="text-align:left; with:100%" class="mwb_qbg_image_wrp" ></div>';
							}
							else
							{
								$mwb_qbg_after_content_div = '<div style="text-align:right; with:100%" class="mwb_qbg_image_wrp" ></div>';
							}
							return $mwb_qbg_before_content_div.$content.$mwb_qbg_after_content_div;	
						}
						elseif (isset($mwb_qbg_setting_data['mwb_qbg_display_before_content']) && $mwb_qbg_setting_data['mwb_qbg_display_before_content'] == 'on')
						{
							if(isset($mwb_qbg_setting_data['mwb_qbg_before_content_position']) && $mwb_qbg_setting_data['mwb_qbg_before_content_position'] == 'left')
							{
								return '<div style="text-align:left; with:100%" class="mwb_qbg_image_wrp" ></div>'.$content;
							}
							else
							{
								return '<div style="text-align:right; with:100%" class="mwb_qbg_image_wrp" ></div>'.$content;
							}	
						}
						elseif (isset($mwb_qbg_setting_data['mwb_qbg_display_after_content']) && $mwb_qbg_setting_data['mwb_qbg_display_after_content'] == 'on') 
						{	
							if(isset($mwb_qbg_setting_data['mwb_qbg_after_content_position']) && $mwb_qbg_setting_data['mwb_qbg_after_content_position'] == 'left')
							{
								return $content.'<div style="text-align:left; with:100%" class="mwb_qbg_image_wrp" ></div>';
							}
							else
							{
								return $content.'<div style="text-align:right; with:100%" class="mwb_qbg_image_wrp" ></div>';
							}	
						}
					}
				}
			}
		}
		return $content;
	}
	
	/**
	 * Creating div for showing qr code in header through the wp-header hook.
	 *
	 * @name mwb_qbg_content_page_link_generator
	 * @author makewebbetter<webmaster@makewebbetter.com>
	 * @link http://www.makewebbetter.com/
	 */
	public function mwb_qbg_link_generator_for_header()
	{
		$mwb_qbg_setting_data = get_option('mwb_qbg_setting_data',array());
		$mwb_qbg_exclude_category = isset($mwb_qbg_setting_data['mwb_qbg_exclude_category'])?$mwb_qbg_setting_data['mwb_qbg_exclude_category'] : array();
		$mwb_qbg_exclude_product_category = isset($mwb_qbg_setting_data['mwb_qbg_exclude_product_category'])?$mwb_qbg_setting_data['mwb_qbg_exclude_product_category'] : array();
		$page_id = get_the_ID();

		if(isset($mwb_qbg_setting_data['mwb_qbg_enable']) && $mwb_qbg_setting_data['mwb_qbg_enable'] == 'on')
		{	
			if(isset($mwb_qbg_setting_data['mwb_qbg_display_in_header']) && $mwb_qbg_setting_data['mwb_qbg_display_in_header'] == 'on')
			{
				$mwb_qbg_post_type = get_post_type($page_id);
				if( $mwb_qbg_post_type == 'post')
				{
					if(isset($mwb_qbg_setting_data['mwb_qbg_display_post']) && $mwb_qbg_setting_data['mwb_qbg_display_post'] == 'on')
					{
						$mwb_qbg_post_category = get_the_category();
						if(!in_array($mwb_qbg_post_category[0]->term_id,$mwb_qbg_exclude_category))
						{
							if(isset($mwb_qbg_setting_data['mwb_qbg_header_position']) && $mwb_qbg_setting_data['mwb_qbg_header_position'] == 'left')
							{
								echo '<div style="max-width:1170px; margin: 0 auto; text-align:left; padding:15px;" class="mwb_qbg_image_wrp mwb_qbg_image_wrp" ></div>';
							}
							else
							{
								echo '<div style="max-width:1170px; text-align:right; margin: 0 auto; padding:15px;" class="mwb_qbg_image_wrp" ></div>';
							}
						}
					}
				}
				if( $mwb_qbg_post_type == 'product')
				{
					if(isset($mwb_qbg_setting_data['mwb_qbg_display_product']) && $mwb_qbg_setting_data['mwb_qbg_display_product'] == 'on')
					{
						$mwb_qbg_product_category = get_the_terms( get_the_ID(), 'product_cat' );
						$mwb_qbg_product_category_exclude = false;
						if($mwb_qbg_product_category != '')
						{
							if(!in_array($mwb_qbg_product_category[0]->term_id,$mwb_qbg_exclude_product_category) )
							{
								$mwb_qbg_product_category_exclude = true;
							}
						}
						 

						
						if($mwb_qbg_product_category_exclude || $mwb_qbg_product_category =='')
						{  
							if(isset($mwb_qbg_setting_data['mwb_qbg_header_position']) && $mwb_qbg_setting_data['mwb_qbg_header_position'] == 'left')
							{
								echo '<div style="max-width:1170px; margin: 0 auto; text-align:left; padding:15px;" class="mwb_qbg_image_wrp mwb_qbg_image_wrp" ></div>';
							}
							else
							{
								echo '<div style="max-width:1170px; text-align:right; margin: 0 auto; padding:15px;" class="mwb_qbg_image_wrp" ></div>';
							}
						}
					}
				}
				if( $mwb_qbg_post_type == 'page')
				{
					if(isset($mwb_qbg_setting_data['mwb_qbg_display_page']) && $mwb_qbg_setting_data['mwb_qbg_display_page'] == 'on')
					{
						if(isset($mwb_qbg_setting_data['mwb_qbg_header_position']) && $mwb_qbg_setting_data['mwb_qbg_header_position'] == 'left')
						{
							echo '<div style="max-width:1170px; margin: 0 auto; text-align:left; padding:15px;" class="mwb_qbg_image_wrp mwb_qbg_image_wrp" ></div>';
						}
						else
						{
							echo '<div style="max-width:1170px; text-align:right; margin: 0 auto; padding:15px;" class="mwb_qbg_image_wrp" ></div>';
						}
					}
				}
			}
		}
	}

	/**
	 * Creating div for showing qr code in footer through the wp-footer hook.
	 *
	 * @name mwb_qbg_link_generator_for_footer
	 * @author makewebbetter<webmaster@makewebbetter.com>
	 * @link http://www.makewebbetter.com/
	 */
	public function mwb_qbg_link_generator_for_footer()
	{
		$mwb_qbg_setting_data = get_option('mwb_qbg_setting_data',array());
		$mwb_qbg_exclude_category = isset($mwb_qbg_setting_data['mwb_qbg_exclude_category'])?$mwb_qbg_setting_data['mwb_qbg_exclude_category'] : array();
		$mwb_qbg_exclude_product_category = isset($mwb_qbg_setting_data['mwb_qbg_exclude_product_category'])?$mwb_qbg_setting_data['mwb_qbg_exclude_product_category'] : array();
		$page_id = get_the_ID();

		if(isset($mwb_qbg_setting_data['mwb_qbg_enable']) && $mwb_qbg_setting_data['mwb_qbg_enable'] == 'on')
		{	
			if (isset($mwb_qbg_setting_data['mwb_qbg_display_in_footer']) && $mwb_qbg_setting_data['mwb_qbg_display_in_footer'] == 'on')
			{
				if(isset($mwb_qbg_setting_data['mwb_qbg_enable']) && $mwb_qbg_setting_data['mwb_qbg_enable'] == 'on')
				{
					$mwb_qbg_post_type = get_post_type($page_id);
					if( $mwb_qbg_post_type == 'post')
					{
						if(isset($mwb_qbg_setting_data['mwb_qbg_display_post']) && $mwb_qbg_setting_data['mwb_qbg_display_post'] == 'on')
						{
							$mwb_qbg_post_category = get_the_category();
							if(!in_array($mwb_qbg_post_category[0]->term_id,$mwb_qbg_exclude_category))
							{
								if(isset($mwb_qbg_setting_data['mwb_qbg_footer_position']) && $mwb_qbg_setting_data['mwb_qbg_footer_position'] == 'left')
								{
									echo '<div style="max-width:1170px; margin: auto; padding:15px; text-align:left;" class="mwb_qbg_image_wrp" ></div>';
								}
								else
								{
									echo '<div style="max-width:1170px; margin: auto; padding:15px; text-align:right;" class="mwb_qbg_image_wrp" ></div>';
								}
							}
						}
					}

					if( $mwb_qbg_post_type == 'product')
					{
						if(isset($mwb_qbg_setting_data['mwb_qbg_display_product']) && $mwb_qbg_setting_data['mwb_qbg_display_product'] == 'on')
						{
							$mwb_qbg_product_category = get_the_terms( get_the_ID(), 'product_cat' );
							$mwb_qbg_product_category_exclude = false;
							if($mwb_qbg_product_category != '')
							{
								if(!in_array($mwb_qbg_product_category[0]->term_id,$mwb_qbg_exclude_product_category) )
								{
									$mwb_qbg_product_category_exclude = true;
								}
							}
							 

							
							if($mwb_qbg_product_category_exclude || $mwb_qbg_product_category =='')
							{
								if(isset($mwb_qbg_setting_data['mwb_qbg_footer_position']) && $mwb_qbg_setting_data['mwb_qbg_footer_position'] == 'left')
								{
									echo '<div style="max-width:1170px; margin: auto; padding:15px; text-align:left;" class="mwb_qbg_image_wrp" ></div>';
								}
								else
								{
									echo '<div style="max-width:1170px; margin: auto; padding:15px; text-align:right;" class="mwb_qbg_image_wrp" ></div>';
								}
							}
						}
					}
					if( $mwb_qbg_post_type == 'page')
					{
						if(isset($mwb_qbg_setting_data['mwb_qbg_display_page']) && $mwb_qbg_setting_data['mwb_qbg_display_page'] == 'on')
						{
							if(isset($mwb_qbg_setting_data['mwb_qbg_footer_position']) && $mwb_qbg_setting_data['mwb_qbg_footer_position'] == 'left')
							{
								echo '<div style="max-width:1170px; margin: auto; padding:15px; text-align:left;" class="mwb_qbg_image_wrp" ></div>';
							}
							else
							{
								echo '<div style="max-width:1170px; margin: auto; padding:15px; text-align:right;" class="mwb_qbg_image_wrp" ></div>';
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Creating qr code image through ajax request.
	 *
	 * @name mwb_qbg_image_generation
	 * @author makewebbetter<webmaster@makewebbetter.com>
	 * @link http://www.makewebbetter.com/
	 */
	public function mwb_qbg_image_generation()
	{
		$page_id = isset($_POST['page_id'])?$_POST['page_id']:'';
		$mwb_qbg_setting_data = get_option('mwb_qbg_setting_data',array());
		if(isset($mwb_qbg_setting_data['mwb_qbg_enable']) && $mwb_qbg_setting_data['mwb_qbg_enable'] == 'on')
		{
			$upload_path = wp_upload_dir();
			$upload_url =$upload_path['url'].'/qr-';
			$upload_path =$upload_path['path'].'/qr-';
			$codeContents = get_permalink($page_id);
			$fileName = $page_id.'.png';
			$pngAbsoluteFilePath = $upload_path.$fileName;
			$urlRelativeFilePath = $upload_url.$fileName;
			QRcode::png($codeContents, $pngAbsoluteFilePath);
			$image = $urlRelativeFilePath;
			
		}
		$response=array('img' => $image);
		echo json_encode($response);
		wp_die();
	}
}
