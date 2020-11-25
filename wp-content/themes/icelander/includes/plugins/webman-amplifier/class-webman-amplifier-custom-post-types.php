<?php
/**
 * WebMan Amplifier: Custom Post Types Class
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 *   0) Init
 *  10) General setup
 *  20) Projects
 *  30) Staff
 *  40) Testimonials
 * 100) Others
 */
class Icelander_WebMan_Amplifier_Custom_Post_Types {





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

						add_action( 'template_redirect', __CLASS__ . '::redirects' );

						add_action( 'wmhook_icelander_postslist_before', __CLASS__ . '::taxonomy_filter' );

						// Projects

							add_action( 'wmhook_icelander_postslist_before', __CLASS__ . '::project_filter' );

							add_action( 'tha_entry_top', __CLASS__ . '::project_category', 15 );

							add_action( 'customize_register', __CLASS__ . '::project_theme_options_pointers' );

							add_action( 'tha_entry_top', __CLASS__ . '::project_content_wrapper', 11 );

							add_action( 'tha_entry_bottom', __CLASS__ . '::project_content_wrapper', 11 );

						// Staff

							add_action( 'wmhook_icelander_postslist_before', __CLASS__ . '::staff_filter' );

							add_action( 'tha_entry_top', __CLASS__ . '::staff_department', 20 );

							add_action( 'tha_entry_top', __CLASS__ . '::staff_specialty', 20 );

							add_action( 'tha_entry_content_after', __CLASS__ . '::staff_more_link' );

					// Filters

						add_filter( 'body_class', __CLASS__ . '::body_class' );

						add_filter( 'wmhook_icelander_is_masonry_layout', __CLASS__ . '::is_archive', 100 );

						add_filter( 'wmhook_icelander_post_navigation_post_type', __CLASS__ . '::navigation_post_types' );

						add_filter( 'wmhook_icelander_subtitles_post_types', __CLASS__ . '::subtitles' );

						add_filter( 'wmhook_icelander_post_type_redirect', __CLASS__ . '::redirects_setup' );

						// Projects

							add_filter( 'wmhook_icelander_loop_content_type', __CLASS__ . '::project_content_type' );

							add_filter( 'wmhook_icelander_post_media_image_size', __CLASS__ . '::project_post_media_size', 15 );

							add_filter( 'wmhook_icelander_theme_options', __CLASS__ . '::project_theme_options' );

							add_filter( 'body_class', __CLASS__ . '::project_layout_body_class' );

						// Staff

							add_filter( 'wmhook_wmamp_cp_register_wm_staff', __CLASS__ . '::staff_args' );

							add_filter( 'wmhook_icelander_loop_content_type', __CLASS__ . '::staff_content_type' );

							add_filter( 'wmhook_icelander_post_media_image_size', __CLASS__ . '::staff_post_media_size', 15 );

							add_filter( 'wmhook_icelander_post_media_image_featured_link', __CLASS__ . '::staff_link' );

							add_filter( 'wmhook_icelander_post_title_args', __CLASS__ . '::staff_title_args' );

						// Testimonials

							add_filter( 'wmhook_wmamp_cp_register_wm_testimonials', __CLASS__ . '::testimonial_args' );

