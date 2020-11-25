<?php

if ( class_exists( 'CMB2', false ) ) {
    return;
}

define( 'DIZA_CMB2_ACTIVED', true );

if ( !function_exists( 'diza_tbay_page_metaboxes' ) ) {
	function diza_tbay_page_metaboxes(array $metaboxes) {

        $sidebars = diza_sidebars_array();

        $footers = array_merge( array('global' => esc_html__( 'Global Setting', 'diza' )), diza_tbay_get_footer_layouts() );
        $headers = array_merge( array('global' => esc_html__( 'Global Setting', 'diza' )), diza_tbay_get_header_layouts() );


		$prefix = 'tbay_page_';
	    $fields = array( 
			array(
				'name' => esc_html__( 'Select Layout', 'diza' ),
				'id'   => $prefix.'layout',
				'type' => 'select',
				'options' => array(
					'main' => esc_html__('Main Content Only', 'diza'),
					'left-main' => esc_html__('Left Sidebar - Main Content', 'diza'),
					'main-right' => esc_html__('Main Content - Right Sidebar', 'diza'),
				)
			),
            array(
                'id' => $prefix.'left_sidebar',
                'type' => 'select',
                'name' => esc_html__('Left Sidebar', 'diza'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'right_sidebar',
                'type' => 'select',
                'name' => esc_html__('Right Sidebar', 'diza'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'show_breadcrumb',
                'type' => 'select',
                'name' => esc_html__('Show Breadcrumb?', 'diza'),
                'options' => array(
                    'no' => esc_html__('No', 'diza'),
                    'yes' => esc_html__('Yes', 'diza')
                ),
                'default' => 'yes',
            ),
            array(
                'name' => esc_html__( 'Select Breadcrumbs Layout', 'diza' ),
                'id'   => $prefix.'breadcrumbs_layout',
                'type' => 'select',
                'options' => array(
                    'image' => esc_html__('Background Image', 'diza'),
                    'color' => esc_html__('Background color', 'diza'),
                    'text' => esc_html__('Just text', 'diza')
                ),
                'default' => 'text',
            ),
            array(
                'id' => $prefix.'breadcrumb_color',
                'type' => 'colorpicker',
                'name' => esc_html__('Breadcrumb Background Color', 'diza')
            ),
            array(
                'id' => $prefix.'breadcrumb_image',
                'type' => 'file',
                'name' => esc_html__('Breadcrumb Background Image', 'diza')
            ),
    	);

        $after_array = array(
            array(
                'id' => $prefix.'header_type',
                'type' => 'select', 
                'name' => esc_html__('Header Layout Type', 'diza'),
                'description' => esc_html__('Choose a header for your website.', 'diza'),
                'options' => $headers,
                'default' => 'global'
            ),            
            array(
                'id' => $prefix.'footer_type',
                'type' => 'select',
                'name' => esc_html__('Footer Layout Type', 'diza'),
                'description' => esc_html__('Choose a footer for your website.', 'diza'),
                'options' => $footers,
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'extra_class',
                'type' => 'text',
                'name' => esc_html__('Extra Class', 'diza'),
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'diza')
            )
        );
        $fields = array_merge($fields, $after_array); 
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'diza' ),
			'object_types'              => array( 'page' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'diza_tbay_page_metaboxes' ); 

if ( !function_exists( 'diza_tbay_cmb2_style' ) ) {
	function diza_tbay_cmb2_style() {
		wp_enqueue_style( 'diza-cmb2', DIZA_THEME_DIR . '/inc/vendors/cmb2/assets/cmb2.css', array(), '1.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'diza_tbay_cmb2_style' );


