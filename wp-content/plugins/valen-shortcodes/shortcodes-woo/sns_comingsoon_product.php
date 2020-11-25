<?php
// SNS Product
add_shortcode('sns_comingsoon_product', 'valen_comingsoon_product_template');
add_action('vc_after_init', 'valen_comingsoon_product_settings');
function valen_comingsoon_product_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_woo_template('sns_comingsoon_product'))
        include $template;
    return ob_get_clean();
}
function valen_comingsoon_product_settings() {
	$extra_class = valen_extra_class();
	$woocat_value = valen_woo_cat();
	// Autocomplete product
    if ( class_exists('Vc_Vendor_Woocommerce') ){
        $valen_vcwoo = 'Vc_Vendor_Woocommerce';
        add_filter( 'vc_autocomplete_sns_comingsoon_product_ids_callback', array(&$valen_vcwoo, 'productIdAutocompleteSuggester',), 10, 1 ); // Get suggestion(find). Must return an array
        add_filter( 'vc_autocomplete_sns_comingsoon_product_ids_render', array(&$valen_vcwoo, 'productIdAutocompleteRender',), 10, 1 ); // Render exact product. Must return an array (label,value)
    }
	vc_map( array(
		"name" => esc_html__("SNS Coming Soon Product",'valen-shortcodes'),
		"base" => "sns_comingsoon_product",
		"icon" => "sns_icon_comingsoon_product",
		"class" => "sns_comingsoon_product",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "Show info about coming soon product",'valen-shortcodes' ),
		"params" => array(
			array(
				'type' => 'autocomplete',
				'heading' => __( 'Select coming soon product', 'valen-shortcodes' ),
				'param_name' => 'ids',
				'settings' => array(
					'multiple' => false,
					'sortable' => true,
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend
				),
				'save_always' => true,
				'description' => __( 'You can typing id or product name to input form.', 'valen-shortcodes' ),
			),
		    array(
		        "type" => "attach_image",
		        "heading" => esc_html__("Background image for box", 'valen-shortcodes'),
		        "param_name" => "bg",
		    ),
		    array(
				"type" => "textfield",
				"heading" => esc_html__("The date", 'valen-shortcodes'),
				"param_name" => "thedate" ,
				"value" => '2018/11/02',
				'description' => esc_html__( 'The format date is Y/m/d. EX: 2018/11/02', 'valen-shortcodes' ),
			),
		    array(
				'type' => 'textarea_html',
				"heading" => esc_html__("Description", 'valen-shortcodes'),
				"param_name" => "content"
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Want to use Post WCode to show Product Attribute", 'valen-shortcodes'),
				"param_name" => "wcode_pa",
				"value" => esc_html__("product-attributes",'valen-shortcodes'),
				'description' => esc_html__( 'Enter alias of your Post WCode', 'valen-shortcodes' ),
				"admin_label" => true 
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Pre text for Read More button", 'valen-shortcodes'),
				"param_name" => "pretext_readmore",
				"value" => esc_html__("Pre-order for 20%",'valen-shortcodes'),
				"admin_label" => true 
			),
			vc_map_add_css_animation(),
			$extra_class,
		)
	) );
}