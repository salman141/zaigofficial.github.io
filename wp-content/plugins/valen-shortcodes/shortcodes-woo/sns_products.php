<?php
// SNS Product
add_shortcode('sns_products', 'valen_products_template');
add_action('vc_after_init', 'valen_products_settings');
function valen_products_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_woo_template('sns_products'))
        include $template;
    return ob_get_clean();
}
function valen_products_settings() {
	$extra_class = valen_extra_class();
	$woocat_value = valen_woo_cat();
	vc_map( array(
		"name" => esc_html__("SNS Products",'valen-shortcodes'),
		"base" => "sns_products",
		"icon" => "sns_icon_products",
		"class" => "sns_products",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "WooCommerce products",'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Text before Title",'valen-shortcodes'),
				"param_name" => "before_title",
				"admin_label" => true,
				"value" =>  "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'valen-shortcodes'),
				"param_name" => "title",
				"admin_label" => true,
				"value" =>  esc_html__("New Products", 'valen-shortcodes'),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Text after Title",'valen-shortcodes'),
				"param_name" => "after_title",
				"admin_label" => true,
				"value" =>  "",
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"value" => $woocat_value,
				"heading" => esc_html__("Select Category",'valen-shortcodes'),
				"param_name" => "lit_cat",
				"description" => esc_html__("If you don't select any category, It mean is selected all category", 'valen-shortcodes')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Order By",'valen-shortcodes'),
				"param_name" => "orderby",
				"value" => array(
					esc_html__('Latest products', 'valen-shortcodes') => "recent",
					esc_html__('Best seller products', 'valen-shortcodes') => "best_selling",
					esc_html__('Top rated products', 'valen-shortcodes') => "top_rate",
					esc_html__('On sale products', 'valen-shortcodes') => "on_sale",
					esc_html__('Hot deal', 'valen-shortcodes') => "hot_deal",
					esc_html__('Featured products', 'valen-shortcodes') => "featured_product",
					esc_html__('Recent review', 'valen-shortcodes') => "recent_review",
				),
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Mode View",'valen-shortcodes'),
				"param_name" => "modeview",
				"admin_label" => true,
				"value" => array(
					esc_html__("Gird",'valen-shortcodes') => '1',
					esc_html__("List",'valen-shortcodes') => '2',
				),
				"description" => esc_html__("Mode View", 'valen-shortcodes')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Grid style",'valen-shortcodes'),
				"param_name" => "gridstyle",
				"admin_label" => true,
				"value" => array(
					esc_html__("Style 1",'valen-shortcodes') => '',
					esc_html__("Style 2",'valen-shortcodes') => '2',
					esc_html__("Style 3",'valen-shortcodes') => '3',
					esc_html__("Style 4",'valen-shortcodes') => '4',
				),
				'dependency' => array(
					'element' => 'modeview',
					'value' => '1',
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Thumbnail type",'valen-shortcodes'),
				"param_name" => "thumb_type",
				"value" => array(
					esc_html__("Shop Thumbnail",'valen-shortcodes') => '',
					esc_html__("Valen 90x68 Thumbnail",'valen-shortcodes') => '9068',
					esc_html__("Valen 90x123 Thumbnail",'valen-shortcodes') => '90123',
				),
				'dependency' => array(
					'element' => 'modeview',
					'value' => '2',
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Use Navigation",'valen-shortcodes'),
				"param_name" => "use_nav",
				"value" => array(
					esc_html__("Yes",'valen-shortcodes') => '1',
					esc_html__("No",'valen-shortcodes') => '2',
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Navigation position",'valen-shortcodes'),
				"param_name" => "nav_pos",
				"value" => array(
					esc_html__("In middle box - Default",'valen-shortcodes') => 'middlebox',
					esc_html__("In top right",'valen-shortcodes') => 'topright',
					esc_html__("In top center",'valen-shortcodes') => 'topcenter',
					
				),
				'dependency' => array(
					'element' => 'use_nav',
					'value' => '1',
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Use Paging",'valen-shortcodes'),
				"param_name" => "use_paging",
				"value" => array(
					esc_html__("No",'valen-shortcodes') => '2',
					esc_html__("Yes",'valen-shortcodes') => '1',
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Product number limit",'valen-shortcodes'),
				"param_name" => "number_limit",
				"value" => "10",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Row per Column",'valen-shortcodes'),
				"param_name" => "number_row",
				"value" => "1"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Column display screen Desktop",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				"param_name" => "number_desktop",
				"value" => "5"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Column display screen Laptop",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				"param_name" => "number_laptop",
				"value" => "5"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Column display screen Tablet Landscape",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				"param_name" => "number_tablet",
				"value" => "4"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Column display screen Tablet Portrait",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				"param_name" => "number_tabletp",
				"value" => "4"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Column display Mobile Landscape",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				"param_name" => "number_mobilel",
				"value" => "2"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Column display screen Mobile Portrait",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				"param_name" => "number_mobilep",
				"value" => "1"
			),
			vc_map_add_css_animation(),
			$extra_class,
		)
	) );
}