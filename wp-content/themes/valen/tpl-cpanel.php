<?php
$buy = valen_themeoption('tf_p_link');
?>
<div id="sns_cpanel">
	<!-- <div id="sns_cpanel_content"> -->
	    <div id="sns_cpanel_content" class="cpanel-set">
	    	<?php if ($buy) : ?>
	    	<div class="envato-buy"><a href="<?php echo esc_url($buy); ?>" title="<?php echo esc_html__('Buy theme now', 'valen'); ?>" target="_blank"><i class="fa fa-shopping-cart"></i><?php echo esc_html__('Buy theme now', 'valen'); ?></a></div>
	    	<?php endif; ?>
	    	<div class="qr-code">
	    		<p><img src="<?php echo VALEN_THEME_URI; ?>/assets/img/qrcode.jpg" alt="<?php echo esc_html__('View on mobile', 'valen'); ?>"/></p>
	    		<p><span><?php echo esc_html__('View on mobile', 'valen'); ?></span></p>
	    	</div>
	    	<div class="demos">
	    		<h4><?php echo esc_html__('Lets explore our demos!', 'valen'); ?></h4>
	    		<div class="demo demo-1">
	    			<a class="img" href="http://demo.snstheme.com/wp/valen/" title="<?php echo esc_html__('Home #1', 'valen'); ?>">
	    				<img src="http://doc.snstheme.com/wp/valen/home-1.jpg" alt="<?php echo esc_html__('Home #1', 'valen'); ?>"/>
	    			</a>
	    			<a href="http://demo.snstheme.com/wp/valen/" title="<?php echo esc_html__('Home #1', 'valen'); ?>">
	    				<span><?php echo esc_html__('Home #1', 'valen'); ?></span>
	    			</a>
	    		</div>
	    		<div class="demo demo-2">
	    			<a class="img" href="http://demo.snstheme.com/wp/valen/home-2/" title="<?php echo esc_html__('Home #2', 'valen'); ?>">
	    				<img src="http://doc.snstheme.com/wp/valen/home-2.jpg" alt="<?php echo esc_html__('Home #2', 'valen'); ?>"/>
	    			</a>
	    			<a href="http://demo.snstheme.com/wp/valen/home-2/" title="<?php echo esc_html__('Home #2', 'valen'); ?>">
	    				<span><?php echo esc_html__('Home #2', 'valen'); ?></span>
	    			</a>
	    		</div>
	    		<div class="demo demo-3">
	    			<a class="img" href="http://demo.snstheme.com/wp/valen-skate/" title="<?php echo esc_html__('Home #3', 'valen'); ?>">
	    				<img src="http://doc.snstheme.com/wp/valen/home-3.jpg" alt="<?php echo esc_html__('Home #3', 'valen'); ?>"/>
	    			</a>
	    			<a href="http://demo.snstheme.com/wp/valen-skate/" title="<?php echo esc_html__('Home #3', 'valen'); ?>">
	    				<span><?php echo esc_html__('Home #3', 'valen'); ?></span>
	    			</a>
	    		</div>
	    		<div class="demo demo-4">
	    			<a class="img"  href="http://demo.snstheme.com/wp/valen-skate/home-4" title="<?php echo esc_html__('Home #4', 'valen'); ?>">
	    				<img src="http://doc.snstheme.com/wp/valen/home-4.jpg" alt="<?php echo esc_html__('Home #4', 'valen'); ?>"/>
	    			</a>
	    			<a href="http://demo.snstheme.com/wp/valen-skate/home-4" title="<?php echo esc_html__('Home #4', 'valen'); ?>">
	    				<span><?php echo esc_html__('Home #4', 'valen'); ?></span>
	    			</a>
	    		</div>
	    	</div>
	    </div>
	<!-- </div> -->
    <div id="sns_cpanel_btn">
    	<?php if ($buy) : ?>
    	<a class="link-buy" href="<?php echo esc_url($buy); ?>" title="<?php echo esc_html__('Buy Theme Now', 'valen'); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_html__('Buy Theme Now', 'valen'); ?>" data-placement="right" target="_blank">
    		<img src="<?php echo VALEN_THEME_URI; ?>/assets/img/envato.png" alt="<?php echo esc_html__('Buy Theme Now', 'valen'); ?>"/>
    	</a>
    	<?php endif; ?>
    	<a class="view-demo" href="#" title="<?php echo esc_html__('View All Demos', 'valen'); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_html__('View All Demos', 'valen'); ?>" data-placement="right">
    		<i class="fa fa-desktop"></i>
    	</a>
    	<a class="link-doc" href="http://doc.snstheme.com/wp/valen/" title="<?php echo esc_html__('Live Documentation', 'valen'); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_html__('Live Documentation', 'valen'); ?>" data-placement="right" target="_blank">
    		<i class="fa fa-life-saver"></i>
    	</a>
    </div>
</div>
<span class="overlay"></span>