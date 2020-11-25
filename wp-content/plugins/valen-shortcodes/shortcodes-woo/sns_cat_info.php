<?php
// SNS Cat Info
add_shortcode('sns_cat_info', 'valen_cat_info_template');
add_action('vc_after_init', 'valen_cat_info_settings');
function valen_cat_info_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_woo_template('sns_cat_info'))
        include $template;
    return ob_get_clean();
}
function valen_cat_info_settings() {
	$extra_class = valen_extra_class();
	$categories = valen_woo_cat(0);
	$woocat_value_drop =  array();
	valen_woo_cat_level(0, 0, $categories, 0, $woocat_value_drop);
	vc_map( array(
		"name" => esc_html__("SNS Cat Info",'valen-shortcodes'),
		"base" => "sns_cat_info",
		"icon" => "sns_icon_cat_info",
		"class" => "sns_cat_info",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "WooCommerce category info",'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Resource type",'valen-shortcodes'),
				"admin_label" => true,
				"param_name" => "r_type",
				"value" => array(
					esc_html__('From Product Category', 'valen-shortcodes') => "1",
					esc_html__('From custom input', 'valen-shortcodes') => "2",
				),
			),
			array(
				"type" => "dropdown",
				'multiple' => false,
				"heading" => esc_html__("Select category",'valen-shortcodes'),
				"admin_label" => true,
				"class" => "",
				"value" => $woocat_value_drop,
				"param_name" => "cat",
				'dependency' => array(
					'element' => 'r_type',
					'value' => array('1'),
				),
			),
			array(
		      	"type" => "textfield",
				"heading" => esc_html__("Want to use Custom Name for category?", "valen-shortcodes"),
				"param_name" => "ctitle",
				"admin_label" => true,
				'dependency' => array(
					'element' => 'r_type',
					'value' => array('1'),
				),
		    ),
		    array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Link for Category', 'valen-shortcodes' ),
				'param_name' => 'clink',
				"admin_label" => true,
				'dependency' => array(
					'element' => 'r_type',
					'value' => array('2'),
				),
			),
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Image for Category", 'valen-shortcodes'),
				"param_name" => "cat_image",
		    ),
			vc_map_add_css_animation(),
			$extra_class,
		)
	) );
}