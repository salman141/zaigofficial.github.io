<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( empty( $class ) ) {
	$class = '';
}
?>
<div <?php post_class($class); ?>>
	<div class="block-product-inner product-inner">
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>
				<div class="item-info">
	<?php
	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	// do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	add_action('valen_hotdeals_item_info', 'woocommerce_template_loop_product_title', 5);
	add_action('valen_hotdeals_item_info', 'woocommerce_template_loop_price', 10);
	do_action( 'valen_hotdeals_item_info' );
	?>
				</div>
				<div class="item-actions">
	<?php
	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	add_action('valen_hotdeals_item_action', 'valen_woo_special_countdown', 5);
	add_action('valen_hotdeals_item_action', 'valen_special_sold_bar', 10);
	add_action('valen_hotdeals_item_action', 'valen_item_addtocart', 15);
	do_action( 'valen_hotdeals_item_action' );
	?>
				</div>
			</div>
</div>