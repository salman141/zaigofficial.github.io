<?php
$output = '';
$id = rand().time();
$atts = vc_map_get_attributes( 'sns_info_box', $atts );
extract( $atts );

vc_icon_element_fonts_enqueue( $icon_type );
$box_css = '';
$tclass = 'sns-info-box fa-parent';
$tclass .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
$info_box = new WPBakeryShortCode_SNS_Info_Box( array( 'base' => 'sns_info_box' ) );
$tclass .= ' '.$info_box->getCSSAnimation( $css_animation );
$tclass .= ' box-style'.$box_style;

if($icon_image != ''){
	$icon_image = preg_replace('/[^\d]/', '', $icon_image);
	$img =   wp_get_attachment_image_src( $icon_image , '');
}

ob_start();
?>
<div id="sns-infobox-<?php echo $id; ?>" class="<?php echo esc_attr($tclass); ?>">
	<div class="info-box-wrapper">
		<div class="icon">
			<?php if($icon_image != ''): 
				$icon_m_css = '';
				if ( $max_width ) {
					$icon_m_css = ' style="max-width:'.$max_width.'"';
				}
				?>
				<img<?php echo $icon_m_css; ?> src="<?php echo $img[0] ?>" alt="<?php echo esc_attr($title) ?>" />
			<?php else:
				$icon_css = '';
				if ( $icon_font_size ) $icon_css .= 'font-size:' . $icon_font_size . ';'; //' line-height:' . $icon_font_size . ';';
				if ( $icon_color ) $icon_css .= 'color:' . $icon_color . ';';
				if ( $max_width ) {
					$icon_css .= 'max-width:'.$max_width.';';
				}
			?>
				<span style="<?php echo esc_attr($icon_css);?>" class="vc_icon_element-icon <?php echo esc_attr( ${"icon_" . $icon_type} ); ?>"></span>
			<?php endif; ?>	
		</div>
		<div class="content-info-box">
			<?php if($title != ''):?>
			<h2 class="sc_heading">
				<?php if ( $link !='' ) {?>
				<a href="<?php echo esc_url( $link ) ?>"><?php echo esc_html( $title ) ?></a>
				<?php }else{ ?>
				<?php echo esc_html( $title ) ?>
				<?php } ?>
			</h2>
			<?php endif; ?>
			<?php
			if (trim(strip_tags($content)) != ''){
				echo $content;
			} ?>
		</div>
	</div>
</div>
<?php
$output = ob_get_clean();
echo $output;