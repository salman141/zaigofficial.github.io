<?php get_header(); ?>
<!-- Content -->
<div id="sns_content">
	<div class="container">
		<div class="row sns-content">
			<?php valen_leftcol(); ?>
			<div class="<?php echo valen_maincolclass(); ?>">
			    <?php
			    if ( have_posts() ) : ?>
	            <div id="snsmain" class="blog-standard posts sns-blog-posts">
	            	<?php
	                // Theloop
	                while ( have_posts() ) : the_post();
	                    get_template_part( 'framework/tpl/posts/post' );
	                endwhile;
	            	?>
	            </div>
	            <?php
		            // Paging
		            get_template_part('tpl-paging');
	            else:
	               echo esc_html__('No post were found matching your selection', 'valen');
	            endif; ?>
			</div>
			<?php valen_rightcol(); ?>
		</div>
	</div>
</div>
<!-- End Content -->
<?php get_footer(); ?>