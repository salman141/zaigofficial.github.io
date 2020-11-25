<?php
// SNS List Post
add_shortcode('sns_list_posts', 'valen_list_posts_template');
add_action('vc_after_init', 'valen_list_posts_settings');
function valen_list_posts_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_list_posts'))
        include $template;
    return ob_get_clean();
}
function valen_list_posts_settings() {
	$extra_class = valen_extra_class();
		vc_map( array(
		"name" => esc_html__("SNS List Post",'valen-shortcodes'),
		"base" => "sns_list_posts",
		"icon" => "sns_icon_listposts",
		"class" => "sns_listposts",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "Show List Posts", 'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'valen-shortcodes'),
				"param_name" => "title",
				"value" =>  esc_html__("Latest News",'valen-shortcodes'),
				"admin_label" => true,
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Want to show date?",'valen-shortcodes'),
				"param_name" => "show_date",
				"class" => "2",
				"value" => array(
					esc_html__("Yes",'valen-shortcodes') => '1',
					esc_html__("No",'valen-shortcodes') =>  '2',
				),
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Want to show author?",'valen-shortcodes'),
				"param_name" => "show_author",
				"class" => "2",
				"value" => array(
					esc_html__("Yes",'valen-shortcodes') => '1',
					esc_html__("No",'valen-shortcodes') =>  '2',
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Template style",'valen-shortcodes'),
				"param_name" => "style",
				"value" => array(
					esc_html__("Style1",'valen-shortcodes') =>  'style1',
					esc_html__("Style2 - Carousel",'valen-shortcodes') => 'style2',
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Want to choose thumbnail",'valen-shortcodes'),
				"param_name" => "thumbnail",
				"value" => array(
					esc_html__("No",'valen-shortcodes') => '',
					esc_html__("valen_blog_tiny_thumb",'valen-shortcodes') => 'valen_blog_tiny_thumb',
					esc_html__("valen_blog_small_thumb",'valen-shortcodes') => 'valen_blog_small_thumb',
					esc_html__("valen_blog_list_thumb",'valen-shortcodes') => 'valen_blog_list_thumb',
					esc_html__("valen_blog_special_thumb",'valen-shortcodes') => 'valen_blog_special_thumb',
					esc_html__("valen_blog_default_thumb",'valen-shortcodes') => 'valen_blog_default_thumb',
					esc_html__("WP thumbnail",'valen-shortcodes') => 'thumbnail',
					esc_html__("WP medium",'valen-shortcodes') => 'medium',
					esc_html__("WP large",'valen-shortcodes') => 'large',
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Posts number limit",'valen-shortcodes'),
				"param_name" => "number_limit",
				"value" => "4"
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Order By",'valen-shortcodes'),
				"param_name" => "orderby",
				"class" => "",
				"value" => array(
					esc_html__("Date",'valen-shortcodes') => 'date',
					esc_html__("Title",'valen-shortcodes') =>  'title',
					esc_html__("author",'valen-shortcodes') =>  'author',
					esc_html__("Random",'valen-shortcodes') =>  'rand',
					esc_html__("Comment Count",'valen-shortcodes') =>  'comment_count',
					esc_html__("Menu Order",'valen-shortcodes') =>  'menu_order',
				),
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Sort order",'valen-shortcodes'),
				"param_name" => "sortorder",
				"class" => "",
				"value" => array(
					esc_html__("ASC",'valen-shortcodes') => 'ASC',
					esc_html__("DESC",'valen-shortcodes') =>  'DESC',
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
					'value' => array('style3', 'style2'),
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
					'value' => array('style3', 'style2'),
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
					'value' => array('style3', 'style2'),
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
					'value' => array('style3', 'style2'),
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
					'value' => array('style3', 'style2'),
				),
			),
			vc_map_add_css_animation(),
			$extra_class,
		)
	) );
}