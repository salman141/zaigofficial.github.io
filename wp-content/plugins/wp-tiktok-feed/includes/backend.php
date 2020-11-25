<?php

class QLTTF_Backend
{

    protected static $instance;

    public static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
            self::$instance->init();
            self::$instance->includes();
        }
        return self::$instance;
    }

    function init()
    {
        add_action('admin_enqueue_scripts', array($this, 'add_js'));
        add_filter('sanitize_option_qlttf', 'wp_unslash');
    }

    function includes()
    {
        include_once(QLTTF_PLUGIN_DIR . 'includes/controllers/WelcomeController.php');
        include_once(QLTTF_PLUGIN_DIR . 'includes/controllers/FeedController.php');
        include_once(QLTTF_PLUGIN_DIR . 'includes/controllers/SettingController.php');
        include_once(QLTTF_PLUGIN_DIR . 'includes/controllers/SuggestionsController.php');
    }

    function add_js()
    {
        wp_register_script('jquery-serializejson', plugins_url('/assets/backend/jquery-serializejson/jquery-serializejson' . QLTTF::is_min() . '.js', QLTTF_PLUGIN_FILE), array('jquery'), QLTTF_PLUGIN_VERSION, true);
        wp_register_script('wp-color-picker-alpha', plugins_url('/assets/backend/rgba/wp-color-picker-alpha.min.js', QLTTF_PLUGIN_FILE), array('jquery', 'wp-color-picker'), QLTTF_PLUGIN_VERSION, true);
        wp_localize_script('wp-color-picker-alpha', 'wpColorPickerL10n', array(
            'clear'            => __('Clear', 'wp-tiktok-feed'),
            'clearAriaLabel'   => __('Clear color', 'wp-tiktok-feed'),
            'defaultString'    => __('Default', 'wp-tiktok-feed'),
            'defaultAriaLabel' => __('Select default color', 'wp-tiktok-feed'),
            'pick'             => __('Select Color', 'wp-tiktok-feed'),
            'defaultLabel'     => __('Color value', 'wp-tiktok-feed'),
        ));
        wp_register_style('qlttf-admin', plugins_url('/assets/backend/css/qlttf-admin' . QLTTF::is_min() . '.css', QLTTF_PLUGIN_FILE), array('wp-color-picker', 'media-views'), QLTTF_PLUGIN_VERSION, 'all');

        if (isset($_GET['page']) && strpos($_GET['page'], QLTTF_PREFIX) !== false) {
            wp_enqueue_style('qlttf-admin');
        }
    }
}

QLTTF_Backend::instance();
