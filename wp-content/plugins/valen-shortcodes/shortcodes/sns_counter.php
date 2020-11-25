<?php
// SNS Member
add_shortcode('sns_counter', 'valen_counter_template');
add_action('vc_after_init', 'valen_counter_settings');
function valen_counter_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_counter'))
        include $template;
    return ob_get_clean();
}
function valen_counter_settings() {
	$extra_class = valen_extra_class();
	vc_map( array(
		"name"  => esc_html__("SNS Counter", 'valen-shortcodes'),
		"base" => "sns_counter",
		"show_settings_on_create" => true ,
		"is_container" => false ,
		"icon" => "vc_icon_snstheme",
		"class" => "vc_icon_snstheme",
		"content_element" => true ,
		"category" => esc_html__('Valen', 'valen-shortcodes'),
		'description' => esc_html__( 'Display box count to', 'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Use icon?","valen-shortcodes"),
				"param_name" => "enable_icon",
				"value" => array(
					esc_html__('Icon font', 'valen-shortcodes') => "1",
					esc_html__('Image', 'valen-shortcodes') => "2",
					esc_html__('No', 'valen-shortcodes') => "0"
				),
				"description" => ""
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon library', 'valen-shortcodes' ),
				'value' => array(
					esc_html__( 'Font Awesome', 'valen-shortcodes' ) => 'fontawesome',
					esc_html__( 'Linecons', 'valen-shortcodes' ) => 'linecons',
				),
				'param_name' => 'icon_type',
				'description' => esc_html__( 'Select icon library.', 'valen-shortcodes' ),
				'dependency' => array(
					'element' => 'enable_icon',
					'value' => '1',
				),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'valen-shortcodes' ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-adjust', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
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
				"heading" => esc_html__("Color for icon", "valen-shortcodes"),
				"param_name" => "icon_color",
				'dependency' => array(
					'element' => 'enable_icon',
					'value' => '1',
				),
		    ),
		    array(
		      	"type" => "attach_image",
		      	"heading" => esc_html__("Icon image", "valen-shortcodes"),
		      	"param_name" => "icon_image",
		      	'dependency' => array(
					'element' => 'enable_icon',
					'value' => '2',
			   	),
		    ),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Font size for icon", "valen-shortcodes"),
				"param_name" => "icon_font_size" ,
				"description" => esc_html__("It's font-size for icon you sellected, example: 24px", "valen-shortcodes"),
				'dependency' => array(
					'element' => 'enable_icon',
					'value' => '1',
				),
			),
	  
		  	array(
		      "type" => "textfield",
		      "heading" => esc_html__("Value to Count", "valen-shortcodes"),
		      "param_name" => "value" ,
			  "description" => "This value must be an integer", 
			  "admin_label" => true
		    ),
		    array(
				"type" => "colorpicker",
				"value" => "",
				"heading" => esc_html__("Color for Value", "valen-shortcodes"),
				"param_name" => "value_color"
		    ),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Font size for Value", "valen-shortcodes"),
				"param_name" => "value_font_size" ,
				"description" => esc_html__("It's font-size for Value, example: 18px", "valen-shortcodes")
			),
		    array(
		      "type" => "textfield",
		      "heading" => esc_html__("Unit", "valen-shortcodes"),
		      "param_name" => "unit",
			  "description" => 'You can use any text such as % , cm or any other . Leave Blank if you do not want to display any unit value'
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => esc_html__("Counter Title", "valen-shortcodes"),
		      "param_name" => "title" ,
			  "value" => esc_html__("Your Title Goes Here...","valen-shortcodes"),
		    ),
		    array(
				"type" => "colorpicker",
				"value" => "",
				"heading" => esc_html__("Color for Title", "valen-shortcodes"),
				"param_name" => "title_color"
		    ),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Font size for Title", "valen-shortcodes"),
				"param_name" => "title_font_size" ,
				"description" => esc_html__("It's font-size for Title, example: 12px", "valen-shortcodes")
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("From to count", "valen-shortcodes"),
				"param_name" => "from" ,
				"value"		=> "0",
				"description" => esc_html__("The number the element should start at, example: 0", "valen-shortcodes")
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Speed to count", "valen-shortcodes"),
				"param_name" => "speed",
				"value"		=> "900",
				"description" => esc_html__("How long it should take to count between the target numbers, example: 900", "valen-shortcodes")
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Interval to count", "valen-shortcodes"),
				"param_name" => "interval",
				"value"		=> "10",
				"description" => esc_html__("How often the element should be updated, example: 10", "valen-shortcodes")
			),
			$extra_class,
			vc_map_add_css_animation(),
	  	)

	));
}