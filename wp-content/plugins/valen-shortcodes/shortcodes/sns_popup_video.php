<?php
// SNS Info Box
add_shortcode('sns_popup_video', 'valen_popup_video_template');
add_action('vc_after_init', 'valen_popup_video_settings');
function valen_popup_video_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_popup_video'))
        include $template;
    return ob_get_clean();
}
function valen_popup_video_settings() {
	$extra_class = valen_extra_class();
    vc_map( array(
		"name"  => esc_html__("SNS Popup Video", 'valen-shortcodes'),
		"base" => "sns_popup_video",
		"show_settings_on_create" => true ,
		"is_container" => false ,
		"icon" => "vc_icon_snstheme",
		"class" => "vc_icon_snstheme",
		"content_element" => true ,
		"category" => esc_html__('Valen', 'valen-shortcodes'),
		'description' => esc_html__( 'Popup video', 'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => esc_html__("Video link", 'valen-shortcodes'),
				"param_name" => "video_link" ,
				"description" => esc_html__("You can use video url from Youtube, Vimeo", 'valen-shortcodes'),
				"value" => "",
			),
			array(
		      "type" => "attach_image",
		      "heading" => esc_html__("Background image for video", 'valen-shortcodes'),
		      "param_name" => "bg_image_video",
		    ),
		    array(
				"type" => "textfield",
				"heading" => esc_html__("Height for wrap", 'valen-shortcodes'),
				"param_name" => "height_wrap" ,
				"value" => esc_html__("680px", 'valen-shortcodes')
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", 'valen-shortcodes'),
				"param_name" => "title",
				"value" => esc_html__("Your Title Here ...",'valen-shortcodes'),
				"admin_label" => true 
			),
			// array(
			// 	"type" => "textfield",
			// 	"heading" => esc_html__("Sub title", 'valen-shortcodes'),
			// 	"param_name" => "sub_title" ,
			// 	"value" => esc_html__("Your sub title here ...",'valen-shortcodes'),
			// 	"description" => esc_html__("It's margin-top for title, example: 5px", 'valen-shortcodes')
			// ),
			$extra_class,
			vc_map_add_css_animation(),
		)
	));
}