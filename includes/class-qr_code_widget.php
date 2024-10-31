<?php 

// register widget hook.
add_action( 'widgets_init', 'mwb_qbg_load_widget' );

/**
 * Register Qr code widget.
 *
 * @name mwb_qbg_load_widget
 * @author makewebbetter<webmaster@makewebbetter.com>
 * @link http://www.makewebbetter.com/
 */
function mwb_qbg_load_widget() {
	register_widget( 'mwb_qbg_widget' );
}


// Shortcode for display qr code hook.
add_shortcode( 'Mwb-Qr-Code', 'mwb_qbg_link_generator_shortcode' );

/**
 * Shortcode for display qr code.
 *
 * @name mwb_qbg_link_generator_shortcode
 * @author makewebbetter<webmaster@makewebbetter.com>
 * @link http://www.makewebbetter.com/
 */
function mwb_qbg_link_generator_shortcode()
{
	$mwb_qbg_setting_data = get_option('mwb_qbg_setting_data',array());
	$mwb_qbg_height = $mwb_qbg_setting_data['mwb_qbg_height'];
	$mwb_qbg_width = $mwb_qbg_setting_data['mwb_qbg_width'];
	if($mwb_qbg_height == '')
	{
		$mwb_qbg_height = 'auto';
	}
	if($mwb_qbg_width == '')
	{
		$mwb_qbg_width = 'auto';
	}
	if(isset($mwb_qbg_setting_data['mwb_qbg_enable']) && $mwb_qbg_setting_data['mwb_qbg_enable'] == 'on')
	{
		
		$upload_path = wp_upload_dir();
		$upload_url =$upload_path['url'].'/qr-';
		$upload_path =$upload_path['path'].'/qr-';
		$codeContents = get_permalink();
		$page_id = get_the_ID(); 
		$fileName = $page_id.'.png';

		$pngAbsoluteFilePath = $upload_path.$fileName;
		$urlRelativeFilePath = $upload_url.$fileName;
		QRcode::png($codeContents, $pngAbsoluteFilePath);

		return '<img class="mwb_qbg_qr_code_img" src="'.$urlRelativeFilePath.'"  height="'.$mwb_qbg_height.'" width="'.$mwb_qbg_width.'">';
		
	}
}


/**
 * Creating qr code widget.
 *
 * @name mwb_qbg_widget
 * @author makewebbetter<webmaster@makewebbetter.com>
 * @link http://www.makewebbetter.com/
 */ 
class mwb_qbg_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
			
	// Base ID of your widget
			'mwb_qbg_widget', 
			
	// Widget name will appear in UI
			__('Qr Code Widget', 'qrcode_generator'), 
			
	// Widget description
			array( 'description' => __( 'Show Qr Code through Widget', 'qrcode_generator' ), ) 
			);
	}
	

	/**
	 * Creating qr code widget backend.
	 *
	 * @name form
	 * @author makewebbetter<webmaster@makewebbetter.com>
	 * @link http://www.makewebbetter.com/
	 */ 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'wpb_widget_domain' );
		}
	// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}

	/**
	 * Creating qr code widget front-end.
	 *
	 * @name widget
	 * @author makewebbetter<webmaster@makewebbetter.com>
	 * @link http://www.makewebbetter.com/
	 */ 
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		$mwb_qbg_setting_data = get_option('mwb_qbg_setting_data',array());
		if(isset($mwb_qbg_setting_data['mwb_qbg_enable']) && $mwb_qbg_setting_data['mwb_qbg_enable'] == 'on')
		{
			$mwb_qbg_height = $mwb_qbg_setting_data['mwb_qbg_height'];
			$mwb_qbg_width = $mwb_qbg_setting_data['mwb_qbg_width'];
			if($mwb_qbg_height == '')
			{
				$mwb_qbg_height = 'auto';
			}
			if($mwb_qbg_width == '')
			{
				$mwb_qbg_width = 'auto';
			}
			
			$upload_path = wp_upload_dir();
			$upload_url =$upload_path['url'].'/qr-';
			$upload_path =$upload_path['path'].'/qr-';
			$codeContents = get_permalink();
			$page_id = get_the_ID(); 
			$fileName = $page_id.'.png';

			$pngAbsoluteFilePath = $upload_path.$fileName;
			$urlRelativeFilePath = $upload_url.$fileName;
			QRcode::png($codeContents, $pngAbsoluteFilePath);

			echo '<img class="mwb_qbg_qr_code_img" src="'.$urlRelativeFilePath.'"  height="'.$mwb_qbg_height.'" width="'.$mwb_qbg_width.'">';
			
		}
	}
	

	/**
	 * Updating widget replacing old instances with new.
	 *
	 * @name update
	 * @author makewebbetter<webmaster@makewebbetter.com>
	 * @link http://www.makewebbetter.com/
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Class wpb_widget ends here