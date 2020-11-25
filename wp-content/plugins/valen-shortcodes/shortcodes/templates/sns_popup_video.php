<?php
$output = '';
$id = rand().time();
$atts = vc_map_get_attributes( 'sns_popup_video', $atts );
extract( $atts );

$box_css = '';
$tclass = 'sns-popup-video';
$tclass .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
$tclass .= ' '.esc_attr( valen_getCSSAnimation( $css_animation ) );
if($bg_image_video != ''){
	$bg_image_video = preg_replace('/[^\d]/', '', $bg_image_video);
	$img =   wp_get_attachment_image_src( $bg_image_video , '');
	$box_css = ' style="background-image:url('.$img[0].');';
	if ( $height_wrap ) {
		$box_css .= ' height:'.$height_wrap.';';
	}
	$box_css .= '"';
}
wp_enqueue_script('prettyPhoto');
ob_start();
?>
<div id="sns-popupvideo-<?php echo $id; ?>" class="<?php echo esc_attr($tclass); ?>"<?php echo $box_css; ?>>
	<div class="text-content">
		<?php if ( $title ) : ?>
		<h3 class="title"><?php echo $title ?></h3>
		<?php endif; ?>
		<a class="btn-popupvideo" href="<?php echo $video_link; ?>" rel="prettyPhoto"><i class="fa fa-play-circle"></i>
			<?php echo esc_html__('click here to play', 'valen-shortcodes'); ?>
		</a>
	</div>
</div>
<?php
$output = ob_get_clean();
echo $output;