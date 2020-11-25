<?php
/**
 * Plugin Name:       QuadLayers TikTok Feed
 * Plugin URI:        https://quadlayers.com/documentation/tiktok-feed/
 * Description:       Display beautiful and responsive galleries on your website from your TikTok feed account.
 * Version:           1.0.7
 * Author:            QuadLayers
 * Author URI:        https://quadlayers.com
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       wp-tiktok-feed
 * Domain Path:       /languages
 */
if (!defined('ABSPATH'))
    exit;

if (!defined('QLTTF_PLUGIN_NAME')) {
    define('QLTTF_PLUGIN_NAME', 'TikTok Feed');
}
if (!defined('QLTTF_PLUGIN_VERSION')) {
    define('QLTTF_PLUGIN_VERSION', '1.0.7');
}
if (!defined('QLTTF_PLUGIN_FILE')) {
    define('QLTTF_PLUGIN_FILE', __FILE__);
}
if (!defined('QLTTF_PLUGIN_DIR')) {
    define('QLTTF_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR);
}
if (!defined('QLTTF_DOMAIN')) {
    define('QLTTF_DOMAIN', 'qlttf');
}
if (!defined('QLTTF_PREFIX')) {
    define('QLTTF_PREFIX', QLTTF_DOMAIN);
}
if (!defined('QLTTF_WORDPRESS_URL')) {
    define('QLTTF_WORDPRESS_URL', 'https://wordpress.org/plugins/tiktok-feed/');
}
if (!defined('QLTTF_DEMO_URL')) {
    define('QLTTF_DEMO_URL', 'https://quadlayers.com/tiktok-feed/?utm_source=qlttf_admin');
}
if (!defined('QLTTF_SUPPORT_URL')) {
    define('QLTTF_SUPPORT_URL', 'https://quadlayers.com/account/support/?utm_source=qlttf_admin');
}
if (!defined('QLTTF_DOCUMENTATION_URL')) {
    define('QLTTF_DOCUMENTATION_URL', 'https://quadlayers.com/documentation/tiktok-feed/?utm_source=qlttf_admin');
}
if (!defined('QLTTF_GROUP_URL')) {
    define('QLTTF_GROUP_URL', 'https://www.facebook.com/groups/quadlayers');
}
if (!defined('QLTTF_DEVELOPER')) {
    define('QLTTF_DEVELOPER', false);
}

if (!class_exists('QLTTF')) {
    include_once( QLTTF_PLUGIN_DIR . 'includes/qlttf.php' );
}

register_activation_hook(QLTTF_PLUGIN_FILE, array('QLTTF', 'do_activation'));
