<?php
/**
 * Welcome Page
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
 * 10) Admin page
 */





/**
 * 1) Requirements check
 */

	if (
			! is_admin()
			|| ! get_theme_mod( 'admin_welcome_page', true )
		) {
		return;
	}





/**
 * 10) Admin page
 */

	require ICELANDER_PATH_INCLUDES . 'welcome/class-welcome.php';
