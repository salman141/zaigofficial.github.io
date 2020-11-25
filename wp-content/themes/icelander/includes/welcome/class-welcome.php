<?php
/**
 * Welcome Page Class
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.0
 *
 * Contents:
 *
 *   0) Init
 *  10) Renderer
 *  20) Admin menu
 *  30) Assets
 * 100) Others
 */
class Icelander_Welcome {





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

					// Actions

						add_action( 'admin_menu', __CLASS__ . '::admin_menu' );

						add_action( 'admin_enqueue_scripts', __CLASS__ . '::assets', 1000 );

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
	 * 10) Renderer
	 */

		/**
		 * Render the screen content
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function render() {

			// Helper variables

				$sections = (array) apply_filters( 'wmhook_icelander_welcome_render_sections', array(
						0   => 'header',
						10  => 'wordpress',
						20  => 'quickstart',
						30  => 'demo',
						100 => 'footer',
					) );

				ksort( $sections );


			// Output

				?>

				<div class="wrap welcome-wrap about-wrap">

					<?php

					do_action( 'wmhook_icelander_welcome_render_top' );

					foreach ( $sections as $section ) {
						get_template_part( 'templates/parts/admin/welcome', $section );
					}

					do_action( 'wmhook_icelander_welcome_render_bottom' );

					?>

				</div>

				<?php

		} // /render





	/**
	 * 20) Admin menu
	 */

		/**
		 * Add screen to WordPress admin menu
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function admin_menu() {

			// Processing

				add_theme_page(
						// $page_title
						esc_html__( 'Welcome', 'icelander' ),
						// $menu_title
						esc_html__( 'Welcome', 'icelander' ),
						// $capability
						'edit_theme_options',
						// $menu_slug
						'icelander-welcome',
						// $function
						__CLASS__ . '::render'
					);

		} // /admin_menu





	/**
	 * 30) Assets
	 */

		/**
		 * Styles and scripts
		 *
		 * Use large priority (over 998) when hooking this method
		 * to make sure the `icelander-welcome` stylesheet
		 * has been registered already.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $hook_suffix
		 */
		public static function assets( $hook_suffix = '' ) {

			// Requirements check

				if ( $hook_suffix !== get_plugin_page_hookname( 'icelander-welcome', 'themes.php' ) ) {
					return;
				}


			// Processing

				// Styles

					wp_enqueue_style( 'icelander-welcome' );

		} // /assets





	/**
	 * 100) Others
	 */

		/**
		 * Info text: Rate the theme.
		 *
		 * @since    1.5.0
		 * @version  1.5.0
		 */
		public static function get_info_like() {

			// Output

				return sprintf(
					esc_html_x( 'If you %1$s like this theme, please rate it %2$s', '%1$s: heart icon, %2$s: star icons', 'icelander' ),
					'<span class="dashicons dashicons-heart" style="color: red; vertical-align: middle;"></span>',
					'<a href="https://themeforest.net/downloads" style="display: inline-block; color: goldenrod; text-decoration-style: wavy; vertical-align: middle;"><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></span></a>'
				);

		} // /get_info_like



		/**
		 * Info text: Contact support.
		 *
		 * @since    1.5.0
		 * @version  1.5.0
		 */
		public static function get_info_support() {

			// Output

				return
					esc_html__( 'Have a suggestion for improvement or something is not working as it should?', 'icelander' )
					. ' <a href="https://support.webmandesign.eu/">'
					. esc_html__( 'Contact support center &rarr;', 'icelander' )
					. '</a>';

		} // /get_info_support





} // /Icelander_Welcome

add_action( 'after_setup_theme', 'Icelander_Welcome::init' );
