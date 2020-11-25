<?php
$output = '';
$atts = vc_map_get_attributes( 'sns_products', $atts );
extract( $atts );
if( class_exists('WooCommerce') ){
	if (!$number_limit) $number_limit = '-1';
	$loop = valen_woo_query($orderby, $number_limit, $lit_cat);
	$uq = rand().time();
	$class = 'sns-products woocommerce';
	if ( $modeview == '1'){
		$class .= ' gird-mode';
	}else{
		$class .= ' list-mode';
	}
	$class .= ' nav-in-' . $nav_pos;
	$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
	if ($css_animation) $class .= ' '.esc_attr($css_animation);
	$data = 'data-usenav="'.$use_nav.'"';
	$data .= ' data-usepaging="'.$use_paging.'"';
	$data .= ' data-desktop="'.$number_desktop.'"';
	$data .= ' data-laptop="'.$number_laptop.'"';
	$data .= ' data-tabletl="'.$number_tablet.'"';
	$data .= ' data-tabletp="'.$number_tabletp.'"';
	$data .= ' data-mobilel="'.$number_mobilel.'"';
	$data .= ' data-mobilep="'.$number_mobilep.'"';
	$data .= ' data-gridstyle="'.esc_attr($gridstyle).'"';
	$output .= '<div class="'.$class.'" '.$data.'>';
	if ($before_title) $output .= '<p class="before-title">'.esc_attr($before_title).'</p>';
	if ($title) $output .= '<h2 class="wpb_heading"><span><span>'.esc_attr($title).'</span></span></h2>';
	if ($after_title) $output .= '<p class="after-title">'.esc_attr($after_title).'</p>';
	$output .= '<div class="sproduct-content">';
	if( $loop->have_posts() ) :
		
		ob_start();
		if( $modeview == '1' ){
			echo '<div class="prdlist-content grid-style'.$gridstyle.'">';
			echo '<div class="s-products product_list grid style'.$gridstyle.' owl-carousel">';
			$i = 0;
			while ( $loop->have_posts() ) : $loop->the_post();
				if ( $number_row && $number_row > 1 ){
					if ( $i == 0 || $i%$number_row == 0 ) {
						echo '<div class="item-row">';
					}
				}
			    wc_get_template( 'vc/item-grid.php', array('gridstyle' => $gridstyle) );
			    if ( $number_row && $number_row > 1 ){
			    	if ( $loop->post_count == $i+1 || ($i+1)%$number_row == 0 ){
			    		echo '</div><!--End .item-row-->';
			    	}
			    	$i++;
			    }
			endwhile;
			echo '</div>';
		}elseif ( $modeview == '2' ) {
			echo '<div class="prdlist-content">';
			echo '<div class="s-products product_list list owl-carousel">';
			$i = 0;
			while ( $loop->have_posts() ) : $loop->the_post();
				if ( $number_row && $number_row > 1 ){
					if ( $i == 0 || $i%$number_row == 0 ) {
						echo '<div class="item-row">';
					}
				}
			    wc_get_template( 'vc/item-list'.$thumb_type.'.php');
			    if ( $number_row && $number_row > 1 ){
			    	if ( $loop->post_count == $i+1 || ($i+1)%$number_row == 0 ){
			    		echo '</div><!--End .item-row-->';
			    	}
			    	$i++;
			    }
			endwhile;
			echo '</div>';
		}
		$output .= ob_get_clean();
		$output .= '</div>';
	else:
		$output .= '<p>'.esc_html__('There are no products matching to show', 'valen-shortcodes').'</p>';
	endif;
	$output .= '</div>';
	$output .= '</div>';
	wp_reset_postdata(); // Because valen_woo_query return WP_Query
}
echo $output;
