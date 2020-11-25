<?php
// SNS Carousel
add_shortcode('sns_grid_items', 'valen_grid_items_template');
add_action('vc_after_init', 'valen_grid_item_settings');
function valen_grid_items_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_grid_items'))
        include $template;
    return ob_get_clean();
}
function valen_grid_item_settings() {
	//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    	class WPBakeryShortCode_SNS_Grid_Items extends WPBakeryShortCodesContainer {}
    }
	$extra_class = valen_extra_class();
	$css_animation = valen_css_animation();
	if ( function_exists('vc_map') ) vc_map( array(
		"name"  => esc_html__("SNS Grid Items", 'valen-shortcodes'),
		"base" => "sns_grid_items",
		"icon" => "vc_icon_snstheme",
		"class" => "vc_icon_snstheme",
		"content_element" => true ,
		"category" => esc_html__('Valen', 'valen-shortcodes'),
		"description" => esc_html__( 'A grid contain items', 'valen-shortcodes' ),
		"as_parent" => array('except' => 'sns_grid_items'),
	    // "content_element" => true,
	    // "show_settings_on_create" => true,
	    // "is_container" => true,
	    "js_view" => 'VcColumnView',
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number column/row on Desktop",'valen-shortcodes'),
				"param_name" => "n_desktop",
				"value" => esc_html__("1",'valen-shortcodes'),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number column/row on Tablet Landscape",'valen-shortcodes'),
				"param_name" => "n_tablet",
				"value" => esc_html__("1",'valen-shortcodes'),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Number column/row on Tablet Portrait",'valen-shortcodes'),
				"param_name" => "n_tabletp",
				"admin_label" => true,
				"value" =>  esc_html__("1", 'valen-shortcodes'),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number column/row on Mobile Landscape",'valen-shortcodes'),
				"param_name" => "n_mobile_l",
				"value" => esc_html__("1",'valen-shortcodes'),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number column/row on Mobile Portrait",'valen-shortcodes'),
				"param_name" => "n_mobile_p",
				"value" => esc_html__("1",'valen-shortcodes'),
			),
			$extra_class,
			vc_map_add_css_animation(),
		)
	) );
}