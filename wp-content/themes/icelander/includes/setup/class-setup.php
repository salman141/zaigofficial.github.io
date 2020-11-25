<?php
/**
 * Theme Setup Class
 *
 * Theme options with `__` prefix (`get_theme_mod( '__option_id' )`) are theme
 * setup related options and can not be edited via customizer.
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.2
 *
 * Contents:
 *
 *  0) Init
 * 10) Installation
 * 20) Setup
 * 30) Globals
 * 40) Images
 * 50) Typography
 * 60) Visual editor
 * 70) Others
 */
class Icelander_Setup {





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

				// Setup

					self::content_width();

				// Hooks

					// Actions

						add_action( 'load-themes.php', __CLASS__ . '::welcome_admin_notice_activation' );

						add_action( 'after_setup_theme', __CLASS__ . '::setup' );

						add_action( 'after_setup_theme', __CLASS__ . '::visual_editor' );

						add_action( 'init', __CLASS__ . '::register_meta' );

						add_action( 'admin_init', __CLASS__ . '::image_sizes_notice' );

					// Filters

						add_filter( 'wmhook_icelander_setup_image_sizes', __CLASS__ . '::image_sizes' );

						add_filter( 'wmhook_icelander_assets_google_fonts_url_fonts_setup', __CLASS__ . '::google_fonts' );

						add_filter( 'wmhook_icelander_library_editor_custom_mce_format', __CLASS__ . '::visual_editor_formats' );

						add_filter( 'wmhook_icelander_is_masonry_layout', __CLASS__ . '::is_masonry' );

						add_filter( 'wmhook_icelander_widget_css_classes', __CLASS__ . '::widget_css_classes' );

