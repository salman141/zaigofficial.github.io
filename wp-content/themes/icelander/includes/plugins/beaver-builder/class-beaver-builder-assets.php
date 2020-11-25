<?php
/**
 * Beaver Builder: Assets Class
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.3.4
 *
 * Contents:
 *
 *  0) Init
 * 10) Setup
 * 20) Assets
 * 30) Custom styles
 */
class Icelander_Beaver_Builder_Assets {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.3.4
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Actions

						add_action( 'init', __CLASS__ . '::late_load', 900 );

						add_action( 'wp_enqueue_scripts', __CLASS__ . '::assets' );
						add_action( 'wp_enqueue_scripts', __CLASS__ . '::assets_widget_text' );

					// Filters

						add_filter( 'fl_builder_layout_style_media', __CLASS__ . '::stylesheet_layout_media' );

						add_filter( 'fl_builder_render_css', __CLASS__ . '::layout_styles', 10, 3 );

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
		 * Load plugin stylesheets after the theme stylesheet
		 *
		 * @since    1.0.0
		 * @version  1.1.9
		 */
		public static function late_load() {

			// Helper variables

				$priority  = 120;
				$callbacks = (array) apply_filters( 'wmhook_icelander_beaver_builder_assets_late_load_callbacks', array(
					'FLBuilder::enqueue_all_layouts_styles_scripts'     => 10,
					'FLBuilder::enqueue_ui_styles_scripts'              => 11,
					'FLBuilderUISettingsForms::enqueue_settings_config' => 11,
				) );

				$order = 0;


			// Processing

				foreach ( $callbacks as $callback => $default_priority ) {
					if ( is_callable( $callback ) ) {
						remove_action( 'wp_enqueue_scripts', $callback, $default_priority );
						   add_action( 'wp_enqueue_scripts', $callback, $priority + $order++ );
					}
				}

		} // /late_load



		/**
		 * Layout stylesheet media
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function stylesheet_layout_media() {

			// Output

				return 'screen';

		} // /stylesheet_layout_media





	/**
	 * 20) Assets
	 */

		/**
		 * Styles and scripts
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function assets() {

			// Processing

				if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {

					// Styles

						wp_enqueue_style(
								'icelander-bb-editor',
								get_theme_file_uri( 'assets/css/beaver-builder-editor.css' ),
								false,
								esc_attr( trim( ICELANDER_THEME_VERSION ) ),
								'screen'
							);

					// Scripts

						wp_enqueue_script(
								'icelander-bb-editor',
								get_theme_file_uri( 'assets/js/scripts-beaver-builder-editor.js' ),
								'fl-builder',
								esc_attr( trim( ICELANDER_THEME_VERSION ) ),
								true
							);

						if ( class_exists( 'Icelander_Beaver_Builder_Form' ) ) {

							$bb_settings = Icelander_Beaver_Builder_Form::register_settings_form( array(), 'col' );

							wp_localize_script(
									'icelander-bb-editor',
									'$icelanderBBPreview',
									array(
										'vertical_alignment' => array_values(
												array_filter(
													array_flip(
														(array) $bb_settings['tabs']['style']['sections']['general']['fields']['vertical_alignment']['options']
													)
												)
											),
										'predefined_color' => array_values(
												array_filter(
													array_flip(
														array_merge(
															(array) $bb_settings['tabs']['style']['sections']['colors_predefined']['fields']['predefined_color']['options']['optgroup-sections']['options'],
															(array) $bb_settings['tabs']['style']['sections']['colors_predefined']['fields']['predefined_color']['options']['optgroup-accents']['options']
														)
													)
												)
											),
									)
								);

						}

				}

		} // /assets



		/**
		 * Loading assets in Beaver Builder
		 *
		 * @subpackage  Widgets
		 *
		 * @since    1.2.0
		 * @version  1.2.0
		 */
		public static function assets_widget_text() {

			// Requirements check

				if (
					! is_callable( 'Icelander_WP_Widget_Text::enqueue' )
					|| ! is_callable( 'FLBuilderModel::is_builder_active' )
					|| ! FLBuilderModel::is_builder_active()
				) {
					return;
				}


			// Processing

				Icelander_WP_Widget_Text::enqueue();

		} // /assets_widget_text





