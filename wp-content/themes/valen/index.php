<?php get_header(); ?>
<!-- Content -->
<div id="sns_content">
	<div class="container">
		<div class="row sns-content">
			<?php valen_leftcol(); ?>
			<div class="<?php echo valen_maincolclass(); ?>">
			    <?php
			    if ( have_posts() ) :
			        get_template_part( 'framework/tpl/blog/blog', valen_themeoption('blog_type', '') );
			    else:
			        get_template_part( 'content', 'none' );
			    endif; ?>
			</div>
			<?php valen_rightcol(); ?>
		</div>
	</div>
</div>
<!-- End Content -->
<?php get_footer(); ?>