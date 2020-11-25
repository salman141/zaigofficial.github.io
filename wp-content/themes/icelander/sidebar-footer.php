<?php
/**
 * Primary widget area in site footer.
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.3.2
 */





// Requirements check

	if ( ! is_active_sidebar( 'footer' ) ) {
		return;
	}


?>

<div class="site-footer-area footer-area-footer-widgets">
	<div class="footer-widgets-inner site-footer-area-inner">

		<aside id="footer-widgets" class="widget-area footer-widgets" aria-label="<?php echo esc_attr_x( 'Footer widgets', 'Sidebar aria label', 'icelander' ); ?>">

			<?php dynamic_sidebar( 'footer' ); ?>

		</aside>

	</div>
</div>
