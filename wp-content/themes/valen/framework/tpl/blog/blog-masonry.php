<?php
wp_enqueue_script('masonry');
$wclass = '';
if ( valen_themeoption('blog_class') ) {
	$wclass = valen_themeoption('blog_class');
}
$pagination = valen_themeoption('pagination', 'def'); // get theme option
?>
<div class="sns-grid posts sns-blog-posts sns-blog-masonry <?php echo esc_attr($wclass);?>">
	<div id="snsmain" class="sns-grid-masonry">
		<?php 
		while ( have_posts() ) : the_post();
		?>
			<?php get_template_part( 'framework/tpl/posts/post-masonry', get_post_format() )?>
		<?php
		endwhile;
		?>
	</div>
	<?php
	// Paging
	if( $pagination == 'def')
		get_template_part('tpl-paging');
	?>
</div>
<?php
if( $pagination == 'ajax' || $pagination == 'ajax2' ){
	wp_enqueue_script('imagesloaded');
	wp_enqueue_script('valen-blog-ajax');
	valen_paging_nav_ajax('#snsmain', 'framework/tpl/posts/post-masonry' ); // This paging nav should be outside #snsmain div
}

echo '<input type="hidden" name="hidden_valen_blog_layout" value="' . valen_themeoption('blog_type') .  '">';