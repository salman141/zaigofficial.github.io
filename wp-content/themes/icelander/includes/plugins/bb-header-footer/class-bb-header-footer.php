<?php
/**
 * Beaver Builder Header Footer Class
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Setup
 */
class Icelander_BB_Header_Footer {





	/**
	 * 0) Init
	 */

		/**
		 * Initialization
		 *
		 * @since    1.0.0
		 * @version  1.5.0
		 */
		public static function init() {

			// Processing

				// Setup

					add_theme_support( 'bb-header-footer' );

				// Hooks

					// Actions

						add_action( 'wp', __CLASS__ . '::hook_overrides', 999 );

		} // /init





	/**
	 * 10) Setup
	 */

		/**
		 * Hooks overrides
		 *
		 * @since    1.0.0
		 * @version  1.5.0
		 */
		public static function hook_overrides() {

			// Requirements check

				if ( is_admin() ) {
					return;
				}


			// Helper variables

				$header_id = BB_Header_Footer::get_settings( 'bb_header_id' );
				$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id' );


			// Processing

				// Custom header

					if ( ! empty( $header_id ) ) {
						remove_all_actions( 'tha_header_top' );
						remove_all_actions( 'tha_header_bottom' );

						add_action( 'tha_header_top', 'Icelander_Header::open' );
						add_action( 'tha_header_top', 'BB_Header_Footer::get_header_content', 20 );
						add_action( 'tha_header_bottom', 'Icelander_Header::close' );

						add_action( 'wp_enqueue_scripts', __CLASS__ . '::dequeue_header_scripts', 110 );

						add_filter( 'theme_mod_' . 'layout_header_sticky', '__return_false', 20 );
						add_filter( 'wmhook_icelander_skip_links_no_header', '__return_true' );
					}

				// Custom footer

					if ( ! empty( $footer_id ) ) {
						remove_all_actions( 'tha_footer_top' );
						remove_all_actions( 'tha_footer_bottom' );

						add_action( 'tha_footer_top', 'Icelander_Footer::open' );
						add_action( 'tha_footer_top', 'BB_Header_Footer::get_footer_content', 20 );
						add_action( 'tha_footer_bottom', 'Icelander_Footer::close' );

						add_filter( 'wmhook_icelander_skip_links_no_footer', '__return_true' );
					}

		} // /hook_overrides



		/**
		 * Dequeue theme header scripts
		 *
		 * @since    1.5.0
		 * @version  1.5.0
		 */
		public static function dequeue_header_scripts() {

			// Processing

				wp_dequeue_script( 'icelander-scripts-nav-a11y' );
				wp_dequeue_script( 'icelander-scripts-nav-mobile' );

		} // /dequeue_header_scripts





} // /Icelander_BB_Header_Footer

add_action( 'after_setup_theme', 'Icelander_BB_Header_Footer::init', 100 );
