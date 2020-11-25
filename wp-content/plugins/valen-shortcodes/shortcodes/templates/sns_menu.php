<?php
$output = '';
$id = rand().time();
$atts = vc_map_get_attributes( 'sns_menu', $atts );
extract( $atts );
if ( $menu_style == '1' ){
    $class = 'sns-menu';
}elseif( $menu_style == '2' ){
    $class = 'sns-inline-menu'; $menu_class .= ' inline-style';
}elseif( $menu_style == '3' ){
    $class = 'sns-vertical-menu'; $menu_class .= ' vertical-style';
}
if ($css_animation) $class .= ' '.esc_attr($css_animation);
if ($extra_class) $class .= ' '.esc_attr($extra_class);
if( $nav_menu ):
	echo '<div class="'.$class.'">';
	if ( $title != '' ) echo '<h3 class="wpb_heading"><span>'.esc_html($title).'</span></h3>';
    wp_nav_menu( array(
                'menu' => $nav_menu,
                'container' => false, 
                'walker' => new valen_Megamenu_Front,
                'menu_id' => 'menu_'.$nav_menu.'_'.rand().time(),
                'menu_class' => $menu_class
    ) );
    if ( $menu_responsive == '1' ) {
        echo '<div class="sns-respmenu hidden-lg hidden-md">';
        wp_nav_menu( array(
       				'container' => false, 
       				'menu' => $nav_menu,
       				'menu_class' => 'nav-sidebar resp-nav'
        ) );
        echo '</div>';
    }
    echo '</div>';
else:
    echo '<p>'.esc_html__('Please select menu for shortcode SNS Vertical Menu', 'valen-shortcodes').'</p>';
endif;