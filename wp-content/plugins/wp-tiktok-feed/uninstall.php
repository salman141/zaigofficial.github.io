<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
  die(-1);
}

if (!is_multisite()) {
  $qlttf = get_option('tiktok_feed_settings');
  if (!empty($qlttf['flush'])) {
    delete_option('tiktok_feed_settings');
    delete_option('tiktok_feed_feeds');
  }
}
