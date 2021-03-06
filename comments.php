<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ):
	return;
endif;
?>
<div class="comments-area padding-top-2x" id="comments">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
			printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;',
				get_comments_number(), 'comments title', 'hypermarket' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3><!-- .comments-title -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>
			<nav class="comment-navigation" id="comment-nav-above">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'hypermarket' ); ?></h1>
				<?php if ( get_previous_comments_link() ): ?>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments',
					'hypermarket' ) ); ?></div>
				<?php endif;
					if ( get_next_comments_link() ): ?>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;',
					'hypermarket' ) ); ?></div>
				<?php endif; ?>
			</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation. ?>
		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'callback' => 'hypermarket_comments_list'
			) );
			?>
		</ol><!-- .comment-list -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>
			<nav class="comment-navigation" id="comment-nav-below">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'hypermarket' ); ?></h1>
				<?php if ( get_previous_comments_link() ): ?>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments',
					'hypermarket' ) ); ?></div>
				<?php endif;
					if ( get_next_comments_link() ) : ?>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;',
					'hypermarket' ) ); ?></div>
				<?php endif; ?>
			</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation. ?>

	<?php endif; // endif have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'hypermarket' ); ?></p>
	<?php
	endif;
		$commenter = wp_get_current_commenter();
		$args = apply_filters('hypermarket_comment_form_args', array(
			'fields' => apply_filters('hypermarket_comment_form_default_fields', array(
				// Name Field
				'author' => '<div class="col-sm-4"><div class="form-element"><label for="author" class="screen-reader-text">' . __('Name', 'hypermarket') . '</label><input id="author" name="author" type="text" class="form-control" required="required" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . __('Name*', 'hypermarket') . '" /></div></div>',
				// Email Field
				'email' => '<div class="col-sm-4"><div class="form-element"><label for="email" class="screen-reader-text">' . __('Email', 'hypermarket') . '</label><input id="email" name="email" type="email" class="form-control" required="required" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . __('Email*', 'hypermarket') . '" /></div></div>',
				// Website Field
				'url' => '<div class="col-sm-4"><div class="form-element"><label for="url" class="screen-reader-text">' . __('Website', 'hypermarket') . '</label><input id="url" name="url" type="url" class="form-control" value="' . esc_attr($commenter['comment_author_url']) . '" placeholder="' . __('Website', 'hypermarket') . '" /></div></div>',
			)) ,
			// Comment Field
			'comment_field' => '<div class="col-sm-12"><div class="form-element"><label for="comment" class="screen-reader-text">' . __('Comment', 'hypermarket') . '</label><textarea id="comment" name="comment" class="form-control" rows="8" required="required" placeholder="' . __('Comment*', 'hypermarket') . '"></textarea></div></div>',
			'title_reply' => have_comments() ? __('Leave a reply', 'hypermarket') : sprintf(__('Be the first to comment &ldquo;%s&rdquo;', 'hypermarket') , get_the_title()),
			'logged_in_as' => '',
			'comment_notes_before' => '',
			'title_reply_before' => '<!-- Comment Form --><h4 class="padding-top">',
			'title_reply_after' => '</h4>',
			'id_form' => 'hypermarket-comment-form',
			'class_form' => 'row padding-top',
			'class_submit' => 'btn btn-block btn-primary space-top-none space-bottom-none',
			'label_submit' => __('Leave Comment', 'hypermarket')
		));
		comment_form($args); // Render comments form. ?>
</div><!-- #comments -->