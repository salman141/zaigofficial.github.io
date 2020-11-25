<?php
// SNS Instagram
add_shortcode('sns_instagram', 'valen_instagram_template');
add_action('vc_after_init', 'valen_instagram_settings');
function valen_instagram_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_instagram'))
        include $template;
    return ob_get_clean();
}
function valen_instagram_settings() {
	$extra_class = valen_extra_class();
		vc_map( array(
		"name" => esc_html__("SNS Instagram",'valen-shortcodes'),
		"base" => "sns_instagram",
		"icon" => "sns_icon_listposts",
		"class" => "sns_listposts",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "Show instagram feed", 'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'valen-shortcodes'),
				"param_name" => "title",
				"value" =>  esc_html__("Instagram",'valen-shortcodes'),
				"admin_label" => true,
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Dispplay type",'valen-shortcodes'),
				"param_name" => "type",
				"class" => "",
				"value" => array(
					esc_html__("New feed",'valen-shortcodes') => 'new',
					esc_html__("By tag",'valen-shortcodes') =>  'tag',
				),
				"admin_label" => true,
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Tag name",'valen-shortcodes'),
				"param_name" => "tag",
				"value" =>  esc_html__("sns_valen",'valen-shortcodes'),
				'dependency' => array(
					'element' => 'type',
					'value' => array('tag'),
				),
			),
			// array(
			// 	"type" => "textfield",
			// 	"class" => "",
			// 	"heading" => esc_html__("User id",'valen-shortcodes'),
			// 	"param_name" => "user_id",
			// 	"value" =>  esc_html__("5922978930",'valen-shortcodes'),
			// 	'dependency' => array(
			// 		'element' => 'type',
			// 		'value' => array('new'),
			// 	),
			// 	"admin_label" => true,
			// ), 
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Access token",'valen-shortcodes'),
				"param_name" => "access_token",
				"value" =>  esc_html__("IGQVJWaXVJaWhzbnVneEpiVjF5dmFlZAzBXMjNJZAVFhaUhDT1J0QWtDMGtfcnlESHBwWmdjbjZAkOHBsNjljNWtHSnBKdnZAYWDdxaFl4TzFoTWJwWUYtYnVqdDBtX1RyclFycHBlY3NrT3lkTkhmb05JawZDZD",'valen-shortcodes'),
				"admin_label" => true,
				'description' => __( 'How to get: User id and your domain http://domain.com to get Access token', 'valen-shortcodes' ),
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Dispplay style",'valen-shortcodes'),
				"param_name" => "style",
				"value" => array(
					esc_html__("Grid",'valen-shortcodes') =>  'grid',
					esc_html__("Carousel",'valen-shortcodes') => 'carousel',
				),
				"admin_label" => true,
			),
			// array(
			// 	"type" => "dropdown",
			// 	"class" => "",
			// 	"heading" => esc_html__("Photo size",'valen-shortcodes'),
			// 	"param_name" => "size",
			// 	"value" => array(
			// 		esc_html__("Standard",'valen-shortcodes') => '',
			// 		esc_html__("Low",'valen-shortcodes') => 'low',
			// 		esc_html__("Thumbnail",'valen-shortcodes') => 'thumbnail',
			// 	),
			// ),

			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number limit",'valen-shortcodes'),
				"param_name" => "limit",
				"value" => "8"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Column on row",'valen-shortcodes'),
				"param_name" => "number",
				"value" => "4",
				'dependency' => array(
					'element' => 'style',
					'value' => array('grid'),
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Column display screen Desktop",'valen-shortcodes'),
				"param_name" => "number_desktop",
				"value" => "5",
				'dependency' => array(
					'element' => 'style',
					'value' => array('carousel'),
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Column display screen Tablet Landscape",'valen-shortcodes'),
				"param_name" => "number_tablet",
				"value" => "4",
				'dependency' => array(
					'element' => 'style',
					'value' => array('carousel'),
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Column display screen Tablet Portrait",'valen-shortcodes'),
				"param_name" => "number_tabletp",
				"value" => "4",
				'dependency' => array(
					'element' => 'style',
					'value' => array('carousel'),
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Column display Mobile Landscape",'valen-shortcodes'),
				"param_name" => "number_mobilel",
				"value" => "2",
				'dependency' => array(
					'element' => 'style',
					'value' => array('carousel'),
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number Column display screen Mobile Portrait",'valen-shortcodes'),
				"param_name" => "number_mobilep",
				"value" => "1",
				'dependency' => array(
					'element' => 'style',
					'value' =>array('carousel'),
				),
			),
			vc_map_add_css_animation(),
			$extra_class,
		)
	) );
}