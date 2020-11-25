<?php
/**
 * Footer menu template
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.1.5
 */





// Requirements check

	if ( ! has_nav_menu( 'footer' ) ) {
		return;
	}


?>

<div class="site-footer-area footer-area-footer-menu">
	<div class="site-footer-area-inner footer-menu-inner">

		<?php do_action( 'wmhook_icelander_menu_footer_before' ); ?>

		<nav class="footer-menu" aria-label="<?php esc_attr_e( 'Footer Menu', 'icelander' ); ?>">

			<?php

			wp_nav_menu( array(
					'theme_location' => 'footer',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => false,
				) );

			?>

		</nav>

		<?php do_action( 'wmhook_icelander_menu_footer_after' ); ?>

	</div>
</div>