						add_filter( 'wmhook_icelander_esc_css', 'wp_strip_all_tags' );

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
	 * 10) Installation
	 */

		/**
		 * Initiate "Welcome" admin notice
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function welcome_admin_notice_activation() {

			// Processing

				global $pagenow;

				if (
					is_admin()
					&& 'themes.php' == $pagenow
					&& isset( $_GET['activated'] )
				) {

					add_action( 'admin_notices', __CLASS__ . '::welcome_admin_notice', 99 );

				}

		} // /welcome_admin_notice_activation



		/**
		 * Display "Welcome" admin notice
		 *
		 * @since    1.0.0
		 * @version  1.5.2
		 */
		public static function welcome_admin_notice() {

			// Requirements check

				if ( ! class_exists( 'Icelander_Welcome' ) ) {
					return;
				}


			// Variables

				$theme_name = wp_get_theme( 'icelander' )->get( 'Name' );


			// Output

				?>

				<div class="updated notice is-dismissible theme-welcome-notice">
					<h2>
						<?php

						printf(
							esc_html__( 'Thank you for installing %s theme!', 'icelander' ),
							'<strong>' . $theme_name . '</strong>'
						);

						?>
					</h2>
					<p>
						<?php esc_html_e( 'Visit "Welcome" page for information on how to set up your website.', 'icelander' ); ?>
						<br>
						<?php echo Icelander_Welcome::get_info_like(); ?>
					</p>
					<p class="call-to-action">
						<a href="<?php echo esc_url( admin_url( 'themes.php?page=icelander-welcome' ) ); ?>" class="button button-primary button-hero">
							<?php esc_html_e( 'Show "Welcome" page', 'icelander' ); ?>
						</a>
					</p>
				</div>

				<?php

				// Related styles

				?>

				<style type="text/css" media="screen">

					.notice.theme-welcome-notice {
						padding: 1.62em;
						line-height: 1.62;
						font-size: 1.38em;
						text-align: center;
						border: 0;
					}

					.theme-welcome-notice h2 {
						margin: 0 0 .62em;
						line-height: inherit;
						font-size: 1.62em;
						font-weight: 400;
					}

					.theme-welcome-notice p {
						font-size: inherit;
					}

					.theme-welcome-notice a {
						padding-bottom: 0;
					}

					.theme-welcome-notice strong {
						font-weight: bolder;
					}

					.theme-welcome-notice .call-to-action {
						margin-top: 1em;
					}

					.theme-welcome-notice .button.button {
						font-size: 1em;
					}

				</style>

				<?php

		} // /welcome_admin_notice





	/**
	 * 20) Setup
	 */

		/**
		 * Theme setup
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function setup() {

			// Helper variables

				$image_sizes   = array_filter( (array) apply_filters( 'wmhook_icelander_setup_image_sizes', array() ) );
				$editor_styles = array_filter( (array) apply_filters( 'wmhook_icelander_setup_editor_stylesheets', array() ) );


			// Processing

				// Localization

					/**
					 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
					 */

					// wp-content/languages/themes/icelander/en_GB.mo

						load_theme_textdomain( 'icelander', trailingslashit( WP_LANG_DIR ) . 'themes/' . get_template() );

					// wp-content/themes/child-theme/languages/en_GB.mo

						load_theme_textdomain( 'icelander', get_stylesheet_directory() . '/languages' );

					// wp-content/themes/icelander/languages/en_GB.mo

						load_theme_textdomain( 'icelander', get_template_directory() . '/languages' );

				// Declare support for child theme stylesheet automatic enqueuing

					add_theme_support( 'child-theme-stylesheet' );

				// Add editor stylesheets

					add_editor_style( $editor_styles );

				// Custom menus

					/**
					 * @see  includes/frontend/class-menu.php
					 */

				// Title tag

					/**
					 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
					 */
					add_theme_support( 'title-tag' );

				// Site logo

					/**
					 * @link  https://codex.wordpress.org/Theme_Logo
					 */
					add_theme_support( 'custom-logo' );

				// Feed links

					/**
					 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#Feed_Links
					 */
					add_theme_support( 'automatic-feed-links' );

				// Enable HTML5 markup

					/**
					 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
					 */
					add_theme_support( 'html5', array(
							'caption',
							'comment-form',
							'comment-list',
							'gallery',
							'search-form',
						) );

				// Custom header

					/**
					 * @see  includes/custom-header/class-intro.php
					 */

				// Custom background

					/**
					 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Background
					 */
					add_theme_support( 'custom-background', apply_filters( 'wmhook_icelander_setup_custom_background_args', array(
							'default-color' => 'e4e3e3',
						) ) );

				// Post formats

					/**
					 * @see  includes/frontend/class-post-media.php
					 */

				// Thumbnails support

					/**
					 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
					 */
					add_theme_support( 'post-thumbnails', array( 'attachment:audio', 'attachment:video' ) );
					add_theme_support( 'post-thumbnails' );

					// Image sizes (x, y, crop)

						if ( ! empty( $image_sizes ) ) {
							foreach ( $image_sizes as $size => $setup ) {
								if ( ! in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
									add_image_size(
										$size,
										$image_sizes[ $size ][0],
										$image_sizes[ $size ][1],
										$image_sizes[ $size ][2]
									);
								}
							}
						}

		} // /setup





	/**
	 * 30) Globals
	 */

		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet
		 *
		 * Priority -100 to make it available to lower priority callbacks.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @global  int $content_width
		 */
		public static function content_width() {

			// Processing

				$content_width = absint( get_theme_mod( 'layout_width_content', 1200 ) );
				$site_width    = absint( get_theme_mod( 'layout_width_site', 1920 ) );

				// Make content width max 88% of site width

					if ( $content_width > absint( $site_width * .88 ) ) {
						$content_width = absint( $site_width * .88 );
					}

				// Allow filtering

					$GLOBALS['content_width'] = absint( apply_filters( 'wmhook_icelander_content_width', $content_width ) );

		} // /content_width





	/**
	 * 40) Images
	 */

		/**
		 * Image sizes
		 *
		 * @example
		 *
		 *   $image_sizes = array(
		 *     'image_size_id' => array(
		 *       absint( width ),
		 *       absint( height ),
		 *       (bool) cropped?,
		 *       (string) optional_theme_usage_explanation_text
		 *     )
		 *   );
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $image_sizes
		 */
		public static function image_sizes( $image_sizes = array() ) {

			// Helper variables

				global $content_width;

				// Intro image size

					if ( 'boxed' === get_theme_mod( 'layout_site', 'boxed' ) ) {

						$intro_width = absint( get_theme_mod( 'layout_width_site', 1920 ) );

						if ( 1000 > $intro_width ) {
							// Can't set site width less then 1000 px,
							// so default to max boxed site width then.
							$intro_width = 1920;
						}

					} else {

						$intro_width = 1920;

					}


			// Processing

				$image_sizes = array(

						'thumbnail' => array(
								480,
								absint( 480 * 9 / 16 ),
								true,
								esc_html__( 'In shortcodes and page builder modules.', 'icelander' ),
							),

						'medium' => array(
								absint( $content_width * .62 ),
								0,
								false,
								esc_html__( 'As featured image preview on single post page.', 'icelander' ) . '<br>' .
								esc_html__( 'In Projects.', 'icelander' ) . '<br>' .
								esc_html__( 'In Staff posts.', 'icelander' ) . '<br>' .
								esc_html__( 'In list of child pages.', 'icelander' ),
							),

						'large' => array(
								absint( $content_width ),
								0,
								false,
								esc_html__( 'Not used in the theme.', 'icelander' ),
							),

						/**
						 * @since  WordPress 4.4.0
						 */
						'medium_large' => array(
								absint( $content_width ),
								0,
								false,
								esc_html__( 'This is WordPress native image size.', 'icelander' ) . '<br>' .
								esc_html__( 'Not used in the theme.', 'icelander' ),
							),

						'icelander-thumbnail' => array(
								absint( $content_width * .62 ),
								absint( $content_width * .62 / 2 ),
								true,
								esc_html__( 'In posts list.', 'icelander' ),
							),

						'icelander-square' => array(
								448,
								448,
								true,
								esc_html__( 'In Testimonials.', 'icelander' ),
							),

						'icelander-intro' => array(
								absint( $intro_width ),
								absint( 9 * $intro_width / 16 ),
								true,
								esc_html__( 'In page intro section.', 'icelander' ),
							),

					);


			// Output

				return $image_sizes;

		} // /image_sizes



		/**
		 * Register recommended image sizes notice
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function image_sizes_notice() {

			// Processing

				add_settings_field(
						// $id
						'recommended-image-sizes',
						// $title
						'',
						// $callback
						__CLASS__ . '::image_sizes_notice_html',
						// $page
						'media',
						// $section
						'default',
						// $args
						array()
					);

				register_setting(
						// $option_group
						'media',
						// $option_name
						'recommended-image-sizes',
						// $sanitize_callback
						'esc_attr'
					);

		} // /image_sizes_notice



		/**
		 * Display recommended image sizes notice
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function image_sizes_notice_html() {

			// Processing

				get_template_part( 'templates/parts/admin/media', 'image-sizes' );

		} // /image_sizes_notice_html





	/**
	 * 50) Typography
	 */

		/**
		 * Google Fonts
		 *
		 * Custom fonts setup left for plugins.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $fonts_setup
		 */
		public static function google_fonts( $fonts_setup ) {

			// Requirements check

				if ( get_theme_mod( 'typography_custom_fonts', false ) ) {
					return array();
				}


			// Helper variables

				$fonts_setup = array();


			// Processing

				/**
				 * translators: Do not translate into your own language!
				 * If there are characters in your language that are not
				 * supported by the font, translate this to 'off'.
				 * The font will not load then.
				 */
				if ( 'off' !== esc_html_x( 'on', 'Fira Sans font: on or off', 'icelander' ) ) {
					$fonts_setup[] = 'Fira+Sans:100,300,400,700,900';
				}


			// Output

				return $fonts_setup;

		} // /google_fonts





	/**
	 * 60) Visual editor
	 */

		/**
		 * Include Visual Editor (TinyMCE) setup
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function visual_editor() {

			// Processing

				if (
						is_admin()
						|| isset( $_GET['fl_builder'] )
					) {

					require_once ICELANDER_LIBRARY . 'includes/classes/class-visual-editor.php';

				}

		} // /visual_editor



		/**
		 * TinyMCE "Formats" dropdown alteration
		 *
		 * @since    1.0.0
		 * @version  1.1.0
		 *
		 * @param  array $formats
		 */
		public static function visual_editor_formats( $formats ) {

			// Requirements check

				global $post;

				if ( ! isset( $post ) ) {
					return $formats;
				}


			// Processing

				// Font weight classes

					$font_weights = array(

							// Font weight names from https://developer.mozilla.org/en/docs/Web/CSS/font-weight

							100 => esc_html__( 'Thin (hairline) text', 'icelander' ),
							200 => esc_html__( 'Extra light text', 'icelander' ),
							300 => esc_html__( 'Light text', 'icelander' ),
							400 => esc_html__( 'Normal weight text', 'icelander' ),
							500 => esc_html__( 'Medium text', 'icelander' ),
							600 => esc_html__( 'Semi bold text', 'icelander' ),
							700 => esc_html__( 'Bold text', 'icelander' ),
							800 => esc_html__( 'Extra bold text', 'icelander' ),
							900 => esc_html__( 'Heavy text', 'icelander' ),

						);

					$formats[ 250 . 'text_weights' ] = array(
							'title' => esc_html__( 'Text weights', 'icelander' ),
							'items' => array(),
						);

					foreach ( $font_weights as $weight => $name ) {

						$formats[ 250 . 'text_weights' ]['items'][ 250 . 'text_weights' . $weight ] = array(
								'title'    => $name . ' (' . $weight . ')',
								'selector' => 'p, h1, h2, h3, h4, h5, h6, address, blockquote',
								'classes'  => 'weight-' . $weight,
							);

					} // /foreach

				// Font classes

					$formats[ 260 . 'font' ] = array(
							'title' => esc_html__( 'Fonts', 'icelander' ),
							'items' => array(

								100 . 'font' . 100 => array(
									'title'    => esc_html__( 'General font', 'icelander' ),
									'selector' => 'p, h1, h2, h3, h4, h5, h6, address, blockquote',
									'classes'  => 'font-body',
								),

								100 . 'font' . 110 => array(
									'title'    => esc_html__( 'Headings font', 'icelander' ),
									'selector' => 'p, h1, h2, h3, h4, h5, h6, address, blockquote',
									'classes'  => 'font-headings',
								),

								100 . 'font' . 120 => array(
									'title'    => esc_html__( 'Logo font', 'icelander' ),
									'selector' => 'p, h1, h2, h3, h4, h5, h6, address, blockquote',
									'classes'  => 'font-logo',
								),

								100 . 'font' . 130 => array(
									'title'    => esc_html__( 'Inherit font', 'icelander' ),
									'selector' => 'p, h1, h2, h3, h4, h5, h6, address, blockquote',
									'classes'  => 'font-inherit',
								),

							),
						);

				// Columns styles

					$formats[ 400 . 'columns' ] = array(
							'title' => esc_html__( 'Columns', 'icelander' ),
							'items' => array(),
						);

					for ( $i = 2; $i <= 3; $i++ ) {

						$formats[ 400 . 'columns' ]['items'][ 400 . 'columns' . ( 100 + 10 * $i ) ] = array(
								'title'   => sprintf( esc_html( _nx( 'Text in %d column', 'Text in %d columns', $i, '%d: Number of columns.', 'icelander' ) ), $i ),
								'classes' => 'text-columns-' . $i,
								'block'   => 'div',
								'wrapper' => true,
							);

					}

				// Buttons

					$formats[ 500 . 'buttons' ] = array(
							'title' => esc_html__( 'Buttons', 'icelander' ),
							'items' => array(

								500 . 'buttons' . 100 => array(
									'title'    => esc_html__( 'Button from link', 'icelander' ),
									'selector' => 'a',
									'classes'  => 'button',
								),

								500 . 'buttons' . 110 => array(
									'title'    => esc_html__( 'Button from link, small', 'icelander' ),
									'selector' => 'a',
									'classes'  => 'button size-small',
								),

								500 . 'buttons' . 120 => array(
									'title'    => esc_html__( 'Button from link, large', 'icelander' ),
									'selector' => 'a',
									'classes'  => 'button size-large',
								),

								500 . 'buttons' . 130 => array(
									'title'    => esc_html__( 'Button from link, extra large', 'icelander' ),
									'selector' => 'a',
									'classes'  => 'button size-extra-large',
								),

							),
						);

				// Outdent styles

					$formats[ 600 . 'media' ] = array(
							'title' => esc_html__( 'Outdent', 'icelander' ),
							'items' => array(

								600 . 'media' . 100 => array(
									'title'   => esc_html__( 'Outdent selected content', 'icelander' ),
									'classes' => 'outdent-content',
									'block'   => 'div',
									'wrapper' => true,
								),

							),
						);

					if ( 'page' === get_post_type( $post ) ) {

						$formats[ 600 . 'media' ]['items'][ 600 . 'media' . 110 ] = array(
								'title'    => esc_html__( 'Outdented heading style', 'icelander' ),
								'selector' => 'p, h1, h2, h3, h4, h5, h6',
								'classes'  => 'outdent-heading',
							);

					}




			// Output

				return $formats;

		} // /visual_editor_formats





	/**
	 * 70) Others
	 */

		/**
		 * Register post meta
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function register_meta() {

			// Processing

				register_meta( 'post', 'show_intro_widgets', 'absint' );
				register_meta( 'post', 'no_intro',           'absint' );
				register_meta( 'post', 'no_intro_media',     'absint' );
				register_meta( 'post', 'no_thumbnail',       'absint' );
				register_meta( 'post', 'content_layout',     'esc_attr' );
				register_meta( 'post', 'intro_image',        'esc_attr' );

		} // /register_meta



		/**
		 * When to use masonry posts layout?
		 *
		 * @since    1.0.0
		 * @version  1.1.3
		 */
		public static function is_masonry() {

			// Helper variables

				$is_masonry_blog = ( 'masonry' === get_theme_mod( 'blog_style', 'masonry' ) );
				$is_masonry_blog = $is_masonry_blog && ( is_home() || is_category() || is_tag() || is_date() || is_author() );


			// Output

				return $is_masonry_blog || is_search();

		} // /is_masonry



		/**
		 * Widget CSS classes
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $classes
		 */
		public static function widget_css_classes( $classes = array() ) {

			// Processing

				$classes = array_merge( (array) $classes, array(
						'hide-widget-title-accessibly',
						'hide-widget-title',
						'set-flex-grow-2',
						'set-flex-grow-3',
						'set-flex-grow-4',
					) );


			// Output

				return $classes;

		} // /widget_css_classes





} // /Icelander_Setup

add_action( 'after_setup_theme', 'Icelander_Setup::init', -100 ); // Low priority for early $content_width setup
