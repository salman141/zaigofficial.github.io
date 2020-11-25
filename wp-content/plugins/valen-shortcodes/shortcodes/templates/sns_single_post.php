<?php
$output = '';
$atts = vc_map_get_attributes( 'sns_single_post', $atts );
extract( $atts );
global $post;
if ( !$sp ) return;
$args = array(
	'post_status' => 'publish',
	'post_type' => 'post',
	'p'		=> $sp
);
$lp_query = new WP_Query( $args );
$uq = rand().time();
$class = 'sns-single-post';
$class .= ( trim($extra_class)!='' )?' '.esc_attr($extra_class):'';
$class .= ' '.esc_attr( valen_getCSSAnimation( $css_animation ) );
if( $lp_query->have_posts() ) :
	while ( $lp_query->have_posts() ) : $lp_query->the_post();
	$output .= '<div id="sns_singlepost'.$uq.'" class="'.$class.'">';
	ob_start();
	?>
	<div class="post-img"><a href="<?php echo esc_url( get_permalink() ) ;?>">
		<?php 
		if( $custom_img ){
			$custom_img = preg_replace('/[^\d]/', '', $custom_img);
			$img =   wp_get_attachment_image_src( $custom_img , '');
			echo '<img src="'.$img[0].'" alt="'.get_the_title().'"/>';
		}else{
			echo get_the_post_thumbnail($post->ID, 'valen_blog_special_thumb'); 
		}
		?></a></div>
	<div class="post-info">
		<div class="post-meta"><div class="inner">
			<div class="post-date"><span><?php echo get_the_date() ?></span></div>
			<div class="post-author"><?php echo esc_html__('By', 'valen-shortcodes');?><a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php echo get_the_author_meta('display_name');?></a></div>
		</div></div>
		<div class="post-title"><a href="<?php echo esc_url( get_permalink() ) ;?>"><span><?php echo str_replace(' ', '</span><span>', get_the_title() ); ?></span></a></div>
		<div class="read-more"><a class="btn-readmore btn" href="<?php echo esc_url( get_permalink() ) ;?>"><?php echo esc_html__('Read more', 'valen-shortcodes'); ?></a></div>
	</div>
	<?php
	$output .= ob_get_clean();
	$output .= '</div>';
	endwhile;
endif;
wp_reset_postdata();
echo $output;
