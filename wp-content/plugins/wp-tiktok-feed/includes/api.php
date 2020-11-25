<?php

if (!defined('ABSPATH'))
  exit;

class QLTTF_API
{

  public $message;
  public $tiktok_url = 'https://www.tiktok.com';
  private $tiktok_api_url = 'https://www.tiktok.com/node';

  function getHashTagProfile($hashtag)
  {

    if (!$hashtag) {
      return;
    }

    $url = "{$this->tiktok_api_url}/share/tag/{$hashtag}";

    $response = $this->remoteGet($url);

    if (!isset($response['body']['challengeData']['challengeId'])) {
      return;
    }

    return array(
      'id' => $response['body']['challengeData']['challengeId'],
      'full_name' => $response['body']['challengeData']['challengeName'],
      'username' => $hashtag,
      'video_count' => $response['body']['challengeData']['posts'],
      'views_count' => $response['body']['challengeData']['views'],
      'tagline' => $response['body']['challengeData']['text'],
      'profile_pic_url' => isset($response['body']['challengeData']['covers'][0]) ? $response['body']['challengeData']['covers'][0] : '',
      'profile_pic_url_hd' => isset($response['body']['challengeData']['coversMedium'][0]) ? $response['body']['challengeData']['coversMedium'][0] : '',
      'link' => "{$this->tiktok_url}/tag/{$hashtag}"
    );
  }

  function getHashTagMedia($hashtag = null, $after = null)
  {

    $profile = $this->getHashTagProfile($hashtag);

    if (!isset($profile['id'])) {
      return;
    }

    $url = add_query_arg(array(
      'id' => $profile['id'],
      'minCursor' => 0,
      'maxCursor' => 0,
      'count' => 30,
      'type' => 3
    ), "{$this->tiktok_api_url}/video/feed");

    $response = $this->remoteGet($url);

    if (!isset($response['body'])) {
      return;
    }

    return $response['body'];
  }

  function getUserNameProfile($username)
  {

    if (!$username) {
      return;
    }

    $url = "{$this->tiktok_api_url}/share/user/@{$username}";

    $response = $this->remoteGet($url);

    if (!isset($response['body']['userData']['userId'])) {
      return;
    }

    return array(
      'id' => $response['body']['userData']['userId'],
      'full_name' => $response['body']['userData']['nickName'],
      'username' => $response['body']['userData']['uniqueId'],
      'following_count' => $response['body']['userData']['following'],
      'fans_count' => $response['body']['userData']['fans'],
      'heart_count' => $response['body']['userData']['heart'],
      'video_count' => $response['body']['userData']['video'],
      'verified' => $response['body']['userData']['verified'],
      'tagline' => $response['body']['userData']['signature'],
      'profile_pic_url' => $response['body']['userData']['covers'][0],
      'profile_pic_url_hd' => $response['body']['userData']['coversMedium'][0],
      'link' => "{$this->tiktok_url}/@{$username}"
    );
  }

  function getUserNameMedia($username = null, $after = null)
  {

    $profile = $this->getUserNameProfile($username);

    if (!isset($profile['id'])) {
      return;
    }

    $url = add_query_arg(array(
      'id' => $profile['id'],
      'minCursor' => 0,
      'maxCursor' => 0,
      'count' => 30,
      'type' => 1
    ), "{$this->tiktok_api_url}/video/feed");

    $response = $this->remoteGet($url);

    if (!isset($response['body'])) {
      return;
    }

    return $response['body'];
  }

  function setupMediaItems($data, $last_id = null)
  {

    static $load = false;
    static $i = 1;

    if (!$last_id) {
      $load = true;
    }

    $tiktok_items = array();

    if (is_array($data) && !empty($data)) {

      foreach ($data as $item) {

        if ($load) {

          //preg_match_all("/#(\\w+)/", $item['itemInfos']['text'], $hashtags);
          preg_match_all('/(?<!\S)#([0-9a-zA-Z]+)/', @$item['itemInfos']['text'], $hashtags);

          $tiktok_items[] = array(
            'i' => $i,
            'id' => $item['itemInfos']['id'],
            'covers' => array(
              'default' => $item['itemInfos']['covers'][0],
              'origin' => $item['itemInfos']['coversOrigin'][0],
              'dynamic' => $item['itemInfos']['coversDynamic'][0],
              'video' => $item['itemInfos']['video']['urls'][0],
            ),
            'digg_count' => $item['itemInfos']['shareCount'],
            'comment_count' => $item['itemInfos']['commentCount'],
            'digg_count' => $item['itemInfos']['diggCount'],
            'play_count' => $item['itemInfos']['playCount'],
            'text' => preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', "<a target=\"_blank\" href=\"{$this->tiktok_url}/tag/$1\">#$1</a>", htmlspecialchars($item['itemInfos']['text'])),
            'hashtags' => isset($hashtags[1]) ? $hashtags[1] : '',
            'link' => "{$this->tiktok_url}/@{$item['authorInfos']['uniqueId']}/video/{$item['itemInfos']['id']}",
            'date' => date_i18n('j F, Y', strtotime($item['itemInfos']['createTime'])),
            'author' => array(
              'id' => $item['authorInfos']['userId'],
              'username' => $item['authorInfos']['uniqueId'],
              'full_name' => $item['authorInfos']['nickName'],
              'tagline' => $item['authorInfos']['signature'],
              'verified' => $item['authorInfos']['verified'],
              'image' => array(
                'small' => $item['authorInfos']['covers'][0],
                'medium' => $item['authorInfos']['coversMedium'][0],
                'larger' => $item['authorInfos']['coversLarger'][0],
              ),
              'link' => "{$this->tiktok_url}/@{$item['authorInfos']['uniqueId']}",
            )
          );
        }
        if ($last_id && ($last_id == $i)) {
          $i = $last_id;
          $load = true;
        }
        $i++;
      }
    }

    return $tiktok_items;
  }

  function validateResponse($json = null)
  {

    if (!($response = json_decode(wp_remote_retrieve_body($json), true)) || 200 !== wp_remote_retrieve_response_code($json)) {

      //        if (isset($response['error']['message'])) {
      //          $this->message = $response['error']['message'];
      //          return array(
      //              'error' => 1,
      //              'message' => $this->message
      //          );
      //        }

      if (is_wp_error($json)) {
        $response = array(
          'error' => 1,
          'message' => $json->get_error_message()
        );
      } else {
        $response = array(
          'error' => 1,
          'message' => esc_html__('Unknow error occurred, please try again', 'wp-tiktok-feed')
        );
      }
    }

    return $response;
  }

  function remoteGet($url = null, $args = array())
  {

    $args = wp_parse_args($args, array('timeout' => 29));

    $response = $this->validateResponse(wp_remote_get($url, $args));

    return (array) $response;
  }

  // Return message
  // ---------------------------------------------------------------------------
  public function getMessage()
  {
    return $this->message;
  }

  public function setMessage($message = '')
  {
    $this->message = $message;
  }
}
