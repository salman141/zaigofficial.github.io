<?php
$output = '';
$uq = rand().time();
$atts = vc_map_get_attributes( 'sns_member', $atts );
extract( $atts );
$class = 'sns-member';
if ( $info_style != '' ) $class .= ' '.$info_style;
$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
$class .= esc_attr($css_animation);

$output .= '<div class="'.$class.'">';
$begin_link = '';
if ( ! empty( $link ) ) {
	$link = vc_build_link( $link );
	$begin_link = '<a href="' . esc_url( $link['url'] ) . '"'
	               . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
	               . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
	               . '>';
}
if($avartar != ''){
	$avartar = preg_replace('/[^\d]/', '', $avartar);
	$img =   wp_get_attachment_image_src( $avartar , '');
	$img = '<img src="'.esc_attr($img[0]).'" alt="'.esc_attr($name).'" />';
	if ( $begin_link !='' ) {
		$img = $begin_link. $img . '</a>';
	}
	
	$avartar_class = ($avartar_style!='') ? 'avartar '.esc_attr($avartar_style) :'avartar';
	$output .= '<div class="'.$avartar_class.'">'.$img.'</div>';
}
$output .= '<div class="member-info">';
if ($name != ''){
	if ( $begin_link !='' ) {
		$name = $begin_link. esc_attr($name) . '</a>';
	}
	$output .= '<div class="name-role">'.$name;
	if ($role != ''){
		$output .= '<span class="role">'.esc_attr($role).'</span>';
	}
	$output .= '</div>';
}
if (trim(strip_tags($short_desc)) != ''){
	$output .= '<div class="short_desc">'.esc_textarea($short_desc).'</div>';
}
	$social = '<div class="social-icons"><ul>';
	if( $facebook != '') {
	 	$social .= '<li><a class="facebook" href="' . esc_url( $facebook ) . '" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
	}
	if( $twitter != '') {
	 	$social .= '<li><a class="twitter" href="' . esc_url( $twitter ) . '" target="_blank" title="twitter"><i class="fa fa-twitter"></i></a></li>';
	}
	if( $instagram != '') {
	 	$social .= '<li><a class="instagram" href="' . esc_url( $instagram ) . '" target="_blank" title="instagram"><i class="fa fa-instagram"></i></a></li>';
	}
	if( $linkedin != '') {
	 	$social .= '<li><a class="linkedin" href="' . esc_url( $linkedin ) . '" target="_blank" title="linkedin"><i class="fa fa-linkedin"></i></a></li>';
	}
	if( $dribbble != '') {
	 	$social .= '<li><a class="dribbble" href="' . esc_url( $dribbble ). '" target="_blank" title="dribbble"><i class="fa fa-dribbble"></i></a></li>';
	}
	if( $behance != '') {
	 	$social .= '<li><a class="behance" href="' . esc_url( $behance ) . '" target="_blank" title="behance"><i class="fa fa-behance"></i></a></li>';
	}
	if( $youtube != '') {
	 	$social .= '<li><a class="youtube" href="' . esc_url( $youtube ) . '" target="_blank" title="youtube"><i class="fa fa-youtube"></i></a></li>';
	}
	if( $pinterest != '') {
	 	$social .= '<li><a class="pinterest" href="' . esc_url( $pinterest ) . '" target="_blank" title="pinterest"><i class="fa fa-pinterest"></i></a></li>';
	}
	if( $google != '') {
	 	$social .= '<li><a class="google" href="' . esc_url( $google ) . '" target="_blank" title="google plus"><i class="fa fa-google-plus"></i></a></li>';
	}
	$social .= '</ul></div>';
	$output .= $social;

$output .= '</div>';
$output .= '</div>';
echo $output;
