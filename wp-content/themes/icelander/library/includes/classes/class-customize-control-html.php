<?php
/**
 * Customizer custom controls
 *
 * Customizer custom HTML.
 *
 * @package     WebMan WordPress Theme Framework
 * @subpackage  Customize
 *
 * @since    1.0.0
 * @version  1.9.0
 * @version  1.4.0
 */
class Icelander_Customize_Control_HTML extends WP_Customize_Control {

	public $type = 'html';

	public $content = '';



	public function render_content() {

		// Output

			if ( isset( $this->label ) && ! empty( $this->label ) ) {
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
			}

			if ( isset( $this->content ) ) {
				echo wp_kses_post( $this->content );
			} else {
				esc_html_e( 'Please set the `content` parameter for the HTML control.', 'icelander' );
			}

			if ( isset( $this->description ) && ! empty( $this->description ) ) {
				echo '<span class="description customize-control-description">' . wp_kses_post( $this->description ) . '</span>';
			}

	} // /render_content

} // /Icelander_Customize_Control_HTML
