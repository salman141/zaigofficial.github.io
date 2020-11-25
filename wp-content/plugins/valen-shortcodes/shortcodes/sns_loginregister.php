<?php
// SNS Info Box
add_shortcode('sns_loginregister', 'valen_loginregistertemplate');
add_action('vc_after_init', 'valen_loginregistersettings');
function valen_loginregistertemplate($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_loginregister'))
        include $template;
    return ob_get_clean();
}
function valen_loginregistersettings() {
	$extra_class = valen_extra_class();
    vc_map( array(
		"name"  => esc_html__("SNS Login and Register", 'valen-shortcodes'),
		"base" => "sns_loginregister",
		"show_settings_on_create" => true ,
		"is_container" => false ,
		"icon" => "vc_icon_snstheme",
		"class" => "vc_icon_snstheme",
		"content_element" => true ,
		"category" => esc_html__('Valen', 'valen-shortcodes'),
		'description' => esc_html__( 'Contain login, register link, welcome text,....', 'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => esc_html__("Want to use welcome text", 'valen-shortcodes'),
				"param_name" => "welcome_text",
				"value" => "",
				'description' => __( 'Example: Hello/Hi/Welcome...', 'valen-shortcodes' ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Login text link", 'valen-shortcodes'),
				"param_name" => "login_text" ,
				"description" => esc_html__("Example: Login", 'valen-shortcodes'),
				"value" => esc_html__("Login", 'valen-shortcodes')
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Want to use seperator between Login and Register?", 'valen-shortcodes'),
				"param_name" => "seperator",
				"value" => esc_html__("|",'valen-shortcodes'),
				'description' => __( 'Example: or', 'valen-shortcodes' ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Register text link", 'valen-shortcodes'),
				"param_name" => "register_text" ,
				"description" => esc_html__("Example: Sign up", 'valen-shortcodes'),
				"value" => esc_html__("Register", 'valen-shortcodes')
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Logout text link", 'valen-shortcodes'),
				"param_name" => "logout_text" ,
				"description" => esc_html__("Example: Logout", 'valen-shortcodes'),
				"value" => esc_html__("Logout", 'valen-shortcodes')
			),
			$extra_class,
			vc_map_add_css_animation(),
		)
	));
}