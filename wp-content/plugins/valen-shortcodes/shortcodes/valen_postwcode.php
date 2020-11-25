<?php
// VALEN Post WCode
add_shortcode('valen_postwcode', 'valen_postwcode_template');
add_action('vc_after_init', 'valen_postwcode_settings');
function valen_postwcode_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('valen_postwcode'))
        include $template;
    return ob_get_clean();
}
function valen_postwcode_settings() {
    vc_map( array(
		"name" => esc_html__("Post WCode",'valen-shortcodes'),
		"base" => "valen_postwcode",
		"icon" => "valen_icon_postwcode",
		"class" => "valen_postwcode",
		"category" => esc_html__("Valen",'valen-shortcodes'),
		"description" => esc_html__( "Display somes shortcodes via slug of Post WCode",'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'valen-shortcodes'),
				"param_name" => "title",
				"admin_label" => true,
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Slug of Post WCode",'valen-shortcodes'),
				"param_name" => "name",
				"admin_label" => true,
			),
		)
    ));
}