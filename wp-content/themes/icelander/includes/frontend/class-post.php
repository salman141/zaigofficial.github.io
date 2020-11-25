<?php
/**
 * Post Class
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
 *  10) Setup
 *  20) Elements
 *  30) Pages
 *  40) Templates
 * 100) Helpers
 */
class Icelander_Post {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.5.0
		 */
		private function __construct() {

			// Processing

				// Setup

					// Post types supports

						add_post_type_support( 'page', 'excerpt' );

						add_post_type_support( 'attachment:audio', 'thumbnail' );
						add_post_type_support( 'attachment:video', 'thumbnail' );

						add_post_type_support( 'attachment', 'custom-fields' );

				// Hooks

					// Actions

						add_action( 'tha_entry_top', __CLASS__ . '::title', 20 );

						add_action( 'tha_entry_top', __CLASS__ . '::meta', 30 );

						add_action( 'tha_entry_bottom', __CLASS__ . '::skip_links', 999 );

						add_action( 'tha_entry_bottom', __CLASS__ . '::list_child_pages' );

						add_action( 'tha_content_bottom', __CLASS__ . '::navigation', 95 );

						add_action( 'save_post', __CLASS__ . '::list_child_pages_cache_flush' );

						add_action( 'wmhook_icelander_loop_child_pages_item', __CLASS__ . '::list_child_pages_item' );

						add_action( 'tha_entry_top', __CLASS__ . '::project_layout_media', 100 );

						add_action( 'tha_entry_content_before', __CLASS__ . '::entry_content_inner', 0 );

						add_action( 'tha_entry_content_after', __CLASS__ . '::entry_content_inner', 999 );

					// Filters

						add_filter( 'single_post_title', __CLASS__ . '::title_single', 10, 2 );

						add_filter( 'wmhook_icelander_post_title_pre', __CLASS__ . '::title_single_page' );

						add_filter( 'wmhook_icelander_post_title_pre', __CLASS__ . '::title_page_builder' );

						add_filter( 'wmhook_icelander_post_title_pre', __CLASS__ . '::is_page_template_blank_maybe_return_empty_string' );

						add_filter( 'post_class', __CLASS__ . '::post_class', 98 );

						add_filter( 'wmhook_icelander_post_media_pre', __CLASS__ . '::page_media', 100 );

						add_filter( 'wmhook_icelander_post_media_pre', __CLASS__ . '::is_page_builder_ready_maybe_return_empty_string', 100 );

						add_filter( 'wmhook_icelander_header_is_disabled', __CLASS__ . '::is_page_template_blank' );
						add_filter( 'wmhook_icelander_footer_is_disabled', __CLASS__ . '::is_page_template_blank' );
						add_filter( 'wmhook_icelander_breadcrumb_navxt_disabled', __CLASS__ . '::is_page_template_blank' );

						add_filter( 'wmhook_icelander_intro_disable', __CLASS__ . '::intro_disable' );

						add_filter( 'wmhook_icelander_sidebar_disable', __CLASS__ . '::project_layout_sidebar' );

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
		 * Post classes
		 *
		 * Compatible with NS Featured Posts plugin.
		 * @link  https://wordpress.org/plugins/ns-featured-posts/
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $classes
		 */
		public static function post_class( $classes ) {

			// Processing

				// A generic class for easy styling

					$classes[] = 'entry';

				// Sticky post

					/**
					 * On paginated posts list the sticky class is not
					 * being applied, so, we need to compensate.
					 */
					if ( is_sticky() ) {
						$classes[] = 'is-sticky';
					}

				// Featured post

					if (
							class_exists( 'NS_Featured_Posts' )
							&& get_post_meta( get_the_ID(), '_is_ns_featured_post', true )
						) {
						$classes[] = 'is-featured';
					}


			// Output

				return $classes;

		} // /post_class





	/**
	 * 20) Elements
	 */

		/**
		 * Post/page heading (title)
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 *
		 * @param  array $args Heading setup arguments
		 */
		public static function title( $args = array() ) {

			// Pre

				$pre = apply_filters( 'wmhook_icelander_post_title_pre', false, $args );

				if ( false !== $pre ) {
					echo $pre; // Method bypass via filter.
					return;
				}


			// Requirements check

				if ( ! ( $title = get_the_title() ) ) {
					return;
				}


			// Helper variables

				$output = '';

				$post_id     = get_the_ID();
				$is_singular = self::is_singular();

				$posts_heading_tag = ( isset( $args['helper']['atts']['heading_tag'] ) ) ? ( trim( $args['helper']['atts']['heading_tag'] ) ) : ( 'h2' );

				$args = wp_parse_args( $args, apply_filters( 'wmhook_icelander_post_title_defaults', array(
						'addon'           => '',
						'class'           => 'entry-title',
						'class_container' => 'entry-header',
						'link'            => esc_url( get_permalink() ),
						'output'          => '<header class="{class_container}"><{tag} class="{class}">{title}</{tag}>{addon}</header>',
						'tag'             => ( $is_singular ) ? ( 'h1' ) : ( $posts_heading_tag ),
						'title'           => '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $title . '</a>',
					) ) );

				// Singular title (no link applied)

					if ( $is_singular ) {

						if ( $suffix = Icelander_Library::get_the_paginated_suffix( 'small' ) ) {
							$args['title'] .= $suffix;
						} else {
							$args['title'] = $title;
						}

					}

				// Filter processed $args

					$args = apply_filters( 'wmhook_icelander_post_title_args', $args );

				// Replacements

					$replacements = (array) apply_filters( 'wmhook_icelander_post_title_replacements', array(
							'{addon}'           => $args['addon'],
							'{class}'           => esc_attr( $args['class'] ),
							'{class_container}' => esc_attr( $args['class_container'] ),
							'{tag}'             => tag_escape( $args['tag'] ),
							'{title}'           => do_shortcode( $args['title'] ),
						), $args );


			// Output

				echo strtr( $args['output'], $replacements );

		} // /title



		/**
		 * Single post title paged
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $title
		 * @param  object $post
		 */
		public static function title_single( $title, $post ) {

			// Requirements check

				if (
						doing_action( 'wp_head' )
						|| doing_action( 'tha_header_top' )
					) {
					return $title;
				}


			// Output

				return $title . Icelander_Library::get_the_paginated_suffix( 'small' );

		} // /title_single



		/**
		 * Don't output post/page title if we use a page builder
		 *
		 * This is to target any page builder plugin, including Beaver Builder.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function title_page_builder( $pre ) {

			// Helper variables

				$meta_no_intro = get_post_meta( get_the_ID(), 'no_intro', true );


			// Processing

				if (
						(
							is_page_template( 'templates/no-intro.php' )
							|| ! empty( $meta_no_intro )
						)
						&& self::is_page_builder_ready()
					) {
					return '';
				}


			// Output

				return $pre;

		} // /title_page_builder



		/**
		 * Post meta top
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function meta() {

			// Output

				get_template_part( 'templates/parts/meta/entry-meta', 'top' );

		} // /meta



		/**
		 * Skip links: Entry bottom
		 *
		 * @since    1.0.0
		 * @version  1.1.0
		 */
		public static function skip_links() {

			// Requirements check

				if (
						! self::is_singular()
						|| (
							is_page_template( 'templates/child-pages.php' )
							&& ! get_the_content()
						)
					) {
					return;
				}


			// Output

				echo Icelander_Library::link_skip_to( 'site-navigation', esc_html__( 'Skip back to main navigation', 'icelander' ), 'focus-position-static' );

		} // /skip_links



		/**
		 * Post navigation
		 *
		 * @since    1.0.0
		 * @version  1.1.0
		 */
		public static function navigation() {

			// Requirements check

				if (
						! ( is_single( get_the_ID() ) || is_attachment() )
						|| ! in_array( get_post_type(), (array) apply_filters( 'wmhook_icelander_post_navigation_post_type', array( 'post', 'attachment' ) ) )
					) {
					return;
				}


			// Helper variables

				$post_type_labels = get_post_type_labels( get_post_type_object( get_post_type() ) );

				/**
				 * Can't really use `sprintf()` here due to translation error when
				 * translator decides not to use the `%s` in translated string.
				 */
				$args = array(
					'prev_text' => '<span class="label">' . str_replace(
							'$s',
							$post_type_labels->singular_name,
							esc_html_x( 'Previous $s', '$s: Custom post type singular label', 'icelander' )
						) . '</span> <span class="title">%title</span>',
					'next_text' => '<span class="label">' . str_replace(
							'$s',
							$post_type_labels->singular_name,
							esc_html_x( 'Next $s', '$s: Custom post type singular label', 'icelander' )
						) . '</span> <span class="title">%title</span>',
				);

				if ( is_attachment() ) {
					$args = array(
						'prev_text' => '<span class="label">' . esc_html__( 'Published in', 'icelander' ) . '</span> <span class="title">%title</span>',
					);
				}


			// Output

				the_post_navigation( (array) apply_filters( 'wmhook_icelander_post_navigation_args', $args ) );

		} // /navigation





	/**
	 * 30) Pages
	 */

		/**
		 * Don't output page title if we have intro
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function title_single_page( $pre ) {

			// Processing

				if (
						is_page( get_the_ID() )
						&& ! (bool) apply_filters( 'wmhook_icelander_intro_disable', false )
					) {
					return '';
				}


			// Output

				return $pre;

		} // /title_single_page



		/**
		 * Disable post media: On all pages
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  mixed $pre
		 */
		public static function page_media( $pre = false ) {

			// Processing

				if (
						is_page( get_the_ID() )
						&& ! is_attachment()
					) {
					$pre = '';
				}


			// Output

				return $pre;

		} // /page_media



		/**
		 * Disable intro?
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  boolean $disable
		 */
		public static function intro_disable( $disable = false ) {

			// Requirements check

				if (
						is_singular()
						&& (
							is_page_template( 'templates/no-intro.php' )
							|| is_page_template( 'templates/blank.php' )
						)
					) {
					$disable = true;
				}


			// Output

				return $disable;

		} // /intro_disable



		/**
		 * Default page layout inner content container
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function entry_content_inner() {

			// Requirements check

				if ( ! is_page( get_the_ID() ) || self::is_page_builder_ready() ) {
					return;
				}


			// Output

				if ( doing_action( 'tha_entry_content_before' ) ) {
					echo '<div class="entry-content-inner">';
				} else {
					echo '</div><!-- /.entry-content-inner -->';
				}

		} // /entry_content_inner





	/**
	 * 40) Templates
	 */

		/**
		 * Page template: Blank
		 */

			/**
			 * Is page template: Blank?
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 */
			public static function is_page_template_blank() {

				// Output

					return is_page_template( 'templates/blank.php' );

			} // /is_page_template_blank



			/**
			 * Is page template Blank used on the page?
			 *
			 * Return empty string if it is.
			 * Useful for `pre` filter hooks.
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 *
			 * @param  mixed $pre
			 */
			public static function is_page_template_blank_maybe_return_empty_string( $pre ) {

				// Processing

					if ( self::is_page_template_blank() ) {
						return '';
					}


				// Output

					return $pre;

			} // /is_page_template_blank_maybe_return_empty_string



		/**
		 * Page template: List child pages
		 */

			/**
			 * List child pages
			 *
			 * The output HTML is being cached.
			 *
			 * @since    1.0.0
			 * @version  1.4.0
			 */
			public static function list_child_pages() {

				// Requirements check

					if (
							! is_page_template( 'templates/child-pages.php' )
							|| ! self::is_singular()
						) {
						return;
					}


				// Helper variables

					$cache_key = 'icelander_list_child_pages_' . get_the_ID();
					$output    = get_transient( $cache_key );


				// Processing

					if ( ! $output ) {
						ob_start();
						get_template_part( 'templates/parts/loop/loop', 'child-pages' );

						$output = wp_kses_post( ob_get_clean() );

						// Cache child pages HTML output for a week

							set_transient( $cache_key, $output, 7 * 24 * 60 * 60 );
					}


				// Output

					echo $output; // WPCS: XSS OK.

			} // /list_child_pages



			/**
			 * List child pages item
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 */
			public static function list_child_pages_item() {

				// Processing

					get_template_part( 'templates/parts/content/content', 'child-page' );

			} // /list_child_pages_item



			/**
			 * List child pages: Flush the cache
			 *
			 * Flushes the child pages cache for all the parents and current page.
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 *
			 * @param  int $post_id
			 */
			public static function list_child_pages_cache_flush( $post_id ) {

				// Helper variables

					$entries   = (array) get_post_ancestors( $post_id );
					$entries[] = $post_id;
					$entries   = array_filter( $entries );


				// Processing

					if ( is_page_template( 'templates/child-pages.php' ) || 1 < count( $entries ) ) {
						foreach ( $entries as $entry_id ) {
							delete_transient( 'icelander_list_child_pages_' . $entry_id );
						}
					}

			} // /list_child_pages_cache_flush



		/**
		 * Post type template: Project layout
		 */

			/**
			 * Project layout template: Is it used on single post?
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 */
			public static function is_project_layout() {

				// Output

					return self::is_singular() && is_page_template( 'templates/project-layout.php' );

			} // /is_project_layout



			/**
			 * Project layout template: Disable sidebar
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 *
			 * @param  boolean $disabled
			 */
			public static function project_layout_sidebar( $disabled = false ) {

				// Processing

					if ( self::is_project_layout() ) {
						return true;
					}


				// Output

					return $disabled;

			} // /project_layout_sidebar



			/**
			 * Project layout template: Media
			 *
			 * @since    1.0.0
			 * @version  1.5.5
			 */
			public static function project_layout_media() {

				// Requirements check

					if ( ! self::is_project_layout() ) {
						return;
					}


				// Helper variables

					global $post;

					$output     = '';
					$image_size = esc_attr( (string) apply_filters( 'wmhook_icelander_post_project_layout_media_image_size', 'medium' ) );


				// Processing

					// Try to get first gallery in the post content first and then remove it from there

						if (
							function_exists( 'has_block' )
							&& has_block( 'gallery', $post->post_content )
						) {
							$parsed_block = parse_blocks( $post->post_content );
							foreach ( $parsed_block as $key => $block ) {
								if ( 'core/gallery' === $block['blockName'] ) {
									$output = render_block( $block );
									break;
								}
							}
							add_filter( 'render_block', __CLASS__ . '::project_layout_remove_gallery_block', 10, 2 );
						} else {
							$output = get_post_gallery();
							if ( strpos( $output, 'gallery-item' ) ) {
								add_filter( 'post_gallery', __CLASS__ . '::project_layout_remove_gallery' );
							}
						}

					// No media? Try to generate the gallery from images attached to post.

						if ( empty( $output ) ) {
							$output = gallery_shortcode( array(
								'columns' => 1,
								'link'    => 'file',
								'size'    => $image_size,
							) );
						}

					// Still no media? Fall back to featured image.

						if ( empty( $output ) ) {
							$output = get_the_post_thumbnail( null, $image_size );
						}

					// Filter the output

						$output = apply_filters( 'wmhook_icelander_post_project_layout_media_output', $output, $image_size );


				// Output

					if ( $output ) {
						echo '<div class="project-layout-media">' . $output . '</div>';
					}

			} // /project_layout_media



			/**
			 * Project layout template: "Remove" the first gallery in content.
			 *
			 * Also making sure this runs only once!
			 * @link  https://wordpress.stackexchange.com/questions/125903/how-to-hide-first-gallery-for-every-post
			 *
			 * @since    1.0.0
			 * @version  1.3.0
			 */
			public static function project_layout_remove_gallery() {

				// Processing

					// Run just once.
					remove_filter( current_filter(), __METHOD__ );


				// Output

					return '<!-- gallery removed -->';

			} // /project_layout_remove_gallery



			/**
			 * Project layout template: "Remove" the first gallery block in content.
			 *
			 * @since    1.5.5
			 * @version  1.5.5
			 */
			public static function project_layout_remove_gallery_block( $block_content, $block ) {

				// Processing

					if ( 'core/gallery' === $block['blockName'] ) {
						// Run just for the first gallery block.
						remove_filter( current_filter(), __METHOD__ );

						return '<!-- gallery removed -->';
					}


				// Output

					return $block_content;

			} // /project_layout_remove_gallery_block





	/**
	 * 100) Helpers
	 */

		/**
		 * Boolean for checking if single post or page is displayed
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function is_singular() {

			// Helper variables

				$post_id = get_the_ID();


			// Output

				return ( is_page( $post_id ) || is_single( $post_id ) );

		} // /is_singular



		/**
		 * Boolean for checking if paged or parted
		 *
		 * @since    1.0.0
		 * @version  1.1.0
		 */
		public static function is_paged() {

			// Helper variables

				global $page, $paged;

				$paginated = max( absint( $page ), absint( $paged ) );


			// Output

				return 1 < $paginated;

		} // /is_paged



		/**
		 * Using some page builder?
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function is_page_builder_ready() {

			// Requirements check

				if ( ! self::is_singular() ) {
					return false;
				}

				// Prioritize Beaver Builder

					if ( is_callable( 'Icelander_Beaver_Builder_Helpers::is_builder_enabled' ) ) {
						return Icelander_Beaver_Builder_Helpers::is_builder_enabled();
					}


			// Helper variables

				$content_layout = (string) get_post_meta( get_the_ID(), 'content_layout', true );


			// Output

				return in_array( $content_layout, array( 'stretched', 'no-padding' ) );

		} // /is_page_builder_ready



			/**
			 * Using some page builder?
			 *
			 * Return empty string if we do.
			 * Useful for `pre` filter hooks.
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 *
			 * @param  mixed $pre
			 */
			public static function is_page_builder_ready_maybe_return_empty_string( $pre ) {

				// Processing

					if ( self::is_page_builder_ready() ) {
						return '';
					}


				// Output

					return $pre;

			} // /is_page_builder_ready_maybe_return_empty_string





} // /Icelander_Post

add_action( 'after_setup_theme', 'Icelander_Post::init' );
