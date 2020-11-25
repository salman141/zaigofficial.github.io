<?php
/**
 * Admin class
 *
 * @package     WebMan WordPress Theme Framework
 * @subpackage  Admin
 *
 * @since    1.0.0
 * @version  2.0.2
 * @version  1.4.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Assets
 */
final class Icelander_Library_Admin {





	/**
	 * 0) Init
	 */

		/**
		 * Initialization.
		 *
		 * @since    1.0.0
		 * @version  1.5.0
		 * @version  1.4.0
		 */
		public static function init() {

			// Processing

				// Hooks

					// Actions

						add_action( 'admin_enqueue_scripts', __CLASS__ . '::assets', 998 );

		} // /init





	/**
	 * 10) Assets
	 */

		/**
		 * Admin assets
		 *
		 * @since    1.0.0
		 * @version  2.0.2
		 */
		public static function assets() {

			// Processing

				// Register

					// Styles

						$register_styles = apply_filters( 'wmhook_icelander_library_admin_assets_register_styles', array(
								'icelander-welcome' => array( get_theme_file_uri( ICELANDER_LIBRARY_DIR . 'css/welcome.css' ) ),
							) );

						foreach ( $register_styles as $handle => $atts ) {
							$src   = ( isset( $atts['src'] )   ) ? ( $atts['src']   ) : ( $atts[0] );
							$deps  = ( isset( $atts['deps'] )  ) ? ( $atts['deps']  ) : ( false    );
							$ver   = ( isset( $atts['ver'] )   ) ? ( $atts['ver']   ) : ( esc_attr( ICELANDER_THEME_VERSION ) );
							$media = ( isset( $atts['media'] ) ) ? ( $atts['media'] ) : ( 'screen' );

							wp_register_style( $handle, $src, $deps, $ver, $media );
						}

					// RTL setup

						wp_style_add_data( 'icelander-welcome', 'rtl', 'replace' );

		} // /assets





} // /Icelander_Library_Admin

add_action( 'admin_init', 'Icelander_Library_Admin::init' );
