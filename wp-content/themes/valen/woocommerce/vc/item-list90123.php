<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $woocommerce_loop;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php post_class(); ?>>
	<div class="block-product-inner list-view">
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>
			<div class="item-img">
					<a class="product-image" href="<?php the_permalink(); ?>">
	<?php
	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	// do_action( 'woocommerce_before_shop_loop_item_title' );
						echo woocommerce_get_product_thumbnail('valen_woo_90123_thumb');
	?>
					</a>
					<?php valen_quickview_liststyle(); ?>
			</div>
			<div class="item-info">
				<div class="item-content">
	<?php
	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	add_action('valen_list90123_after_item_title', 'valen_woo_product_list_title', 5);
	add_action('valen_list90123_after_item_title', 'woocommerce_template_loop_price', 10);
	add_action('valen_list90123_after_item_title', 'woocommerce_template_loop_rating', 15);
	do_action( 'valen_list90123_after_item_title' );
	?>
				</div>
			</div>
	</div>
</div>
