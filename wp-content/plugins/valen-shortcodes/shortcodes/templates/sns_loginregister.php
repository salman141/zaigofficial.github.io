<?php
$output = '';
$id = rand().time();
$atts = vc_map_get_attributes( 'sns_loginregister', $atts );
extract( $atts );
$tclass = 'sns-login-register';
$tclass .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
$tclass .= esc_attr($css_animation);
$output = '<div class="'.$tclass.'">';
$current_user = wp_get_current_user();
if ( 0 == $current_user->ID ) {
	if ( $welcome_text ) {
		$output .= $welcome_text;
		$output .= ' Guest!';
	}
	$output .= '<a class="login-link" href="'.wp_login_url().'">'.$login_text.'</a>';
	if ( $seperator ) $output .= $seperator;
	$output .= '<a  class="register-link" href="'.wp_registration_url().'">'.$register_text.'</a>';
}else{
	if ( $welcome_text ) {
		$output .= $welcome_text;
		$output .= ' '.$current_user->user_login.'!';
	}
	$output .= esc_html__('Want to', 'valen').'<a href="'.wp_logout_url().'">'.$logout_text.'</a>';
}
$output .= '</div>';
echo $output;