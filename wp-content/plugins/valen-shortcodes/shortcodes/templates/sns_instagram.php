<?php
$output = '';
$atts = vc_map_get_attributes( 'sns_instagram', $atts );
extract( $atts );
$uq = rand().time();
$class = 'sns-instagram';
// if ( $show_author == '1' ) $class .= ' show-author';

$class .= ' style-'.esc_attr($style);
$class .= ' type-'.esc_attr($type);
$class .= ( trim($extra_class)!='' )?' '.esc_attr($extra_class):'';
$class .= ' '.esc_attr( valen_getCSSAnimation( $css_animation ) );
$flag = true;
if ( $access_token && $limit) {
	$media_url = 'https://graph.instagram.com/me/media?fields=id,caption,tag&access_token=' . $access_token;
	$media = wp_remote_get( $media_url );
	if ( ! is_wp_error( $media ) ) {
		$media = json_decode( $media['body'] );
		if ( isset($media->error->message) ) {
			$output .= '<p>'.$media->error->message.'</p>';
		}else{
			$m_items = $media->data; 
			$i = 0;
			$ids = array(); $imgs = array();
			foreach ( $m_items as $m_item ) {
				if ( $i >= $limit ) break; 
				if ( $type == 'tag' && $tag != '' ) { // get follow tag
					if ( isset( $m_item->caption ) ) {
						$pos = strpos($m_item->caption, '#' . $tag); 
						if ( $pos === false ) { 
							continue; 
						}
					}else{
						continue; 
					}
				}
				$image_url = 'https://graph.instagram.com/' . $m_item->id . '?fields=media_type,media_url,permalink&access_token=' . $access_token;
				$image = wp_remote_get( $image_url );
				if ( ! is_wp_error( $image ) ) {
					$image = json_decode( $image['body'] );
					if ( isset($image->error->message) ) {
						$output .= '<p>'.$image->error->message.'</p>';
					}else{
						if ( $image->media_type == 'IMAGE' ) {
							$imgs[] = array(
								'src' 	=> $image->media_url,
								'link' 	=> $image->permalink
							);
							$i ++;
						}
					}
				}else{
					$flag = false;
				}
			}
		}
	}else{
		$flag = false;
	}
}
$output .= '<div id="sns_instagram'.($uq).'" class="'.esc_attr($class).'">';
	if ( $title != '' ) $output .= '<h3 class="wpb_heading"><span>'.esc_attr($title).'</span></h3>';
	$output .= '<div class="list-items">';
	if ( $style == 'grid' ) {
		$output .= '<div class="grid col-'.$number.'">';
	}elseif ( $style == 'carousel' ) {
		$data = '';
		$data .= ' data-desktop="'.$number_desktop.'"';
		$data .= ' data-tabletl="'.$number_tablet.'"';
		$data .= ' data-tabletp="'.$number_tabletp.'"';
		$data .= ' data-mobilel="'.$number_mobilel.'"';
		$data .= ' data-mobilep="'.$number_mobilep.'"';
		$output .= '<div class="owl-carousel"'.$data.'>';
	}else{
		$output .= '<div class="grid col-'.$number.'">';
		$output .= '<p>'.esc_html__('Please select Display style', 'valen-shortcodes').'</p>';
	}
	if ( $flag == true && isset( $imgs ) ) {
		foreach ( $imgs as $item ) {
			// $link     = $item['link'];
			// $image    = $item['src'];
			// $comments = $item['comments'];
			// $like     = $item['like'];
			$output .= '<div class="item">';
				$output .= '<a class="item-image" href="'.esc_url($item['link']).'" target="_blank"><img src="' . esc_url( $item['src'] ) . '" alt="Instagram" /></a>';
				// $output .= '<div class="info">';
				// 	$output .= '<span class="like">' . $like . '</span>';
				// 	$output .= '<span class="comment">' . $comments . '</span>';
				// $output .= '</div>';
			$output .= '</div>';
		}
	}
	$output .= '</div>';
	$output .= '</div>';
$output .= '</div>';
echo $output;
