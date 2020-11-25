<?php
/**
 * WooCommerce: Assets Class
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
class Icelander_WooCommerce_Assets {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		private function __construct() {

			// Processing

				// Actions

					add_action( 'wp_enqueue_scripts', __CLASS__ . '::assets', 100 );

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
		 * Enqueue assets
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function assets() {

			// Processing

				// Styles

					wp_enqueue_style(
						'icelander-stylesheet-woocommerce',
						get_theme_file_uri( 'assets/css/woocommerce.css' ),
						array( 'icelander-stylesheet-global' ),
						esc_attr( trim( ICELANDER_THEME_VERSION ) ),
						'screen'
					);
					wp_style_add_data( 'icelander-stylesheet-woocommerce', 'rtl', 'replace' );

					wp_enqueue_style(
						'icelander-stylesheet-custom-styles-woocommerce',
						get_theme_file_uri( 'assets/css/custom-styles-woocommerce.css' ),
						array( 'icelander-stylesheet-global' ),
						esc_attr( trim( ICELANDER_THEME_VERSION ) ),
						'screen'
					);

				// Scripts

					wp_enqueue_script(
							'icelander-scripts-woocommerce',
							get_theme_file_uri( 'assets/js/scripts-woocommerce.js' ),
							array( 'jquery' ),
							esc_attr( trim( ICELANDER_THEME_VERSION ) ),
							true
						);

		} // /assets





} // /Icelander_WooCommerce_Assets

add_action( 'after_setup_theme', 'Icelander_WooCommerce_Assets::init' );
