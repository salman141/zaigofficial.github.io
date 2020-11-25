<?php
/**
 * WebMan Amplifier: Helpers Class
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Pagination
 */
class Icelander_WebMan_Amplifier_Helpers {





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

						add_filter( 'wmhook_wmamp_wma_pagination_output', __CLASS__ . '::pagination' );

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
	 * 10) Pagination
	 */

		/**
		 * Adding `pagination` CSS class
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $output
		 */
		public static function pagination( $output ) {

			// Output

				return str_replace( 'wm-pagination', 'wm-pagination pagination', $output );

		} // /pagination





} // /Icelander_WebMan_Amplifier_Helpers

add_action( 'after_setup_theme', 'Icelander_WebMan_Amplifier_Helpers::init' );
