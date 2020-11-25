<?php
// SNS Social Links
add_shortcode('sns_social_links', 'valen_social_links_template');
add_action('vc_after_init', 'valen_social_links_settings');
function valen_social_links_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_social_links'))
        include $template;
    return ob_get_clean();
}
function valen_social_links_settings() {
	$extra_class = valen_extra_class();
	vc_map( array(
		"name"  => esc_html__("SNS Social Links", 'valen-shortcodes'),
		"base" => "sns_social_links",
		"show_settings_on_create" => true ,
		"is_container" => false ,
		"icon" => "vc_icon_snstheme",
		"class" => "vc_icon_snstheme",
		"content_element" => true ,
		"category" => esc_html__('Valen', 'valen-shortcodes'),
		'description' => esc_html__( 'Display link to your social links', 'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => esc_html__("Label for Follow us", 'valen-shortcodes'),
				"param_name" => "label_followus" ,
				"value" => esc_html__("Follow us on:", 'valen-shortcodes')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Style",'valen-shortcodes'),
				"param_name" => "style",
				"value" => array(
					esc_html__("Rounded",'valen-shortcodes') => '1',
					esc_html__("Circle",'valen-shortcodes') => '2',
					esc_html__("Simple",'valen-shortcodes') => '3',
				),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Facebook link", 'valen-shortcodes'),
				"param_name" => "facebook_link" ,
				"value" => ""
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Goolgle Plus link", 'valen-shortcodes'),
				"param_name" => "google_link" ,
				"value" => ""
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Twitter link", 'valen-shortcodes'),
				"param_name" => "twitter_link" ,
				"value" => ""
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Youtube link", 'valen-shortcodes'),
				"param_name" => "youtube_link" ,
				"value" => ""
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Pinterest link", 'valen-shortcodes'),
				"param_name" => "pinterest_link" ,
				"value" => ""
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Instagram link", 'valen-shortcodes'),
				"param_name" => "instagram_link" ,
				"value" => ""
			),
			vc_map_add_css_animation(),
			$extra_class,
		)
	));
}