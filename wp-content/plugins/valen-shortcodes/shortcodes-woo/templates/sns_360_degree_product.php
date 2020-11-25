<?php
$output = '';
$atts = vc_map_get_attributes( 'sns_360_degree_product', $atts );
extract( $atts );
if( class_exists('WooCommerce') ){
	$uq = rand().time();
	$class = 'sns-360-degree-product';
	$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
	if ($css_animation) $class .= ' '.esc_attr($css_animation);
	$data = 'data-total_frame="'.$total_frame.'"';
	$data .= ' data-image_path="'.$image_path.'"';
	$data .= ' data-file_prefix="'.$file_prefix.'"';
	$data .= ' data-file_ext="'.$file_ext.'"';
	$data .= ' data-navigation="'.$navigation.'"';
	wp_enqueue_script('threesixty');
	$output .= '<div class="'.$class.'" '.$data.'>';
	$output .= '<div class="content-left">';
	if ($title) $output .= '<div class="product-title second-font"><span>'.esc_attr($title).'</span></div>';
	if ($content) $output .= '<div class="desc">'.$content.'</div>';
	$link = vc_build_link( $plink );
	$output .= '<a class="btn readmore" href="' . esc_url( $link['url'] ) . '"'
	               . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
	               . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
	               . '>'.esc_attr( $link['title'] ).'</a>';
	$output .= '</div>';
	ob_start(); ?>
	<div class="content-right">
		<div class="content-360">
			<div class="spinner">
		    	<span>0%</span>
		  	</div>
		  	<ol class="images"></ol>
		</div>
	</div>
    <?php
    $output .= ob_get_clean();
	$output .= '</div>';
}
echo $output;
