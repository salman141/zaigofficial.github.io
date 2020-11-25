<?php
$output = '';
$atts = vc_map_get_attributes( 'sns_list_posts', $atts );
extract( $atts );

global $post;
$args = array(
	'post_status' => 'publish',
	'post_type' => 'post',
	'orderby' => ($orderby) ? $orderby : 'date',
	'order' => ($sortorder) ? $sortorder : 'DESC',
	'posts_per_page' => (int)$number_limit,
	'ignore_sticky_posts' => 1,
);
$lp_query = new WP_Query( $args );
$uq = rand().time();
$class = 'sns-list-posts';
if ( $show_author == '1' ) $class .= ' show-author';
if ( $show_date == '1' ) $class .= ' show-date';
$class .= ( trim($extra_class)!='' )?' '.esc_attr($extra_class):'';
$class .= ' '.esc_attr( valen_getCSSAnimation( $css_animation ) );
$class .= ' '.esc_attr($style);

if( $lp_query->have_posts() ) :
	$output .= '<div id="sns_listposts'.$uq.'" class="'.$class.'">';
	if ( $title != '' ) $output .= '<h3 class="wpb_heading"><span>'.esc_attr($title).'</span></h3>';
	
	if ( $style == 'style1' ) {
		if ( $thumbnail == '' ) { $thumbnail = 'valen_blog_tiny_thumb'; }
		$output .= '<div class="list-post">';
		while ( $lp_query->have_posts() ) : $lp_query->the_post();
			$output .= '<div class="item-post">';
			$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),  $thumbnail);
			if( $img['0'] != '' ){
				$output .= '<div class="post-img"><a href="'.esc_url( get_permalink() ).'"><img src="'.$img['0'].'"/></a></div>';
			}
			$output .= '<div class="post-title"><a href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></div>';
			if ( $show_author == '1' ) {
				$output .= '<div class="post-author"><a class="author-link" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'.get_the_author_meta('display_name').'</a></div>';
			}
			if ( $show_date == '1' ) {
				$output .= '<div class="post-date"><span>'.get_the_date().'</span></div>';
			}
			$output .= '</div>';
		endwhile;
		$output .= '</div>';
	}elseif ( $style == 'style2' ) {
		$data = '';
		$data .= ' data-desktop="'.$number_desktop.'"';
		$data .= ' data-tabletl="'.$number_tablet.'"';
		$data .= ' data-tabletp="'.$number_tabletp.'"';
		$data .= ' data-mobilel="'.$number_mobilel.'"';
		$data .= ' data-mobilep="'.$number_mobilep.'"';
		$output .= '<div class="list-post"><div class="owl-carousel"'.$data.'>';
		if ( $thumbnail == '' ) { $thumbnail = 'valen_blog_large_thumb'; }
		ob_start();
		while ( $lp_query->have_posts() ) : $lp_query->the_post(); ?>
			<div class="item-post">
				<div class="post-img"><a href="<?php echo esc_url( get_permalink() ) ;?>"><?php echo get_the_post_thumbnail($post->ID, $thumbnail); ?></a></div>
				<div class="post-info">
					<?php if ( $show_author == '1' || $show_date == '1' ) { ?>
						<div class="post-meta">
						<?php if ( $show_date == '1' ) { ?>
							<div class="post-date">
								<?php printf( '%1$s<a href="%2$s" rel="bookmark"><time class="entry-date published" datetime="%3$s">%4$s</time></a>',
				                    esc_html__('on ', 'valen-shortcodes'),
				                    get_permalink(),
				                    esc_attr( get_the_date() ),
				                    get_the_date()
				                );?>
							</div>
						<?php } ?>
						<?php if ( $show_author == '1' ) { ?>
							<div class="post-author"><?php echo esc_html__('by', 'valen-shortcodes');?><a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php echo get_the_author_meta('display_name');?></a></div>
						<?php } ?>
						</div>
					<?php } ?>
					<div class="post-title second-font"><a href="<?php echo esc_url( get_permalink() ) ;?>"><?php echo get_the_title(); ?></a></div>
					
					<div class="post-excerpt">
		                <?php 
		                if( empty( $post->post_excerpt ) ) {
		                	$readmore = '<span>'.esc_html__('Read More', 'valen-shortcodes').'</span>';
		                    echo strip_shortcodes(get_the_content($readmore));
		                } else { ?>
		                    <p><?php echo valen_excerpt(32, ''); ?></p>
		                    <a class="more-link" href="<?php echo esc_url( get_permalink() ) ;?>"><?php echo esc_html__( 'Read more','valen-shortcodes' ); ?></a>
		                <?php } ?>
		            </div>
				</div>
			</div>
		<?php
		endwhile;
		$output .= ob_get_clean();
		$output .= '</div></div>';
	}

	$output .= '</div>';
endif;
wp_reset_postdata();
echo $output;
