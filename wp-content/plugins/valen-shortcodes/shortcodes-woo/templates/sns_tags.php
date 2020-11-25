<?php
$output = '';
$atts = vc_map_get_attributes( 'sns_tags', $atts );
extract( $atts );
$class = 'sns-tags';
$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
$class .= esc_attr($css_animation);
?>
<div class="<?php echo $class; ?>">
<?php if ($title): ?>
	<h3 class="wpb_heading"><span><?php echo esc_html($title); ?></span></h3>
<?php endif; ?>
	<div class="tags-content">
<?php 
if ($tags_display == 'select') {
	$tag_arr = explode(',', $tag_list);
	foreach ($tag_arr as $key => $tag) {
		$tg = get_term_by('term_taxonomy_id', $tag, 'post_tag');
		if( !empty($tg->term_id) ) echo '<a class="tag-link-'.$tag.'" href="'.get_term_link($tg->term_id).'">'.$tg->name.'</a>';
	}
}else {
	$output = wp_tag_cloud( apply_filters( 'widget_tag_cloud_args', array(
				'taxonomy' => $tag_taxonomy,
				'echo' => false,
				'largest' => 1,
				'smallest' => 1,
				'unit' => 'em',
				'number' => $number_limit,
				'show_count' => 0
			) ) );
	echo $output;
}?>
	</div>
</div>