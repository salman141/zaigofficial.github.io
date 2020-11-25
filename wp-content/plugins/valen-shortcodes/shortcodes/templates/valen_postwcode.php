<?php
$output = '';
$atts = vc_map_get_attributes( 'valen_postwcode', $atts );
extract( $atts );
if ( !post_type_exists('post-wcode') ) return;
if ( $name ){
	$wcode = new WP_Query(array( 'name' => $name, 'post_type' => 'post-wcode' ));
    if ($wcode->have_posts()) {
        $wcode->the_post();
        global $post;
        $post_content = $post->post_content;
        $output .= '<div class="postwcode-widget">';
        if ($title) $output .= '<h2 class="wpb_heading"><span>'.esc_attr($title).'</span></h2>';
        $output .= do_shortcode($post_content);
        // Add css
        /*
        $wcode_css = get_post_meta( get_the_ID(), '_wpb_post_custom_css', true );
		$wcode_css .= get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
        if ( ! empty( $wcode_css ) ) {
        	$output .= '<style type="text/css">';
        	$output .= $wcode_css;
        	$output .= '</style>';
        } */
        $output .= '</div>';
    }
    wp_reset_postdata();
}
echo $output;