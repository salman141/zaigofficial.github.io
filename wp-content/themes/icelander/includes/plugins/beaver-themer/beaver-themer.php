<?php
/**
 * Plugin compatibility file.
 *
 * Beaver Themer
 *
 * @link  https://www.wpbeaverbuilder.com/beaver-themer/
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Plugin integration
 */





/**
 * 1) Requirements check
 */

	if ( ! class_exists( 'FLThemeBuilder' ) ) {
		return;
	}





/**
 * 10) Plugin integration
 */

	require ICELANDER_PATH_PLUGINS . 'beaver-themer/class-beaver-themer.php';
