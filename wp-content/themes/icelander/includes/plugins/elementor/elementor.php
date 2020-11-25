<?php
/**
 * Plugin compatibility file.
 *
 * Elementor
 *
 * @link  https://wordpress.org/plugins/elementor/
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.5.0
 * @version  1.5.0
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Plugin integration
 */





/**
 * 1) Requirements check
 */

	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		return;
	}





/**
 * 10) Plugin integration
 */

	require ICELANDER_PATH_PLUGINS . 'elementor/class-elementor.php';
