(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	 var ajax_url = qbg_ajax.ajaxurl;

	 $(document).ready(function(){
	 	
		$.ajax({
				url 	: ajax_url,
				type 	: "POST",
				cache 	: false,
				async 	: false,
				dataType: "json",
				data 	: { 
					action  :'mwb_qbg_image_generation',
					page_id :qbg_ajax.page_id
				},
				success: function(response) 
				{
					$('.mwb_qbg_image_wrp').html('<p style="margin-bottom:7px;">'+qbg_ajax.mwb_qbg_above_text+'</p><img class="mwb_qbg_qr_code_img" src="'+response.img+'" style="display:inline-block;"  height="'+qbg_ajax.height+'" width="'+qbg_ajax.width+'"><p style="margin-bottom:7px;">'+qbg_ajax.mwb_qbg_bellow_text+'</p>');
				}
			});
	});
	

})( jQuery );
