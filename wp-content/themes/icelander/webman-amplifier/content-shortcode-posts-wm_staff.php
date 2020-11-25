<?php
/**
 * Posts shortcode item template
 *
 * Default wm_staff item template.
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 *
 * @uses  array $helper  Contains shortcode $atts array plus additional helper variables.
 */





?>

<div class="<?php echo esc_attr( $helper['item_class'] ); ?>">

	<?php include get_theme_file_path( 'templates/parts/content/content-staff.php' ); ?>

</div>
