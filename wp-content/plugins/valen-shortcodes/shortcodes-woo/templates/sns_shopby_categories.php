<?php
$output = '';
$atts = vc_map_get_attributes( 'sns_shopby_categories', $atts );
extract( $atts );
if( class_exists('WooCommerce') ){
	$uq = rand().time();
	$class = 'sns-shopby-categories';
	$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
	if ($css_animation) $class .= ' '.esc_attr($css_animation);
	
	$output .= '<div id="sns_shopby_categories_'.$uq.'" class="'.$class.'">';
	if($cat_image != ''){
		$cat_image = preg_replace('/[^\d]/', '', $cat_image);
		$img =   wp_get_attachment_image_src( $cat_image , '');
		$output .= '<div class="cat-img"><img src="'.$img[0].'" alt="'.esc_attr($title).'"/></div>';
	}
	if ( $title ) $output .= '<h4 class="wpb_heading"><span>'.esc_attr($title).'</span></h4>';
	$output .= '<div class="content">';
	if ( $lit_cat ) {
		$output .= '<ul class="list-cats">';
		$categories = explode(',', $lit_cat);
		foreach ($categories as $category):
			$cat_i = get_term_by('slug', $category, 'product_cat');
			if( !empty($cat_i->term_id) ):
				$output .= '<li><a href="'.get_term_link($cat_i->term_id, 'product_cat').'" title="'.esc_attr($cat_i->name).'">'.$cat_i->name.'</a></li>';
			endif;
		endforeach;
		$output .= '</ul>';
	}
	if ( ! empty( $link ) ) {
		$link = vc_build_link( $link );
		$output .= '<a class="view-all" href="' . esc_url( $link['url'] ) . '"'
		               . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
		               . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
		               . '>' . esc_html__('View all', 'valen-shortcodes') . '</a>';
	}
	$output .= '</div>';
	$output .= '</div>';
}
echo $output;
