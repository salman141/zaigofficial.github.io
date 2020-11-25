<?php
// VALEN Product Ajax Tab
add_shortcode('valen_products_ajaxtab', 'valen_products_ajaxtab_template');
add_action('vc_after_init', 'valen_products_ajaxtab_settings');
function valen_products_ajaxtab_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_woo_template('valen_products_ajaxtab'))
        include $template;
    return ob_get_clean();
}
function valen_products_ajaxtab_settings() {
	$extra_class = valen_extra_class();
	$woocat_value = valen_woo_cat();
	$categories = valen_woo_cat(0);
	$woocat_value_drop =  array();
	valen_woo_cat_level(0, 0, $categories, 0, $woocat_value_drop);

	vc_map( array(
		"name" => esc_html__("Products Ajax Tab",'valen-shortcodes'),
		"base" => "valen_products_ajaxtab",
		"icon" => "icon_valen_products_ajaxtab",
		"class" => "valen_products_ajaxtab",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "Products Ajax Tab",'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title",'valen-shortcodes'),
				"param_name" => "title",
				"admin_label" => true,
				"value" =>  esc_html__("The title", 'valen-shortcodes'),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Tab by?",'valen-shortcodes'),
				"param_name" => "tab_type",
				"admin_label" => true,
				"value" => array(
					esc_html__("Order by",'valen-shortcodes') => '1',
					esc_html__("Category",'valen-shortcodes') => '2',
				),
			),
			array(
				"type" => "checkbox",
				"heading" => esc_html__("Select tab to display",'valen-shortcodes'),
				"param_name" => "orderby_tab",
				"value" => array(
					esc_html__('Latest', 'valen-shortcodes') => "recent",
					esc_html__('Best Seller', 'valen-shortcodes') => "best_selling",
					esc_html__('Top Rated', 'valen-shortcodes') => "top_rate",
					esc_html__('Special', 'valen-shortcodes') => "on_sale",
					esc_html__('Featured', 'valen-shortcodes') => "featured_product",
					esc_html__('Recent Review', 'valen-shortcodes') => "recent_review",
				),
				"description" => "",
				'dependency' => array(
					'element' => 'tab_type',
					'value' => '1',
				),
			),
			array(
				"type" => "checkbox",
				"heading" => esc_html__("Select tab to display",'valen-shortcodes'),
				"param_name" => "cat_tab",
				"value" => $woocat_value,
				"description" => "",
				'dependency' => array(
					'element' => 'tab_type',
					'value' => '2',
				),
			),
			array(
				"type" => "dropdown",
				'multiple' => false,
				"heading" => esc_html__("Want to show total product in category?",'valen-shortcodes'),
				"admin_label" => true,
				"value" => array(
					esc_html__("Yes",'valen-shortcodes') => '1',
					esc_html__("No",'valen-shortcodes') => '2',
				),
				"param_name" => "show_cat_number",
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Want to show tab All Category?",'valen-shortcodes'),
				"param_name" => "show_tab_all",
				"value" => array(
					esc_html__('Yes', 'valen-shortcodes') => "1",
					esc_html__('No', 'valen-shortcodes') => "2",
				),
				'dependency' => array(
					'element' => 'tab_type',
					'value' => '2',
				),
			),
			array(
		        "type" => "attach_images",
		        "heading" => esc_html__("Background image(or banner) for each tab content", 'valen-shortcodes'),
		        "param_name" => "image_tabcontent",
		        'description' => esc_html__( 'Drag and drop image to sort oder. The oder of image is the same with the oder of tab above', 'valen-shortcodes' ),
		        'dependency' => array(
					'element' => 'content_tab_template',
					'value' => array('3', '4'),
				),
		    ),
			array(
				"type" => "checkbox",
				"value" => $woocat_value,
				"heading" => esc_html__("Choice categories",'valen-shortcodes'),
				"param_name" => "cat",
				"description" => esc_html__('If you dont choice, That mean it will query all category','valen-shortcodes'),
				'dependency' => array(
					'element' => 'tab_type',
					'value' => '1',
				),
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Order by",'snsmarket-shortcodes'),
				"param_name" => "orderby",
				"value" => array(
					esc_html__('Latest', 'valen-shortcodes') => "recent",
					esc_html__('Best Seller', 'valen-shortcodes') => "best_selling",
					esc_html__('Top Rated', 'valen-shortcodes') => "top_rate",
					esc_html__('Special', 'valen-shortcodes') => "on_sale",
					esc_html__('Featured', 'valen-shortcodes') => "featured_product",
					esc_html__('Recent Review', 'valen-shortcodes') => "recent_review",
				),
				'dependency' => array(
					'element' => 'tab_type',
					'value' => '2',
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Product style",'valen-shortcodes'),
				"param_name" => "gridstyle",
				"admin_label" => true,
				"value" => array(
					esc_html__("Style 1",'valen-shortcodes') => '',
					esc_html__("Style 2",'valen-shortcodes') => '2',
					esc_html__("Style 3",'valen-shortcodes') => '3',
					esc_html__("Style 4",'valen-shortcodes') => '4',
				),
			),
			array(
				"type" => "dropdown",
				'multiple' => true,
				"class" => "",
				"value" => array(
					esc_html__('No Effect', 'valen-shortcodes') => "simple-effect",
					esc_html__('fadeIn', 'valen-shortcodes') => "fadeIn",
					esc_html__('fadeInUp', 'valen-shortcodes') => "fadeInUp",
					esc_html__('fadeInDown', 'valen-shortcodes') => "fadeInDown",
					esc_html__('fadeInRight', 'valen-shortcodes') => "fadeInRight",
					esc_html__('fadeInLeft', 'valen-shortcodes') => "fadeInLeft",
					esc_html__('bounceIn', 'valen-shortcodes') => "bounceIn",
					esc_html__('bounceInUp', 'valen-shortcodes') => "bounceInUp",
					esc_html__('bounceInDown', 'valen-shortcodes') => "bounceInDown",
					esc_html__('bounceInLeft', 'valen-shortcodes') => "bounceInLeft",
					esc_html__('bounceInRight', 'valen-shortcodes') => "bounceInRight",
					esc_html__('zoomIn', 'valen-shortcodes') => "zoomIn",
					esc_html__('zoomInUp', 'valen-shortcodes') => "zoomInUp",
					esc_html__('zoomInDown', 'valen-shortcodes') => "zoomInDown",
					esc_html__('zoomInLeft', 'valen-shortcodes') => "zoomInLeft",
					esc_html__('zoomInRight', 'valen-shortcodes') => "zoomInRight",

				),
				"heading" => esc_html__("Effect to show product in tab",'valen-shortcodes'),
				"param_name" => "effect",
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Template for each tab content",'valen-shortcodes'),
				"param_name" => "content_tab_template",
				"admin_label" => true,
				"value" => array(
					esc_html__("Carousel",'valen-shortcodes') => '1',
					esc_html__("Grid and Load more button",'valen-shortcodes') => '2',
					esc_html__("Carousel - Special template 1",'valen-shortcodes') => '3',
					esc_html__("Carousel - Special template 2",'valen-shortcodes') => '4',
					esc_html__("Carousel - Special template 3",'valen-shortcodes') => '5',
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
				'dependency' => array(
					'element' => 'content_tab_template',
					'value' => array('1', '3', '4', '5'),
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
				'dependency' => array(
					'element' => 'content_tab_template',
					'value' => array('1', '3', '4', '5'),
				),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Number product limit for each tab",'valen-shortcodes'),
				"param_name" => "number_limit",
				"admin_label" => true,
				"value" =>  esc_html__("16", 'valen-shortcodes'),
				'dependency' => array(
					'element' => 'content_tab_template',
					'value' => array('1', '3', '4', '5'),
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number product will show more with each click load more button",'valen-shortcodes'),
				"param_name" => "num_showmore",
				"value" => "6",
				'dependency' => array(
					'element' => 'content_tab_template',
					'value' => '2',
				),
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
				"heading" => esc_html__("Number product per column to display on Desktop",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				"param_name" => "number_desktop",
				"admin_label" => true,
				"value" =>  esc_html__("5", 'valen-shortcodes'),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Number product per column to display on Tablet Landscape",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				"param_name" => "number_tablet",
				"admin_label" => true,
				"value" =>  esc_html__("3", 'valen-shortcodes'),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Number product per column to display on Tablet Portrait",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				"param_name" => "number_tabletp",
				"admin_label" => true,
				"value" =>  esc_html__("2", 'valen-shortcodes'),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Number product per column to display on Mobile Landscape",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				"param_name" => "number_mobilel",
				"admin_label" => true,
				"value" =>  esc_html__("2", 'valen-shortcodes'),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Number product per column to display on Nobile Portrait",'valen-shortcodes'),
				"group" => __( 'Column settings', 'valen-shortcodes' ),
				"param_name" => "number_mobilep",
				"admin_label" => true,
				"value" =>  esc_html__("1", 'valen-shortcodes'),
			),
			vc_map_add_css_animation(),
			$extra_class,
		)
	) );
}