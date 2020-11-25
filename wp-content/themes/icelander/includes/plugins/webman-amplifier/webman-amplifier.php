<?php
/**
 * Plugin compatibility file.
 *
 * WebMan Amplifier
 *
 * @link  https://wordpress.org/plugins/webman-amplifier/
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.1.0
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Plugin integration
 */





/**
 * 1) Requirements check
 */

	if ( ! class_exists( 'WM_Amplifier' ) ) {
		return;
	}





/**
 * 10) Plugin integration
 */

	define( 'ICELANDER_PATH_PLUGINS_WEBMAN_AMPLIFIER', ICELANDER_PATH_PLUGINS . 'webman-amplifier/class-webman-amplifier-' );

	require ICELANDER_PATH_PLUGINS_WEBMAN_AMPLIFIER . 'setup.php';
	require ICELANDER_PATH_PLUGINS_WEBMAN_AMPLIFIER . 'custom-post-types.php';
	require ICELANDER_PATH_PLUGINS_WEBMAN_AMPLIFIER . 'metaboxes.php';
	require ICELANDER_PATH_PLUGINS_WEBMAN_AMPLIFIER . 'shortcodes.php';
	require ICELANDER_PATH_PLUGINS_WEBMAN_AMPLIFIER . 'icons.php';
	require ICELANDER_PATH_PLUGINS_WEBMAN_AMPLIFIER . 'helpers.php';
