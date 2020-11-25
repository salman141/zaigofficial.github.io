<?php
// SNS Hot Deals
add_shortcode('sns_hot_deals', 'valen_hot_deals_template');
add_action('vc_after_init', 'valen_hot_deals_settings');
function valen_hot_deals_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_woo_template('sns_hot_deals'))
        include $template;
    return ob_get_clean();
}
function valen_hot_deals_settings() {
	$extra_class = valen_extra_class();
	$woocat_value = valen_woo_cat();
	// Autocomplete product
    if ( class_exists('Vc_Vendor_Woocommerce') ){
        $valen_vcwoo = 'Vc_Vendor_Woocommerce';
        add_filter( 'vc_autocomplete_sns_hot_deals_ids_callback', array(&$valen_vcwoo, 'productIdAutocompleteSuggester',), 10, 1 ); // Get suggestion(find). Must return an array
        add_filter( 'vc_autocomplete_sns_hot_deals_ids_render', array(&$valen_vcwoo, 'productIdAutocompleteRender',), 10, 1 ); // Render exact product. Must return an array (label,value)
    }
	vc_map( array(
		"name" => esc_html__("SNS Hot Deals",'valen-shortcodes'),
		"base" => "sns_hot_deals",
		"icon" => "sns_icon_hot_deals",
		"class" => "sns_hot_deals",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "Show hot deals",'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'valen-shortcodes'),
				"param_name" => "title",
				"admin_label" => true,
				"value" =>  esc_html__("Hot Deals", 'valen-shortcodes'),
			),
			array(
				'type' => 'autocomplete',
				'heading' => __( 'Select product deals', 'valen-shortcodes' ),
				'param_name' => 'ids',
				'settings' => array(
					'multiple' => true,
					'sortable' => true,
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend
				),
				'save_always' => true,
				'description' => __( 'You can typing id or product name to input form. And should select products are On sale and have "Sale price dates to"', 'valen-shortcodes' ),
			),
			vc_map_add_css_animation(),
			$extra_class,
		)
	) );
}