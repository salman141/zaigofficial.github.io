<?php get_header(); ?>
<!-- Content -->
<div id="sns_content" class="sns-woocommerce-page">
	<div class="container">
		<div class="row sns-content">
			<?php valen_leftcol(); ?>
			<div class="<?php echo valen_maincolclass(); ?>">
			    <?php
		    	if( is_product() ){
					wc_get_template( 'single-product.php' );
				}else{
					wc_get_template( 'archive-product.php' );
				}
				?>
			</div>
			<?php valen_rightcol(); ?>
		</div>
	</div>
</div>
<!-- End Content -->
<?php get_footer(); ?>