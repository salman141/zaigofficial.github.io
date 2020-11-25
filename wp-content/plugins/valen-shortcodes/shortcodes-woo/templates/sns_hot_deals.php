<?php
$output = '';
$atts = vc_map_get_attributes( 'sns_hot_deals', $atts );
extract( $atts );
if( class_exists('WooCommerce') ){
	$uq = rand().time();
	$class = 'sns-hot-deals woocommerce';
	$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
	if ($css_animation) $class .= ' '.esc_attr($css_animation);
	$output .= '<div class="'.$class.'">';
	if ($title) $output .= '<h4 class="wpb_heading"><span>'.esc_attr($title).'</span></h4>';
	if( $ids ) :
		$args = array(
			    'post_type' 		=> 'product',
			    'posts_per_page' 	=> '-1',
			    'post__in'			=> explode(',', $ids),
			    'post_status' 		=> 'publish'
	    );
		$special_prds = new WP_Query($args);
		if( $special_prds->have_posts() ) :
			ob_start();
			echo '<div class="owl-carousel_">';
			while ( $special_prds->have_posts() ) : $special_prds->the_post();
			    wc_get_template( 'vc/item-hotdeals.php');
			endwhile;
			echo '</div>';
			$output .= ob_get_clean();
		endif;
		wp_reset_postdata();
	else:
		$output .= '<p>'.esc_html('Please select products in admin panel of shortcodes', 'snsevon-shortcodes').'</p>';
	endif;
	$output .= '</div>';
}
echo $output;