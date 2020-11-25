<?php
// SNS Product
add_shortcode('sns_360_degree_product', 'valen_360_degree_product_template');
add_action('vc_after_init', 'valen_360_degree_product_settings');
function valen_360_degree_product_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_woo_template('sns_360_degree_product'))
        include $template;
    return ob_get_clean();
}
function valen_360_degree_product_settings() {
	$extra_class = valen_extra_class();
	$woocat_value = valen_woo_cat();
	vc_map( array(
		"name" => esc_html__("SNS 360 Degree Product",'valen-shortcodes'),
		"base" => "sns_360_degree_product",
		"icon" => "sns_icon_products",
		"class" => "sns_360_degree_product",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "WooCommerce products",'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Product title",'valen-shortcodes'),
				"param_name" => "title",
				"admin_label" => true,
				"value" =>  esc_html__("Product title", 'valen-shortcodes'),
			),
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => __( 'Text', 'valen-shortcodes' ),
				'param_name' => 'content',
				'value' => __( '<p>The description of product here.</p>', 'valen-shortcodes' ),
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Link for peoduct', 'valen-shortcodes' ),
				'param_name' => 'plink',
				"admin_label" => true,
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Total frame",'valen-shortcodes'),
				"param_name" => "total_frame",
				"value" => "32",
				"group" => __( '360 Degree Settings', 'valen-shortcodes' ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Image Path",'valen-shortcodes'),
				"param_name" => "image_path",
				"value" => "",
				"group" => __( '360 Degree Settings', 'valen-shortcodes' ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("File prefix",'valen-shortcodes'),
				"param_name" => "file_prefix",
				"value" => "",
				"group" => __( '360 Degree Settings', 'valen-shortcodes' ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("File extension",'valen-shortcodes'),
				"param_name" => "file_ext",
				"value" => ".jpg",
				"group" => __( '360 Degree Settings', 'valen-shortcodes' ),
			),

			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Show navigation",'valen-shortcodes'),
				"param_name" => "navigation",
				"admin_label" => true,
				"value" => array(
					esc_html__("Yes",'valen-shortcodes') => '1',
					esc_html__("No",'valen-shortcodes') => '2',
				),
				"group" => __( '360 Degree Settings', 'valen-shortcodes' ),
			),
			
			vc_map_add_css_animation(),
			$extra_class,
		)
	) );
}