<?php
$output = '';
$id = rand().time();
$atts = vc_map_get_attributes( 'sns_store_info', $atts );
extract( $atts );

$class = 'sns-store-info';
if ($style) $class .= ' style-'.esc_attr($style);
$class .= ' '.esc_attr( valen_getCSSAnimation( $css_animation ) );
if ($extra_class) $class .= ' '.esc_attr($extra_class);

$ico_phone = esc_html__('Tel: ', 'valen-shortcodes');
$ico_phone2 = esc_html__('Mobile: ', 'valen-shortcodes');
$ico_address = esc_html__('Add: ', 'valen-shortcodes');
$ico_email = esc_html__('Email: ', 'valen-shortcodes');
if ($style == 2) {
	$ico_phone = '<span class="vc_icon_element-icon '.esc_attr($icon_phone).'"></span>';
	$ico_phone2 = '<span class="vc_icon_element-icon '.esc_attr($icon_phone2).'"></span>';
	$ico_address = '<span class="vc_icon_element-icon '.esc_attr($icon_address).'"></span>';
	$ico_email = '<span class="vc_icon_element-icon '.esc_attr($icon_email).'"></span>';
}elseif($style == 3){
	$ico_phone = '<span class="vc_icon_element-icon '.esc_attr($icon_phone).'"></span>'.$ico_phone;
	$ico_phone2 = '<span class="vc_icon_element-icon '.esc_attr($icon_phone2).'"></span>'.$ico_phone2;
	$ico_address = '<span class="vc_icon_element-icon '.esc_attr($icon_address).'"></span>'.$ico_address;
	$ico_email = '<span class="vc_icon_element-icon '.esc_attr($icon_email).'"></span>'.$ico_email;
}

$output = '<div class="'.$class.'">';
if ( $title ) {
	$output .= '<h3 class="wpb_heading"><span>'.esc_html($title).'</span></h3>';
}
$output .= '<div class="store-info">';
if ( $logo_store ) {
	$logo_store = preg_replace('/[^\d]/', '', $logo_store);
	$img_src =   wp_get_attachment_image_src( $logo_store , '');
	$output .= '<div class="store-logo"><img src="'.$img_src[0].'" alt="'.esc_html__("Store Logo",'valen-shortcodes').'"/></div>';
}
if ( $short_intro ) {
	$output .= '<div class="store-intro">'.nl2br(esc_html($short_intro)).'</div>';
}
if ( $address ) {
	$output .= '<div class="store-address">'.$ico_address.nl2br(esc_html($address)).'</div>';
}
if ( $phone || $phone2 ) {
	$output .= '<div class="store-phone">'.$ico_phone;
	$phone_html = '';
	//if ( $phone != '' ) {
		if ( strpos($phone, ':') == false ) {
			$phone_html .= '<a href="tel:'.str_replace(' ', '', esc_html($phone) ).'">'.esc_html($phone).'</a>';
		}else{
			$phone_html .= esc_html($phone);
		}
	//}
	$output .= $phone_html.'</div>';
}
if ( $phone2 ) {
	$output .= '<div class="store-phone">'.$ico_phone2;
	$phone_html = '';
	//if ( $phone2 != '' ) {
		if ( $phone_html != '' ) { $phone_html .= '<br/>'; }
		if ( strpos($phone2, ':') == false ) {
			$phone_html .= '<a href="tel:'.str_replace(' ', '', esc_html($phone2) ).'">'.esc_html($phone2).'</a>';
		}else{
			$phone_html .= esc_html($phone2);
		}
	//}
	$output .= $phone_html.'</div>';
}
if ( $email ) {
	$output .= '<div class="store-email">'.$ico_email;
	$email_html = '';
	if ( $email != '' ) {
		if ( strpos($email, ':') == false ) {
			$email_html .= '<a href="mailto:'.esc_html($email).'">'.esc_html($email).'</a>';
		}else{
			$email_html .= esc_html($email);
		}
	}
	// if ( $email2 != '' ) {
	// 	if ( $email_html != '' ) { $email_html .= '<br/>'; }
	// 	if ( strpos($email2, ':') == false ) {
	// 		$email_html .= '<a href="mailto:'.esc_html($email2).'">'.esc_html($email2).'</a>';
	// 	}else{
	// 		$email_html .= esc_html($email2);
	// 	}
	// }
	$output .= $email_html.'</div>';
}
$output .= '</div>';
$output .= '</div>';

echo $output;