<?php
// SNS Info Box
// SNS Info Box
class WPBakeryShortCode_SNS_Info_Box extends WPBakeryShortCode {
	function __construct( $settings ) {
		parent::__construct( $settings );
	}
}
add_shortcode('sns_info_box', 'valen_info_box_template');
add_action('vc_after_init', 'valen_info_box_settings');
function valen_info_box_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_info_box'))
        include $template;
    return ob_get_clean();
}
function valen_info_box_settings() {
	$extra_class = valen_extra_class();
    vc_map( array(
		"name"  => esc_html__("SNS Info Box", 'valen-shortcodes'),
		"base" => "sns_info_box",
		"show_settings_on_create" => true ,
		"is_container" => false ,
		"icon" => "vc_icon_snstheme",
		"class" => "vc_icon_snstheme",
		"content_element" => true ,
		"category" => esc_html__('Valen', 'valen-shortcodes'),
		'description' => esc_html__( 'Box contain: icon, title, description', 'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "dropdown",
				'value' => array(
					esc_html__( 'Style 1', 'valen-shortcodes' ) => '1',
					esc_html__( 'Style 2', 'valen-shortcodes' ) => '2',
					esc_html__( 'Style 3', 'valen-shortcodes' ) => '3',
					esc_html__( 'Style 4', 'valen-shortcodes' ) => '4',
				),
				"heading" => esc_html__("Box style", 'valen-shortcodes'),
				"param_name" => "box_style"
		    ),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon library', 'valen-shortcodes' ),
				'value' => array(
					esc_html__( 'Media', 'valen-shortcodes' ) => 'media',
					esc_html__( 'Font Awesome', 'valen-shortcodes' ) => 'fontawesome',
					esc_html__( 'Flaticon', 'valen-shortcodes' ) => 'flaticon',
					esc_html__( 'Open Iconic', 'valen-shortcodes' ) => 'openiconic',
					esc_html__( 'Typicons', 'valen-shortcodes' ) => 'typicons',
					esc_html__( 'Entypo', 'valen-shortcodes' ) => 'entypo',
					esc_html__( 'Linecons', 'valen-shortcodes' ) => 'linecons',
				),
				'param_name' => 'icon_type',
				'description' => esc_html__( 'Select icon library.', 'valen-shortcodes' ),
			),
			array(
		      "type" => "attach_image",
		      "heading" => esc_html__("Image", 'valen-shortcodes'),
		      "param_name" => "icon_image",
		      'dependency' => array(
					'element' => 'icon_type',
					'value' => 'media',
			   ),
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
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'flaticon',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'flaticon',
				),
				'description' => esc_html__( 'Select icon from library.', 'valen-shortcodes' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'valen-shortcodes' ),
				'param_name' => 'icon_openiconic',
				'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'openiconic',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'openiconic',
				),
				'description' => esc_html__( 'Select icon from library.', 'valen-shortcodes' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'valen-shortcodes' ),
				'param_name' => 'icon_typicons',
				'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'typicons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'typicons',
				),
				'description' => esc_html__( 'Select icon from library.', 'valen-shortcodes' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'valen-shortcodes' ),
				'param_name' => 'icon_entypo',
				'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'entypo',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'entypo',
				),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'valen-shortcodes' ),
				'param_name' => 'icon_linecons',
				'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'linecons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'linecons',
				),
				'description' => esc_html__( 'Select icon from library.', 'valen-shortcodes' ),
			),
			array(
				"type" => "colorpicker",
				"value" => "",
				"heading" => esc_html__("Color for icon", 'valen-shortcodes'),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => array('linecons','fontawesome','entypo','typicons','openiconic'),
				),
				"param_name" => "icon_color"
		    ),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Font size for icon", 'valen-shortcodes'),
				"param_name" => "icon_font_size" ,
				"value" => esc_html__("22px",'valen-shortcodes'),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => array('linecons','fontawesome', 'flaticon', 'entypo','typicons','openiconic'),
				),
				"description" => esc_html__("It's font-size for icon you sellected, example: 24px", 'valen-shortcodes')
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Max width of icon", 'valen-shortcodes'),
				"param_name" => "max_width" ,
				"description" => esc_html__("It's max-width style for icon, example: 40px", 'valen-shortcodes'),
				// 'dependency' => array(
				// 	'element' => 'icon_type',
				// 	'value' => 'media',
			 //    ),
				"value" => esc_html__("", 'valen-shortcodes')
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Custom Link", 'valen-shortcodes'),
				"param_name" => "link" ,
				"description" => esc_html__("Enter the  link. Do't forget to include http:// ", 'valen-shortcodes'),
				"value" => esc_html__("http://", 'valen-shortcodes')
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", 'valen-shortcodes'),
				"param_name" => "title",
				"value" => esc_html__("Your Title Here ...",'valen-shortcodes'),
				"admin_label" => true 
			),
			array(
				'type' => 'textarea_html',
				"heading" => esc_html__("Description", 'valen-shortcodes'),
				"param_name" => "content",
				'dependency' => array(
					'element' => 'box_style',
					'value' => array('1', '2'),
				),
			),
			$extra_class,
			vc_map_add_css_animation(),
		)
	));
}