							add_filter( 'wmhook_icelander_loop_content_type', __CLASS__ . '::testimonial_content_type' );

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
	 * 10) General setup
	 */

		/**
		 * Custom posts types redirects
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function redirects() {

			// Requirements check

				if ( ! function_exists( 'wma_meta_option' ) ) {
					return;
				}


			// Helper variables

				$get_post_type = get_post_type( get_the_ID() );

				$redirects = (array) apply_filters( 'wmhook_icelander_post_type_redirect', array() );


			// Processing

				if (
						! empty( $redirects )
						&& in_array( $get_post_type, array_keys( $redirects ) )
					) {
					wp_redirect( esc_url( $redirects[ $get_post_type ] ), 301 );
					exit;
				}

		} // /redirects



		/**
		 * Custom posts types redirects
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $redirects  Pairs: key = post type, value = redirect URL.
		 */
		public static function redirects_setup( $redirects = array() ) {

			// Processing

				$redirects = array(
						'wm_logos'   => home_url( '/' ),
						'wm_modules' => home_url( '/' ),
					);

				if ( is_singular() ) {
					$redirects['wm_testimonials'] = home_url( '/' );
				}


			// Output

				return $redirects;

		} // /redirects_setup



		/**
		 * Body classes
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $classes
		 */
		public static function body_class( $classes = array() ) {

			// Helper variables

				$classes = (array) $classes; // Just in case...


			// Processing

				if ( is_archive() ) {

					switch ( get_post_type() ) {

						case 'wm_projects':
							$classes[] = 'archive-projects';
							break;

						case 'wm_staff':
							$classes[] = 'archive-staff';
							break;

						case 'wm_testimonials':
							$classes[] = 'archive-testimonials';
							break;

						default:
							break;

					} // /switch

				}


			// Output

				return array_unique( $classes );

		} // /body_class



		/**
		 * Is specific archive page?
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  boolean $is_archive
		 */
		public static function is_archive( $is_archive = false ) {

			// Processing

				if (
						is_archive()
						&& in_array( get_post_type(), array(
							'wm_staff',
							'wm_projects',
							'wm_testimonials',
						) )
					) {
					return true;
				}


			// Output

				return $is_archive;

		} // /is_archive



		/**
		 * Post navigation support
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $post_types  Post types supporting post navigation.
		 */
		public static function navigation_post_types( $post_types = array() ) {

			// Helper variables

				$post_types[] = 'wm_projects';
				$post_types[] = 'wm_staff';


			// Processing

				return $post_types;

		} // /navigation_post_types



		/**
		 * Subtitles plugin support
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $post_types  Post types supporting Subtitles plugin.
		 */
		public static function subtitles( $post_types = array() ) {

			// Helper variables

				$post_types[] = 'wm_modules';
				$post_types[] = 'wm_projects';
				$post_types[] = 'wm_staff';


			// Processing

				return $post_types;

		} // /subtitles





	/**
	 * 20) Projects
	 */

		/**
		 * Custom posts type content: Project
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $type
		 */
		public static function project_content_type( $type ) {

			// Processing

				if ( 'wm_projects' == get_post_type( get_the_ID() ) ) {
					return 'project';
				}


			// Output

				return $type;

		} // /project_content_type



		/**
		 * Project media size
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $image_size
		 */
		public static function project_post_media_size( $image_size ) {

			// Processing

				if (
						( is_single( get_the_ID() ) || is_search() || is_archive() )
						&& 'wm_projects' === get_post_type()
					) {
					$image_size = 'medium';
				}


			// Output

				return $image_size;

		} // /project_post_media_size



		/**
		 * Project filter: Categories links
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function project_filter() {

			// Requirements check

				if ( ! is_post_type_archive( 'wm_projects' ) ) {
					return;
				}


			// Helper variables

				$terms = get_terms( array(
						'taxonomy' => 'project_category',
						'orderby'  => 'name',
						'parent'   => 0,
					) );

					if ( is_wp_error( $terms ) || empty( $terms ) ) {
						return;
					}


			// Output

				echo self::get_term_links( $terms );

		} // /project_filter



		/**
		 * Project taxonomy: Category
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function project_category() {

			// Requirements check

				if ( is_single( get_the_ID() ) ) {
					return;
				}


			// Output

				echo self::output_taxonomy( 'project_category' );

		} // /project_category



		/**
		 * Theme options: Project
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $options
		 */
		public static function project_theme_options( $options = array() ) {

			// Processing

				$options[ 300 . 'layout' . 420 ] = array(
						'type'        => 'radio',
						'id'          => 'portfolio_style',
						'label'       => esc_html__( 'Projects list style', 'icelander' ),
						'description' => esc_html__( 'Sets the display of projects in posts lists.', 'icelander' ),
						'default'     => '',
						'choices'     => array(
							''        => esc_html_x( 'Default, no overlay', 'Project layout.', 'icelander' ),
							'compact' => esc_html_x( 'Blurred overlay', 'Project layout.', 'icelander' ),
						),
						// This actually requires reload to wrap project summary in a div.
						//
						// 'preview_js'  => array(
						// 	'custom' => "jQuery( 'body' ).toggleClass( 'portfolio-style-compact' ).toggleClass( 'portfolio-style-compact' );",
						// ),
					);


			// Output

				return $options;

		} // /project_theme_options



		/**
		 * Theme options: Project options pointers
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $wp_customize  WP customizer object.
		 */
		public static function project_theme_options_pointers( $wp_customize ) {

			// Processing

				$wp_customize->selective_refresh->add_partial( 'portfolio_style', array(
						'selector' => '.archive-projects #main > .posts',
					) );

		} // /project_theme_options_pointers



		/**
		 * Body class: Project layout
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $classes
		 */
		public static function project_layout_body_class( $classes = array() ) {

			// Processing

				if ( $layout = get_theme_mod( 'portfolio_style' ) ) {
					$classes[] = 'portfolio-style-' . sanitize_title( $layout );
				}


			// Output

				return $classes;

		} // /project_layout_body_class



		/**
		 * Wrap project content in posts list
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $args  Shortcode helper.
		 */
		public static function project_content_wrapper( $args = array() ) {

			// Requirements check

				if (
						'wm_projects' !== get_post_type()
						|| is_single( get_the_ID() )
						|| 'compact' !== get_theme_mod( 'portfolio_style' )
					) {
					return;
				}


			// Output

				if ( doing_action( 'tha_entry_bottom' ) ) {

					echo '</div>';

				} else {

					$image_size = ( isset( $args['helper']['image_size'] ) ) ? ( $args['helper']['image_size'] ) : ( 'medium' );
					$image_url  = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size, true );
					$image_url  = $image_url[0];

					echo '<div class="entry-summary-container" style="background-image: url(\'' . esc_url( $image_url ) . '\');">';

				}

		} // /project_content_wrapper





	/**
	 * 30) Staff
	 */

		/**
		 * Custom posts type setup: Staff
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $args
		 */
		public static function staff_args( $args ) {

			// Processing

				$args['taxonomies'] = array( 'post_tag' );


			// Output

				return $args;

		} // /staff_args



		/**
		 * Custom posts type content: Staff
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $type
		 */
		public static function staff_content_type( $type ) {

			// Processing

				if ( 'wm_staff' == get_post_type( get_the_ID() ) ) {
					return 'staff';
				}


			// Output

				return $type;

		} // /staff_content_type



		/**
		 * Custom posts type link: Staff
		 *
		 * Remove single post link when there is no post content.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $image_link
		 */
		public static function staff_link( $image_link = array() ) {

			// Processing

				if (
						'wm_staff' == get_post_type( get_the_ID() )
						&& ! get_the_content()
					) {
					$image_link = false;
				}


			// Output

				return $image_link;

		} // /staff_link



		/**
		 * Custom posts type title: Staff
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $args
		 */
		public static function staff_title_args( $args ) {

			// Processing

				// Remove single post link when there is no post content

					if ( false === self::staff_link() ) {
						$args['title'] = get_the_title();
					}


			// Output

				return $args;

		} // /staff_title_args



		/**
		 * Staff media size
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $image_size
		 */
		public static function staff_post_media_size( $image_size ) {

			// Processing

				if (
						( is_single( get_the_ID() ) || is_search() || is_archive() )
						&& 'wm_staff' === get_post_type()
					) {
					$image_size = 'medium';
				}


			// Output

				return $image_size;

		} // /staff_post_media_size



		/**
		 * Staff filter: Departments links
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function staff_filter() {

			// Requirements check

				if ( ! is_post_type_archive( 'wm_staff' ) ) {
					return;
				}


			// Helper variables

				$terms = get_terms( array(
						'taxonomy' => 'staff_department',
						'orderby'  => 'name',
						'parent'   => 0,
					) );

					if ( is_wp_error( $terms ) || empty( $terms ) ) {
						return;
					}


			// Output

				echo self::get_term_links( $terms );

		} // /staff_filter



		/**
		 * Staff taxonomy: Department
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function staff_department() {

			// Requirements check

				if ( is_single( get_the_ID() ) ) {
					return;
				}


			// Output

				echo self::output_taxonomy( 'staff_department' );

		} // /staff_department



		/**
		 * Staff taxonomy: Specialty
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function staff_specialty() {

			// Requirements check

				if ( is_single( get_the_ID() ) ) {
					return;
				}


			// Output

				echo self::output_taxonomy( 'staff_specialty' );

		} // /staff_specialty



		/**
		 * Staff more link
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function staff_more_link() {

			// Requirements check

				if ( is_single( get_the_ID() ) || 'wm_staff' !== get_post_type() ) {
					return;
				}


			// Output

				if ( trim( get_the_content() ) ) {

					echo '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="button" rel="bookmark">';
					esc_html_e( 'Nice to meet you!', 'icelander' );
					echo '</a>';

				}

		} // /staff_more_link





	/**
	 * 40) Testimonials
	 */

		/**
		 * Custom posts type setup: Testimonial
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $args
		 */
		public static function testimonial_args( $args ) {

			// Processing

				$args['exclude_from_search'] = false;


			// Output

				return $args;

		} // /testimonial_args



		/**
		 * Custom posts type content: Testimonial
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $type
		 */
		public static function testimonial_content_type( $type ) {

			// Processing

				if ( 'wm_testimonials' == get_post_type( get_the_ID() ) ) {
					return 'testimonial';
				}


			// Output

				return $type;

		} // /testimonial_content_type





	/**
	 * 100) Others
	 */

		/**
		 * Taxonomies
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $taxonomy
		 */
		public static function output_taxonomy( $taxonomy = '' ) {

			// Pre

				$pre = apply_filters( 'wmhook_icelander_webman_amplifier_custom_post_types_output_taxonomy_pre', false, $taxonomy );

				if ( false !== $pre ) {
					return $pre;
				}


			// Requirements check

				if ( ! taxonomy_exists( $taxonomy ) ) {
					return;
				}


			// Helper variables

				$output       = '';
				$terms_array  = array();
				$terms        = get_the_terms( get_the_ID(), $taxonomy );
				$taxonomy_obj = get_taxonomy( $taxonomy );


			// Processing

				if (
						! is_wp_error( $terms )
						&& ! empty( $terms )
					) {

					foreach( $terms as $term ) {

						$output_single = '';
						$term_link     = get_term_link( $term, $taxonomy );

						if ( $term_link && ! is_wp_error( $term_link ) ) {
							$output_single .= '<a href="' . esc_url( $term_link ) . '"';
						} else {
							$output_single .= '<span';
						}

						$output_single .= ' class="term term-' . esc_attr( $taxonomy ) . ' term-' . sanitize_html_class( $term->slug ) . '">';
						$output_single .= $term->name;

						if ( $term_link && ! is_wp_error( $term_link ) ) {
							$output_single .= '</a>';
						} else {
							$output_single .= '</span>';
						}

						$terms_array[] = $output_single;

					} // /foreach

				}

				if ( ! empty( $terms_array ) ) {

					$output .= '<div class="wm-posts-element wm-html-element taxonomy taxonomy-' . esc_attr( $taxonomy ) . '">';

						$output .= '<span class="taxonomy-label">' . $taxonomy_obj->labels->singular_name . ': </span>';

						$output .= wp_kses(
								implode( ', ', $terms_array ),
								array(
									'a' => array(
											'href' => true,
											'class' => true,
										),
									'span' => array(
											'class' => true,
										),
								)
							);

					$output .= '</div>';

				}


			// Output

				return $output;

		} // /output_taxonomy



		/**
		 * Taxonomy filter: Sub-terms links
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function taxonomy_filter() {

			// Requirements check

				if (
						! is_tax()
						|| ! in_array( get_post_type(), array(
							'wm_staff',
							'wm_projects',
						) )
					) {
					return;
				}


			// Helper variables

				$parent = get_queried_object();
				$terms  = array();


			// Processing

				if ( is_taxonomy_hierarchical( $parent->taxonomy ) ) {

					$terms = get_terms( array(
							'taxonomy' => $parent->taxonomy,
							'orderby'  => 'name',
							'parent'   => $parent->term_id,
						) );

						if ( is_wp_error( $terms ) ) {
							return;
						}

				}


			// Output

				echo self::get_term_links( $terms, true ); // Show "all" link.

		} // /taxonomy_filter



		/**
		 * Return list of taxonomy term links
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array   $terms
		 * @param  boolean $show_parents  Whether to show parents links at the beginning.
		 */
		public static function get_term_links( $terms, $show_parents = false ) {

			// Requirements check

				if ( empty( $terms ) && ! $show_parents ) {
					return;
				}


			// Helper variables

				$output = array();

				$post_type_obj  = get_post_type_object( get_post_type() );
				$post_type_name = ( isset( $post_type_obj->labels->name ) ) ? ( $post_type_obj->labels->name ) : ( esc_html_x( 'Posts', 'Articles.', 'icelander' ) );


			// Processing

				if ( is_tax() && $show_parents ) {

					$output[] = '<a href="' . esc_url( get_post_type_archive_link( get_post_type() ) ) . '" class="link-back link-all">' . esc_html_x( 'All', 'All posts.', 'icelander' ) . '</a>';

					$term_object = get_queried_object();

					if ( is_taxonomy_hierarchical( $term_object->taxonomy ) ) {

						$parents = array_reverse( (array) get_ancestors( $term_object->term_id, $term_object->taxonomy, 'taxonomy' ) );

						foreach ( $parents as $term_id ) {
							$term = get_term( $term_id );
							$output[] = '<a href="' . esc_url( get_term_link( $term ) ) . '" class="link-back link-parent" title="' . esc_attr( sprintf( _x( 'Back to "%s"', '%s: Parent taxonomy term name.', 'icelander' ), $term->name ) ) . '">' . esc_html( $term->name ) . '</a>';
						}

					}

				}

				foreach ( $terms as $term ) {
					$title = (string) apply_filters( 'wmhook_icelander_webman_amplifier_custom_post_types_get_term_links_title', sprintf( _x( 'View all %1$s filed under "%2$s"', '%1$s: Post type name. %2$s: Taxonomy term name.', 'icelander' ), $post_type_name, $term->name ), $post_type_obj, $term );
					if ( $title ) {
						$title = ' title="' . esc_attr( $title ) . '"';
					}

					$output[] = '<a href="' . esc_url( get_term_link( $term ) ) . '"' . $title . '>' . esc_html( $term->name ) . '</a>';
				}

				if ( ! empty( $output ) ) {
					$output = '<nav class="wm-filter"><ul><li>' . implode( '</li><li>', (array) $output ) . '</li></ul></nav>';
				} else {
					$output = false;
				}


			// Output

				return $output;

		} // /get_term_links





} // /Icelander_WebMan_Amplifier_Custom_Post_Types

add_action( 'after_setup_theme', 'Icelander_WebMan_Amplifier_Custom_Post_Types::init' );
