<!-- Header -->
<div id="sns_header" class="wrap <?php echo esc_attr(valen_getoption('header_style', 'style1')); ?>">
	<div class="main-header">
		<div class="container">
			<div class="row">
				<div class="header-logo col-lg-2 col-md-6 col-xs-6 col-phone-12">
					<div id="logo">
						<?php $logourl = valen_getoption('header_logo', VALEN_THEME_URI.'/assets/img/logo.png', 'image'); ?>
						<a class="logo-retina" href="<?php echo esc_url( home_url('/') ) ?>" title="<?php bloginfo( 'sitename' ); ?>">
							<img src="<?php echo esc_attr($logourl); ?>" alt="<?php bloginfo( 'sitename' ); ?>"/>
						</a>
					</div>		
				</div>
				<div id="sns_mainmenu" class="main-cat col-lg-8">
					<?php
                    if(has_nav_menu('categories_navigation')):
                    	$ico_style = valen_getoption('mcat_style', '2');
                    	if( $ico_style == '1' ){
                    		$ico_style = 'main-big-cat';
                    	}else{
                    		$ico_style = 'main-cat';
                    	}
                   		wp_nav_menu( array(
			           				'theme_location' => 'categories_navigation',
			           				'container' => false,
			           				'menu_id' => 'main_menu_cats',
			           				'walker' => new valen_Megamenu_Front,
				           			'menu_class' => 'visible-lg nav navbar-nav '.esc_attr($ico_style)
			           	) );
			           	wp_nav_menu( array(
			           				'theme_location' => 'categories_navigation',
			           				'container' => false,
			           				'menu_id' => 'main_menu_cats_res',
			           				'menu_class' => 'hidden-lg nav-sidebar resp-nav'
			           	) );
                    else:
                        echo '<p class="hidden main_navigation_alert">'.esc_html__('Please sellect menu for Categories navigation', 'valen').'</p>';
                    endif;
                    ?>
				</div>
				<div class="header-right col-lg-2 col-md-6 col-xs-6 col-phone-12"><div class="inner">
					<div class="mini-main-cat"><span class="overlay"></span></div>
					<div class="mini-search">
						<span class="tongle"></span>
					</div>
					<?php
					if ( class_exists('WooCommerce') ) : ?>
						<?php
						if ( function_exists('YITH_WCWL') ) { ?>
						<div class="mini-wishlist">
							<a class="tongle" href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>">
								<span class="number"><?php echo YITH_WCWL()->count_products(); ?></span>						
							</a>
						</div>
						<?php
						}?>
						<div class="mini-cart sns-ajaxcart">
							<a href="<?php echo wc_get_cart_url(); ?>" class="tongle">
								<span class="cart-label"><?php echo esc_html__("Cart", "valen"); ?>
								</span>
								<span class="number">
									<?php echo sizeof( WC()->cart->get_cart() );?>
								</span>
							</a>
							<?php if ( !is_cart() && !is_checkout() ) : ?>
								<div class="content">
									<div class="cart-title"><h4><?php echo esc_html__("My cart", "valen"); ?></h4></div>
									<div class="block-inner">
										<?php the_widget( 'WC_Widget_Cart', 'title= ', array('before_title' => '', 'after_title' => '') ); ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<!-- Main menu wrap -->
					<div class="menu-sidebar">
						<span class="tongle"></span><span class="overlay"></span>
						<div class="sidebar-content">
							<?php
							$tms_wcode = new WP_Query(array( 'name' => 'top-menu-sidebar', 'post_type' => 'post-wcode' ));
						    if ($tms_wcode->have_posts()) { ?>
						    	<div class="top-menu-sidebar">
						    	<?php echo do_shortcode('[valen_postwcode name="top-menu-sidebar"]'); ?>
						    	</div>
						    	<?php
						    } ?>
							<div class="mid-menu-sidebar">
		                    <?php
		                    if(has_nav_menu('main_navigation')):
			                   $main_menu = '';
								if(is_page() && ($menu_selected = get_post_meta(get_the_ID(), 'valen_main_menu', true))){
									$main_menu = $menu_selected;
								}
		                   		wp_nav_menu( array(
					           				'theme_location' => 'main_navigation',
					           				'container' => false,
					           				'menu'		=> $main_menu,
					           				'menu_id' => 'main_menu_sidebar',
					           				'menu_class' => 'nav-sidebar resp-nav'
					           	) );
		                    else:
		                        echo '<p class="hidden main_navigation_alert">'.esc_html__('Please sellect menu for Main navigation', 'valen').'</p>';
		                    endif;
		                    ?>
		                	</div>
		                	<?php 
		                	$bms_wcode = new WP_Query(array( 'name' => 'bottom-menu-sidebar', 'post_type' => 'post-wcode' ));
						    if ($bms_wcode->have_posts()) { ?>
						    	<div class="bottom-menu-sidebar">
						    	<?php echo do_shortcode('[valen_postwcode name="bottom-menu-sidebar"]'); ?>
						    	</div>
						    	<?php
						    } ?>
		                </div>
                    </div>
                    <div class="btn-navbar leftsidebar">
					    <span class="overlay"></span>
					</div>
					<div class="btn-navbar rightsidebar">
					    <span class="overlay"></span>
					</div>
				</div></div>
			</div>
		</div>
		<div class="search-box">
			<div class="inner">
					<?php
					if ( valen_getoption('enable_search_cat') == true ) valen_get_searchform('def');
					else valen_get_searchform('hide_cat');
					?>
				</div>
			</div>
	</div>
</div>
<?php valen_slideshow_wrap(false); ?>
<?php
do_action('valen_before_sns_content');
