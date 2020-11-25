<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="block-product-inner grid-view style1 product-inner">
	<div class="item-inner">
<?php
/**
 * woocommerce_before_shop_loop_item hook.
 *
 * @hooked woocommerce_template_loop_product_link_open - 10
 */
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
do_action( 'woocommerce_before_shop_loop_item' );
?>
		<div class="item-img clearfix">
			<div class="item-img-info">
				<a class="product-image" href="<?php the_permalink(); ?>">
<?php
/**
 * woocommerce_before_shop_loop_item_title hook.
 *
 * @hooked woocommerce_show_product_loop_sale_flash - 10
 * @hooked valen_product_thumbnail - 11
 */

do_action( 'woocommerce_before_shop_loop_item_title' );
// add_action('valen_grid1_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash');
// do_action( 'valen_grid1_before_shop_loop_item_title' );
?>
				</a>
				<div class="buttons-action"><div class="inner">
				<?php
				add_action('valen_grid1_after_item_thumbnail', 'valen_item_addtocart', 5 );
				add_action('valen_grid1_after_item_thumbnail', 'valen_item_wishlist2', 6 ); 
				add_action('valen_grid1_after_item_thumbnail', 'valen_item_compare', 7 ); 
				add_action('valen_grid1_after_item_thumbnail', 'valen_quickview_liststyle', 8);
				do_action( 'valen_grid1_after_item_thumbnail' );
				?>
				</div></div>
			</div>
			<div class="item-content">
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
add_action('valen_grid1_after_item_title', 'woocommerce_template_loop_product_title', 5);
add_action('valen_grid1_after_item_title', 'woocommerce_template_loop_price', 15);
add_action('valen_grid1_after_item_title', 'woocommerce_template_loop_rating', 10);
do_action( 'valen_grid1_after_item_title' );
?>
			</div>
		</div>
<?php
/**
 * woocommerce_after_shop_loop_item hook.
 *
 * @hooked woocommerce_template_loop_product_link_close - 5
 * @hooked woocommerce_template_loop_add_to_cart - 10
 */
do_action( 'valen_grid1_after_shop_loop_item' );
?>
	</div>
</div>