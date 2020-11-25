<?php
$atts = vc_map_get_attributes( 'sns_grid_items', $atts );
extract( $atts );
$class = 'sns-grid-items';
$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
$class .= esc_attr($css_animation);
$output = '';
?>
<div class="<?php echo $class; ?>" data-desktop="<?php echo esc_attr($n_desktop); ?>" data-tabletl="<?php echo  esc_attr($n_tablet); ?>" data-tabletp="<?php echo  esc_attr($n_tabletp); ?>" data-mobilel="<?php echo  esc_attr($n_mobile_l); ?>" data-mobilep="<?php echo  esc_attr($n_mobile_p); ?>">
<?php
	$output .= wpb_js_remove_wpautop( $content );
	echo $output;
?>
</div>