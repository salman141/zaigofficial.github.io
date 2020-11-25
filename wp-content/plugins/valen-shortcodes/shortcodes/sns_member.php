<?php
// SNS Member
add_shortcode('sns_member', 'valen_member_template');
add_action('vc_after_init', 'valen_member_settings');
function valen_member_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_member'))
        include $template;
    return ob_get_clean();
}
function valen_member_settings() {
	$extra_class = valen_extra_class();
    vc_map( array(
		"name"  => esc_html__("SNS Member", 'valen-shortcodes'),
		"base" => "sns_member",
		"show_settings_on_create" => true ,
		"is_container" => false ,
		"icon" => "vc_icon_snstheme",
		"class" => "vc_icon_snstheme",
		"content_element" => true ,
		"category" => esc_html__('Valen', 'valen-shortcodes'),
		'description' => esc_html__( 'Box contain member info', 'valen-shortcodes' ),
		"params" => array(
			array(
		      "type" => "attach_image",
		      "heading" => esc_html__("Avartar", "valen-shortcodes"),
		      "param_name" => "avartar" 
		    ),
		    array(
				"type" => "dropdown",
				"heading" => esc_html__("Avartar style","valen-shortcodes"),
				"param_name" => "avartar_style",
				"value" => array(
					"Default" => "",
					"Rounded" =>  "rounded",
					"Circle" =>  "circle"
				),
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Info style","valen-shortcodes"),
				"param_name" => "info_style",
				"value" => array(
					"Alway display info" => "",
					"Hover to show info" =>  "hover",
				),
				"description" => ""
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Link to member', 'valen-shortcodes' ),
				'param_name' => 'link',
			),
		    array(
		      "type" => "textfield",
		      "heading" => esc_html__("Member name", "valen-shortcodes"),
		      "param_name" => "name",
			  "admin_label" => true
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => esc_html__("Member role", "valen-shortcodes"),
		      "param_name" => "role",
			  "admin_label" => true
		    ),
		    array(
		      "type" => "textarea_html",
		      "heading" => esc_html__("Short description", "valen-shortcodes"),
		      "param_name" => "short_desc",
		    ),
			array(
		      "type" => "textfield",
		      "heading" => esc_html__("Twitter link", "valen-shortcodes"),
		      "param_name" => "twitter",
			  //"dependency" => Array('element' => "social_links", 'value' => 'twitter')
		    ),
			array(
		      "type" => "textfield",
		      "heading" => esc_html__("Facebook link", "valen-shortcodes"),
		      "param_name" => "facebook",
			  //"dependency" => Array('element' => "social_links", 'value' => 'facebook')
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => esc_html__("Instagram link", "valen-shortcodes"),
		      "param_name" => "instagram",
			  //"dependency" => Array('element' => "social_links", 'value' => 'facebook')
		    ),
			array(
		      "type" => "textfield",
		      "heading" => esc_html__("linkedin link", "valen-shortcodes"),
		      "param_name" => "linkedin",
			  //"dependency" => Array('element' => "social_links", 'value' => 'linkedin')
		    ),
			array(
		      "type" => "textfield",
		      "heading" => esc_html__("youtube link", "valen-shortcodes"),
		      "param_name" => "youtube",
			  //"dependency" => Array('element' => "social_links", 'value' => 'youtube')
		    ),
			array(
		      "type" => "textfield",
		      "heading" => esc_html__("google link", "valen-shortcodes"),
		      "param_name" => "google",
			  //"dependency" => Array('element' => "social_links", 'value' => 'google')
		    ),
			array(
		      "type" => "textfield",
		      "heading" => esc_html__("behance link", "valen-shortcodes"),
		      "param_name" => "behance",
			  //"dependency" => Array('element' => "social_links", 'value' => 'behance')
		    ),
			array(
		      "type" => "textfield",
		      "heading" => esc_html__("dribbble link", "valen-shortcodes"),
		      "param_name" => "dribbble",
			  //"dependency" => Array('element' => "social_links", 'value' => 'dribbble')
		    ),
			array(
		      "type" => "textfield",
		      "heading" => esc_html__("pinterest link", "valen-shortcodes"),
		      "param_name" => "pinterest",
			  //"dependency" => Array('element' => "social_links", 'value' => 'pinterest')
		    ),
			$extra_class,
			vc_map_add_css_animation(),
		)
	));
}