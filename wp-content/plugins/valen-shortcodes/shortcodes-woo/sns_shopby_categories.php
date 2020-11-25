<?php
// SNS Product
add_shortcode('sns_shopby_categories', 'valen_shopby_categories_template');
add_action('vc_after_init', 'valen_shopby_categories_settings');
function valen_shopby_categories_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_woo_template('sns_shopby_categories'))
        include $template;
    return ob_get_clean();
}
function valen_shopby_categories_settings() {
	$extra_class = valen_extra_class();
	$woocat_value = valen_woo_cat();
	vc_map( array(
		"name" => esc_html__("SNS Shop by Categories",'valen-shortcodes'),
		"base" => "sns_shopby_categories",
		"icon" => "sns_icon_products",
		"class" => "sns_shopby_categories",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "Display categories shop",'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'valen-shortcodes'),
				"param_name" => "title",
				"admin_label" => true,
				"value" =>  esc_html__("Your Main Category Name", 'valen-shortcodes'),
			),
			array(
		      "type" => "attach_image",
		      "heading" => esc_html__("Image for this box - main category", 'valen-shortcodes'),
		      "param_name" => "cat_image",
		    ),
			array(
				"type" => "checkbox",
				"class" => "",
				"value" => $woocat_value,
				"heading" => esc_html__("Select Category List",'valen-shortcodes'),
				"param_name" => "lit_cat",
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Want to use link View All?', 'valen-shortcodes' ),
				'param_name' => 'link',
			),
			vc_map_add_css_animation(),
			$extra_class,
		)
	) );
}