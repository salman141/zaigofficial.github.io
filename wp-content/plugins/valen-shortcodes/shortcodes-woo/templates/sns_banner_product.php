<?php
$output = '';
$atts = vc_map_get_attributes( 'sns_banner_product', $atts );
extract( $atts );
if( class_exists('WooCommerce') ){
	$uq = rand().time();
	$class = 'sns-banner-product';
	$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
	$class .= ' '.esc_attr( valen_getCSSAnimation( $css_animation ) );
	if( $id ) :
		$args = array(
			    'post_type' 		=> 'product',
			    'posts_per_page' 	=> '-1',
			    'post__in'			=> explode(',', $id),
			    'post_status' 		=> 'publish'
	    );
		$prds = new WP_Query($args);
		if( $prds->have_posts() ) :
			ob_start();
			echo '<div class="'.$class.'">';
			while ( $prds->have_posts() ) : $prds->the_post(); ?>
				<a class="prd-img" href="<?php the_permalink(); ?>"><span>
				<?php 
				if($prd_image != ''){
					$prd_image = preg_replace('/[^\d]/', '', $prd_image);
					$img =   wp_get_attachment_image_src( $prd_image , ''); 
					?>
					<img src="<?php echo $img[0]; ?>" alt="<?php the_title(); ?>"/>
					<?php
				} ?>
				</span></a>
				<div class="prd-info">
					<?php if ( $show_cat == '1' && $cat ) : 
						$cat_info = get_term_by('slug', $cat, 'product_cat');
						?>
						<div class="cat-title"><a href="<?php echo get_term_link($cat, 'product_cat');?>"><?php echo $cat_info->name; ?></a></div>
					<?php endif; ?>
					<h4 class="prd-title">
					 	<a href="<?php the_permalink(); ?>">
					 		<?php the_title(); ?>
					 	</a>
					</h4>
					<?php if ( $show_price == '3' && $price != '' ) : ?>
						<div class="price">
							<?php echo ($price_label) ? '<span class="price-label">'.$price_label.'</span>' : '' ; ?>
							<?php echo '<span class="price-value">'.$price.'</span>'; ?>
						</div>
					<?php endif; ?>
					<?php if ( $show_price == '2' ) : ?>
						<div class="price">
							<?php woocommerce_template_loop_price() ?>
						</div>
					<?php endif; ?>
				</div>
				<?php
			endwhile;
			echo '</div>';
			$output .= ob_get_clean();
		endif;
		wp_reset_postdata();
	else:
		$output .= '<p>'.esc_html('Please select products in admin panel of shortcodes', 'valen-shortcodes').'</p>';
	endif;
}
echo $output;