<!-- Footer -->
<?php 
	$footer_layout = valen_getoption('footer_layout', '1'); ?>	
	<div id="sns_footer" class="sns-footer <?php echo 'footer-'.esc_attr($footer_layout); ?>">
		<div class="container">
	<?php
	$default_html = wp_kses(__( '<div class="row"><div class="col-md-12 copyright default">© 2018 <a href="%s">%s</a>. All Rights Reserved.</div></div>', 'valen' ), array(
												'a' => array(
													'href' => array(),
													'class' => array(),
												),
												'div' => array(
													'class' => array(),
												),
												'strong' => array(
													'class' => array(),
												), 
											) );
	if ( $footer_layout != '') {
	    $f_wcode = new WP_Query(array( 'name' => 'footer-'.esc_attr($footer_layout), 'post_type' => 'post-wcode' ));
	    if ($f_wcode->have_posts()) {
	        echo do_shortcode('[valen_postwcode name="footer-'.esc_attr($footer_layout).'"]');
	    }else{
	    	printf( $default_html, esc_url(home_url('/')), esc_html__('SNSTheme', 'valen') );
	    }
	    wp_reset_postdata();
	}else{
		printf( $default_html, esc_url(home_url('/')), esc_html__('SNSTheme', 'valen') );
	}
	?>
		</div>
	</div>
	<?php
	$advance_scrolltotop = valen_themeoption('advance_scrolltotop', 1);
	$advance_cpanel = valen_themeoption('advance_cpanel', 0);
	if ( $advance_scrolltotop == 1 || $advance_cpanel == 1 ) : ?>
	<!-- Tools -->
	<div id="sns_tools">
		<?php 
		if ( $advance_scrolltotop == 1 ) : ?>
		<div class="sns-croll-to-top">
			<a href="#" id="sns-totop"></a>
		</div>
		<?php
		endif;
		if ( $advance_cpanel == 1 ) : 
			get_template_part( 'tpl-cpanel');
		endif;
		?>
	</div>
	<?php endif; ?>
</div>