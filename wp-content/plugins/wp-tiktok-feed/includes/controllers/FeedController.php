<?php

include_once(QLTTF_PLUGIN_DIR . 'includes/models/Feed.php');
include_once(QLTTF_PLUGIN_DIR . 'includes/controllers/Controller.php');

class QLTTF_Feed_Controller extends QLTTF_Controller {

  protected static $instance;
  protected static $slug = QLTTF_DOMAIN . '_feeds';

  function add_menu() {
    add_submenu_page(QLTTF_DOMAIN, esc_html__('Feeds', 'wp-tiktok-feed'), esc_html__('Feeds', 'wp-tiktok-feed'), 'manage_options', self::$slug, array($this, 'add_panel'));
  }

  function add_panel() {
    global $submenu, $qlttf_api;
    $feed_model = new QLTTF_Feed();
    $feeds = $feed_model->get_feeds();

    include (QLTTF_PLUGIN_DIR . '/includes/view/backend/pages/parts/header.php');
    include (QLTTF_PLUGIN_DIR . '/includes/view/backend/pages/feeds.php');
  }

  function get_feed($feed_id) {

    function get_the_title1($id) {
      return ($id == 'all') ? esc_html__('All', 'wp-tiktok-feed') : get_the_title($id);
    }

    $feed_model = new QLTTF_Feed();
    $feed = $feed_model->get_feed($feed_id);
    return $feed;
  }

  function ajax_edit_feed() {
    if (current_user_can('manage_options') && check_ajax_referer('qlttf_edit_feed', 'nonce', false)) {

      $feed_id = (isset($_REQUEST['feed_id'])) ? absint($_REQUEST['feed_id']) : -1;

      if ($feed_id != -1) {
        $feed = $this->get_feed($feed_id);
        if ($feed) {
          return parent::success_ajax($feed);
        }
      }
      parent::error_reload_page();
    }
    parent::error_access_denied();
  }

  function ajax_save_feed() {

    if (isset($_REQUEST['feed']) && current_user_can('manage_options') && check_ajax_referer('qlttf_save_feed', 'nonce', false)) {

      $feed = json_decode(stripslashes($_REQUEST['feed']), true);

      if (is_array($feed)) {

        $feed_model = new QLTTF_Feed();

        if (isset($feed['id'])) {
          return parent::success_ajax($feed_model->update_feed($feed));
        } else {
          return parent::success_ajax($feed_model->add_feed($feed));
        }

        return parent::error_reload_page();
      }
    }
    return parent::error_access_denied();
  }

  function ajax_delete_feed() {

    if (isset($_REQUEST['feed_id']) && current_user_can('manage_options') && check_ajax_referer('qlttf_delete_feed', 'nonce', false)) {

      $feed_id = absint($_REQUEST['feed_id']);

      $feed_model = new QLTTF_Feed();

      $feed = $feed_model->delete_feed($feed_id);

      if ($feed_id) {
        return parent::success_ajax($feed);
      }

      parent::error_reload_page();
    }

    parent::error_access_denied();
  }

  function ajax_clear_cache() {

    global $wpdb;

    if (isset($_REQUEST['feed_id']) && current_user_can('manage_options') && check_ajax_referer('qlttf_clear_cache', 'nonce', false)) {

      $feed_id = absint($_REQUEST['feed_id']);

      $feed_model = new QLTTF_Feed();

      $feed = $feed_model->get_feed($feed_id);

      if ($feed['source'] == 'username') {
        $tk = "%%tiktok_feed_username_videos_{$feed['username']}_%%";
      } else {
        $tk = "%%tiktok_feed_hashtag_videos_{$feed['hashtag']}_%%";
      }

      if ($tks = $wpdb->get_row($wpdb->prepare("SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE %s", $tk))) {
        foreach ($tks as $key => $name) {
          delete_transient(str_replace('_transient_', '', $name));
        }
      }

      return parent::success_ajax(esc_html__('Feed cache cleared', 'wp-tiktok-feed'));
    }

    parent::error_access_denied();
  }

  function init() {
    add_action('wp_ajax_qlttf_edit_feed', array($this, 'ajax_edit_feed'));
    add_action('wp_ajax_qlttf_save_feed', array($this, 'ajax_save_feed'));
    add_action('wp_ajax_qlttf_delete_feed', array($this, 'ajax_delete_feed'));
    add_action('wp_ajax_qlttf_clear_cache', array($this, 'ajax_clear_cache'));
    add_action('admin_enqueue_scripts', array($this, 'add_js'));
    add_action('admin_menu', array($this, 'add_menu'));
  }

  function add_js() {
    if (isset($_GET['page']) && ($_GET['page'] === self::$slug)) {
      $feed_model = new QLTTF_Feed();
      wp_enqueue_script('qlttf-admin-feed', plugins_url('/assets/backend/js/qlttf-admin-feed' . QLTTF::is_min() . '.js', QLTTF_PLUGIN_FILE), array('wp-util', 'jquery', 'backbone', 'jquery-serializejson', 'wp-color-picker-alpha', 'jquery-ui-sortable'), QLTTF_PLUGIN_VERSION, true);
      wp_localize_script('qlttf-admin-feed', 'qlttf_feed', array(
          'nonce' => array(
              'qlttf_edit_feed' => wp_create_nonce('qlttf_edit_feed'),
              'qlttf_save_feed' => wp_create_nonce('qlttf_save_feed'),
              'qlttf_delete_feed' => wp_create_nonce('qlttf_delete_feed'),
              'qlttf_clear_cache' => wp_create_nonce('qlttf_clear_cache'),
          ),
          'message' => array(
              'confirm_delete' => __('Do you want to delete the feed?', 'wp-tiktok-feed'),
              'confirm_clear_cache' => __('Do you want to delete the feed?', 'wp-tiktok-feed')
          ),
          'args' => $feed_model->get_args()));
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

QLTTF_Feed_Controller::instance();
