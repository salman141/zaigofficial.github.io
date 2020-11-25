<?php
/**
 * Plugins recommendations
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
 * 10) Functionality
 */





/**
 * 1) Requirements check
 */

	if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
		return;
	}





/**
 * 20) Functionality
 */

	require ICELANDER_PATH_INCLUDES . 'tgmpa/class-tgmpa-plugins.php';
