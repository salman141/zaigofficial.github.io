<?php
add_action( 'tgmpa_register', 'sns_plugin_activation' );
function sns_plugin_activation() {
    $plugins = array(
            // install Redux Framework, it on wordpress.org/plugins
            array(
                'name'      => esc_html__('Redux Framework', 'valen'),
                'slug'      => 'redux-framework',
                'required'  => true,
            ),
            array(
                'name'               => esc_html__('Meta Box', 'valen'),
                'slug'               => 'meta-box',
                'required'           => true,
            ),
            array(
                'name'                  => esc_html__('Slider Revolution', 'valen'),
                'slug'                  => 'revslider',
                'source'                => 'revslider.zip',
                'required'              => true,
            ),
            array(
                'name'                  => esc_html__('WPBakery Visual Composer', 'valen'),
                'slug'                  => 'js_composer',
                'source'                => 'js_composer.zip',
                'required'              => true,
            ),
            array(
                'name'                  => esc_html__('Valen Extra', 'valen'),
                'slug'                  => 'valen-extra',
                'source'                => 'valen-extra.zip',
                'required'              => true,
            ),
            array(
                'name'                  => esc_html__('Valen Shortcodes', 'valen'),
                'slug'                  => 'valen-shortcodes',
                'source'                => 'valen-shortcodes.zip',
                'required'              => true,
            ),
            array(
                'name'               => esc_html__('WooCommerce - excelling eCommerce', 'valen'),
                'slug'               => 'woocommerce',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('YITH WooCommerce Wishlist', 'valen'),
                'slug'               => 'yith-woocommerce-wishlist',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('YITH WooCommerce Compare', 'valen'),
                'slug'               => 'yith-woocommerce-compare',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('YITH WooCommerce Quick View', 'valen'),
                'slug'               => 'yith-woocommerce-quick-view',
                'required'           => true,
            ),
	    	array(
	    		'name'               => esc_html__('YITH WooCommerce Ajax Product Filter', 'valen'),
	    		'slug'               => 'yith-woocommerce-ajax-navigation',
	    		'required'           => true,
	    	),
            array(
                'name'               => esc_html__('YITH WooCommerce Badge Management', 'valen'),
                'slug'               => 'yith-woocommerce-badges-management',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Newsletter', 'valen'),
                'slug'               => 'newsletter',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Instagram Shop by Snapppt', 'valen'),
                'slug'               => 'shop-feed-for-instagram-by-snapppt',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Contact Form 7', 'valen'),
                'slug'               => 'contact-form-7',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Simple Share Buttons Adder', 'valen'),
                'slug'               => 'simple-share-buttons-adder',
                'required'           => true,
            ),
        );
  
    $config = array(
        'default_path' => esc_url('http://demo.snstheme.com/wp/resource/q3-2020/'),
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Is show notices or not?
        'dismissable'  => false,                   // If false then user cannot colose notices above.
        'is_automatic' => false,                    // If false thene plugin cannot auto active after install.
    );
    tgmpa( $plugins, $config );
}