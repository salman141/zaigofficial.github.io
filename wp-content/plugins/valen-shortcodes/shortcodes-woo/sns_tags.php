<?php
// SNS Product/Post Tags
add_shortcode('sns_tags', 'valen_tags_template');
add_action('vc_after_init', 'valen_tags_settings');
function valen_tags_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_woo_template('sns_tags'))
        include $template;
    return ob_get_clean();
}
function valen_tags_settings() {
	$extra_class = valen_extra_class();
	$tags_woo = valen_woo_tags_array();
	vc_map( array(
		"name" => esc_html__("SNS Tags",'valen-shortcodes'),
		"base" => "sns_tags",
		"icon" => "sns_icon_tags",
		"class" => "sns_tags",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "Display tags of Products/Post",'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'valen-shortcodes'),
				"param_name" => "title",
				"admin_label" => true,
				"value" =>  "",
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Tags Display",'valen-shortcodes'),
				"param_name" => "tags_display",
				"value" => array(
					esc_html__('For select', 'valen-shortcodes') => "select",
					esc_html__('Query for limit', 'valen-shortcodes') => "query",
				),
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Tag Taxonomy",'valen-shortcodes'),
				"param_name" => "tag_taxonomy",
				"value" => array(
					esc_html__('Post', 'valen-shortcodes') => "post_tag",
					esc_html__('Product', 'valen-shortcodes') => "product_tag",
				),
				'dependency' => array(
					'element' => 'tags_display',
					'value' => 'query',
				),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Tag number limit",'valen-shortcodes'),
				"param_name" => "number_limit",
				"value" => "10",
				"description" => esc_html__( "The number to query tags for display",'valen-shortcodes' ),
				'dependency' => array(
					'element' => 'tags_display',
					'value' => 'query',
				),
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => esc_html__("Tag List",'valen-shortcodes'),
				"param_name" => "tag_list",
				"value" => $tags_woo,
				'dependency' => array(
					'element' => 'tags_display',
					'value' => 'select',
				),
			),
			
			vc_map_add_css_animation(),
			$extra_class,
		)
	) );
}