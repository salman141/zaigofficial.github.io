<?php

class QLTTF {

  protected static $instance;

  public static function instance() {
    if (!isset(self::$instance)) {
      self::$instance = new self();
      self::$instance->api();
      self::$instance->init();
      self::$instance->includes();
    }
    return self::$instance;
  }

  function init() {
    do_action('qlttf_init');
    load_plugin_textdomain('wp-tiktok-feed', false, QLTTF_PLUGIN_DIR . '/languages/');
  }

  function includes() {
    include_once(QLTTF_PLUGIN_DIR . 'includes/notices.php');
    include_once(QLTTF_PLUGIN_DIR . 'includes/helpers.php');
    include_once(QLTTF_PLUGIN_DIR . 'includes/backend.php');
    include_once(QLTTF_PLUGIN_DIR . 'includes/frontend.php');
  }

  function api() {

    global $qlttf_api;

    if (!class_exists('QLTTF_API')) {

      include_once(QLTTF_PLUGIN_DIR . 'includes/api.php');

      $qlttf_api = new QLTTF_API();
    }
  }

  public static function do_activation() {
    set_transient('qlttf-first-rating', true, MONTH_IN_SECONDS);
  }

  public static function is_min() {
    if (!QLTTF_DEVELOPER && (!defined('SCRIPT_DEBUG') || !SCRIPT_DEBUG)) {
      return '.min';
    }
  }

}

QLTTF::instance();

