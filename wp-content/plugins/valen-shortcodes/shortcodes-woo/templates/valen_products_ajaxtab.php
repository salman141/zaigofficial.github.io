<?php
$output = '';
$atts = vc_map_get_attributes( 'valen_products_ajaxtab', $atts );
extract( $atts );

if( class_exists('WooCommerce') ){
	$uq = rand().time();
	$class = 'sns-products-ajaxtab woocommerce';
	$class .= ' nav-in-' . $nav_pos;
	$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
	$class .= esc_attr($css_animation);
	if (!$number_limit) $number_limit = '-1';
	$data = '';
	$data .= ' data-usenav="'.$use_nav.'"';
	$data .= ' data-usepaging="'.$use_paging.'"';
	$data .= ' data-tabtype="'.esc_attr($tab_type).'"';
	$data .= ' data-gridstyle="'.esc_attr($gridstyle).'"';
	$data .= ' data-template="'.esc_attr($content_tab_template).'"';
	if ( $tab_type == '1' ) {
		$class .= ' ajaxtab-byorderby';
		$data .= ' data-desktop="'.esc_attr($number_desktop).'"';
		$data .= ' data-tabletl="'.esc_attr($number_tablet).'"';
		$data .= ' data-tabletp="'.esc_attr($number_tabletp).'"';
		$data .= ' data-mobilel="'.esc_attr($number_mobilel).'"';
		$data .= ' data-mobilep="'.esc_attr($number_mobilep).'"';
		$data .= ' data-row="'.esc_attr($number_row).'"';
		$data .= ' data-limit="'.esc_attr( $number_limit ).'"';
		$data .= ' data-effect="'.esc_attr($effect).'"';
		$data .= ' data-cat="'.esc_attr( $cat ).'"';
		$data .= ' data-uq="'.esc_attr($uq).'"';
	}elseif( $tab_type == '2' ){
		$class .= ' ajaxtab-bycat';
		$data .= ' data-desktop="'.esc_attr($number_desktop).'"';
		$data .= ' data-tabletl="'.esc_attr($number_tablet).'"';
		$data .= ' data-tabletp="'.esc_attr($number_tabletp).'"';
		$data .= ' data-mobilel="'.esc_attr($number_mobilel).'"';
		$data .= ' data-mobilep="'.esc_attr($number_mobilep).'"';
		$data .= ' data-row="'.esc_attr($number_row).'"';
		$data .= ' data-limit="'.esc_attr( $number_limit ).'"';
		$data .= ' data-effect="'.esc_attr($effect).'"';
		$data .= ' data-order="'.esc_attr( $orderby ).'"';
		$data .= ' data-uq="'.esc_attr($uq).'"';
	}
	if ( $content_tab_template != '2' ){
		$class .= ' template-carousel';
	}else {
		$class .= ' template-loadmore';
		$data .= ' data-showmore="'.esc_attr($num_showmore).'"';
	}
	wp_enqueue_script('sns-products-ajaxtab', VALEN_SHORTCODES_URL . 'assets/sns-products-ajaxtab.js', array('jquery'), '', true);
	// Start html
	ob_start(); ?>
<div id="sns_products_ajaxtab_<?php echo $uq; ?>" class="<?php echo $class;?>"<?php echo $data;?>>
	<div class="header-tab">
		<?php
		if ( $title != '' ){ ?>
		<h2 class="wpb_heading"><span><?php echo esc_attr($title); ?></span></h2>
		<?php 
		} ?>
		<?php
		if ( $tab_type == '1' ){
			include valen_shortcode_woo_template('product-tab/tab-items-orderby'); 
		}elseif ( $tab_type == '2' ) {
			include valen_shortcode_woo_template('product-tab/tab-items-cat'); 
		}?>
	</div>
	<div class="content-tab">
		<div class="content-tab-inner">
			<?php
			if ( $content_tab_template == '3' || $content_tab_template == '4' ||$content_tab_template == '5' ) {
				include valen_shortcode_woo_template('product-tab/tab-content'.$content_tab_template); 
			}else{
				include valen_shortcode_woo_template('product-tab/tab-content'); 
			}
			?>
		</div>
	</div>
</div>
	<?php
	$output .= ob_get_clean();
}
echo $output;
