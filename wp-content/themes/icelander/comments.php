<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.1.5
 */





/**
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}





do_action( 'tha_comments_before' );

?>

<div id="comments" class="comments-area">
<div class="comments-area-inner">

	<h2 class="comments-title">
		<?php

		printf(
			esc_html( _nx( '%1$d comment on &ldquo;%2$s&rdquo;', '%1$d comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'Comments list title.', 'icelander' ) ),
			number_format_i18n( get_comments_number() ),
			'<span>' . get_the_title() . '</span>'
		);

		?>
	</h2>

	<?php

	/**
	 * Comments list
	 */
	if ( have_comments() ) {

		// If comments are closed and there are comments, let's leave a little note, shall we?

			if (
					! comments_open()
					&& get_comments_number()
					&& post_type_supports( get_post_type(), 'comments' )
				) :

				?>

				<p class="comments-closed no-comments"><?php esc_html_e( 'Comments are closed.', 'icelander' ); ?></p>

				<?php

			endif;

		// Actual comments list

			?>

			<ol class="comment-list">
				<?php

				wp_list_comments( array(
						'avatar_size' => 240,
						'style'       => 'ol',
						'short_ping'  => true,
					) );

				?>
			</ol>

			<?php

		// Are there comments to navigate through?

			if (
					1 < get_comment_pages_count()
					&& get_option( 'page_comments' )
				) :

				$total   = get_comment_pages_count();
				$current = ( get_query_var( 'cpage' ) ) ? ( absint( get_query_var( 'cpage' ) ) ) : ( 1 );

				?>

				<nav id="comment-nav-below" class="pagination comment-pagination" aria-label="<?php esc_attr_e( 'Comments Navigation', 'icelander' ); ?>" data-current="<?php echo esc_attr( $current ); ?>" data-total="<?php echo esc_attr( $total ); ?>">

					<?php

					paginate_comments_links( (array) apply_filters( 'wmhook_icelander_pagination_args', array(
						'prev_text' => esc_html_x( '&laquo;', 'Pagination text (visible): previous.', 'icelander' ) . '<span class="screen-reader-text"> '
						               . esc_html_x( 'Previous page', 'Pagination text (hidden): previous.', 'icelander' ) . '</span>',
						'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next page', 'Pagination text (hidden): next.', 'icelander' )
						               . ' </span>' . esc_html_x( '&raquo;', 'Pagination text (visible): next.', 'icelander' ),
					), 'comments' ) );

					?>

				</nav>

				<?php

			endif;

	} // /have_comments()



	/**
	 * Comments form
	 */
	comment_form();

	?>

</div>
</div><!-- #comments -->

<?php

do_action( 'tha_comments_after' );
