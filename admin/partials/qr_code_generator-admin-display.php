<?php

/**
 * Provide a admin area for settings view.
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    pc-to-mobile-via-qr -code
 * @subpackage pc-to-mobile-via-qr -code/admin/partials
 */
 
/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(isset($_POST['mwb_qbg_save_settings']))
{
	?>
	<div class="notice notice-success is-dismissible">
	    <p><strong><?php _e('Settings saved.','qrcode_generator'); ?></strong></p>
	    <button type="button" class="notice-dismiss">
	        <span class="screen-reader-text"><?php _e('Dismiss this notices.','qrcode_generator'); ?></span>
	    </button>
	</div><?php
	$mwb_qbg_setting_array = array();

	$mwb_qbg_setting_array['mwb_qbg_enable'] = isset($_POST['mwb_qbg_enable'])?$_POST['mwb_qbg_enable'] : '0';
	$mwb_qbg_setting_array['mwb_qbg_display_in_header'] = isset($_POST['mwb_qbg_display_in_header'])?$_POST['mwb_qbg_display_in_header'] : '';
	$mwb_qbg_setting_array['mwb_qbg_header_position'] = isset($_POST['mwb_qbg_header_position'])?$_POST['mwb_qbg_header_position'] : '';
	$mwb_qbg_setting_array['mwb_qbg_display_in_footer'] = isset($_POST['mwb_qbg_display_in_footer'])?$_POST['mwb_qbg_display_in_footer'] : '';
	$mwb_qbg_setting_array['mwb_qbg_footer_position'] = isset($_POST['mwb_qbg_footer_position'])?$_POST['mwb_qbg_footer_position'] : '';
	$mwb_qbg_setting_array['mwb_qbg_display_before_content'] = isset($_POST['mwb_qbg_display_before_content'])?$_POST['mwb_qbg_display_before_content'] : '';
	$mwb_qbg_setting_array['mwb_qbg_before_content_position'] = isset($_POST['mwb_qbg_before_content_position'])?$_POST['mwb_qbg_before_content_position'] : '';
	$mwb_qbg_setting_array['mwb_qbg_display_after_content'] = isset($_POST['mwb_qbg_display_after_content'])?$_POST['mwb_qbg_display_after_content'] : '';
	$mwb_qbg_setting_array['mwb_qbg_after_content_position'] = isset($_POST['mwb_qbg_after_content_position'])?$_POST['mwb_qbg_after_content_position'] : '';
	$mwb_qbg_setting_array['mwb_qbg_display_post'] = isset($_POST['mwb_qbg_display_post'])?$_POST['mwb_qbg_display_post'] : '';
	$mwb_qbg_setting_array['mwb_qbg_display_product'] = isset($_POST['mwb_qbg_display_product'])?$_POST['mwb_qbg_display_product'] : '';
	$mwb_qbg_setting_array['mwb_qbg_display_page'] = isset($_POST['mwb_qbg_display_page'])?$_POST['mwb_qbg_display_page'] : '';
	$mwb_qbg_setting_array['mwb_qbg_height'] = isset($_POST['mwb_qbg_height'])?$_POST['mwb_qbg_height'] : '';
	$mwb_qbg_setting_array['mwb_qbg_width'] = isset($_POST['mwb_qbg_width'])?$_POST['mwb_qbg_width'] : '';
	$mwb_qbg_setting_array['mwb_qbg_above_text'] = isset($_POST['mwb_qbg_above_text'])?$_POST['mwb_qbg_above_text'] : '';
	$mwb_qbg_setting_array['mwb_qbg_bellow_text'] = isset($_POST['mwb_qbg_bellow_text'])?$_POST['mwb_qbg_bellow_text'] : '0';
	$mwb_qbg_setting_array['mwb_qbg_exclude_category'] = isset($_POST['mwb_qbg_exclude_category'])?$_POST['mwb_qbg_exclude_category'] : array();
	$mwb_qbg_setting_array['mwb_qbg_exclude_product_category'] = isset($_POST['mwb_qbg_exclude_product_category'])?$_POST['mwb_qbg_exclude_product_category'] : array();


	//// update setting data in option table ////

	update_option('mwb_qbg_setting_data',$mwb_qbg_setting_array);
}

	$mwb_qbg_setting_data = get_option('mwb_qbg_setting_data',array());

	$mwb_qbg_enable = isset($mwb_qbg_setting_data['mwb_qbg_enable'])?$mwb_qbg_setting_data['mwb_qbg_enable'] : '';
	$mwb_qbg_display_in_header = isset($mwb_qbg_setting_data['mwb_qbg_display_in_header'])?$mwb_qbg_setting_data['mwb_qbg_display_in_header'] : '';
	$mwb_qbg_display_in_footer = isset($mwb_qbg_setting_data['mwb_qbg_display_in_footer'])?$mwb_qbg_setting_data['mwb_qbg_display_in_footer'] : '';
	$mwb_qbg_display_before_content = isset($mwb_qbg_setting_data['mwb_qbg_display_before_content'])?$mwb_qbg_setting_data['mwb_qbg_display_before_content'] : '';
	$mwb_qbg_display_after_content = isset($mwb_qbg_setting_data['mwb_qbg_display_after_content'])?$mwb_qbg_setting_data['mwb_qbg_display_after_content'] : '';
	$mwb_qbg_header_position = isset($mwb_qbg_setting_data['mwb_qbg_header_position'])?$mwb_qbg_setting_data['mwb_qbg_header_position'] : '';
	$mwb_qbg_footer_position = isset($mwb_qbg_setting_data['mwb_qbg_footer_position'])?$mwb_qbg_setting_data['mwb_qbg_footer_position'] : '';
	$mwb_qbg_before_content_position = isset($mwb_qbg_setting_data['mwb_qbg_before_content_position'])?$mwb_qbg_setting_data['mwb_qbg_before_content_position'] : '';
	$mwb_qbg_after_content_position = isset($mwb_qbg_setting_data['mwb_qbg_after_content_position'])?$mwb_qbg_setting_data['mwb_qbg_after_content_position'] : '';
	$mwb_qbg_display_post = isset($mwb_qbg_setting_data['mwb_qbg_display_post'])?$mwb_qbg_setting_data['mwb_qbg_display_post'] : '';
	$mwb_qbg_display_product = isset($mwb_qbg_setting_data['mwb_qbg_display_product'])?$mwb_qbg_setting_data['mwb_qbg_display_product'] : '';
	$mwb_qbg_display_page = isset($mwb_qbg_setting_data['mwb_qbg_display_page'])?$mwb_qbg_setting_data['mwb_qbg_display_page'] : '';
	$mwb_qbg_height = isset($mwb_qbg_setting_data['mwb_qbg_height'])?$mwb_qbg_setting_data['mwb_qbg_height'] : '';
	$mwb_qbg_width = isset($mwb_qbg_setting_data['mwb_qbg_width'])?$mwb_qbg_setting_data['mwb_qbg_width'] : '';
	$mwb_qbg_above_text = isset($mwb_qbg_setting_data['mwb_qbg_above_text'])?$mwb_qbg_setting_data['mwb_qbg_above_text'] : '';
	$mwb_qbg_bellow_text = isset($mwb_qbg_setting_data['mwb_qbg_bellow_text'])?$mwb_qbg_setting_data['mwb_qbg_bellow_text'] : '';
	$mwb_qbg_exclude_category = isset($mwb_qbg_setting_data['mwb_qbg_exclude_category'])?$mwb_qbg_setting_data['mwb_qbg_exclude_category'] : array();
	$mwb_qbg_exclude_product_category = isset($mwb_qbg_setting_data['mwb_qbg_exclude_product_category'])?$mwb_qbg_setting_data['mwb_qbg_exclude_product_category'] : array();

