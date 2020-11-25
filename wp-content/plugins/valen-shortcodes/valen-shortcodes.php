<?php
/*
Plugin Name: Valen Shortcodes
Plugin URI: http://snstheme.com
Description: Provide Shortcodes for Valen theme. This plugin just work for WPBakery Visual Composer.
Version: 1.2
Author URI: http://snstheme.com
License: GPL2+
*/

// don't load directly
if (!defined('ABSPATH'))
    die('-1');

define('VALEN_SHORTCODES_URL', plugin_dir_url(__FILE__));
define('VALEN_SHORTCODES_PATH', dirname(__FILE__));
class VALEN_Shortcodes_Class {
	private $shortcodes = array(
                                "sns_instagram", //1
                                "sns_store_info", 
                                "sns_social_links", //1
                                "sns_info_box", //1
                                "sns_info_inline", //1
                                "valen_postwcode", //1
                                "sns_carousel", //1
                                "sns_grid_items", 
                                "sns_blog_page", //1
                                "sns_popup_video", 
                                "sns_time_countdown", 
                                "sns_counter", 
                                "sns_member",  //1
                                "sns_loginregister", //1
                                "sns_menu", 
                                "sns_single_testimonial", //1
                                "sns_list_posts", //1
                                "sns_single_post", //1
                            );
    private $shortcodes_woo = array(
                                "sns_products", //1
                                "sns_hot_deals", //1
                                "sns_comingsoon_product", //1
                                //"sns_banner_product", 
                                "sns_cat_info", //1
                                //"sns_shopby_categories", 
                                "valen_products_ajaxtab", //1
                                //"sns_360_degree_product",
                            );
	function __construct() {
		// Load text domain
        load_plugin_textdomain( 'valen-shortcodes', false, dirname( plugin_basename(__FILE__) ) . '/languages' );
        // Load Shortcode
        $this->loadshortcodes(); 
	}
	function loadshortcodes() {
        if ( ! function_exists( 'is_plugin_active' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
            require_once(VALEN_SHORTCODES_PATH . '/functions.php');
            foreach ($this->shortcodes as $shortcode) {
                if ( file_exists(VALEN_SHORTCODES_PATH . '/shortcodes/' . $shortcode . '.php') ) 
                	require_once(VALEN_SHORTCODES_PATH . '/shortcodes/' . $shortcode . '.php');
            }
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
                foreach ($this->shortcodes_woo as $shortcode_woo) {
                    if ( file_exists(VALEN_SHORTCODES_PATH . '/shortcodes-woo/' . $shortcode_woo . '.php') ) 
                    	require_once(VALEN_SHORTCODES_PATH . '/shortcodes-woo/' . $shortcode_woo . '.php');
                }
                // Ajaxtab
                add_action('wp_ajax_sns_products_ajaxtab', array(&$this, 'valen_content_tab_products'));
                add_action('wp_ajax_nopriv_sns_products_ajaxtab', array(&$this, 'valen_content_tab_products'));
                // Load more
                add_action('wp_ajax_sns_wooloadmore', array(&$this, 'valen_woo_loadmore'));
                add_action('wp_ajax_nopriv_sns_wooloadmore', array(&$this, 'valen_woo_loadmore'));
            }
        }
    }
    function valen_content_tab_products(){
        $tab_args = array(
            'box_id'              => $_POST['box_id'],
            'tab_content_id'      => $_POST['tab_content_id'],
            'cat'                 => $_POST['cat'],
            'order'               => $_POST['order'],
            'limit'               => $_POST['limit'],
            'uq'                  => $_POST['uq'],
            'effect'              => $_POST['effect'],
            'gridstyle'           => $_POST['gridstyle'],
            'eclass'              => $_POST['eclass'],
            'row'                 => $_POST['row'],
            'template'            => $_POST['template'],
            'number_desktop'             => $_POST['number_desktop'],
            'number_tablet'              => $_POST['number_tablet'],
            'number_tabletp'             => $_POST['number_tabletp'],
            'number_mobilel'             => $_POST['number_mobilel'],
            'number_mobilep'             => $_POST['number_mobilep'],
        );
        if ( $_POST['template'] == '3' || $_POST['template'] == '4' || $_POST['template'] == '5' ) {
            include valen_shortcode_woo_template('product-tab/tab-content'.$_POST['template']);
        }else{
            include valen_shortcode_woo_template('product-tab/tab-content');
        }
        wp_die();
    }
    public function valen_woo_loadmore(){
        $orderby        = $_POST['order'];
        $showmore       = $_POST['showmore'];
        $start          = $_POST['start'];
        $cat            = $_POST['cat'];
        $eclass         = $_POST['eclass'];
        $gridstyle              = $_POST['gridstyle'];
        $number_desktop         = $_POST['number_desktop'];
        $number_tablet          = $_POST['number_tablet'];
        $number_tabletp         = $_POST['number_tabletp'];
        $number_mobilel         = $_POST['number_mobilel'];
        $number_mobilep         = $_POST['number_mobilep'];
        //
        $eclass .= ' item-animate';
        $eclass .= ( !empty($number_desktop) && $number_desktop > 0 ) ? ' col-lg-' . 12/$number_desktop : ' col-lg-2' ;
        $eclass .= ( !empty($number_tablet) && $number_tablet > 0 ) ? ' col-md-' . 12/$number_tablet : ' col-md-4' ;
        $eclass .= ( !empty($number_tabletp) && $number_tabletp > 0 ) ? ' col-sm-' . 12/$number_tabletp : ' col-sm-4' ;
        $eclass .= ( !empty($number_mobilel) && $number_mobilel > 0 ) ? ' col-xs-' . 12/$number_mobilel : ' col-xs-6' ;
        $eclass .= ( !empty($number_mobilep) && $number_mobilep > 0 ) ? ' col-phone-' . 12/$number_mobilep : ' col-phone-12' ;
        $eclass = str_replace('.', '_', $eclass);
        //
        $loop = valen_woo_query($orderby, $showmore, $cat, $start);
        while ( $loop->have_posts() ) : $loop->the_post();
            wc_get_template( 'vc/item-grid.php', array('class' => $eclass, 'gridstyle' => $gridstyle) );
        endwhile;
        wp_reset_postdata(); // Because valen_woo_query return WP_Query
        wp_die();
    }
}
// Finally initialize code
new VALEN_Shortcodes_Class();