<?php

class QLTTF_Controller {

  function error_ajax($data) {
    return wp_send_json_error($data);
  }

  function success_ajax($data) {
    return wp_send_json_success($data);
  }

  function error_reload_page() {
    return wp_send_json_error(esc_html__('Please, reload page', 'wp-tiktok-feed'));
  }

  function error_access_denied() {
    return wp_send_json_error(esc_html__('Access denied', 'wp-tiktok-feed'));
  }

}
