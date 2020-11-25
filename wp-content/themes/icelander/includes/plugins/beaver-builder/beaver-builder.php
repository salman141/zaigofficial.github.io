<?php
/**
 * Plugin compatibility file.
 *
 * Beaver Builder
 *
 * @link  https://www.wpbeaverbuilder.com/
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

	if ( ! class_exists( 'FLBuilder' ) ) {
		return;
	}





/**
 * 10) Plugin integration
 */

	define( 'ICELANDER_PATH_PLUGINS_BEAVER_BUILDER', ICELANDER_PATH_PLUGINS . 'beaver-builder/class-beaver-builder-' );

	require ICELANDER_PATH_PLUGINS_BEAVER_BUILDER . 'setup.php';
	require ICELANDER_PATH_PLUGINS_BEAVER_BUILDER . 'assets.php';
	require ICELANDER_PATH_PLUGINS_BEAVER_BUILDER . 'form.php';
	require ICELANDER_PATH_PLUGINS_BEAVER_BUILDER . 'row.php';
	require ICELANDER_PATH_PLUGINS_BEAVER_BUILDER . 'column.php';
	require ICELANDER_PATH_PLUGINS_BEAVER_BUILDER . 'helpers.php';
