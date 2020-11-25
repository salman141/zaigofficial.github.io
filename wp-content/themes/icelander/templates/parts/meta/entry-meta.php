<?php
/**
 * Post meta
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.1.3
 */





// Requirements check

	if (
			post_password_required()
			|| ! in_array( get_post_type( get_the_ID() ), (array) apply_filters( 'wmhook_icelander_entry_meta_post_type', array( 'post' ) ) )
		) {
		return;
	}


?>

<footer class="entry-meta"><?php

	get_template_part( 'templates/parts/meta/entry-meta-element', 'date' );
	get_template_part( 'templates/parts/meta/entry-meta-element', 'author' );
	get_template_part( 'templates/parts/meta/entry-meta-element', 'comments' );

	if ( is_single( get_the_ID() ) ) {
		get_template_part( 'templates/parts/meta/entry-meta-element', 'category' );
		get_template_part( 'templates/parts/meta/entry-meta-element', 'tags' );
	}

?></footer>