	/**
	 * 30) Custom styles
	 */

		/**
		 * Custom layout styles
		 *
		 * @since    1.0.0
		 * @version  1.3.4
		 *
		 * @param  string $css
		 * @param  array  $nodes
		 * @param  object $global_settings
		 */
		public static function layout_styles( $css, $nodes, $global_settings ) {

			// Processing

				$css .= PHP_EOL.PHP_EOL;

				// Row width compensation

					$settings = array(
						'module_margins'            => false,
						'module_margins_medium'     => '@media (max-width: ' . absint( $global_settings->medium_breakpoint ) . 'px)',
						'module_margins_responsive' => '@media (max-width: ' . absint( $global_settings->responsive_breakpoint ) . 'px)',
					);

					foreach ( $settings as $setting => $wrapper ) {
						$margin_compensation = ( isset( $global_settings->{ $setting } ) ) ? ( $global_settings->{ $setting } ) : ( false );

						if ( is_numeric( $margin_compensation ) ) {
							$margin_compensation .= ( isset( $global_settings->{ $setting . '_unit' } ) ) ? ( $global_settings->{ $setting . '_unit' } ) : ( 'px' );

							$indent = ( $wrapper ) ? ( "\t" ) : ( '' );

							$css .= ( $wrapper ) ? ( $wrapper . ' {'.PHP_EOL ) : ( '' );
							$css .= $indent . '.fl-row-fixed-width .fl-row-content-wrap,'.PHP_EOL;
							$css .= $indent . '.fl-row-layout-full-fixed .fl-row-fixed-width > .fl-col-group {'.PHP_EOL;
							$css .= $indent . "\t".'width: auto;'.PHP_EOL;
							$css .= $indent . "\t".'max-width: calc(100% + ' . esc_attr( $margin_compensation ) . ' + ' . esc_attr( $margin_compensation ) . ');'.PHP_EOL;
							$css .= $indent . "\t".'margin-left: -' . esc_attr( $margin_compensation ) . ';'.PHP_EOL;
							$css .= $indent . "\t".'margin-right: -' . esc_attr( $margin_compensation ) . ';'.PHP_EOL;
							$css .= $indent . '}'.PHP_EOL;
							$css .= ( $wrapper ) ? ( '}'.PHP_EOL ) : ( '' );
						}
					}

				// Fixing responsive element hiding

					$css .= PHP_EOL.PHP_EOL;

					$css .= '@media (min-width: ' . absint( $global_settings->responsive_breakpoint + 1 ) . 'px) and (max-width: ' . absint( $global_settings->medium_breakpoint ) . 'px) {'.PHP_EOL;
					$css .= "\t".'.fl-col-group .fl-visible-desktop-medium.fl-col,'.PHP_EOL;
					$css .= "\t".'.fl-col-group .fl-visible-medium.fl-col,'.PHP_EOL;
					$css .= "\t".'.fl-col-group .fl-visible-medium-mobile.fl-col {'.PHP_EOL;
					$css .= "\t\t".'display: flex;'.PHP_EOL;
					$css .= "\t".'}'.PHP_EOL;
					$css .= '}'.PHP_EOL;

					$css .= '@media (max-width: ' . absint( $global_settings->responsive_breakpoint ) . 'px) {'.PHP_EOL;
					$css .= "\t".'.fl-col-group .fl-visible-medium-mobile.fl-col,'.PHP_EOL;
					$css .= "\t".'.fl-col-group .fl-visible-mobile.fl-col {'.PHP_EOL;
					$css .= "\t\t".'display: flex;'.PHP_EOL;
					$css .= "\t".'}'.PHP_EOL;
					$css .= '}'.PHP_EOL;


			// Output

				return $css;

		} // /layout_styles





} // /Icelander_Beaver_Builder_Assets

add_action( 'after_setup_theme', 'Icelander_Beaver_Builder_Assets::init' );
