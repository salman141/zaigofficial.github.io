<?php
$output = '';
$uq = rand().time();
$atts = vc_map_get_attributes( 'sns_comingsoon_product', $atts );
extract( $atts );
if( class_exists('WooCommerce') ){
	$uq = rand().time();
	$class = 'sns-comingsoon-product';
	$class .= ' comingsoon-box-' . $uq;
	$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
	if ($css_animation) $class .= ' '.esc_attr($css_animation);
	if ($bg) { ?>
    <style>
    	<?php echo '.comingsoon-box-' . $uq . '{ background-image: url(' .wp_get_attachment_url($bg) . ');}'; ?>
    </style>
    <?php
	}
	$output .= '<div class="'.$class.'">';
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
			while ( $special_prds->have_posts() ) : $special_prds->the_post(); ?>
				<div class="item comingsoon-<?php echo $uq; ?>">
					<div class="date-part">
						<?php 
			            if( strpos(site_url(), 'demo.snstheme.com') || strpos(site_url(), 'dev.snsgroup.me') ){
			                if($thedate == '' || $thedate <= date('Y/m/d') ) $thedate = date('Y/m/d', strtotime('+10 days'));
			            }
			            wp_enqueue_script('jquery-countdown');
			            ?>
			            <div class="time-count-down" id="sns-tcd-<?php echo esc_attr($uq); ?>" data-date="<?php echo esc_attr($thedate); ?>">
			                <div class="clock-digi">
			                    <div><div><div class="day"></div><?php esc_html_e('Days', 'valen');?></div></div>
			                    <div><div><div class="hours"></div><?php esc_html_e('Hours', 'valen');?></div></div>
			                    <div><div><div class="minutes"></div><?php esc_html_e('Mins', 'valen');?></div></div>
			                    <div><div><div class="seconds"></div><?php esc_html_e('Secs', 'valen');?></div></div>
			                </div>
			            </div>
					</div>
					<div class="content-part">
						<?php $link = get_the_permalink(); ?>
						<div class="pre-title"><span><?php echo esc_html__('Coming soon', 'valen-shortcodes'); ?></span></div>
					    <h3 class="item-title">
						 	<a href="<?php echo esc_url($link); ?>">
						 		<?php the_title(); ?>
						 	</a>
						</h3>
						<div class="item-desc"><?php echo $content; ?></div>
						<?php
						if ( $wcode_pa ) {
							$atts = new WP_Query(array( 'name' => $wcode_pa, 'post_type' => 'post-wcode' ));
							if ($atts->have_posts()) { ?>
							    <div class="item-atts">
										<?php echo do_shortcode('[valen_postwcode name="'.$wcode_pa.'"]'); ?>
								</div>
								<?php
							}
						}
						wp_reset_postdata(); ?>
						<div class="item-button">
							<div class="pre-text"><?php echo $pretext_readmore; ?></div>
							<a class="btn-readmore btn" href="<?php echo esc_url($link); ?>"><?php echo esc_html__('Read more', 'valen-shortcodes'); ?></a>
						</div>
					</div>
				</div>
			<?php
			endwhile;
			$output .= ob_get_clean();
		endif;
		wp_reset_postdata();
	else:
		$output .= '<p>'.esc_html('Please select products in admin panel of shortcodes', 'valen-shortcodes').'</p>';
	endif;
	$output .= '</div>';
}
echo $output;
