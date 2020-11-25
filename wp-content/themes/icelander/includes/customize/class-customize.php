<?php
/**
 * Theme Customization Class
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.5
 *
 * Contents:
 *
 *   0) Init
 *  10) Options
 *  20) Active callbacks
 *  30) Partial refresh
 * 100) Helpers
 */
class Icelander_Customize {





	/**
	 * 0) Init
	 */

		/**
		 * Initialization.
		 *
		 * @uses  `wmhook_icelander_theme_options` global hook
		 * @uses  `wmhook_icelander_css_rgb_alphas` global hook
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function init() {

			// Processing

				// Setup

					// Indicate widget sidebars can use selective refresh in the Customizer

						add_theme_support( 'customize-selective-refresh-widgets' );

				// Hooks

					// Actions

						add_action( 'customize_register', __CLASS__ . '::setup' );

					// Filters

						add_filter( 'wmhook_icelander_theme_options', __CLASS__ . '::options', 5 );
						add_filter( 'wmhook_icelander_theme_options', __CLASS__ . '::customize_preview_rgba', 100 );

						add_filter( 'wmhook_icelander_css_rgb_alphas', __CLASS__ . '::rgba_alphas' );

		} // /init





	/**
	 * 10) Options
	 */

		/**
		 * Modify native WordPress options and setup partial refresh
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 *
		 * @param  object $wp_customize  WP customizer object.
		 */
		public static function setup( $wp_customize ) {

			// Processing

				// Move the custom logo option down

					$wp_customize->get_control( 'custom_logo' )->priority = 101;

				// Remove header color in favor of theme options

					$wp_customize->remove_control( 'header_textcolor' );

				// Partial refresh

					// Site title

						$wp_customize->selective_refresh->add_partial( 'blogname', array(
								'selector'        => '.site-title-text',
								'render_callback' => __CLASS__ . '::partial_blogname',
							) );

					// Site description

						$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
								'selector'        => '.site-description',
								'render_callback' => __CLASS__ . '::partial_blogdescription',
							) );

					// Site info (footer credits)

						$wp_customize->selective_refresh->add_partial( 'texts_site_info', array(
								'selector'        => '.site-info',
								'render_callback' => __CLASS__ . '::partial_texts_site_info',
							) );

					// Option pointers only

						$wp_customize->selective_refresh->add_partial( 'blog_style', array(
								'selector' => '.blog #main > .posts',
							) );

						$wp_customize->selective_refresh->add_partial( 'layout_page_outdent', array(
								'selector' => '.page-layout-outdented:not(.content-layout-no-paddings):not(.fl-builder) .entry-content',
							) );

		} // /setup



		/**
		 * Set theme options array
		 *
		 * @since    1.0.0
		 * @version  1.5.3
		 *
		 * @param  array $options
		 */
		public static function options( $options = array() ) {

			// Helper variables

				// Registered image sizes

					$image_sizes = (array) get_intermediate_image_sizes();
					$image_sizes = array_combine( $image_sizes, $image_sizes );


			// Processing

				/**
				 * Theme customizer options array
				 */

					$options = array(

						/**
						 * Site identity: Logo image size
						 */
						'0' . 10 . 'logo' . 10 => array(
							'id'          => 'custom_logo_dimenstions_info',
							'section'     => 'title_tagline',
							'priority'    => 100,
							'type'        => 'html',
							'content'     => '<h3>' . esc_html__( 'Logo image', 'icelander' ) . '</h3>',
							'description' => esc_html__( 'Please, do not forget to set the logo max height.', 'icelander' ) . ' ' . esc_html__( 'To make your logo image ready for high DPI screens, please upload twice as big image.', 'icelander' ),
						),

							'0' . 10 . 'logo' . 20 => array(
								'section'     => 'title_tagline',
								'priority'    => 102,
								'type'        => 'text',
								'id'          => 'custom_logo_height',
								'label'       => esc_html__( 'Max logo image height (px)', 'icelander' ),
								'default'     => 50,
								'validate'    => 'absint',
								'input_attrs' => array(
									'size'     => 5,
									'maxwidth' => 3,
								),
								'css_var'     => 'Icelander_Library_Sanitize::css_pixels',
								'preview_js'  => array(
									'css' => array(
										':root' => array(
											array(
												'property' => '--[[id]]',
												'suffix'   => 'px',
											),
										),
									),
								),
							),



						/**
						 * Theme credits
						 */
						'0' . 90 . 'placeholder' => array(
							'id'                   => 'placeholder',
							'type'                 => 'section',
							'create_section'       => '',
							'in_panel'             => esc_html_x( 'Theme Options', 'Customizer panel title.', 'icelander' ),
							'in_panel-description' => '<h3>' . esc_html__( 'Theme Credits', 'icelander' ) . '</h3>'
								. '<p class="description">'
								. sprintf(
									esc_html_x( '%1$s is a WordPress theme developed by %2$s.', '1: linked theme name, 2: theme author name.', 'icelander' ),
									'<a href="' . esc_url( wp_get_theme( 'icelander' )->get( 'ThemeURI' ) ) . '"><strong>' . esc_html( wp_get_theme( 'icelander' )->get( 'Name' ) ) . '</strong></a>',
									'<strong>' . esc_html( wp_get_theme( 'icelander' )->get( 'Author' ) ) . '</strong>'
								)
								. '</p>'
								. '<p class="description">'
								. sprintf(
									esc_html_x( 'You can obtain other professional WordPress themes at %s.', '%s: theme author link.', 'icelander' ),
									'<strong><a href="' . esc_url( wp_get_theme( 'icelander' )->get( 'AuthorURI' ) ) . '">' . esc_html( str_replace( 'http://', '', untrailingslashit( wp_get_theme( 'icelander' )->get( 'AuthorURI' ) ) ) ) . '</a></strong>'
								)
								. '</p>'
								. '<p class="description">'
								. esc_html__( 'Thank you for using a theme by WebMan Design!', 'icelander' )
								. '</p>',
						),



						/**
						 * Colors: Accents and predefined colors
						 *
						 * Don't use `preview_js` here as these colors affect too many elements.
						 */
						100 . 'colors' . 10 => array(
							'id'             => 'colors-accents',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'icelander' ), esc_html_x( 'Accents', 'Customizer color section title', 'icelander' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'icelander' ),
						),



							/**
							 * Accent colors
							 */

								100 . 'colors' . 10 . 100 => array(
									'type'    => 'html',
									'content' => '<p class="description">' . esc_html__( 'These colors affect links, buttons and other elements.', 'icelander' ) . '</p>',
								),

								100 . 'colors' . 10 . 200 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Primary accent color', 'icelander' ) . '</h3>',
								),

									100 . 'colors' . 10 . 210 => array(
										'type'       => 'color',
										'id'         => 'color_accent',
										'label'      => esc_html__( 'Accent color', 'icelander' ),
										'default'    => '#dc1e35',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 10 . 220 => array(
										'type'        => 'color',
										'id'          => 'color_accent_text',
										'label'       => esc_html__( 'Accent text color', 'icelander' ),
										'description' => esc_html__( 'Color of text on accent color background.', 'icelander' ),
										'default'     => '#ffffff',
										'css_var'     => 'maybe_hash_hex_color',
										'preview_js'  => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),



						/**
						 * Colors: Header
						 */
						100 . 'colors' . 20 => array(
							'id'             => 'colors-header',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'icelander' ), esc_html_x( 'Header', 'Customizer color section title', 'icelander' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'icelander' ),
						),



							/**
							 * Header colors
							 */

								100 . 'colors' . 20 . 100 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Header', 'icelander' ) . '</h3>',
								),

									100 . 'colors' . 20 . 110 => array(
										'type'        => 'color',
										'id'          => 'color_header_background',
										'label'       => esc_html__( 'Background color', 'icelander' ),
										'description' => esc_html__( 'This color is also used to style a mobile device browser address bar.', 'icelander' ) . ' <a href="https://wordpress.org/plugins/chrome-theme-color-changer/">' . esc_html__( 'You can further customize it with a dedicated plugin.', 'icelander' ) . '</a>',
										'default'     => '#fffefe',
										'css_var'     => 'maybe_hash_hex_color',
										'preview_js'  => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 20 . 120 => array(
										'type'       => 'color',
										'id'         => 'color_header_text',
										'label'      => esc_html__( 'Text color', 'icelander' ),
										'default'    => '#545353',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 20 . 130 => array(
										'type'       => 'color',
										'id'         => 'color_header_headings',
										'label'      => esc_html__( 'Site title (logo) color', 'icelander' ),
										'default'    => '#242323',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),



							/**
							 * Header widgets colors
							 */

								100 . 'colors' . 20 . 300 => array(
									'type'        => 'html',
									'content'     => '<h3>' . esc_html__( 'Header widgets', 'icelander' ) . '</h3>',
									'description' => esc_html__( 'Please note that this widgets area is displayed only if it contains some widgets.', 'icelander' ),
								),

									100 . 'colors' . 20 . 310 => array(
										'type'       => 'color',
										'id'         => 'color_header_widgets_background',
										'label'      => esc_html__( 'Background color', 'icelander' ),
										'default'    => '#2e2d2d',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 20 . 320 => array(
										'type'       => 'color',
										'id'         => 'color_header_widgets_text',
										'label'      => esc_html__( 'Text color', 'icelander' ),
										'default'    => '#c4c3c3',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),



						/**
						 * Colors: Intro
						 */
						100 . 'colors' . 25 => array(
							'id'             => 'colors-intro',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'icelander' ), esc_html_x( 'Intro', 'Customizer color section title', 'icelander' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'icelander' ),
						),



							/**
							 * Intro colors
							 */

								100 . 'colors' . 25 . 100 => array(
									'type'        => 'html',
									'content'     => '<h3>' . esc_html__( 'Intro', 'icelander' ) . '</h3>',
									'description' => esc_html__( 'This is a specially styled, main, dominant page title section.', 'icelander' ),
								),

									100 . 'colors' . 25 . 110 => array(
										'type'       => 'color',
										'id'         => 'color_intro_background',
										'label'      => esc_html__( 'Background color', 'icelander' ),
										'default'    => '#242323',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 25 . 120 => array(
										'type'       => 'color',
										'id'         => 'color_intro_text',
										'label'      => esc_html__( 'Text color', 'icelander' ),
										'default'    => '#a4a3a3',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 25 . 130 => array(
										'type'       => 'color',
										'id'         => 'color_intro_headings',
										'label'      => esc_html__( 'Headings color', 'icelander' ),
										'default'    => '#e4e3e3',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),



						/**
						 * Special Intro colors
						 */

							100 . 'colors' . 25 . 200 => array(
								'type'        => 'html',
								'content'     => '<h3>' . esc_html__( 'Intro overlay', 'icelander' ) . '</h3>',
								'description' => esc_html__( 'Intro overlay is displayed on homepage only.', 'icelander' ),
							),

								100 . 'colors' . 25 . 210 => array(
									'type'       => 'color',
									'id'         => 'color_intro_overlay_background',
									'label'      => esc_html__( 'Background color', 'icelander' ),
									'default'    => '#000000',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
									'active_callback' => 'is_front_page',
								),
								100 . 'colors' . 25 . 220 => array(
									'type'       => 'color',
									'id'         => 'color_intro_overlay_text',
									'label'      => esc_html__( 'Text color', 'icelander' ),
									'default'    => '#ffffff',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
									'active_callback' => 'is_front_page',
								),
								100 . 'colors' . 25 . 230 => array(
									'type'       => 'range',
									'id'         => 'color_intro_overlay_opacity',
									'label'      => esc_html__( 'Overlay opacity', 'icelander' ),
									'default'    => .60,
									'min'        => .05,
									'max'        => .95,
									'step'       => .05,
									'multiplier' => 100,
									'suffix'     => '%',
									'validate'   => 'icelander_Library_Sanitize::float',
									'css_var'    => 'floatval',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
									'active_callback' => 'is_front_page',
								),



							/**
							 * Intro widgets colors
							 */

								100 . 'colors' . 25 . 500 => array(
									'type'        => 'html',
									'content'     => '<h3>' . esc_html__( 'Intro widgets', 'icelander' ) . '</h3>',
									'description' => esc_html__( 'Please note that this widgets area is displayed only if it contains some widgets.', 'icelander' ),
								),

									100 . 'colors' . 25 . 510 => array(
										'type'       => 'color',
										'id'         => 'color_intro_widgets_background',
										'label'      => esc_html__( 'Background color', 'icelander' ),
										'default'    => '#2e2d2d',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 25 . 520 => array(
										'type'       => 'color',
										'id'         => 'color_intro_widgets_text',
										'label'      => esc_html__( 'Text color', 'icelander' ),
										'default'    => '#a4a3a3',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 25 . 530 => array(
										'type'       => 'color',
										'id'         => 'color_intro_widgets_headings',
										'label'      => esc_html__( 'Headings color', 'icelander' ),
										'default'    => '#e4e3e3',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),



						/**
						 * Colors: Content
						 */
						100 . 'colors' . 30 => array(
							'id'             => 'colors-content',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'icelander' ), esc_html_x( 'Content', 'Customizer color section title', 'icelander' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'icelander' ),
						),



							/**
							 * Content colors
							 */

								100 . 'colors' . 30 . 100 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Content', 'icelander' ) . '</h3>',
								),

									100 . 'colors' . 30 . 110 => array(
										'type'       => 'color',
										'id'         => 'color_content_background',
										'label'      => esc_html__( 'Background color', 'icelander' ),
										'default'    => '#fdfcfc',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 30 . 120 => array(
										'type'       => 'color',
										'id'         => 'color_content_text',
										'label'      => esc_html__( 'Text color', 'icelander' ),
										'default'    => '#6f6e6e',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 30 . 130 => array(
										'type'       => 'color',
										'id'         => 'color_content_headings',
										'label'      => esc_html__( 'Headings color', 'icelander' ),
										'default'    => '#242323',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),



						/**
						 * Colors: Footer
						 */
						100 . 'colors' . 40 => array(
							'id'             => 'colors-footer',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'icelander' ), esc_html_x( 'Footer', 'Customizer color section title', 'icelander' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'icelander' ),
						),



							/**
							 * Footer colors
							 */

								100 . 'colors' . 40 . 100 => array(
									'type'        => 'html',
									'content'     => '<h3>' . esc_html__( 'Footer', 'icelander' ) . '</h3>',
									'description' => esc_html__( 'The main footer widgets area is displayed only if it contains some widgets.', 'icelander' ),
								),

									100 . 'colors' . 40 . 110 => array(
										'type'       => 'color',
										'id'         => 'color_footer_background',
										'label'      => esc_html__( 'Background color', 'icelander' ),
										'default'    => '#242323',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 40 . 120 => array(
										'type'       => 'color',
										'id'         => 'color_footer_text',
										'label'      => esc_html__( 'Text color', 'icelander' ),
										'default'    => '#a4a3a3',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 40 . 130 => array(
										'type'       => 'color',
										'id'         => 'color_footer_headings',
										'label'      => esc_html__( 'Headings color', 'icelander' ),
										'default'    => '#e4e3e3',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),

									100 . 'colors' . 40 . 140 => array(
										'type'       => 'image',
										'id'         => 'footer_image',
										'label'      => esc_html__( 'Background image', 'icelander' ),
										'default'    => trailingslashit( get_template_directory_uri() ) . 'assets/images/footer/footer.jpg',
										'css_var'    => 'Icelander_Library_Sanitize::css_image_url',
										'preview_js' => array(
											'custom' => "jQuery( '.site-footer' ).addClass( 'is-customize-preview' );",
											'css'    => array(
												':root' => array(
													array(
														'property' => '--[[id]]',
														'prefix'   => 'url("',
														'suffix'   => '")',
													),
												),
											),
										),
									),
										100 . 'colors' . 40 . 141 => array(
											'type'       => 'select',
											'id'         => 'footer_image_position',
											'label'      => esc_html__( 'Image position', 'icelander' ),
											'default'    => '50% 50%',
											'choices'    => array(

												'0 0'    => esc_html_x( 'Top left', 'Image position.', 'icelander' ),
												'50% 0'  => esc_html_x( 'Top center', 'Image position.', 'icelander' ),
												'100% 0' => esc_html_x( 'Top right', 'Image position.', 'icelander' ),

												'0 50%'    => esc_html_x( 'Center left', 'Image position.', 'icelander' ),
												'50% 50%'  => esc_html_x( 'Center', 'Image position.', 'icelander' ),
												'100% 50%' => esc_html_x( 'Center right', 'Image position.', 'icelander' ),

												'0 100%'    => esc_html_x( 'Bottom left', 'Image position.', 'icelander' ),
												'50% 100%'  => esc_html_x( 'Bottom center', 'Image position.', 'icelander' ),
												'100% 100%' => esc_html_x( 'Bottom right', 'Image position.', 'icelander' ),

											),
											'css_var'    => 'esc_attr',
											'preview_js' => array(
												'css' => array(
													':root' => array(
														'--[[id]]',
													),
												),
											),
										),
										100 . 'colors' . 40 . 142 => array(
											'type'       => 'select',
											'id'         => 'footer_image_size',
											'label'      => esc_html__( 'Image size', 'icelander' ),
											'default'    => 'cover',
											'choices'    => array(
												'auto'    => esc_html_x( 'Original', 'Image size.', 'icelander' ),
												'contain' => esc_html_x( 'Fit', 'Image size.', 'icelander' ),
												'cover'   => esc_html_x( 'Fill', 'Image size.', 'icelander' ),
											),
											'css_var'    => 'esc_attr',
											'preview_js' => array(
												'css' => array(
													':root' => array(
														'--[[id]]',
													),
												),
											),
										),
										100 . 'colors' . 40 . 143 => array(
											'type'       => 'checkbox',
											'id'         => 'footer_image_repeat',
											'label'      => esc_html__( 'Tile the image', 'icelander' ),
											'default'    => true,
											'css_var'    => 'Icelander_Library_Sanitize::css_checkbox_background_repeat',
											'preview_js' => array(
												'custom' => "jQuery( '.site-footer' ).addClass( 'is-customize-preview' ).css( 'background-repeat', ( to ) ? ( 'repeat' ) : ( 'no-repeat' ) );",
											),
										),
										100 . 'colors' . 40 . 144 => array(
											'type'       => 'checkbox',
											'id'         => 'footer_image_attachment',
											'label'      => esc_html__( 'Fix image position', 'icelander' ),
											'default'    => false,
											'css_var'    => 'Icelander_Library_Sanitize::css_checkbox_background_attachment',
											'preview_js' => array(
												'custom' => "jQuery( '.site-footer' ).addClass( 'is-customize-preview' ).css( 'background-attachment', ( to ) ? ( 'fixed' ) : ( 'scroll' ) );",
											),
										),
										100 . 'colors' . 40 . 145 => array(
											'type'       => 'range',
											'id'         => 'footer_image_opacity',
											'label'      => esc_html__( 'Background image opacity', 'icelander' ),
											'default'    => .05,
											'min'        => .05,
											'max'        => 1,
											'step'       => .05,
											'multiplier' => 100,
											'suffix'     => '%',
											'validate'   => 'Icelander_Library_Sanitize::float',
											'css_var'    => 'floatval',
											'preview_js' => array(
												'css' => array(
													':root' => array(
														'--[[id]]',
													),
												),
											),
										),



							/**
							 * Footer secondary widgets colors
							 */

								100 . 'colors' . 40 . 200 => array(
									'type'        => 'html',
									'content'     => '<h3>' . esc_html__( 'Secondary widgets', 'icelander' ) . '</h3>',
									'description' => esc_html__( 'Please note that this widgets area is displayed only if it contains some widgets.', 'icelander' ),
								),

									100 . 'colors' . 40 . 210 => array(
										'type'       => 'color',
										'id'         => 'color_footer_secondary_background',
										'label'      => esc_html__( 'Background color', 'icelander' ),
										'default'    => '#dc1e35',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 40 . 220 => array(
										'type'       => 'color',
										'id'         => 'color_footer_secondary_text',
										'label'      => esc_html__( 'Text color', 'icelander' ),
										'default'    => '#fefbfb',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 40 . 230 => array(
										'type'       => 'color',
										'id'         => 'color_footer_secondary_headings',
										'label'      => esc_html__( 'Headings color', 'icelander' ),
										'default'    => '#ffffff',
										'css_var'    => 'maybe_hash_hex_color',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),



						/**
						 * Blog
						 */
						200 . 'blog' => array(
							'id'             => 'blog',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Blog', 'Customizer section title.', 'icelander' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'icelander' ),
						),

							200 . 'blog' . 100 => array(
								'type'        => 'radio',
								'id'          => 'blog_style',
								'label'       => esc_html__( 'Blog style', 'icelander' ),
								'description' => esc_html__( 'This layout style will be applied on blog, category and tag archive pages.', 'icelander' ),
								'default'     => 'masonry',
								'choices'     => array(
									'masonry' => esc_html_x( 'Masonry', 'Blog style.', 'icelander' ),
									'list'    => esc_html_x( 'List', 'Blog style.', 'icelander' ),
									'minimal' => esc_html_x( 'Minimal (without sidebar)', 'Blog style.', 'icelander' ),
								),
							),

							200 . 'blog' . 110 => array(
								'type'            => 'select',
								'id'              => 'blog_style_masonry_image_size',
								'label'           => esc_html__( 'Masonry image size', 'icelander' ),
								'description'     => esc_html__( 'Select a size for post thumbnail image in masonry style blog.', 'icelander' ),
								'default'         => 'thumbnail',
								'choices'         => (array) $image_sizes,
								'active_callback' => __CLASS__ . '::is_blog_style_masonry',
							),



						/**
						 * Layout
						 */
						300 . 'layout' => array(
							'id'             => 'layout',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Layout', 'Customizer section title.', 'icelander' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'icelander' ),
						),



							/**
							 * Site layout
							 */

								300 . 'layout' . 100 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html_x( 'Site Container', 'A website container.', 'icelander' ) . '</h3>',
								),

									300 . 'layout' . 110 => array(
										'type'    => 'radio',
										'id'      => 'layout_site',
										'label'   => esc_html__( 'Website layout', 'icelander' ),
										'default' => 'boxed',
										'choices' => array(
											'fullwidth' => esc_html__( 'Fullwidth', 'icelander' ),
											'boxed'     => esc_html__( 'Boxed', 'icelander' ),
										),
										// No need for `preview_js` here as it won't trigger the `active_callback` below.
									),

									300 . 'layout' . 120 => array(
										'type'        => 'range',
										'id'          => 'layout_width_site',
										'label'       => esc_html__( 'Website max width', 'icelander' ),
										'description' => esc_html__( 'For boxed website layout.', 'icelander' ) . '<br />' . sprintf( esc_html__( 'Default value: %s', 'icelander' ), number_format_i18n( 1920 ) ),
										'default'     => 1920,
										'min'         => 1000,
										'max'         => 1920, // cca 1920 x 96%
										'step'        => 20,
										'suffix'      => 'px',
										'css_var'     => 'Icelander_Library_Sanitize::css_pixels',
										'preview_js'  => array(
											'custom' => "jQuery( '.masthead-placeholder #masthead' ).css( 'width', jQuery( '.masthead-placeholder' ).outerWidth() + 'px' );",
											'css'    => array(
												':root' => array(
													array(
														'property' => '--[[id]]',
														'suffix'   => 'px',
													),
												),
											),
										),
										'active_callback' => __CLASS__ . '::is_layout_site_boxed',
									),
									300 . 'layout' . 130 => array(
										'type'        => 'range',
										'id'          => 'layout_width_content',
										'label'       => esc_html__( 'Content width', 'icelander' ),
										'description' => sprintf( esc_html__( 'Default value: %s', 'icelander' ), number_format_i18n( 1200 ) ),
										'default'     => 1200,
										'min'         => 880,
										'max'         => 1620, // cca ( 1920 x 96% ) x 88%
										'step'        => 20,
										'suffix'      => 'px',
										'css_var'     => 'Icelander_Library_Sanitize::css_pixels',
										'preview_js'  => array(
											'css' => array(
												':root' => array(
													array(
														'property' => '--[[id]]',
														'suffix'   => 'px',
													),
												),
											),
										),
									),



							/**
							 * Header layout
							 */

								300 . 'layout' . 200 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Header', 'icelander' ) . '</h3>',
								),

									300 . 'layout' . 210 => array(
										'type'    => 'radio',
										'id'      => 'layout_header',
										'label'   => esc_html__( 'Header layout', 'icelander' ),
										'default' => 'boxed',
										'choices' => array(
											'fullwidth' => esc_html__( 'Fullwidth', 'icelander' ),
											'boxed'     => esc_html__( 'Boxed', 'icelander' ),
										),
										'preview_js'  => array(
											'custom' => "jQuery( 'body' ).toggleClass( 'header-layout-boxed' ).toggleClass( 'header-layout-fullwidth' );",
										),
									),

									300 . 'layout' . 220 => array(
										'type'        => 'checkbox',
										'id'          => 'layout_header_sticky',
										'label'       => esc_html__( 'Sticky header', 'icelander' ),
										'description' => esc_html__( 'Allow header to appear when user attempt to scroll up.', 'icelander' ),
										'default'     => true,
										// No need for `preview_js` here as we also need to load the scripts.
									),



							/**
							 * Intro layout
							 */

								300 . 'layout' . 300 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Intro', 'icelander' ) . '</h3>',
								),

									300 . 'layout' . 310 => array(
										'type'        => 'radio',
										'id'          => 'layout_intro_widgets_display',
										'label'       => esc_html__( 'Enable intro widgets', 'icelander' ),
										'description' => esc_html__( 'If you enable this widget area also for archives, we recommend using a plugin to control its appearance further more.', 'icelander' ) . ' <a href="https://wordpress.org/plugins/search/sidebars/">' . esc_html__( 'You can use any sidebar management plugin from WordPress.org.', 'icelander' ) . '</a>',
										'default'     => '',
										'choices'     => array(
											''       => esc_html__( 'On singular pages only', 'icelander' ),
											'always' => esc_html__( 'On both archive and singular pages', 'icelander' ),
										),
									),



							/**
							 * Content layout
							 */

								300 . 'layout' . 400 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Content', 'icelander' ) . '</h3>',
								),

									300 . 'layout' . 410 => array(
										'type'        => 'checkbox',
										'id'          => 'layout_page_outdent',
										'label'       => esc_html__( 'Outdented page content', 'icelander' ),
										'description' => esc_html__( 'Page content will be displayed in 2 columns: H2 headings in first, all the other page content in second column.', 'icelander' ) . ' ' . esc_html__( 'This does not affect pages using "With sidebar" page template.', 'icelander' ),
										'default'     => true,
										'preview_js'  => array(
											'custom' => "jQuery( 'body.page:not(.page-template-sidebar)' ).toggleClass( 'page-layout-outdented' );",
										),
									),



							/**
							 * Footer layout
							 */

								300 . 'layout' . 500 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Footer', 'icelander' ) . '</h3>',
								),

									300 . 'layout' . 510 => array(
										'type'    => 'radio',
										'id'      => 'layout_footer',
										'label'   => esc_html__( 'Footer layout', 'icelander' ),
										'default' => 'boxed',
										'choices' => array(
											'fullwidth' => esc_html__( 'Fullwidth', 'icelander' ),
											'boxed'     => esc_html__( 'Boxed', 'icelander' ),
										),
										'preview_js'  => array(
											'custom' => "jQuery( 'body' ).toggleClass( 'footer-layout-boxed' ).toggleClass( 'footer-layout-fullwidth' );",
										),
									),



						/**
						 * Texts
						 *
						 * Don't use `preview_js` here as it outputs escaped HTML.
						 */
						800 . 'texts' => array(
							'id'             => 'texts',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Texts', 'Customizer section title.', 'icelander' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'icelander' ),
						),

							800 . 'texts' . 500 => array(
								'type'        => 'textarea',
								'id'          => 'texts_site_info',
								'label'       => esc_html__( 'Footer credits (copyright)', 'icelander' ),
								'description' => sprintf( esc_html__( 'Set %s to disable this area.', 'icelander' ), '<code>-</code>' ) . ' ' . esc_html__( 'Leaving the field empty will fall back to default theme setting.', 'icelander' ),
								'default'     => '',
								'validate'    => 'wp_kses_post',
								'preview_js'  => array(
									'custom' => "jQuery( '.site-info' ).html( to ); if ( '-' === to ) { jQuery( '.footer-area-site-info' ).hide(); } else { jQuery( '.footer-area-site-info:hidden' ).show(); }",
								),
							),



						/**
						 * Typography
						 */
						900 . 'typography' => array(
							'id'             => 'typography',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Typography', 'Customizer section title.', 'icelander' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'icelander' ),
						),

							900 . 'typography' . 100 => array(
								'type'        => 'range',
								'id'          => 'typography_size_html',
								'label'       => esc_html__( 'Basic font size in px', 'icelander' ),
								'description' => esc_html__( 'All other font sizes are calculated automatically from this basic font size.', 'icelander' ),
								'default'     => 16,
								'min'         => 12,
								'max'         => 24,
								'step'        => 1,
								'suffix'      => 'px',
								'validate'    => 'absint',
								'css_var'     => 'Icelander_Library_Sanitize::css_pixels',
								'preview_js'  => array(
									'css' => array(
										':root' => array(
											array(
												'property' => '--[[id]]',
												'suffix'   => 'px',
											),
										),
									),
								),
							),

							900 . 'typography' . 200 => array(
								'type'        => 'checkbox',
								'id'          => 'typography_custom_fonts',
								'label'       => esc_html__( 'Use custom fonts', 'icelander' ),
								'description' => esc_html__( 'Disables theme default fonts loading and lets you set up your own custom fonts.', 'icelander' ),
								'default'     => false,
							),

								900 . 'typography' . 210 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Custom fonts setup', 'icelander' ) . '</h3><p class="description">' . sprintf(
											esc_html_x( 'This theme does not restrict you to choose from a predefined set of fonts. Instead, please use any font service (such as %s) plugin you like.', '%s: linked examples of web fonts libraries such as Google Fonts or Adobe Typekit.', 'icelander' ),
											'<a href="http://www.google.com/fonts"><strong>Google Fonts</strong></a>, <a href="https://typekit.com/fonts"><strong>Adobe Typekit</strong></a>'
										) . '</p><p class="description">' . esc_html__( 'You can set your fonts plugin according to information provided below, or insert your custom font names (a value of "font-family" CSS property) directly into input fields (you still need to use a plugin to load those fonts on the website).', 'icelander' ) . '</p>',
									'active_callback' => __CLASS__ . '::is_typography_custom_fonts',
								),

								900 . 'typography' . 220 => array(
									'type'            => 'text',
									'id'              => 'typography_fonts_text',
									'label'           => esc_html__( 'General text font', 'icelander' ),
									'description'     => sprintf(
										esc_html__( 'Default value: %s', 'icelander' ),
										'<code>' . "'Fira Sans', 'Helvetica Neue', Arial, sans-serif" . '</code>'
									),
									'default'         => "'Fira Sans', 'Helvetica Neue', Arial, sans-serif",
									'input_attrs'     => array(
										'placeholder' => "'Fira Sans', 'Helvetica Neue', Arial, sans-serif",
									),
									'active_callback' => __CLASS__ . '::is_typography_custom_fonts',
									'validate'        => 'Icelander_Library_Sanitize::fonts',
									'css_var'         => 'Icelander_Library_Sanitize::css_fonts',
								),

								900 . 'typography' . 230 => array(
									'type'            => 'text',
									'id'              => 'typography_fonts_headings',
									'label'           => esc_html__( 'Headings font', 'icelander' ),
									'description'     => sprintf(
										esc_html__( 'Default value: %s', 'icelander' ),
										'<code>' . "'Fira Sans', 'Helvetica Neue', Arial, sans-serif" . '</code>'
									),
									'default'         => "'Fira Sans', 'Helvetica Neue', Arial, sans-serif",
									'input_attrs'     => array(
										'placeholder' => "'Fira Sans', 'Helvetica Neue', Arial, sans-serif",
									),
									'active_callback' => __CLASS__ . '::is_typography_custom_fonts',
									'validate'        => 'Icelander_Library_Sanitize::fonts',
									'css_var'         => 'Icelander_Library_Sanitize::css_fonts',
								),

								900 . 'typography' . 240 => array(
									'type'            => 'text',
									'id'              => 'typography_fonts_logo',
									'label'           => esc_html__( 'Logo font', 'icelander' ),
									'description'     => sprintf(
										esc_html__( 'Default value: %s', 'icelander' ),
										'<code>' . "'Fira Sans', 'Helvetica Neue', Arial, sans-serif" . '</code>'
									),
									'default'         => "'Fira Sans', 'Helvetica Neue', Arial, sans-serif",
									'input_attrs'     => array(
										'placeholder' => "'Fira Sans', 'Helvetica Neue', Arial, sans-serif",
									),
									'active_callback' => __CLASS__ . '::is_typography_custom_fonts',
									'validate'        => 'Icelander_Library_Sanitize::fonts',
									'css_var'         => 'Icelander_Library_Sanitize::css_fonts',
								),

								900 . 'typography' . 290 => array(
									'type'            => 'html',
									'content'         => '<h3>' . esc_html__( 'Info: CSS selectors', 'icelander' ) . '</h3>'
										. '<p class="description">' . esc_html__( 'Here you can find CSS selectors/variables list associated with each font group in the theme. You can use these in your custom font plugin settings.', 'icelander' ) . '</p>'

										. '<p>'
										. '<strong>' . esc_html__( 'General text font CSS selectors:', 'icelander' ) . '</strong>'
										. '</p>'
										. '<pre>'
										. '--typography_fonts_text'
										. '</pre>'

										. '<p>'
										. '<strong>' . esc_html__( 'Headings font CSS selectors:', 'icelander' ) . '</strong>'
										. '</p>'
										. '<pre>'
										. '--typography_fonts_headings'
										. '</pre>'

										. '<p>'
										. '<strong>' . esc_html__( 'Logo font CSS selectors:', 'icelander' ) . '</strong>'
										. '</p>'
										. '<pre>'
										. '--typography_fonts_logo'
										. '</pre>',
									'active_callback' => __CLASS__ . '::is_typography_custom_fonts',
								),



						/**
						 * Others
						 */
						950 . 'others' => array(
							'id'             => 'others',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Others', 'Customizer section title.', 'icelander' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'icelander' ),
						),

							950 . 'others' . 100 => array(
								'type'        => 'checkbox',
								'id'          => 'admin_welcome_page',
								'label'       => esc_html__( 'Show "Welcome" page', 'icelander' ),
								'description' => esc_html__( 'Under "Appearance" WordPress dashboard menu.', 'icelander' ),
								'default'     => true,
								'preview_js'  => false, // This is to prevent customizer preview reload
							),

							950 . 'others' . 110 => array(
								'type'        => 'checkbox',
								'id'          => 'navigation_mobile',
								'label'       => esc_html__( 'Enable mobile navigation', 'icelander' ),
								'description' => esc_html__( 'If your website navigation is very simple and you do not want to use the mobile navigation functionality, you can disable it here.', 'icelander' ),
								'default'     => true,
							),



					);


			// Output

				return $options;

		} // /options





	/**
	 * 20) Active callbacks
	 */

		/**
		 * Is site layout: Boxed?
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $control
		 */
		public static function is_layout_site_boxed( $control ) {

			// Helper variables

				$option = $control->manager->get_setting( 'layout_site' );


			// Output

				return ( 'boxed' == $option->value() );

		} // /is_layout_site_boxed



		/**
		 * Is site layout: Fullwidth?
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $control
		 */
		public static function is_layout_site_fullwidth( $control ) {

			// Helper variables

				$option = $control->manager->get_setting( 'layout_site' );


			// Output

				return ( 'fullwidth' == $option->value() );

		} // /is_layout_site_fullwidth



		/**
		 * Do you want to use custom fonts?
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $control
		 */
		public static function is_typography_custom_fonts( $control ) {

			// Helper variables

				$option = $control->manager->get_setting( 'typography_custom_fonts' );


			// Output

				return (bool) $option->value();

		} // /is_typography_custom_fonts



		/**
		 * Is masonry blog style?
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $control
		 */
		public static function is_blog_style_masonry( $control ) {

			// Helper variables

				$option = $control->manager->get_setting( 'blog_style' );


			// Output

				return ( 'masonry' == $option->value() );

		} // /is_blog_style_masonry





	/**
	 * 30) Partial refresh
	 */

		/**
		 * Render the site title for the selective refresh partial
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function partial_blogname() {

			// Output

				bloginfo( 'name' );

		} // /partial_blogname



		/**
		 * Render the site tagline for the selective refresh partial
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function partial_blogdescription() {

			// Output

				bloginfo( 'description' );

		} // /partial_blogdescription



		/**
		 * Render the site info in the footer for the selective refresh partial
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function partial_texts_site_info() {

			// Helper variables

				$site_info_text = trim( get_theme_mod( 'texts_site_info' ) );


			// Output

				?>

				<div class="site-info">
					<?php

					if ( empty( $site_info_text ) ) {
						esc_html_e( 'Please set your website credits text or the theme default one will be displayed.', 'icelander' );
					} else {
						echo (string) $site_info_text;
					}

					?>
				</div>

				<?php

		} // /partial_texts_site_info





	/**
	 * 100) Helpers
	 */

		/**
		 * Alpha values (%) for generating rgba() colors.
		 *
		 * Don't forget to update CSS variables too.
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 *
		 * @param  array $alphas
		 */
		public static function rgba_alphas( $alphas = array() ) {

			// Output

				return array(
					'color_content_text'          => 20,
					'color_footer_secondary_text' => 20,
					'color_footer_text'           => 20,
					'color_header_text'           => 20,
					'color_header_widgets_text'   => 20,
					'color_intro_text'            => 20,
					'color_intro_widgets_text'    => 20,
				);

		} // /rgba_alphas



		/**
		 * Customize preview RGBA colors.
		 *
		 * @uses  `wmhook_icelander_css_rgb_alphas` global hook
		 *
		 * @since    1.4.0
		 * @version  1.5.5
		 *
		 * @param  array $options
		 */
		public static function customize_preview_rgba( $options = array() ) {

			// Variables

				$alphas = (array) apply_filters( 'wmhook_icelander_css_rgb_alphas', array() );


			// Processing

				foreach ( $options as $key => $option ) {
					if (
						isset( $option['css_var'] )
						&& isset( $alphas[ $option['id'] ] )
					) {
						$options[ $key ]['preview_js']['css'][':root'][] = array(
							'property'         => '--[[id]]--a' . absint( $alphas[ $option['id'] ] ),
							'prefix'           => 'rgba(',
							'suffix'           => ',.' . absint( $alphas[ $option['id'] ] ) . ')',
							'process_callback' => 'icelander.Customize.hexToRgbJoin',
						);

						// Automatically adding also transparent RGBA color.
						$options[ $key ]['preview_js']['css'][':root'][] = array(
							'property'         => '--[[id]]--a0',
							'prefix'           => 'rgba(',
							'suffix'           => ',0)',
							'process_callback' => 'icelander.Customize.hexToRgbJoin',
						);
					}
				}


			// Output

				return $options;

		} // /customize_preview_rgba





} // /Icelander_Customize

add_action( 'after_setup_theme', 'Icelander_Customize::init' );
