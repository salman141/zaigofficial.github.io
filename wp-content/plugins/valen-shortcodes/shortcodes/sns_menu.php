<?php
// SNS Vertical Menu
add_shortcode('sns_menu', 'valen_menu_template');
add_action('vc_after_init', 'valen_menu_settings');
function valen_menu_template($atts, $content = null) {
    ob_start();
    if ($template = valen_shortcode_template('sns_menu'))
        include $template;
    return ob_get_clean();
}
function valen_menu_settings() {
	$extra_class = valen_extra_class();
	$custom_menus = array();
	if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		if ( is_array( $menus ) && ! empty( $menus ) ) {
			foreach ( $menus as $single_menu ) {
				if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
					$custom_menus[ $single_menu->name ] = $single_menu->term_id;
				}
			}
		}
	}
	vc_map( array(
		"name"  => esc_html__("SNS Menu", 'valen-shortcodes'),
		"base" => "sns_menu",
		"show_settings_on_create" => true ,
		"is_container" => false ,
		"icon" => "vc_icon_snstheme",
		"class" => "vc_icon_snstheme",
		"content_element" => true ,
		"category" => esc_html__('Valen', 'valen-shortcodes'),
		'description' => esc_html__( 'Display menu with our style ...', 'valen-shortcodes' ),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'valen-shortcodes'),
				"param_name" => "title",
				"value" =>  esc_html__("Your menu",'valen-shortcodes'),
				"admin_label" => true,
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Menu', 'valen-shortcodes' ),
				'param_name' => 'nav_menu',
				'value' => $custom_menus,
				'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'valen-shortcodes' ) : esc_html__( 'Select menu to display.', 'valen-shortcodes' ),
				'admin_label' => true,
				'save_always' => true,
			),
			array(
				"type" => "dropdown",
				'value' => array(
					esc_html__( 'Default', 'valen-shortcodes' ) => '1',
					esc_html__( 'Inline menu', 'valen-shortcodes' ) => '2',
					esc_html__( 'Vertical menu', 'valen-shortcodes' ) => '3',
				),
				"heading" => esc_html__("Menu style", 'valen-shortcodes'),
				"param_name" => "menu_style"
		    ),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Menu class",'valen-shortcodes'),
				"param_name" => "menu_class",
				"value" =>  esc_html__("nav navbar-nav",'valen-shortcodes'),
				"admin_label" => true,
			),
			array(
				"type" => "dropdown",
				'value' => array(
					esc_html__( 'No', 'valen-shortcodes' ) => '2',
					esc_html__( 'Yes', 'valen-shortcodes' ) => '1',
				),
				"heading" => esc_html__("Want to use responsive menu?", 'valen-shortcodes'),
				"param_name" => "menu_responsive"
		    ),
			vc_map_add_css_animation(),
			$extra_class,
		)
	));
}