?>
<form enctype="multipart/form-data" action="" class="mwb_qbg_setting_form" id="mainform" method="post">	
	<h1><?php _e('QR Code Generator Settings','qrcode_generator') ?></h1>
	<table class="form-table mwb_qbg_setting">	
		<tbody>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="mwb_qbg_enable"><?php _e('Enable/Disable','qrcode_generator')?></label>
				</th>
				<td class="forminp forminp-text">
					<span>					
						<?php 
						$attribute_description = __('Enable to activate plugin.', 'qrcode_generator');
						echo ( $attribute_description );
						?>
					</span>	
					<label for="mwb_qbg_enable">
						<div class="slideThree"> 
				          	<input id="slideThree" <?php checked($mwb_qbg_enable,'on');?> name="mwb_qbg_enable"  type="checkbox">
				          	<label for="slideThree"></label>
					    </div>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="mwb_qbg_display_page"><?php _e('Display Option','qrcode_generator')?></label>
				</th>
				<td class="forminp forminp-text">
					
					<label for="mwb_qbg_display_page">
						<span>
						<?php 
							$attribute_description = __('Check box where you want to show Qr code.', 'qrcode_generator');
							echo ( $attribute_description );
							?>
						</span>
						<div class="mwb-qrcode_generator-control-group">
				            <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--checkbox"><?php _e('Post','qrcode_generator')?>
				              <input type="checkbox" <?php checked($mwb_qbg_display_post,'on');?> name="mwb_qbg_display_post" />
				              <div class="mwb-qrcode_generator-control__indicator"></div>
				            </label>
				            <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--checkbox"><?php _e('Product','qrcode_generator')?>
				              <input name="mwb_qbg_display_product" <?php checked($mwb_qbg_display_product,'on');?> type="checkbox"/>
				              <div class="mwb-qrcode_generator-control__indicator"></div>
				            </label>
				            <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--checkbox"><?php _e('Page','qrcode_generator')?>
				              <input type="checkbox" <?php checked($mwb_qbg_display_page,'on');?> name="mwb_qbg_display_page" />
				              <div class="mwb-qrcode_generator-control__indicator"></div>
				            </label>
				          </div>
					</label>						
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="mwb_qbg_display_page"><?php _e('Display Location','qrcode_generator')?></label>
				</th>
				<td class="forminp forminp-text">
					<label for="mwb_qbg_display_page">
						<span>
							<?php 
							$attribute_description = __('Check box where you want to show Qr code.', 'qrcode_generator');
							echo ( $attribute_description );
							?>
						</span>
						<div class="mwb-qrcode_generator-control-group">
				            <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--checkbox"><?php _e('Header','qrcode_generator')?>
				              <input type="checkbox" <?php checked($mwb_qbg_display_in_header,'on');?> name="mwb_qbg_display_in_header" />
				              <div class="mwb-qrcode_generator-control__indicator"></div>
						 	</label>
						 	<div class="mwb-qrcode_generator-control-group">
						 		<p><?php _e('Header Qr code Position', 'qrcode_generator'); ?></p>
							    <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--radio"><?php _e('Left', 'qrcode_generator'); ?>
					              <input type="radio" value="left" name="mwb_qbg_header_position" <?php checked($mwb_qbg_header_position,'left');?>/>
					              <div class="mwb-qrcode_generator-control__indicator"></div>
					            </label>
					            <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--radio"><?php _e('Right', 'qrcode_generator'); ?>
					              <input type="radio" value="right" name="mwb_qbg_header_position" <?php checked($mwb_qbg_header_position,'right');?>/>
					              <div class="mwb-qrcode_generator-control__indicator"></div>
					            </label>
					        </div>
				            <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--checkbox"><?php _e('Footer','qrcode_generator')?>
				              <input type="checkbox" <?php checked($mwb_qbg_display_in_footer,'on');?> name="mwb_qbg_display_in_footer" />
				              <div class="mwb-qrcode_generator-control__indicator"></div>
				            </label>
				            <div class="mwb-qrcode_generator-control-group">
				            	<p><?php _e('Footer Qr code Position', 'qrcode_generator'); ?></p>
							    <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--radio"><?php _e('Left', 'qrcode_generator'); ?>
					              <input type="radio" value="left" name="mwb_qbg_footer_position" <?php checked($mwb_qbg_footer_position,'left');?>/>
					              <div class="mwb-qrcode_generator-control__indicator"></div>
					            </label>
					            <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--radio"><?php _e('Right', 'qrcode_generator'); ?>
					              <input type="radio" value="right" name="mwb_qbg_footer_position" <?php checked($mwb_qbg_footer_position,'right');?>/>
					              <div class="mwb-qrcode_generator-control__indicator"></div>
					            </label>
					        </div>
				            <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--checkbox"><?php _e('Before Content','qrcode_generator')?>
				              <input type="checkbox" <?php checked($mwb_qbg_display_before_content,'on');?> name="mwb_qbg_display_before_content" />
				              <div class="mwb-qrcode_generator-control__indicator"></div>
				            </label>
				            <div class="mwb-qrcode_generator-control-group">
				            	<p><?php _e('Before Content Qr code Position', 'qrcode_generator'); ?></p>
							    <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--radio"><?php _e('Left', 'qrcode_generator'); ?>
					              <input type="radio" value="left" name="mwb_qbg_before_content_position" <?php checked($mwb_qbg_before_content_position,'left');?>/>
					              <div class="mwb-qrcode_generator-control__indicator"></div>
					            </label>
					            <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--radio"><?php _e('Right', 'qrcode_generator'); ?>
					              <input type="radio" value="right" name="mwb_qbg_before_content_position" <?php checked($mwb_qbg_before_content_position,'footer');?>/>
					              <div class="mwb-qrcode_generator-control__indicator"></div>
					            </label>
					        </div>
				            <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--checkbox"><?php _e('After Content','qrcode_generator')?>
				              <input name="mwb_qbg_display_after_content" <?php checked($mwb_qbg_display_after_content,'on');?> type="checkbox"/>
				              <div class="mwb-qrcode_generator-control__indicator"></div>
				            </label>
				            <div class="mwb-qrcode_generator-control-group">
				            	<p><?php _e('After Content Qr code Position', 'qrcode_generator'); ?></p>
							    <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--radio"><?php _e('Left', 'qrcode_generator'); ?>
					              <input type="radio" value="left" name="mwb_qbg_after_content_position" <?php checked($mwb_qbg_after_content_position,'left');?>/>
					              <div class="mwb-qrcode_generator-control__indicator"></div>
					            </label>
					            <label class="mwb-qrcode_generator-control mwb-qrcode_generator-control--radio"><?php _e('Right', 'qrcode_generator'); ?>
					              <input type="radio" value="right" name="mwb_qbg_after_content_position" <?php checked($mwb_qbg_after_content_position,'right');?>/>
					              <div class="mwb-qrcode_generator-control__indicator"></div>
					            </label>
					        </div>
				          </div>
					</label>						
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="mwb_qbg_height"><?php _e('Qr code height','qrcode_generator')?></label>
				</th>
				<td class="forminp forminp-text">
					<label for="mwb_qbg_above_text">
						<input type="number" min="0" value="<?php echo $mwb_qbg_height; ?>" name="mwb_qbg_height">
					</label>
					<span>
						<?php 
						$attribute_description = __('Enter height(in pixel) of Qr code.', 'qrcode_generator');
						echo ( $attribute_description );
						?>
					</span>						
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="mwb_qbg_width"><?php _e('Qr code width','qrcode_generator')?></label>
				</th>
				<td class="forminp forminp-text">
					<label for="mwb_qbg_above_text">
						<input type="number" min="0" value="<?php echo $mwb_qbg_width; ?>" name="mwb_qbg_width">
					</label>
					<span>
						<?php 
						$attribute_description = __('Enter width(in pixel) of Qr code.', 'qrcode_generator');
						echo ( $attribute_description );
						?>
					</span>						
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="mwb_qbg_above_text"><?php _e('Above text for Qr code','qrcode_generator')?></label>
				</th>
				<td class="forminp forminp-text">
					<label for="mwb_qbg_above_text">
						<input type="text" value="<?php echo $mwb_qbg_above_text; ?>" name="mwb_qbg_above_text">
					</label>
					<span>
						<?php 
						$attribute_description = __('Put text here that you want to display above of Qr code.', 'qrcode_generator');
						echo ( $attribute_description );
						?>
					</span>						
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="mwb_qbg_bellow_text"><?php _e('Bellow text for Qr code','qrcode_generator')?></label>
				</th>
				<td class="forminp forminp-text">
					<label for="mwb_qbg_bellow_text">
						<input type="text" value="<?php echo $mwb_qbg_bellow_text; ?>" name="mwb_qbg_bellow_text">
					</label>
					<span>
						<?php 
						$attribute_description = __('Put text here that you want to display bellow of Qr code.', 'qrcode_generator');
						echo ( $attribute_description );
						?>
					</span>						
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="mwb_qbg_exclude_category"><?php _e('Exclude Post category for Qr code','qrcode_generator')?></label>
				</th>
				<td class="forminp forminp-text">
					
					<label for="mwb_qbg_exclude_category">
					<?php $categories = get_categories(); ?>
						<select class="mwb_qbg_categories_selection" name="mwb_qbg_exclude_category[]" multiple="multiple">
							<?php if(is_array($categories) && !empty($categories)) {
								 foreach ($categories as $key => $value) { ?>
								<option <?php if(is_array($mwb_qbg_exclude_category) && !empty($mwb_qbg_exclude_category)) :
									foreach ($mwb_qbg_exclude_category as $id): 
									if($value->term_id == $id ) : echo 'selected'; endif;  endforeach; endif ?>
								 value="<?php echo $value->term_id; ?>"><?php echo $value->name; ?></option>
						<?php } } ?>
						</select>
					</label>
					<span>
						<?php 
						$attribute_description = __("Select Post Category where you don't want to display Qr code.", 'qrcode_generator');
						echo ( $attribute_description );
						?>
					</span>						
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="mwb_qbg_exclude_category"><?php _e('Exclude Product category for Qr code','qrcode_generator')?></label>
				</th>
				<td class="forminp forminp-text">
					<label for="mwb_qbg_exclude_category">
					<?php $all_cat = get_terms('product_cat',array('hide_empty'=>0));
					 	$product_category = array();
					 	// print_r($all_cat);die;
					 	if(!is_wp_error($all_cat)){
					 		if(is_array($all_cat) && !empty($all_cat)){
						 		foreach ($all_cat as $cat){
						 			$product_category[$cat->term_id] = $cat->name;
						 		}
						 	}
					 	}?>
						<select class="mwb_qbg_categories_selection" name="mwb_qbg_exclude_product_category[]" multiple="multiple">
							<?php if(is_array($product_category) && !empty($product_category)) {
								 foreach ($product_category as $key => $value) { ?>
								<option <?php if(is_array($mwb_qbg_exclude_product_category) && !empty($mwb_qbg_exclude_product_category)) :
									foreach ($mwb_qbg_exclude_product_category as $id): 
									if($key == $id ) : echo 'selected'; endif;  endforeach; endif ?>
								 value="<?php echo $key; ?>"><?php echo $value; ?></option>
						<?php } } ?>
						</select>
					</label>
					<span>
						<?php 
						$attribute_description = __("Select Product Category where you don't want to display Qr code.", 'qrcode_generator');
						echo ( $attribute_description );
						?>
					</span>						
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="mwb_qbg_shortcode"><?php _e('Shortcode','qrcode_generator'); ?></label>
				</th>
				<td class="forminp forminp-text">
					
					<label for="mwb_qbg_shortcode">
					<span class="mwb_qbg_scode">[Mwb-Qr-Code]</span>
					<span class="mwb_qbg_mwb_qbg_shortcode_tooltip"><?php 
					$attribute_description = __("Use shortcode where want to display Qr code.", 'qrcode_generator');
					echo ( $attribute_description );
					?></span>
					</label>						
				</td>
			</tr>
		</tbody>
	</table>
	<p class="submit">
		<input type="submit" value="<?php _e('Save changes','qrcode_generator'); ?>" class="button-primary woocommerce-save-button mwb_qbg_save_changes" name="mwb_qbg_save_settings">
	</p>
</form>