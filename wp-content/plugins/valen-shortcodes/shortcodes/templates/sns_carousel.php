<?php
$atts = vc_map_get_attributes( 'sns_carousel', $atts );
extract( $atts );
$uq = rand().time();
$class = 'sns-carousel';
$class .= ' carousel-' . $uq;
$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
$class .= esc_attr($css_animation);
$data = 'data-type="'.esc_attr($slider_type).'"';
if ( $show_nav ) $data .= ' data-nav="'.esc_attr($show_nav).'"';
if ( $show_paging ) $data .= ' data-paging="'.esc_attr($show_paging).'"';
if ( $autoplay ) $data .= ' data-autoplay="'.esc_attr($autoplay).'"';
if ( $n_desktop ) $data .= ' data-desktop="'.esc_attr($n_desktop).'"';
if ( $n_tablet ) $data .= ' data-tabletl="'.esc_attr($n_tablet).'"';
if ( $n_tabletp ) $data .= ' data-tabletp="'.esc_attr($n_tabletp).'"';
if ( $n_mobile_l ) $data .= ' data-mobilel="'.esc_attr($n_mobile_l).'"';
if ( $n_mobile_p ) $data .= ' data-mobilep="'.esc_attr($n_mobile_p).'"';
$data .= ' data-next="'.esc_attr__('Next', 'valen-shortcodes').'"';
$data .= ' data-prev="'.esc_attr__('Prev', 'valen-shortcodes').'"';
$data .= ' data-uq="'.esc_attr($uq).'"';
$output = '';
$content_class = '';
if ( $slider_type == 'h' ){
	$content_class .= ' owl-carousel';
}elseif( $slider_type == 'h-c' || $slider_type == 'h-s' ){
	$content_class .= ' hidden';
}
?>
<div class="<?php echo $class; ?>" <?php echo $data; ?>>
<?php
if ( $title ) $output .= '<h2 class="wpb_heading"><span>'.esc_html($title).'</span></h2> ';
	$output .= '<div class="carousel-content'.$content_class.'">';
	$output .= wpb_js_remove_wpautop( $content );
	$output .= '</div>';
	echo $output;
?>
</div>