<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://metabox.io/docs/registering-meta-boxes/
 */
add_filter( 'rwmb_meta_boxes', 'valen_register_meta_boxes' );
/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function valen_register_meta_boxes( $meta_boxes ){
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'valen_';
	global $wpdb, $valen_opt;
	$revsliders =array();
	$revsliders[0] = esc_html__("Don't use", "valen");
	if ( class_exists('RevSlider') ) {
		$query = $wpdb->prepare("
			SELECT * 
			FROM {$wpdb->prefix}revslider_sliders 
			ORDER BY %s"
			, "ASC");
	    $get_sliders = $wpdb->get_results($query);
	    if($get_sliders) {
		    foreach($get_sliders as $slider) {
			   $revsliders[$slider->alias] = $slider->title;
		   }
	    }
	}
	$default_layout = 'm-r';
	if ( isset($valen_opt['blog_layout']) ) $default_layout = $valen_opt['blog_layout'];
	$siderbars = array();
	foreach ($GLOBALS['wp_registered_sidebars'] as $sidebars) {
		$siderbars[ $sidebars['id']] = $sidebars['name'];
	}
	// Layout config
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'sns_productcfg',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => esc_html__( 'Product Config', 'valen' ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'product' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		// 'autosave'   => true,
		// List of meta fields

		'fields'     => array(
            array(
                'id'       => "{$prefix}breadcrumbbg",
                'type'     => 'image_advanced',
                'name'     => esc_html__("Background image for Breadcrumb", 'valen'),
                'desc'	   => esc_html__('Just apply when Show Product Title in the Breadcrumb', 'valen'),
            ),
			array(
				'name'    => esc_html__( 'Gallery Thumbnail Type', 'valen' ),
				'id'       => "{$prefix}woo_gallery_type",
				'type'     => 'select',
				'std'  => '',
				'options'  => array(
					''  => esc_html__( 'Default', 'valen' ),
					'h'  => esc_html__( 'Horizontal', 'valen' ),
					'v'  => esc_html__( 'Vertical', 'valen' ),
					'n1'      => esc_html__( 'None - Use scrolling layout', 'valen' ),
				)
			),
		  	array(
				'name'    => esc_html__( 'Zoom Type for Cloud Zoom', 'valen' ),
				'id'       => "{$prefix}woo_zoomtype",
				'type'     => 'select',
				'std'  => '',
				'options'  => array(
					''  => esc_html__( 'Default', 'valen' ),
					'lens'  => esc_html__( 'Lens', 'valen' ),
					'inner'  => esc_html__( 'Inner', 'valen' ),
				),
				'desc'		=> '',
			),
			array(
				'name'    => esc_html__( 'Your product has ratio is 11:15 ?', 'valen' ),
				'id'       => "{$prefix}ratio_1115",
				'type'     => 'select',
				'std'  => 0,
				'options'  => array(
					0  => esc_html__( 'No', 'valen' ),
					1  => esc_html__( 'Yes', 'valen' ),
				),
				'desc'		=> esc_html__('Your product page will look good with this setting - apply for ratio 11:15', 'valen'),
			),
			array(
				'id'    => "{$prefix}product_video",
				'name'  => esc_html__( 'Product Video', 'valen' ),
				'type'  => 'oembed',
				// Allow to clone? Default is false
				'clone' => false,
				'desc'		  => esc_html__( 'Enter your video url(youtube, video)', 'valen' ),
				// Input size
				'size'  => 50,
			),
			array(
				'name'    => esc_html__( 'Use Variation Thumbnail for Variable product', 'valen' ),
				'id'       => "{$prefix}use_variation_thumb",
				'type'     => 'select',
				'std'  => 0,
				'options'  => array(
					0  => esc_html__( 'No', 'valen' ),
					1  => esc_html__( 'Yes', 'valen' ),
				),
				'desc'		=> esc_html__('Just applies for Variable Product', 'valen'),
			),
		)
	);
	// Layout config
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'sns_layout',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => esc_html__( 'Layout Config', 'valen' ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		// 'autosave'   => true,
		// List of meta fields

		'fields'     => array(
			// Layout Type
			array(
				'name'        => esc_html__( 'Layout Type', 'valen' ),
				'id'          => "{$prefix}layouttype",
				'type'        => 'layouttype',
				// Array of 'value' => 'Label' pairs for select box
				'options'     => array(
					'm' => esc_html__( 'Without Sidebar', 'valen' ),
					'l-m' => esc_html__( 'Use Left Sidebar', 'valen' ),
					'm-r' => esc_html__( 'Use Right Sidebar', 'valen' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => $default_layout,
				'placeholder' => esc_html__( '--- Select a layout type ---', 'valen' ),
			),
			// Left Sidebar
			array(
				'name'  => esc_html__( 'Left Sidebar', 'valen' ),
				'id'    => "{$prefix}leftsidebar",
				'type'  => 'select',
				'options'	=> $siderbars,
				'multiple'	=> false,
				'std'		=> 'left-sidebar',
				'placeholder' => esc_html__( '--- Select a sidebar ---', 'valen' ),
			),
			// Right Sidebar
			array(
				'name'  => esc_html__( 'Right Sidebar', 'valen' ),
				'id'    => "{$prefix}rightsidebar",
				'type'  => 'select',
				'options'	=> $siderbars,
				'multiple'	=> false,
				'std'		=> 'right-sidebar',
				'placeholder' => esc_html__( '--- Select a sidebar ---', 'valen' ),
			),
			
		)
	);
	
	$menus = get_terms('nav_menu', array( 'hide_empty' => false ));
	$menu_options[''] = __('Default Menu...', 'valen');
	foreach ( $menus as $menu ){
		$menu_options[$menu->term_id] = $menu->name;
	}
	
	// Page config
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'sns_pageconfig',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => esc_html__( 'Page Config', 'valen' ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		// 'autosave'   => true,
		// List of meta fields

		'fields'     => array(
			array(
				'name'    => esc_html__( 'Want use custom logo?', 'valen' ),
				'id'      => "{$prefix}header_logo",
				'type'    => 'image_advanced',
				'desc'		=> esc_html__('It priority more than Logon in theme option', 'valen'),
			),
			array(
				'name'    => esc_html__( 'Header Style', 'valen' ),
				'id'       => "{$prefix}header_style",
				'type'     => 'select',
				'std'  => '',
				'options'  => array(
					''   	  => esc_html__( 'Default', 'valen' ),
					'style1'  => esc_html__( 'Style1', 'valen' ),
					'style2'  => esc_html__( 'Style2', 'valen' ),
					'style3'  => esc_html__( 'Style3', 'valen' ),
					'style4'  => esc_html__( 'Style4', 'valen' ),
				),
				'desc'		=> esc_html__('Select Header style. ', 'valen'),
			),
			array(
				'name'    => esc_html__( 'Enable Sticky Menu', 'valen' ),
				'id'       => "{$prefix}use_stickmenu",
				'type'     => 'select',
				'std'  => '',
				'options'  => array(
					''   	  => esc_html__( 'Default', 'valen' ),
					true  => esc_html__( 'Yes', 'valen' ),
					false  => esc_html__( 'No', 'valen' ),
				),
			),
			array(
				'name'    => esc_html__( 'Style of menu category', 'valen' ),
				'id'       => "{$prefix}mcat_style",
				'type'     => 'select',
				'std'  => '',
				'options'  => array(
					''   	  => esc_html__( 'Default', 'valen' ),
					'1'  => esc_html__( 'Big item', 'valen' ),
					'2'  => esc_html__( 'Inline icon', 'valen' ),
				),
			),
			array(
				'name'    => esc_html__( 'Enable Search Category for Live Ajax Search', 'valen' ),
				'id'       => "{$prefix}enable_search_cat",
				'type'     => 'select',
				'std'  => '',
				'options'  => array(
					''   	  => esc_html__( 'Default', 'valen' ),
					true  => esc_html__( 'Yes', 'valen' ),
					false  => esc_html__( 'No', 'valen' ),
				),
			),
			array(
				'name'    => esc_html__( 'Use Slideshow', 'valen' ),
				'id'      => "{$prefix}useslideshow",
				'type'    => 'radio',
				'options' => array(
					'1' => esc_html__( 'Yes', 'valen' ),
					'2' => esc_html__( 'No', 'valen' ),
				),
				'std'         => '2',
			),
			array(
				'name'    => esc_html__( 'Select Slideshow', 'valen' ),
				'id'      => "{$prefix}revolutionslider",
				'type'    => 'select',
				'options' =>  $revsliders ,
				'std'         => '',
			),
			array(
				'name'    => esc_html__( 'Show Title', 'valen' ),
				'id'      => "{$prefix}showtitle",
				'type'    => 'radio',
				'options' => array(
					'1' => esc_html__( 'Yes', 'valen' ),
					'2' => esc_html__( 'No', 'valen' ),
				),
				'std'         => '1',
			),
			array(
				'name'    => esc_html__( 'Show Breadcrumbs?', 'valen' ),
				'id'      => "{$prefix}showbreadcrump",
				'type'    => 'select',
				'options' => array(
					'' => esc_html__( 'Default', 'valen' ),
					'1' => esc_html__( 'Yes', 'valen' ),
					'2' => esc_html__( 'No', 'valen' ),
				),
				'multiple'	=> false,
				'std'         => '',
				'desc' => esc_html__( 'Dont apply for Front page.', 'valen' ),
			),
			array(
				'name'    => esc_html__( 'Want use Background image for Breadcrumbs?', 'valen' ),
				'id'      => "{$prefix}breadcrumbbg",
				'type'    => 'image_advanced',
			),
			array(
				'name'    => esc_html__( 'Footer Style', 'valen' ),
				'id'       => "{$prefix}footer_layout",
				'type'     => 'select',
				'std'  => '',
				'options'  => array(
					''  => esc_html__( 'Default', 'valen' ),
					'1'  => esc_html__( 'Style 1', 'valen' ),
					'2'  => esc_html__( 'Style 2', 'valen' ),
					'3'  => esc_html__( 'Style 3', 'valen' ),
					'4'  => esc_html__( 'Style 4', 'valen' ),
					'blank'  => esc_html__( 'Blank', 'valen'),
				),
				'desc'		=> esc_html__('Select Footer layout. "Default" to use in Theme Options.', 'valen'),
			),
			array(
				'name'    => esc_html__( 'Config Theme Color for this page?', 'valen' ),
				'id'      => "{$prefix}page_themecolor",
				'type'    => 'radio',
				'options' => array(
					'1' => esc_html__( 'Yes', 'valen' ),
					'2' => esc_html__( 'No', 'valen' ),
				),
				'std'         => '2',
			),
			array(
				'name' => esc_html__( 'Sellect Theme Color', 'valen' ),
				'id'   => "{$prefix}theme_color",
				'type' => 'color',
				'desc' => esc_html__( 'It will priority than Theme Color in Theme Option panel', 'valen' ),
			),
			array(
				'name'    	=> esc_html__( 'Want to use page class?', 'valen' ),
				'id'       	=> "{$prefix}page_class",
				'type'     	=> 'text',
				'std'  		=> '',
				'desc'		=> esc_html__('It is a class css to add some special style, and just for this page', 'valen'),
			),
		)
	);
	// Post format - Gallery
	$meta_boxes[] = array(
	    	'id' => 'sns-post-gallery',
		    'title' =>  esc_html__('Gallery Settings','valen'),
	    	'description' => '',
    		'pages'      => array( 'post' ), // Post type
	    	'context'    => 'normal',
		    'priority'   => 'high',
	    	'fields' => array(
			     array(
			        'name'		=> 'Gallery Images',
			        'desc'	    => 'Upload Images for post Gallery ( Limit is 15 Images ).',
			        'type'      => 'image_advanced',
			        'id'	    => "{$prefix}post_gallery",
	         		'max_file_uploads' => 15 
	        	)
			)
	);
	// Post format - Video
    $meta_boxes[] = array(
		'id' => 'sns-post-video',
		'title' => esc_html__('Featured Video','valen'),
		'description' => '',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => array( 
		    array(
				'id'    => "{$prefix}post_video",
				'name'  => esc_html__( 'Video', 'valen' ),
				'type'  => 'oembed',
				// Allow to clone? Default is false
				'clone' => false,
				// Input size
				'size'  => 50,
			)
		)
	);
	// Post format - Audio
    $meta_boxes[] = array(
		'id' => 'sns-post-audio',
		'title' => esc_html__('Featured Audio','valen'),
		'description' => '',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => array( 
		    array(
				'id'    => "{$prefix}post_audio",
				'name'  => esc_html__( 'Audio', 'valen' ),
				'type'  => 'oembed',
				// Allow to clone? Default is false
				'clone' => false,
				// Input size
				'size'  => 50,
			)
		)
	);
	// Post format - quote
    $meta_boxes[] = array(
		'id' => 'sns-post-quote',
		'title' => esc_html__('Featured Quote','valen'),
		'description' => '',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => array( 
		    array(
				'id'    => "{$prefix}post_quotecontent",
				'name'  => esc_html__( 'Quote Content', 'valen' ),
				'type'  => 'textarea',
				// Allow to clone? Default is false
				'clone' => false,
			),
			array(
				'id'      => "{$prefix}post_quoteauthor",
				'name'    => esc_html__( 'Quote author', 'valen' ),
				'type'    => 'text',
				'clone' => false,
			),
		)
	);
	// Post format - Link
    $meta_boxes[] = array(
		'id' => 'sns-post-link',
		'title' => esc_html__('Link Settings','valen'),
		'description' => '',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => array( 
		    array(
				'id'    => "{$prefix}post_linkurl",
				'name'  => esc_html__( 'Link URL', 'valen' ),
				'type'  => 'text',
				// Allow to clone? Default is false
				'clone' => false,
			),
			array(
				'id'      => "{$prefix}post_linktitle",
				'name'    => esc_html__( 'Link Title', 'valen' ),
				'type'    => 'text',
				'clone' => false,
			),
		)
	);

	return $meta_boxes;
}


if ( class_exists( 'RWMB_Field' ) ) {
	class RWMB_Layouttype_Field extends RWMB_Select_Field {
		static function admin_enqueue_scripts(){
			wp_enqueue_style( 'valen-imgselect', VALEN_THEME_URI . '/framework/meta-box/img-select.css' );
		}
	}
	// Js for metabox fields action
	add_action( 'admin_print_scripts', 'valen_metabox_adminjs');
    function valen_metabox_adminjs(){
		wp_enqueue_script('valen-imgselect', VALEN_THEME_URI . '/framework/meta-box/sns-metabox.js', array('jquery'), '', true);
	}
}
