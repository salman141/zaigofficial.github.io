<?php
// SNS Cat Info
add_shortcode('sns_banner_product', 'valen_banner_product_template');
add_action('vc_after_init', 'valen_banner_product_settings');
function valen_banner_product_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_woo_template('sns_banner_product'))
        include $template;
    return ob_get_clean();
}
function valen_banner_product_settings() {
	$extra_class = valen_extra_class();
	$categories = valen_woo_cat(0);
	$woocat_value_drop =  array();
	valen_woo_cat_level(0, 0, $categories, 0, $woocat_value_drop);
	if ( class_exists('Vc_Vendor_Woocommerce') ){
        $valen_vcwoo = 'Vc_Vendor_Woocommerce';
        add_filter( 'vc_autocomplete_sns_banner_product_id_callback', array(&$valen_vcwoo, 'productIdAutocompleteSuggester',), 10, 1 ); // Get suggestion(find). Must return an array
        add_filter( 'vc_autocomplete_sns_banner_product_id_render', array(&$valen_vcwoo, 'productIdAutocompleteRender',), 10, 1 ); // Render exact product. Must return an array (label,value)
    }
	vc_map( array(
		"name" => esc_html__("SNS Banner Product",'valen-shortcodes'),
		"base" => "sns_banner_product",
		"icon" => "sns_icon_banner_product",
		"class" => "sns_banner_product",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "WooCommerce banner for a product",'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Banner for Product", 'valen-shortcodes'),
				"param_name" => "prd_image",
		    ),
			array(
				"type" => "dropdown",
				'multiple' => false,
				"heading" => esc_html__("Want to show category of product?",'valen-shortcodes'),
				"admin_label" => true,
				"value" => array(
					esc_html__("Yes",'valen-shortcodes') => '1',
					esc_html__("No",'valen-shortcodes') => '2',
				),
				"param_name" => "show_cat",
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
					'element' => 'show_cat',
					'value' => array('1'),
				),
			),
			array(
				'type' => 'autocomplete',
				'heading' => __( 'Select products', 'valen-shortcodes' ),
				'param_name' => 'id',
				'settings' => array(
					'multiple' => false,
					'sortable' => true,
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend
				),
				'save_always' => true,
				'description' => __( 'You can typing id or product name to input form. And should select products are On sale and Manage stock', 'valen-shortcodes' ),
			),
			array(
				"type" => "dropdown",
				'multiple' => false,
				"heading" => esc_html__("Want to show price of product?",'valen-shortcodes'),
				"admin_label" => true,
				"value" => array(
					esc_html__("No",'valen-shortcodes') => '1',
					esc_html__("Yes - Show default price",'valen-shortcodes') => '2',
					esc_html__("Yes - Show custom price",'valen-shortcodes') => '3',
				),
				"param_name" => "show_price",
			),
		    array(
				"type" => "textfield",
				"heading" => esc_html__("Want use price label?", 'valen-shortcodes'),
				"param_name" => "price_label",
				"value" => "",
				'description' => __( 'Example: From/Just...', 'valen-shortcodes' ),
				'dependency' => array(
					'element' => 'show_price',
					'value' => array('3'),
				),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Price of product", 'valen-shortcodes'),
				"param_name" => "price",
				"value" => "",
				'dependency' => array(
					'element' => 'show_price',
					'value' => array('3'),
				),
			),
			vc_map_add_css_animation(),
			$extra_class,
		)
	) );
}