<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





get_header();

	if ( have_posts() ) :

		?>

		<header class="page-header">
			<h1 class="page-title"><?php

				printf(
					esc_html__( 'Search Results for: %s', 'icelander' ),
					'<span>' . get_search_query() . '</span>'
				);

			?></h1>
		</header>

		<?php

	endif;

	get_template_part( 'templates/parts/loop/loop', 'search' );

get_footer();
