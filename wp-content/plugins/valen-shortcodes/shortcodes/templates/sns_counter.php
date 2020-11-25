<?php
$output = '';
$uq = rand().time();
$atts = vc_map_get_attributes( 'sns_counter', $atts );
extract( $atts );

vc_icon_element_fonts_enqueue( $icon_type );
wp_enqueue_script( 'valen-countTo', VALEN_THEME_URI . '/assets/js/jquery.countTo.js', array(), '', true );
wp_enqueue_script( 'waypoints' );
$uq = time().rand();
$class = 'sns-counter';
$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
$class .= esc_attr($css_animation);
$output .= '<style>';
// Icon
if ($enable_icon == '1') 
$output .= '#sns_counter_'.$uq.' .vc_icon_element-icon{
				color:'.esc_attr($icon_color).';
				font-size:'.esc_attr($icon_font_size).';
				height:'.esc_attr($icon_font_size).';
				line-height:'.esc_attr($icon_font_size).';
			}';
// Vaule
$output .= '#sns_counter_'.$uq.' .counter-value{
				color:'.esc_attr($value_color).';
				font-size:'.esc_attr($value_font_size).';
				line-height:'.esc_attr($value_font_size).';
			}';
// Title
$output .= '#sns_counter_'.$uq.' .title{
				color:'.esc_attr($title_color).';
				font-size:'.esc_attr($title_font_size).';
			}';
$output .= '</style>';
$output .= '<div id="sns_counter_'.$uq.'" class="'.$class.'">';
if ($enable_icon == '1') 
	$output .= '<span class="vc_icon_element-icon '.esc_attr( ${"icon_" . $icon_type} ).'"></span>';
if ($enable_icon == '2' && $icon_image ) {
	$icon_image = preg_replace('/[^\d]/', '', $icon_image);
	$img =   wp_get_attachment_image_src( $icon_image , '');
	$img = '<img src="'.esc_attr($img[0]).'"/>';

	$output .= '<span class="vc_icon_element-icon">'.$img.'</span>';
}
$output .= '<span class="counter-value"><span data-from="'.esc_attr(trim($from)).'" data-to="'.esc_attr(trim($value)).'" data-interval="'.esc_attr(trim($interval)).'" data-speed="'.esc_attr(trim($speed)).'">'.esc_html($value).'</span>'.esc_attr($unit).'</span>';
if($title != '') {
	$output .= '<p class="title">'.esc_attr( $title ).'</p>';
}

$output .= '</div>';
echo $output;
