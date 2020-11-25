<?php
// SNS Blog Page
add_shortcode('sns_blog_page', 'valen_blog_page_template');
add_action('vc_after_init', 'valen_blog_page_settings');
function valen_blog_page_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_blog_page'))
        include $template;
    return ob_get_clean();
}
function valen_blog_page_settings() {
	$extra_class = valen_extra_class();
	$css_animation = valen_css_animation();
	$cat_value = valen_cat();
	vc_map( array(
		"name" => esc_html__("SNS Blog Page",'valen-shortcodes'),
		"base" => "sns_blog_page",
		"icon" => "sns_icon_blogpage",
		"class" => "sns_blogpage",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "To create blog page with some style", 'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "checkbox",
				"value" => $cat_value,
				"class" => "",
				"heading" => esc_html__("Categories",'valen-shortcodes'),
				"description" => esc_html__( "If you dont sellect category, the default is sellected all category", 'valen-shortcodes' ),
				"param_name" => "category"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Blog Style",'valen-shortcodes'),
				"param_name" => "blog_type",
				"value" => array(
					esc_html__("Blog Default", "valen-shortcodes") 	=> "layout1",
					esc_html__("Blog List", "valen-shortcodes") 		=> "layout2",
					//esc_html__("Blog Masonry", "valen-shortcodes")	=>  "masonry",
				),
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Page Navigation",'valen-shortcodes'),
				"param_name" => "pagination",
				"value" => array(
					esc_html__("Default",'valen-shortcodes') => 'def',
					esc_html__("Ajax click load more",'valen-shortcodes') =>  'ajax',
					esc_html__("Ajax auto load more",'valen-shortcodes') =>  'ajax2'
				),
				'description' => esc_html__('Choose Type of navigation.','valen-shortcodes')
			),
            array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Number post with each load more",'valen-shortcodes'),
				"param_name" => "masonry_numload",
				"value" => "3",
				'dependency' => array(
					'element' => 'pagination',
					'value' => array('ajax', 'ajax2')
				),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Post per pages",'valen-shortcodes'),
				"param_name" => "posts_per_page",
				"value" => "6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Excerpt Length",'valen-shortcodes'),
				"param_name" => "excerpt_length",
				"value" => "75"
			),
			
			
			$css_animation,
			$extra_class,
		)
	) );
}