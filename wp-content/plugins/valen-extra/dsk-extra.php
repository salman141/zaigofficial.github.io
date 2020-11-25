<?php
/*
Plugin Name: Valen Extra
Plugin URI: http://snstheme.com
Description: Extra some featured for Valen theme.
Version: 1.0
Author URI: http://snstheme.com
License: GPL2+
*/

// don't load directly
if (!defined('ABSPATH'))
    die('-1');
class VALEN_Extra{
	function __construct(){
		// Load text domain
	    load_plugin_textdomain( 'valen-extra', false, dirname( plugin_basename(__FILE__) ) . '/languages' );
	    require "lib/scssphp/scss.inc.php";
		require "lib/scssphp/compass/compass.inc.php";
	}
}
function valen_load_extra(){
	global $valen_extra;
	$valen_extra = new VALEN_Extra();
}
add_action( 'plugins_loaded', 'valen_load_extra' );
// Begin: Define Post Type: post-wcode
class VALEN_PostWCode{
	function __construct(){
		add_action('init', array($this,'addPostWCodeType'));
	}
	function addPostWCodeType(){
		$labels = array(
			'name' => __( 'Post WCode', 'valen-extra' ),
			'singular_name' => __( 'Post WCode', 'valen-extra' ),
			'add_new' => __( 'Add New Post WCode', 'valen-extra' ),
			'add_new_item' => __( 'Add New Post WCode', 'valen-extra' ),
			'edit_item' => __( 'Edit Post WCode', 'valen-extra' ),
			'new_item' => __( 'New Post WCode', 'valen-extra' ),
			'view_item' => __( 'View Post WCode', 'valen-extra' ),
			'search_items' => __( 'Search Post WCode', 'valen-extra' ),
			'not_found' => __( 'No Post WCode found', 'valen-extra' ),
			'not_found_in_trash' => __( 'No Post WCode found in Trash', 'valen-extra' ),
			'parent_item_colon' => __( 'Parent Post WCode:', 'valen-extra' ),
			'menu_name' => __( 'Post WCode', 'valen-extra' ),
		);

		$args = array(
		    'labels' => $labels,
		    'exclude_from_search' => true,
            'has_archive' => false,
            'public' => true,
            'menu_icon'   => 'dashicons-media-code',
            'rewrite' => true,
            'supports' => array('title', 'editor'),
            'can_export' => true,
            'show_in_nav_menus' => false
		);
		register_post_type( 'post-wcode', $args );
	}
}
function valen_load_postwcode(){
	global $valen_postwcode;
	$valen_postwcode = new VALEN_PostWCode();
}
add_action( 'plugins_loaded', 'valen_load_postwcode' );
// End: Define Post Type: post-code
// Begin: Define widget
class VALEN_Widget_PostWCode extends WP_Widget {
    public function __construct() {
        parent::__construct(
			'postcode-widget',
			esc_html__( 'Post WCode', 'valen-extra' ),
			array( "description" => esc_html__("Display somes shortcodes via slug of Post WCode", 'valen-extra') )
		);
	}
	function widget($args, $instance) {
		extract($args);
        $title = '';
        if (isset($instance['title']))
		    $title = apply_filters('widget_title', $instance['title']);
        $output = '';
        if ($instance['name']) {
            $output = do_shortcode('[valen_postwcode name="' . $instance['name'] . '"]');
        }
        if (!$output) return;
        //echo $before_widget;
		if ($title) {
			echo $before_title . $title . $after_title;
		}
        echo $output;
        //echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['name'] = $new_instance['name'];
		return $instance;
	}
	function form($instance) {
		$defaults = array();
		$instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php esc_html_e('Title:', 'valen-extra'); ?>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset($instance['title'])) echo $instance['title']; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('name'); ?>">
                <?php esc_html_e('Slug of Post WCode:', 'valen-extra'); ?>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" value="<?php if (isset($instance['name'])) echo $instance['name']; ?>" />
            </label>
        </p>
	    <?php
	}
}
class VALEN_Widget_Vertical_Menu extends WP_Widget {
	function __construct(){
		parent::__construct(
			'VALEN_Widget_Vertical_Menu',
			esc_html__( 'SNS VALEN Vertical Menu', 'valen' ),
			array( "description" => esc_html__("Add a vertical menu to your sidebar.", 'valen') )
		);
	}
	function widget( $args, $instance ) {
		// Get menu
		$ver_menu = ! empty( $instance['ver_menu'] ) ? wp_get_nav_menu_object( $instance['ver_menu'] ) : false;
		if ( !$ver_menu )
			return;
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo $args['before_widget'];
		?>
		<div class="sns-vertical-menu hidden-md hidden-sm hidden-xs">
		<?php
			if ( !empty($instance['title']) )
				echo $args['before_title'] . $instance['title'] . $args['after_title'];
			?>
			<?php 
			$nav_menu_args = array(
				'fallback_cb' => '',
				'menu'        => $ver_menu
			);
			 wp_nav_menu( array(
   				'container' => false, 
   				'menu' => $ver_menu,
   				'walker' => new valen_Megamenu_Front,
   				'menu_class' => 'vertical-style'
       		) ); 
			?>
		</div>
		<div class="sns-respmenu hidden-lg">
		    <?php
		    if ( !empty($instance['title']) )
				echo $args['before_title'] . $instance['title'] . $args['after_title'];
            wp_nav_menu( array(
   				'container' => false, 
   				'menu' => $ver_menu,
   				'menu_class' => 'nav-sidebar resp-nav'
           	) );
			?>
		</div>
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['ver_menu'] ) ) {
			$instance['ver_menu'] = (int) $new_instance['ver_menu'];
		}
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$ver_menu = isset( $instance['ver_menu'] ) ? $instance['ver_menu'] : '';
		// Get menus
		$menus = wp_get_nav_menus();
		?>
		<div class="sns-vertical-menu-widget-form-controls" style="width: 100%; vertical-align: top; display: inline-block; margin-bottom: 15px;" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'valen' ) ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'ver_menu' ); ?>"><?php esc_html_e( 'Select Menu:', 'valen'); ?></label><br />
				<select id="<?php echo $this->get_field_id( 'ver_menu' ); ?>" name="<?php echo $this->get_field_name( 'ver_menu' ); ?>">
					<option value="0"><?php esc_html_e( '&mdash; Select &mdash;', 'valen' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $ver_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
		</div>
		<?php
	}
}
function valen_load_widgets() {
    register_widget( 'VALEN_Widget_PostWCode' );
    register_widget( 'VALEN_Widget_Vertical_Menu' );
}
add_action('widgets_init', 'valen_load_widgets');
// End: Define widget
// Add Custom CSS for valen_postwcode
add_action( 'wp_head', 'valen_load_postwcode_css', 1000 );
function valen_load_postwcode_css(){
	$args = array(
			'post_type' => 'post-wcode',
			'post_status' => 'publish', 
			'posts_per_page' => -1
	);
	$wcode = new WP_Query($args);
	$output = '';
	$output .= '<style type="text/css">';
	if ( $wcode->have_posts() ) {
		while ( $wcode->have_posts() ) { // echo '->'.get_the_ID().'<br/>';
			$wcode->the_post();
			$wcode_css = get_post_meta( get_the_ID(), '_wpb_post_custom_css', true );
			$wcode_css .= get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		    if ( ! empty( $wcode_css ) ) {
		        $output .= $wcode_css;
		    }
		}
	}
    $output .= '</style>';
    wp_reset_postdata();
    echo $output;
}