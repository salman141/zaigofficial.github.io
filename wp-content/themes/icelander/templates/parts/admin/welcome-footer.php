<?php
/**
 * Admin "Welcome" page content component
 *
 * Footer.
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.2
 */





// Requirements check

	if ( ! class_exists( 'Icelander_Welcome' ) ) {
		return;
	}


?>

</div> <!-- /.welcome-content -->

<p>
	<?php echo Icelander_Welcome::get_info_support(); ?>
	<br>
	<?php echo Icelander_Welcome::get_info_like(); ?>
</p>

<p><small><em><?php esc_html_e( 'You can disable this page in Appearance &raquo; Customize &raquo; Theme Options &raquo; Others.', 'icelander' ); ?></em></small></p>
