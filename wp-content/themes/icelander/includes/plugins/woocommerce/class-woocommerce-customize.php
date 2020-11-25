<?php
/**
 * WooCommerce: Customize Class
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
 * 10) Options
 */
class Icelander_WooCommerce_Customize {





	/**
	 * 0) Init
	 */

		/**
		 * Initialization.
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function init() {

			// Processing

				// Hooks

					// Actions

						add_action( 'customize_register', __CLASS__ . '::options_pointers' );

					// Filters

						add_filter( 'wmhook_icelander_theme_options', __CLASS__ . '::options' );

		} // /init





	/**
	 * 10) Options
	 */

		/**
		 * Theme options addons and modifications
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 *
		 * @param  array $options
		 */
		public static function options( $options = array() ) {

			// Processing

				// WooCommerce specific options

					$options = array_merge( $options, array(

						970 . 'woocommerce' => array(
							'id'             => 'woocommerce',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Shop', 'Customizer section title.', 'icelander' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'icelander' ),
						),

							970 . 'woocommerce' . 100 => array(
								'type'    => 'html',
								'content' => '<h3>' . esc_html__( 'Cart and Checkout', 'icelander' ) . '</h3>',
							),

								970 . 'woocommerce' . 110 => array(
									'type'        => 'checkbox',
									'id'          => 'woocommerce_checkout_guide',
									'label'       => esc_html__( 'Display checkout guide', 'icelander' ),
									'description' => esc_html__( 'Enables the checkout process steps visualization.', 'icelander' ),
									'default'     => true,
									// No need for `preview_js` here as we also need to load the scripts.
								),

							970 . 'woocommerce' . 200 => array(
								'type'    => 'html',
								'content' => '<h3>' . esc_html__( 'Product', 'icelander' ) . '</h3>',
							),

								970 . 'woocommerce' . 220 => array(
									'type'    => 'html',
									'id'      => 'woocommerce_colors_product_widgets',
									'content' => '<p><span class="dashicons dashicons-info" aria-hidden="true"></span> <strong>' . esc_html__( 'Product widgets area colors', 'icelander' ) . '</strong><br>' . esc_html__( 'This widgets area inherits the colors of Footer Secondary Widgets area.', 'icelander' ) . '</p>',
								),

					) );


			// Output

				return $options;

		} // /options



		/**
		 * Theme options pointers
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $wp_customize  WP customizer object.
		 */
		public static function options_pointers( $wp_customize ) {

			// Processing

				$wp_customize->selective_refresh->add_partial( 'woocommerce_checkout_guide', array(
						'selector' => '.checkout-guide',
					) );

				$wp_customize->selective_refresh->add_partial( 'woocommerce_colors_product_widgets', array(
						'selector' => '.product-widgets-inner',
					) );

		} // /options_pointers





} // /Icelander_WooCommerce_Customize

add_action( 'after_setup_theme', 'Icelander_WooCommerce_Customize::init' );
