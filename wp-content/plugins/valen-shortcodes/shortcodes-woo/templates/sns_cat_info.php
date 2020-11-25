<?php
$output = '';
$atts = vc_map_get_attributes( 'sns_cat_info', $atts );
extract( $atts );
if( class_exists('WooCommerce') ){
	$uq = rand().time();
	$class = 'sns-cat-info';
	// $class .= ( esc_attr($style) !='' )?' style-'.esc_attr($style):'';
	$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
	$class .= ' '.esc_attr( valen_getCSSAnimation( $css_animation ) );
	
	$l_href = $l_name = $l_target = '' ;
	if ( $r_type == '1' ){
		$cat_info = get_term_by('slug', $cat, 'product_cat');
		$l_href = get_term_link($cat, 'product_cat');
		$l_name = trim($ctitle) != '' ? $ctitle : $cat_info->name;
		$l_target = '';
	}elseif ($r_type == '2' && !empty( $clink ) ) {
		$clink = vc_build_link( $clink );
		$l_href = $clink['url'];
		$l_name = $clink['title'] ? esc_attr( $clink['title'] ) : esc_html__('You should enter title', 'valen-shortcodes');
		$l_target = esc_attr( $clink['target'] ) ;
	}
	$output .= '<div class="'.$class.'">';
	$output .= '<a class="cat-img" href="'.$l_href.'"><span>';
	if($cat_image != ''){
		$cat_image = preg_replace('/[^\d]/', '', $cat_image);
		$img =   wp_get_attachment_image_src( $cat_image , '');
		$output .= '<img src="'.$img[0].'" alt="'.$l_name.'" />';
	}
	$output .= '</span></a>';
	$output .= '<div class="cat-info">';
	$output .= '<h4 class="cat-title second-font"><a href="'.$l_href.'" target="'.$l_target.'">'.$l_name.'</a></h4>';
	//if ( $show_prd_num == '1' ){
		$output .= '<span class="cat-prd-num">'.$cat_info->count. ' ' . esc_html__('Products', 'valen-shortcodes') .'</span>';
	//}
	$output .= '</div>';
	$output .= '</div>';
}
echo $output;