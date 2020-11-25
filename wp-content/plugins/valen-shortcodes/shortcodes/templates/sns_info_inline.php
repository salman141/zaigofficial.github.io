<?php
$output = '';
$id = rand().time();
$atts = vc_map_get_attributes( 'sns_info_inline', $atts );
extract( $atts );
vc_icon_element_fonts_enqueue('fontawesome');
$tclass = 'sns-info-inline';
$tclass .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
$tclass .= ( trim(esc_attr($style))!='' )?' '.esc_attr($style):'';
$tclass .= esc_attr($css_animation);
$output = '';
if ($icon_type){ 
	$icon_class = '';
	if ( $icon_type == 'fontawesome' ) {
		$icon_class = $icon_fontawesome;
	}elseif( $icon_type == 'flaticon' ){
		$icon_class = $icon_flaticon;
	}
	$output .= '<span class="vc_icon_element-icon '.esc_attr( $icon_class ).'"></span>';
}
if ($use_label && $label) {
	$output .= esc_attr( $label );
}
if ($use_link && $link) {
	if ($target) {
		$target = ' target="'.$target.'"';
	}
	if ($href_type == '0') {
		$href = ' href="'.esc_attr($link).'"';
	}elseif($href_type == '1'){
		$href = ' href="mailto:'.esc_attr($link).'"';
	}elseif($href_type == '2'){
		$href = ' href="tel:'.str_replace(' ', '', esc_attr($link)).'"';
	}
	$output = '<a'.$href.$target.'>'.$output.'</a>';
}
$output = '<div class="'.esc_attr($tclass).'">'.$output.'</div>'; // id="sns-infoinline-'.$id.'"
echo $output;