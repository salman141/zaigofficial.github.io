<?php

include_once(QLTTF_PLUGIN_DIR . 'includes/models/Setting.php');
include_once(QLTTF_PLUGIN_DIR . 'includes/controllers/SettingController.php');

class QLTTF_Setting_Controller extends QLTTF_Controller {

  protected static $instance;
  protected static $slug = QLTTF_DOMAIN . '_setting';

  function add_menu() {
    add_submenu_page(QLTTF_DOMAIN, esc_html__('Settings', 'wp-tiktok-feed'), esc_html__('Settings', 'wp-tiktok-feed'), 'manage_options', self::$slug, array($this, 'add_panel'));
  }

  function add_panel() {
    global $submenu;
    $settings_model = new QLTTF_Setting();
    $settings = $settings_model->get_settings();

    include (QLTTF_PLUGIN_DIR . '/includes/view/backend/pages/parts/header.php');
    include (QLTTF_PLUGIN_DIR . '/includes/view/backend/pages/settings.php');
  }

  function init() {
    add_action('wp_ajax_qlttf_save_settings', array($this, 'ajax_save_settings'));
    add_action('admin_enqueue_scripts', array($this, 'add_js'));
    add_action('admin_menu', array($this, 'add_menu'));
  }

  function ajax_save_settings() {

    if (!empty($_REQUEST['settings_data']) && current_user_can('manage_options') && check_admin_referer('qlttf_save_settings', 'nonce')) {
      $settings_model = new QLTTF_Setting();

      $settings_data = array();
      parse_str($_REQUEST['settings_data'], $settings_data);

      $settings_model->save_settings($settings_data);
      parent::success_ajax(esc_html__('Settings updated successfully', 'wp-tiktok-feed'));
    }

    parent::error_ajax(esc_html__('Invalid Request', 'wp-tiktok-feed'));
  }

  function add_js() {
    if (isset($_GET['page']) && ($_GET['page'] === self::$slug)) {
      wp_enqueue_media();
      wp_enqueue_script('qlttf-admin-settings', plugins_url('/assets/backend/js/qlttf-admin-settings' . QLTTF::is_min() . '.js', QLTTF_PLUGIN_FILE), array('wp-util', 'jquery', 'backbone', 'jquery-serializejson', 'wp-color-picker-alpha'), QLTTF_PLUGIN_VERSION, true);
      wp_localize_script('qlttf-admin-settings', 'qlttf_settings', array(
          'nonce' => array(
              'qlttf_save_settings' => wp_create_nonce('qlttf_save_settings'),
          )
      ));
    }
  }

  public static function instance() {
    if (!isset(self::$instance)) {
      self::$instance = new self();
      self::$instance->init();
    }
    return self::$instance;
  }

}

QLTTF_Setting_Controller::instance();

