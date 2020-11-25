<?php
/**
 * One Click Demo Import Class
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
 *  10) Files
 *  20) Texts
 *  30) Setup
 * 100) Helpers
 */
class Icelander_One_Click_Demo_Import {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.1.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Actions

						add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles', 99 );

						add_action( 'pt-ocdi/before_content_import', __CLASS__ . '::before' );

						add_action( 'pt-ocdi/after_import', __CLASS__ . '::after' );

						add_action( 'pt-ocdi/before_widgets_import', __CLASS__ . '::before_widgets_import' );

					// Filters

						add_filter( 'pt-ocdi/import_files', __CLASS__ . '::files' );

						add_filter( 'pt-ocdi/plugin_intro_text', __CLASS__ . '::info' );

						add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

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
	 * 10) Files
	 */

		/**
		 * Import files setup
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function files() {

			// Output

				return array(

						array(
							'import_file_name'       => esc_html__( 'Theme demo content', 'icelander' ),
							'import_file_url'        => esc_url_raw( 'https://raw.githubusercontent.com/webmandesign/demo-content/master/icelander/content/demo-content-icelander.xml' ),
							'import_widget_file_url' => esc_url_raw( 'https://raw.githubusercontent.com/webmandesign/demo-content/master/icelander/widgets/demo-widgets-icelander.wie' ),
							'preview_url'            => 'https://themedemos.webmandesign.eu/icelander/',
						),

					);

		} // /files





	/**
	 * 20) Texts
	 */

		/**
		 * Info texts
		 *
		 * @since    1.0.0
		 * @version  1.5.0
		 *
		 * @param  string $text  Default intro text.
		 */
		public static function info( $text = '' ) {

			// Processing

				$text .= '<div class="media-files-quality-info">';

					$text .= '<h3>';
					$text .= esc_html__( 'Media files quality', 'icelander' );
					$text .= '</h3>';

					$text .= '<p>';
					$text .= esc_html__( 'Please note that imported media files (such as images, video and audio files) are of low quality to prevent copyright infringement.', 'icelander' );
					$text .= ' ' . esc_html__( 'Please read "Credits" section of theme documentation for reference where the demo media files were obtained from.', 'icelander' );
					$text .= ' <a href="https://webmandesign.github.io/docs/icelander/#credits">' . esc_html__( 'Get media for your website &raquo;', 'icelander' ) . '</a>';
					$text .= '</p>';

				$text .= '</div>';

				$text .= '<div class="ocdi__demo-import-notice">';

					$text .= '<h3>';
					$text .= esc_html__( 'Install demo required plugins!', 'icelander' );
					$text .= '</h3>';

					$text .= '<p>';
					$text .= esc_html__( 'Please read the information about the theme demo required plugins first.', 'icelander' );
					$text .= ' ' . esc_html__( 'If you do not install and activate demo required plugins, some of the content will not be imported.', 'icelander' );
					$text .= ' <a href="https://github.com/webmandesign/demo-content/tree/master/icelander/content#before-you-begin" title="' . esc_attr__( 'Read the information before you run the theme demo content import process.', 'icelander' ) . '"><strong>';
					$text .= esc_html__( 'View the list of required plugins &raquo;', 'icelander' );
					$text .= '</strong></a>';
					$text .= '</p>';

					$text .= '<p>';
					$text .= '<em>';
					$text .= esc_html__( '(Note that this set of plugins may differ from plugins recommended under Appearance &rarr; Install Plugins!)', 'icelander' );
					$text .= '</em>';
					$text .= '</p>';

				$text .= '</div>';


			// Output

				return $text;

		} // /info





	/**
	 * 30) Setup
	 */

		/**
		 * Before import actions
		 *
		 * @since    1.1.0
		 * @version  1.1.0
		 */
		public static function before() {

			// Helper variables

				$image_sizes = array_filter( (array) apply_filters( 'wmhook_icelander_setup_image_sizes', array() ) );


			// Processing

				// Default logo

					set_theme_mod( 'custom_logo', -1 );

				// Image sizes

					foreach ( array( 'thumbnail', 'medium', 'medium_large', 'large' ) as $size ) {
						if ( isset( $image_sizes[ $size ] ) ) {
							update_option( $size . '_size_w', $image_sizes[ $size ][0] );
							update_option( $size . '_size_h', $image_sizes[ $size ][1] );
							update_option( $size . '_crop', $image_sizes[ $size ][2] );
						}
					}

				// WooCommerce image sizes

					self::woocommerce_image_sizes();

		} // /before



		/**
		 * After import actions
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $selected_import
		 */
		public static function after( $selected_import = '' ) {

			// Processing

				// Theme options

					self::theme_options();

				// Front and blog page

					self::front_and_blog_page();

				// Menu locations

					self::menu_locations();

				// WooCommerce pages

					self::woocommerce_pages();

				// Beaver Builder setup

					self::beaver_builder();

		} // /after



		/**
		 * Setup theme options
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function theme_options() {

			// Processing

				set_theme_mod( 'external_header_video', 'https://youtu.be/vvxP5n2vsrw' );

		} // /theme_options



		/**
		 * Setup front and blog page
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function front_and_blog_page() {

			// Processing

				update_option( 'show_on_front', 'page' );

				// Front page

					$page = get_page_by_path( 'home' );

					update_option( 'page_on_front', $page->ID );

				// Blog page

					$page = get_page_by_path( 'blog' );

					update_option( 'page_for_posts', $page->ID );

		} // /front_and_blog_page



		/**
		 * Setup navigation menu locations
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function menu_locations() {

			// Helper variables

				$menu              = array();
				$menu['primary']   = get_term_by( 'slug', 'primary', 'nav_menu' );
				$menu['secondary'] = get_term_by( 'slug', 'secondary', 'nav_menu' );
				$menu['footer']    = get_term_by( 'slug', 'footer', 'nav_menu' );
				$menu['social']    = get_term_by( 'slug', 'social-links', 'nav_menu' );


			// Processing

				set_theme_mod( 'nav_menu_locations', array(
						'primary'   => ( isset( $menu['primary']->term_id ) ) ? ( $menu['primary']->term_id ) : ( null ),
						'secondary' => ( isset( $menu['secondary']->term_id ) ) ? ( $menu['secondary']->term_id ) : ( null ),
						'footer'    => ( isset( $menu['footer']->term_id ) ) ? ( $menu['footer']->term_id ) : ( null ),
						'social'    => ( isset( $menu['social']->term_id ) ) ? ( $menu['social']->term_id ) : ( null ),
					) );

		} // /menu_locations



		/**
		 * Remove all widgets from sidebars first
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function before_widgets_import() {

			// Processing

				delete_option( 'sidebars_widgets' );

		} // /before_widgets_import



		/**
		 * Setup WooCommerce pages
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function woocommerce_pages() {

			// Requirements check

				if ( ! class_exists( 'WooCommerce' ) ) {
					return;
				}


			// Processing

				// Shop page

					$page = get_page_by_path( 'shop' );

					update_option( 'woocommerce_shop_page_id', $page->ID );

				// Cart page

					$page = get_page_by_path( 'shop/cart' );

					update_option( 'woocommerce_cart_page_id', $page->ID );

				// Checkout page

					$page = get_page_by_path( 'shop/checkout' );

					update_option( 'woocommerce_checkout_page_id', $page->ID );

				// Terms and Conditions page

					$page = get_page_by_path( 'shop/terms-and-conditions' );

					update_option( 'woocommerce_terms_page_id', $page->ID );

				// My Account page

					$page = get_page_by_path( 'shop/my-account' );

					update_option( 'woocommerce_myaccount_page_id', $page->ID );

		} // /woocommerce_pages



		/**
		 * Setup WooCommerce image sizes
		 *
		 * Must be set before the images are imported to generate correct sizes.
		 *
		 * @since    1.0.0
		 * @version  1.1.0
		 */
		public static function woocommerce_image_sizes() {

			// Requirements check

				if ( ! class_exists( 'WooCommerce' ) ) {
					return;
				}


			// Processing

				// Shop images

					update_option( 'shop_catalog_image_size', array(
							'width'  => 480,
							'height' => 640,
							'crop'   => 1,
						) );
					add_image_size( 'shop_catalog_image_size', 480, 640, true );

					update_option( 'shop_single_image_size', array(
							'width'  => 1200,
							'height' => 1600,
							'crop'   => 1,
						) );
					add_image_size( 'shop_single_image_size', 1200, 1600, true );

					update_option( 'shop_thumbnail_image_size', array(
							'width'  => 120,
							'height' => 120,
							'crop'   => 1,
						) );
					add_image_size( 'shop_thumbnail_image_size', 120, 120, true );

		} // /woocommerce_image_sizes



		/**
		 * Setup Beaver Builder
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function beaver_builder() {

			// Processing

				// Page builder enabled post types

					update_option( '_fl_builder_post_types', array(
							'post',
							'page',
							'wm_projects',
							'wm_staff',
							'product',
						) );

		} // /beaver_builder





	/**
	 * 100) Helpers
	 */

		/**
		 * OCDI plugin admin page styles
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function styles() {

			// Processing

				// OCDI 2.0 styling fix

					wp_add_inline_style(
							'ocdi-main-css',
							'.ocdi.about-wrap { max-width: 66em; }'
						);

		} // /styles





} // /Icelander_One_Click_Demo_Import

add_action( 'after_setup_theme', 'Icelander_One_Click_Demo_Import::init', 5 ); // Hook before plugin setup (see plugin code).
