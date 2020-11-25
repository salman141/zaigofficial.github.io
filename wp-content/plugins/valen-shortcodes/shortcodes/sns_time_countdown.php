<?php
// SNS Time Count Down
add_shortcode('sns_time_countdown', 'valen_time_countdown_template');
add_action('vc_after_init', 'valen_time_countdown_settings');
function valen_time_countdown_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_time_countdown'))
        include $template;
    return ob_get_clean();
}
function valen_time_countdown_settings() {
	$extra_class = valen_extra_class();
	vc_map( array(
		"name"  => esc_html__("SNS Time Count Down", 'valen-shortcodes'),
		"base" => "sns_time_countdown",
		"show_settings_on_create" => true ,
		"is_container" => false ,
		"icon" => "vc_icon_snstheme",
		"class" => "vc_icon_snstheme",
		"content_element" => true ,
		"category" => esc_html__('Valen', 'valen-shortcodes'),
		'description' => esc_html__( 'Show time count down', 'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => esc_html__("Date", 'valen-shortcodes'),
				"param_name" => "thedate" ,
				"value" => '2017/10/02',
				'description' => esc_html__( 'The format date is Y/m/d. EX: 2017/10/02', 'valen-shortcodes' ),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Style",'valen-shortcodes'),
				"param_name" => "style",
				"value" => array(
					esc_html__("Style1",'valen-shortcodes') => 'style1',
					esc_html__("Style2",'valen-shortcodes') => 'style2',
					esc_html__("Style3",'valen-shortcodes') => 'style3',
				),
			),
			vc_map_add_css_animation(),
			$extra_class,
		)
	));
}