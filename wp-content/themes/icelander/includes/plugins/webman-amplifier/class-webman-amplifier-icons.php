<?php
/**
 * WebMan Amplifier: Icons Class
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Setup
 */
class Icelander_WebMan_Amplifier_Icons {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Filters

						add_filter( 'wmhook_icons_default_iconfont_css_url', __CLASS__ . '::css_url' );

						add_filter( 'wmhook_icons_default_iconfont_config_path', __CLASS__ . '::config_path' );

		} // /__construct



		/**
		 * Initialization (get instance)
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function init() {

			// Processing

				if ( null === self::$instance ) {
					self::$instance = new self;
				}


			// Output

				return self::$instance;

		} // /init





	/**
	 * 10) Setup
	 */

		/**
		 * Default icon font CSS file URL
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function css_url() {

			// Output

				return get_theme_file_uri( 'assets/fonts/fontello/fontello.css' );

		} // /css_url



		/**
		 * Default icons config array file path.
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function config_path() {

			// Output

				return get_theme_file_path( 'assets/fonts/fontello/config.php' );

		} // /config_path





} // /Icelander_WebMan_Amplifier_Icons

add_action( 'after_setup_theme', 'Icelander_WebMan_Amplifier_Icons::init' );
