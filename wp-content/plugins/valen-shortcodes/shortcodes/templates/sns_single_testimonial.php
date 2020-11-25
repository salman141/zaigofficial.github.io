<?php
$output = '';
$id = rand().time();
$atts = vc_map_get_attributes( 'sns_single_testimonial', $atts );
extract( $atts );
$class = 'sns-single-testimonial '.esc_attr($style);
if ($css_animation) $class .= ' '.esc_attr($css_animation);
if ($extra_class) $class .= ' '.esc_attr($extra_class);

if ( $author_avatar != '' ){
	$avatar = preg_replace('/[^\d]/', '', $author_avatar);
	$avatar =   wp_get_attachment_image_src( $avatar , '');
}

$output = '<div class="'.$class.'"';
	if ( $style == 'style1' ){
		$output .= '>';
	}elseif ( $style == 'style2' ) {
		$output .= ' data-dotimg="'.$avatar[0].'">';
	}
	if ( $testimonial_content != '' ) 
		$output .= '<div class="content"><span class="icon">"</span>'.esc_html($testimonial_content).'<span class="icon"> "</span></div>';
	
	if ( $style == 'style1' ){
		$output .= '<div class="avatar"><img src="'.$avatar[0].'" alt="'.esc_attr($author_name).'" /></div>';
	}
	$output .= '<div class="info">';
	if ( $author_name != '' ) $output .= '<div class="name">'.esc_html($author_name).'</div>';
	if ( $author_position != '' ) $output .= '<div class="position">'.esc_html($author_position).'</div>';
	$output .= '</div>';
$output .= '</div>';
echo $output;