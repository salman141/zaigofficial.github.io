<?php
/**
 * Skip links
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.5.0
 * @version  1.5.0
 */





?>

<ul class="skip-link-list">
	<?php

	$links = array(
		'site-navigation' => __( 'Skip to main navigation', 'icelander' ),
		'content'         => __( 'Skip to main content', 'icelander' ),
		'colophon'        => __( 'Skip to footer', 'icelander' ),
	);

	foreach ( $links as $id => $text ) {
		echo Icelander_Library::link_skip_to(
			$id,
			$text,
			'',
			'<li class="skip-link-list-item">%s</li>'
		);
	}

	?>
</ul>
