<?php
// SNS Carousel
add_shortcode('sns_carousel', 'valen_carousel_template');
add_action('vc_after_init', 'valen_carousel_settings');
function valen_carousel_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_carousel'))
        include $template;
    return ob_get_clean();
}
function valen_carousel_settings() {
	//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    	class WPBakeryShortCode_SNS_Carousel extends WPBakeryShortCodesContainer {}
    }
	$extra_class = valen_extra_class();
	$css_animation = valen_css_animation();
	if ( function_exists('vc_map') ) vc_map( array(
		"name" => esc_html__("SNS Carousel",'valen-shortcodes'),
		"base" => "sns_carousel",
		"class" => "sns_carousel",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "Carousel for other shortcodes",'valen-shortcodes' ),

	    "as_parent" => array('except' => 'sns_carousel'),
	    "content_element" => true,
	    "show_settings_on_create" => true,
	    "is_container" => true,
	    "js_view" => 'VcColumnView',

	    "params" => array(
	        // add params same as with any other content element
	        array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'valen-shortcodes'),
				"param_name" => "title",
				"admin_label" => true,
				"value" => "",
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Slider Type",'valen-shortcodes'),
				"param_name" => "slider_type",
				"value" => array(
					esc_html__("Horizontal",'valen-shortcodes') => 'h',
					esc_html__("Horizontal center mode",'valen-shortcodes') => 'h-c',
					esc_html__("Horizontal Syncing with pagging",'valen-shortcodes') => 'h-s',
					esc_html__("Vertical",'valen-shortcodes') =>  'v'
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Show Navigation",'valen-shortcodes'),
				"param_name" => "show_nav",
				"value" => array(
					esc_html__("No",'valen-shortcodes') => '0',
					esc_html__("Yes",'valen-shortcodes') =>  '1'
				),
				'dependency' => array(
					'element' => 'slider_type',
					'value' => array('h', 'v' , 'h-c')
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Show Paging",'valen-shortcodes'),
				"param_name" => "show_paging",
				"value" => array(
					esc_html__("No",'valen-shortcodes') => '0',
					esc_html__("Yes",'valen-shortcodes') =>  '1'
				),
				'dependency' => array(
					'element' => 'slider_type',
					'value' => array('h', 'v')
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Auto play",'valen-shortcodes'),
				"param_name" => "autoplay",
				"value" => array(
					esc_html__("Yes",'valen-shortcodes') => '1',
					esc_html__("No",'valen-shortcodes') =>  '0'
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number row on column",'valen-shortcodes'),
				"param_name" => "row",
				"value" => esc_html__("1",'valen-shortcodes'),
				'dependency' => array(
					'element' => 'slider_type',
					'value' => array('h', 'v')
				),
			),
	        array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number items on Desktop",'valen-shortcodes'),
				"param_name" => "n_desktop",
				"value" => esc_html__("1",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				'dependency' => array(
					'element' => 'slider_type',
					'value' => array('h')
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number items on Tablet Landscape",'valen-shortcodes'),
				"param_name" => "n_tablet",
				"value" => esc_html__("1",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				'dependency' => array(
					'element' => 'slider_type',
					'value' => array('h')
				),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Number items on Tablet Portrait",'valen-shortcodes'),
				"param_name" => "n_tabletp",
				"admin_label" => true,
				"value" =>  esc_html__("1", 'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				'dependency' => array(
					'element' => 'slider_type',
					'value' => array('h')
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number items on Mobile Landscape",'valen-shortcodes'),
				"param_name" => "n_mobile_l",
				"value" => esc_html__("1",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				'dependency' => array(
					'element' => 'slider_type',
					'value' => array('h')
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number items on Mobile Portrait",'valen-shortcodes'),
				"param_name" => "n_mobile_p",
				"value" => esc_html__("1",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				'dependency' => array(
					'element' => 'slider_type',
					'value' => array('h')
				),
			),
			$css_animation,
			$extra_class,
	    ),
	) );
}
