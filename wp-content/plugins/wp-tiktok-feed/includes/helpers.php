<?php

include_once(QLTTF_PLUGIN_DIR . 'includes/models/Setting.php');

function qlttf_thousands_roud($num) {

  if ($num > 1000) {

    $x = round($num);
    $x_number_format = number_format($x);
    $x_array = explode(',', $x_number_format);
    $x_parts = array('k', 'm', 'b', 't');
    $x_count_parts = count($x_array) - 1;
    $x_display = $x;
    $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
    $x_display .= $x_parts[$x_count_parts - 1];

    return $x_display;
  }

  return $num;
}

function qlttf_sanitize_tiktok_feed($feed) {

  global $qlttf_api;

  // Removing @, # and trimming input
  // ---------------------------------------------------------------------

  $feed = sanitize_text_field($feed);

  $feed = trim($feed);
  $feed = str_replace('@', '', $feed);
  $feed = str_replace('#', '', $feed);
  $feed = str_replace($qlttf_api->tiktok_url, '', $feed);
  $feed = str_replace('/explore/tags/', '', $feed);
  $feed = str_replace('/', '', $feed);

  return $feed;
}

// Return user profile
// -----------------------------------------------------------------------------
function qlttf_get_username_profile($username = null) {

  global $qlttf_api;

  $defaults = array(
      'id' => $username,
      'username' => $username,
      'full_name' => '',
      'profile_pic_url' => 'http://2.gravatar.com/avatar/b642b4217b34b1e8d3bd915fc65c4452?s=150&d=mm&r=g',
      'profile_pic_url_hd' => 'http://2.gravatar.com/avatar/b642b4217b34b1e8d3bd915fc65c4452?s=320&d=mm&r=g',
      'link' => "{$qlttf_api->tiktok_url}/@{$username}",
      'video_count' => 0
  );

  if (empty($username)) {
    return $defaults;
  }

  $tk = "tiktok_feed_username_profile_{$username}"; // transient key

  if (!QLTTF_DEVELOPER && false !== ($profile_info = get_transient($tk))) {
    return wp_parse_args($profile_info, $defaults);
  }

  if (!$_profile_info = $qlttf_api->getUserNameProfile($username)) {
    return $defaults;
  }

  $settings_model = new QLTTF_Setting();
  $settings = $settings_model->get_settings();

  $profile_info = wp_parse_args($_profile_info, $defaults);

  set_transient($tk, $profile_info, absint($settings['reset']) * HOUR_IN_SECONDS);


  return $profile_info;
}

// Return tag info
// -----------------------------------------------------------------------------
function qlttf_get_hashtag_profile($hashtag = null) {

  global $qlttf_api;

  $defaults = array(
      'id' => '',
      'username' => $hashtag,
      'full_name' => $hashtag,
      'profile_pic_url' => plugins_url('/assets/backend/img/hashtag.svg', QLTTF_PLUGIN_FILE),
      'profile_pic_url_hd' => plugins_url('/assets/backend/img/hashtag.svg', QLTTF_PLUGIN_FILE),
      'link' => "{$qlttf_api->tiktok_url}/tag/{$hashtag}",
      'video_count' => 0
  );

  if (empty($hashtag)) {
    return $defaults;
  }

  $tk = "tiktok_feed_hashtag_profile_{$hashtag}"; // transient key

  if (!QLTTF_DEVELOPER && false !== ($profile_info = get_transient($tk))) {
    return wp_parse_args($profile_info, $defaults);
  }

  if (!$_profile_info = $qlttf_api->getHashTagProfile($hashtag)) {
    return $defaults;
  }

  $profile_info = wp_parse_args(array_filter($_profile_info), $defaults);
  $settings_model = new QLTTF_Setting();
  $settings = $settings_model->get_settings();

  set_transient($tk, $profile_info, absint($settings['reset']) * HOUR_IN_SECONDS);

  return $profile_info;
}

// Get user feed
// -----------------------------------------------------------------------------
function qlttf_get_username_videos($username = null, $limit = 12, $last_id = null, $after = null) {

  global $qlttf_api;

  if (!$username) {
    $qlttf_api->setMessage(esc_html__('Please update TikTok username in the feed settings.', 'wp-tiktok-feed'));
    return;
  }

  $tk = "tiktok_feed_username_videos_{$username}_{$after}";

  // Get any existing copy of our transient data
  if (QLTTF_DEVELOPER || false === ($response = get_transient($tk))) {

    $response = $qlttf_api->getUserNameMedia($username, $after);

    if (!isset($response['itemListData'])) {
      return;
    }

    if (!count($response['itemListData'])) {
      return;
    }

    $settings_model = new QLTTF_Setting();
    $settings = $settings_model->get_settings();

    set_transient($tk, $response, absint($settings['reset']) * HOUR_IN_SECONDS);
  }

  $feeds = $qlttf_api->setupMediaItems($response['itemListData'], $last_id);

//  if (!$last_id) {
  return $feeds;
//  }
//  if (count($feeds) >= $limit) {
//    return $feeds;
//  }
//
//  if (!isset($response['paging']['next'])) {
//    return $feeds;
//  }
//
//  if (!isset($response['paging']['cursors']['after'])) {
//    return $feeds;
//  }
//
//  $after = $response['paging']['cursors']['after'];
//
//  return array_merge($feeds, qlttf_get_username_videos($username, $limit, $last_id, $after));
}

// Get tag items
// -----------------------------------------------------------------------------
function qlttf_get_hashtag_videos($hashtag = null, $limit = 12, $last_id = null, $after = null) {

  global $qlttf_api;

  if (!$hashtag) {
    $qlttf_api->setMessage(esc_html__('Please update TikTok tag in the feed settings.', 'wp-tiktok-feed'));
    return;
  }

  $tk = "tiktok_feed_hashtag_videos_{$hashtag}_{$after}";

  // Get any existing copy of our transient data
  if (QLTTF_DEVELOPER || false === ($response = get_transient($tk))) {

    $response = $qlttf_api->getHashTagMedia($hashtag, $after);

    if (!isset($response['itemListData'])) {
      return;
    }

    if (!count($response['itemListData'])) {
      return;
    }

    $settings_model = new QLTTF_Setting();
    $settings = $settings_model->get_settings();

    set_transient($tk, $response, absint($settings['reset']) * HOUR_IN_SECONDS);
  }

  $feeds = $qlttf_api->setupMediaItems($response['itemListData'], $last_id);

//  if (!$last_id) {
  return $feeds;
//  }
//  if (count($feeds) >= $limit) {
//    return $feeds;
//  }
//
//  if (!isset($response['paging']['next'])) {
//    return $feeds;
//  }
//
//  if (!isset($response['paging']['cursors']['after'])) {
//    return $feeds;
//  }
//
//  $after = $response['paging']['cursors']['after'];
//
//  return array_merge($feeds, qlttf_get_hashtag_videos($hashtag, $limit, $last_id, $after));
}
