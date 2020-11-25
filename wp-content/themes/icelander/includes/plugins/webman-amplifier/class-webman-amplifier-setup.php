<?php
/**
 * WebMan Amplifier: Setup Class
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 * 0) Init
 */
class Icelander_WebMan_Amplifier_Setup {





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

				// Setup

					// Plugin features

						add_theme_support( 'webman-amplifier', apply_filters( 'wmhook_icelander_webman_amplifier_setup', array(
								'cp-modules',
								'cp-projects',
								'cp-staff',
								'cp-testimonials',
								'widget-module',
								'widget-subnav',
								'disable-isotope-notice',
								'disable-visual-composer-support',
							) ) );

					// Post types support

						add_post_type_support(
								'wm_staff',
								array(
									'excerpt',
									'custom-fields',
								)
							);

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





} // /Icelander_WebMan_Amplifier_Setup

add_action( 'after_setup_theme', 'Icelander_WebMan_Amplifier_Setup::init' );
