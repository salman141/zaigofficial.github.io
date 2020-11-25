<?php

class QLTTF_Notices {

  protected static $instance;

  public static function instance() {
    if (is_null(self::$instance)) {
      self::$instance = new self();
      self::$instance->init();
    }
    return self::$instance;
  }

  function init() {
    add_filter('plugin_action_links_' . plugin_basename(QLTTF_PLUGIN_FILE), array($this, 'add_action_links'));
  }

  public function add_action_links($links) {

    $links[] = '<a href="' . admin_url('admin.php?page=' . sanitize_title(QLTTF_PREFIX)) . '">' . esc_html__('Settings', 'wp-tiktok-feed') . '</a>';

    return $links;
  }

}

QLTTF_Notices::instance();
