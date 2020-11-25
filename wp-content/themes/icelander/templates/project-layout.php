<?php
/**
 * Template Name: Project layout
 * Template Post Type: wm_projects
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.1.1
 */

/* translators: Custom page template name. */
__( 'Project layout', 'icelander' );





get_template_part( 'single', get_post_type() );
