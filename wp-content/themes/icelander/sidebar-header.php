<?php
/**
 * Widget area in site header.
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.3.2
 */





// Requirements check

	if ( ! is_active_sidebar( 'header' ) ) {
		return;
	}


?>

<div class="header-widgets-container">

	<aside id="header-widgets" class="widget-area header-widgets" aria-label="<?php echo esc_attr_x( 'Header widgets', 'Sidebar aria label', 'icelander' ); ?>">

		<?php dynamic_sidebar( 'header' ); ?>

	</aside>

</div>
