(function ($) {
	"use strict";
	$(document).ready(function($){
		if( $('#valen_layouttype').length > 0 ){
			var selector = document.getElementById('valen_layouttype');
			var imgLayoutHTML = '';
		    for(var i = 1; i < selector.options.length; i++){
		    	if( selector.options[i].value ){
		    		imgLayoutHTML = imgLayoutHTML + '<span class="img-layout '+selector.options[i].value+'" data-value="'+selector.options[i].value+'" title="'+selector.options[i].text+'"></span>';
		    	}
		    }
		    $('#valen_layouttype').parent().append(imgLayoutHTML); $('#valen_layouttype').css('display', 'none');
		}
		$('.img-layout').each(function(){
			// Add active class
			if($(this).attr('data-value') == $('#valen_layouttype').attr('data-selected')){
				$(this).addClass('active');
			}
			showHideDependLayout($('#valen_layouttype').attr('data-selected'));
			// Click img select
			$(this).on('click', function() {
				// Change active class
				var $val = $(this).attr('data-value'); $('.img-layout').removeClass('active'); $(this).addClass('active');
				// Set value for select
				$('#wpbody #valen_layouttype').val($val);
				if( typeof $('#wpbody #valen_layouttype').attr('data-selected') != 'undefined' ){
					$('#wpbody #valen_layouttype').attr('data-selected', $val);
				}
				// Hide or show field codition
				showHideDependLayout($val);
			});
		});
		//
		if ( $('#page_template').val() == 'fullwidth.php' || $('#page_template').val() == 'sidepage.php' ){
			$('#sns_layout').fadeOut(500);
		}else{
			$('#sns_layout').fadeIn(500);
		}
		
		$('#page_template').change(function(){
			if( $(this).val() == 'fullwidth.php' || $('#page_template').val() == 'sidepage.php' ){
				$('#sns_layout').fadeOut(500);
			}else{
				$('#sns_layout').fadeIn(500);
			}
		})
		function showHideDependLayout($val){
			if( $val == 'm' ){
				$('#wpbody #valen_leftsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
				$('#wpbody #valen_rightsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
			}else if( $val == 'l-m' ){
				$('#wpbody #valen_leftsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeIn(500);
				$('#wpbody #valen_rightsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
			}else if( $val == 'm-r' ){
				$('#wpbody #valen_rightsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeIn(500);
				$('#wpbody #valen_leftsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
			}
		}
		// Enable layout config
		$('#wpbody input[name="valen_enablelayoutconfig"]').each(function(){
			if( $(this).attr('checked') == 'checked' ) enableLayoutConfig( $(this).val() );
			$(this).change(function(){
				enableLayoutConfig( $(this).val() );console.log($(this).val());
			})
		})
		function enableLayoutConfig($val){
			if( $val == '1' ){
				$('#wpbody #valen_layouttype').parents('.rwmb-layouttype-wrapper').stop(true,true).fadeIn(500);
				showHideDependLayout($('#valen_layouttype').val());
			}else{
				$('#wpbody #valen_leftsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
				$('#wpbody #valen_rightsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
				$('#wpbody #valen_layouttype').parents('.rwmb-layouttype-wrapper').stop(true,true).fadeOut(500);
			}
		}
		//
		if ( $('#post-formats-select input').lenth > 0 ) {
			showHideDependPostFormat($('#post-format-gallery').attr('checked'), '#sns-post-gallery' );
			showHideDependPostFormat($('#post-format-video').attr('checked'), '#sns-post-video' );
			showHideDependPostFormat($('#post-format-audio').attr('checked'), '#sns-post-audio' );
			showHideDependPostFormat($('#post-format-quote').attr('checked'), '#sns-post-quote' );
			showHideDependPostFormat($('#post-format-link').attr('checked'), '#sns-post-link' );
			$('#post-formats-select input').each(function(){
				$(this).on('click', function() {
					showHideDependPostFormat($('#post-format-gallery').attr('checked'), '#sns-post-gallery' );
					showHideDependPostFormat($('#post-format-video').attr('checked'), '#sns-post-video' );
					showHideDependPostFormat($('#post-format-audio').attr('checked'), '#sns-post-audio' );
					showHideDependPostFormat($('#post-format-quote').attr('checked'), '#sns-post-quote' );
					showHideDependPostFormat($('#post-format-link').attr('checked'), '#sns-post-link' );
				});
			});
			function showHideDependPostFormat($checked, $id){
				if( $checked == 'checked' ){
					$($id).stop(true,true).fadeIn(500);
				}else {
					$($id).stop(true,true).fadeOut(500);
				}
			}
		}
		// Header style
		$('#wpbody select[name=valen_header_style]').each(function(){
			if ( $(this).val() == 'style1' ) {
				$('#wpbody select#valen_mcat_style').parents('.rwmb-select-wrapper').stop(true,true).fadeIn(500);
			}else {
				$('#wpbody select#valen_mcat_style').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
			}
			$(this).change(function(){
				if ( $(this).val() == 'style1' ) {
					$('#wpbody select#valen_mcat_style').parents('.rwmb-select-wrapper').stop(true,true).fadeIn(500);
				}else {
					$('#wpbody select#valen_mcat_style').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
				}
			})
		});
		// Breadcumd
		$('#wpbody select[name=valen_showbreadcrump]').each(function(){
			if ( $(this).val() == '1' ) {
				$('#wpbody input[name=valen_breadcrumbbg]').parents('.rwmb-image_advanced-wrapper').stop(true,true).fadeIn(500);
			}else {
				$('#wpbody input[name=valen_breadcrumbbg]').parents('.rwmb-image_advanced-wrapper').stop(true,true).fadeOut(500);
			}
			$(this).change(function(){
				if ( $(this).val() == '1' ) {
					$('#wpbody input[name=valen_breadcrumbbg]').parents('.rwmb-image_advanced-wrapper').stop(true,true).fadeIn(500);
				}else {
					$('#wpbody input[name=valen_breadcrumbbg]').parents('.rwmb-image_advanced-wrapper').stop(true,true).fadeOut(500);
				}
			})
		});
		// Revolution
		$('#wpbody input[name=valen_useslideshow]').each(function(){
			if( $(this).attr('checked') == 'checked' ){
				if ( $(this).val() == '1' ) {
					$('#wpbody select#valen_revolutionslider').parents('.rwmb-select-wrapper').stop(true,true).fadeIn(500);
				}else {
					$('#wpbody select#valen_revolutionslider').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
				}
			}
			$(this).change(function(){
				if ( $(this).val() == '1' ) {
					$('#wpbody select#valen_revolutionslider').parents('.rwmb-select-wrapper').stop(true,true).fadeIn(500);
				}else {
					$('#wpbody select#valen_revolutionslider').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
				}
			})
		});
		// Theme color
		$('#wpbody input[name=valen_page_themecolor]').each(function(){
			if( $(this).attr('checked') == 'checked' ){
				if ( $(this).val() == '1' ) {
					$('#wpbody input#valen_theme_color').parents('.rwmb-color-wrapper').stop(true,true).fadeIn(500);
				}else {
					$('#wpbody input#valen_theme_color').parents('.rwmb-color-wrapper').stop(true,true).fadeOut(500);
				}
			}
			$(this).change(function(){
				if ( $(this).val() == '1' ) {
					$('#wpbody input#valen_theme_color').parents('.rwmb-color-wrapper').stop(true,true).fadeIn(500);
				}else {
					$('#wpbody input#valen_theme_color').parents('.rwmb-color-wrapper').stop(true,true).fadeOut(500);
				}
			})
		});
		$(window).load(function(){
			if ( $('#post-format-selector-0').length > 0 ){
				$('#sns-post-gallery, #sns-post-video, #sns-post-audio, #sns-post-quote, #sns-post-link').each(function(){
					$(this).fadeOut(500);
				});
				var $p_vale = $('#post-format-selector-0').val();
				if( $p_vale !== '' && $p_vale !== 'standard' ) {
					$('#sns-post-' + $p_vale).fadeIn(500);
				}
				$('#post-format-selector-0').change(function(){
					$('#sns-post-gallery, #sns-post-video, #sns-post-audio, #sns-post-quote, #sns-post-link').each(function(){
						$(this).fadeOut(500);
					});
					var $p_vale = $('#post-format-selector-0').val();
					if( $p_vale !== '' && $p_vale !== 'standard' ) {
						$('#sns-post-' + $p_vale).fadeIn(500);
					}
				});
			}
		});
	});
})(jQuery);