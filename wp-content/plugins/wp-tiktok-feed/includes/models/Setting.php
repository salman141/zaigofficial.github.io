<?php

include_once 'Model.php';

class QLTTF_Setting extends QLTTF_Model
{

  protected $table = 'tiktok_feed_settings';

  function get_args()
  {
    return array(
      'flush' => 0,
      'reset' => 1,
      'spinner_id' => 666666
    );
  }

  function get_defaults()
  {
    return $this->get_args();
  }

  function get_settings()
  {

    $settings = wp_parse_args($this->get_all(), $this->get_defaults());

    return $settings;
  }

  function save($settings)
  {
    $settings = wp_parse_args($settings, $this->get_settings());
    return update_option($this->table, $settings);
  }

  function save_settings($settings_data = null)
  {
    return $this->save_all($settings_data);
  }
}
