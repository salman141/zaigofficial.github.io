<?php
// SNS List Post
add_shortcode('sns_single_post', 'valen_single_post_template');
add_action('vc_after_init', 'valen_single_post_settings');
function valen_single_post_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_single_post'))
        include $template;
    return ob_get_clean();
}
function valen_single_post_settings() {
	$extra_class = valen_extra_class();
	add_filter( 'vc_autocomplete_sns_single_post_sp_callback', 'vc_include_field_search', 10, 1 ); // Get suggestion(find). Must return an array
	add_filter( 'vc_autocomplete_sns_single_post_sp_render', 'vc_include_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)
	vc_map( array(
	"name" => esc_html__("SNS Single Post",'valen-shortcodes'),
	"base" => "sns_single_post",
	"icon" => "sns_icon_listposts",
	"class" => "sns_listposts",
	"category" => esc_html__("Valen",'valen-shortcodes'),
	"description" => esc_html__( "Show single post", 'valen-shortcodes' ),
		"params" => array(
			array(
				'type' => 'autocomplete',
				'heading' => __( 'Select post', 'valen-shortcodes' ),
				'param_name' => 'sp',
				'description' => __( 'Select posts, pages, etc. by title.', 'valen-shortcodes' ),
				'settings' => array(
					'multiple' => false,
				),
			),
			array(
		      "type" => "attach_image",
		      "heading" => esc_html__("Want use custom image for that post above?", 'valen-shortcodes'),
		      "param_name" => "custom_img",
		      "admin_label" => true,
		    ),
			vc_map_add_css_animation(),
			$extra_class,
		)
	) );
}