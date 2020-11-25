<?php

class QLTTF_Welcome_Controller {

  protected static $instance;

  public static function instance() {
    if (!isset(self::$instance)) {
      self::$instance = new self();
      self::$instance->init();
    }
    return self::$instance;
  }

  function init() {
    add_action('admin_menu', array($this, 'add_menu'));
  }

  function add_menu() {
    add_menu_page(QLTTF_PLUGIN_NAME, QLTTF_PLUGIN_NAME, 'edit_posts', QLTTF_DOMAIN, array($this, 'add_panel'), plugins_url('/assets/backend/img/tiktok-white.svg', QLTTF_PLUGIN_FILE));
    add_submenu_page(QLTTF_DOMAIN, esc_html__('Welcome', 'wp-tiktok-feed'), esc_html__('Welcome', 'wp-tiktok-feed'), 'edit_posts', QLTTF_DOMAIN, array($this, 'add_panel'));
  }

  function add_panel() {
    global $submenu;
    include (QLTTF_PLUGIN_DIR . '/includes/view/backend/pages/parts/header.php');
    include (QLTTF_PLUGIN_DIR . '/includes/view/backend/pages/welcome.php');
  }

}

QLTTF_Welcome_Controller ::instance();
