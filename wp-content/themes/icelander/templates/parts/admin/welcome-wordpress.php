<?php
/**
 * Admin "Welcome" page content component
 *
 * WordPress guide.
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

<div class="wm-notes special" style="padding: 2em; font-size: inherit;">

	<a class="button button-hero button-primary mt0 alignright" href="https://webmandesign.github.io/docs/icelander/#wordpress"><?php esc_html_e( 'WordPress Video Tutorials &raquo;', 'icelander' ); ?></a>

	<h2 class="mt0" style="font-size: 1.62em;"><strong><?php esc_html_e( 'New to WordPress?', 'icelander' ); ?></strong></h2>

	<p>
		<?php esc_html_e( 'If you are new to WordPress, please check out the introduction section in theme documentation.', 'icelander' ); ?>
	</p>

</div>
