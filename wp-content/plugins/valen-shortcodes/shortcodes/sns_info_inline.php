<?php
// SNS Info Box
add_shortcode('sns_info_inline', 'valen_info_inline_template');
add_action('vc_after_init', 'valen_info_inline_settings');
function valen_info_inline_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_info_inline'))
        include $template;
    return ob_get_clean();
}
function valen_info_inline_settings() {
	$extra_class = valen_extra_class();
    vc_map( array(
		"name"  => esc_html__("SNS Info Inline", 'valen-shortcodes'),
		"base" => "sns_info_inline",
		"show_settings_on_create" => true ,
		"is_container" => false ,
		"icon" => "vc_icon_snstheme",
		"class" => "vc_icon_snstheme",
		"content_element" => true ,
		"category" => esc_html__('Valen', 'valen-shortcodes'),
		'description' => esc_html__( 'Contain: icon, title, link, ... and display inline', 'valen-shortcodes' ),
		"params" => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Style', 'valen-shortcodes' ),
				'value' => array(
					esc_html__( 'Default', 'valen-shortcodes' ) => '',
					esc_html__( 'Social', 'valen-shortcodes' ) => 'social',
					esc_html__( 'Social Rounded', 'valen-shortcodes' ) => 'social_rounded',
				),
				'param_name' => 'style',
			),
			// array(
			// 	'type' => 'checkbox',
			// 	'heading' => __( 'Use icon?', 'valen-shortcodes' ),
			// 	'param_name' => 'use_icon',
			// 	'description' => __( 'Use icon in content', 'valen-shortcodes' ),
			// ),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Use icon?', 'valen-shortcodes' ),
				'value' => array(
					esc_html__( 'No', 'valen-shortcodes' ) => '',
					esc_html__( 'Font Awesome', 'valen-shortcodes' ) => 'fontawesome',
					esc_html__( 'Flaticon', 'valen-shortcodes' ) => 'flaticon',
				),
				'param_name' => 'icon_type',
				'description' => esc_html__( 'Select icon library.', 'valen-shortcodes' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'valen-shortcodes' ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-adjust', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					'iconsPerPage' => 4000,
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'fontawesome',
				),
				'description' => esc_html__( 'Select icon from library.', 'valen-shortcodes' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'valen-shortcodes' ),
				'param_name' => 'icon_flaticon',
				'value' => '', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					'type' => 'flaticon',
					'iconsPerPage' => 4000,
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'flaticon',
				),
				'description' => esc_html__( 'Select icon from library.', 'valen-shortcodes' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Use label?', 'valen-shortcodes' ),
				'param_name' => 'use_label',
				'description' => __( 'Use label in content', 'valen-shortcodes' ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Label", 'valen-shortcodes'),
				"param_name" => "label",
				"value" => esc_html__("Your label here ...",'valen-shortcodes'),
				'dependency' => array(
					'element' => 'use_label',
					'value' => 'true',
				),
				"admin_label" => true 
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Use link?', 'valen-shortcodes' ),
				'param_name' => 'use_link',
				'description' => __( 'Use link in content', 'valen-shortcodes' ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Link", 'valen-shortcodes'),
				"param_name" => "link" ,
				"description" => esc_html__("Enter the  link. Do't forget to include http:// ", 'valen-shortcodes'),
				'dependency' => array(
					'element' => 'use_link',
					'value' => 'true',
				),
				"value" => esc_html__("http://", 'valen-shortcodes')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Link type', 'valen-shortcodes' ),
				'value' => array(
					esc_html__( 'Default', 'valen-shortcodes' ) => '0',
					esc_html__( 'Use mailto:', 'valen-shortcodes' ) => '1',
					esc_html__( 'Use tel:', 'valen-shortcodes' ) => '2',
				),
				'dependency' => array(
					'element' => 'use_link',
					'value' => 'true',
				),
				'param_name' => 'href_type',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Link target', 'valen-shortcodes' ),
				'value' => array(
					esc_html__( 'Same window', 'valen-shortcodes' ) => '_self',
					esc_html__( 'New window', 'valen-shortcodes' ) => '_blank',
				),
				'dependency' => array(
					'element' => 'use_link',
					'value' => 'true',
				),
				'param_name' => 'target',
			),
			$extra_class,
			vc_map_add_css_animation(),
		)
	));
}