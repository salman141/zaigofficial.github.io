<?php
/**
 * Secondary widget area in site footer.
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.3.2
 */





// Requirements check

	if ( ! is_active_sidebar( 'footer-secondary' ) ) {
		return;
	}


?>

<div class="site-footer-area footer-area-footer-secondary-widgets">
	<div class="footer-secondary-widgets-inner site-footer-area-inner">

		<aside id="footer-secondary-widgets" class="widget-area footer-secondary-widgets" aria-label="<?php echo esc_attr_x( 'Footer secondary widgets', 'Sidebar aria label', 'icelander' ); ?>">

			<?php dynamic_sidebar( 'footer-secondary' ); ?>

		</aside>

	</div>
</div>
