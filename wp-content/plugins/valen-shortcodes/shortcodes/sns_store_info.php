<?php
// SNS Store Info
add_shortcode('sns_store_info', 'valen_store_info_template');
add_action('vc_after_init', 'valen_store_info_settings');
function valen_store_info_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_store_info'))
        include $template;
    return ob_get_clean();
}
function valen_store_info_settings() {
	$extra_class = valen_extra_class();
	vc_map( array(
		"name"  => esc_html__("SNS Store Info", 'valen-shortcodes'),
		"base" => "sns_store_info",
		"show_settings_on_create" => true ,
		"is_container" => false ,
		"icon" => "vc_icon_snstheme",
		"class" => "vc_icon_snstheme",
		"content_element" => true ,
		"category" => esc_html__('Valen', 'valen-shortcodes'),
		'description' => esc_html__( 'Store info: Address, Phone, Email, ...', 'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", 'valen-shortcodes'),
				"param_name" => "title" ,
				"value" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Style",'valen-shortcodes'),
				"param_name" => "style",
				"value" => array(
					esc_html__("Show label",'valen-shortcodes') => '1',
					esc_html__("Show icon",'valen-shortcodes') => '2',
					esc_html__("Show icon and label",'valen-shortcodes') => '3',
				),
			),
			array(
		      "type" => "attach_image",
		      "heading" => esc_html__("Logo Store", 'valen-shortcodes'),
		      "param_name" => "logo_store",
		    ),
			array(
				"type" => "textarea",
				"heading" => esc_html__("Short Intro", 'valen-shortcodes'),
				"param_name" => "short_intro"
			),
		    array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon for Address', 'valen-shortcodes' ),
				'param_name' => 'icon_address',
				'value' => 'fa fa-adjust',
				'settings' => array(
					'emptyIcon' => false,
					'iconsPerPage' => 4000,
				),
				'dependency' => array(
					'element' => 'style',
					'value' => array('2', '3'),
				),
				'description' => esc_html__( 'Select icon from library.', 'valen-shortcodes' ),
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__("Address", 'valen-shortcodes'),
				"param_name" => "address"
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon for Phone Number', 'valen-shortcodes' ),
				'param_name' => 'icon_phone',
				'value' => 'fa fa-adjust',
				'settings' => array(
					'emptyIcon' => false,
					'iconsPerPage' => 4000,
				),
				'dependency' => array(
					'element' => 'style',
					'value' => array('2', '3'),
				),
				'description' => esc_html__( 'Select icon from library.', 'valen-shortcodes' ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Phone Number", 'valen-shortcodes'),
				"param_name" => "phone"
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon for Mobile Number', 'valen-shortcodes' ),
				'param_name' => 'icon_phone2',
				'value' => 'fa fa-adjust',
				'settings' => array(
					'emptyIcon' => false,
					'iconsPerPage' => 4000,
				),
				'dependency' => array(
					'element' => 'style',
					'value' => array('2', '3'),
				),
				'description' => esc_html__( 'Select icon from library.', 'valen-shortcodes' ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Mobile Number", 'valen-shortcodes'),
				"param_name" => "phone2"
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon for Email', 'valen-shortcodes' ),
				'param_name' => 'icon_email',
				'value' => 'fa fa-adjust',
				'settings' => array(
					'emptyIcon' => false,
					'iconsPerPage' => 4000,
				),
				'dependency' => array(
					'element' => 'style',
					'value' => array('2', '3'),
				),
				'description' => esc_html__( 'Select icon from library.', 'valen-shortcodes' ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Email 1", 'valen-shortcodes'),
				"param_name" => "email"
			),
			// array(
			// 	"type" => "textfield",
			// 	"heading" => esc_html__("Email 2", 'valen-shortcodes'),
			// 	"param_name" => "email2"
			// ),
			vc_map_add_css_animation(),
			$extra_class,
		)
	));
}