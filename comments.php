<?php
	/**
	* The template for displaying comments.
	*
	* The area of the page that contains both current comments
	* and the comment form.
	*
	* @package ModRealistic
	*/
	
	/*
	* If the current post is protected by a password and
	* the visitor has not yet entered the password we will
	* return early without loading the comments.
	*/
	
	if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','modrealistic'); ?></p>
	<?php
		return;
	}
?>
<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
<div id="comments">
	<h3 class="total-comments">
		<?php
			printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'modrealistic' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
		?>
	</h3>
	<ol class="commentlist clearfix">
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link() ?></div>
			<div class="alignright"><?php next_comments_link() ?></div>
		</div>
		<?php wp_list_comments('type=comment&callback=realistic_custom_comments'); ?>
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link() ?></div>
			<div class="alignright"><?php next_comments_link() ?></div>
		</div>
	</ol>
</div>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments"></p>
<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>
<div id="commentsAdd" class="mdl-cell mdl-cell--12-col">
		<?php global $aria_req; $comments_args = array(
			'title_reply'=> __('Add a Comment','modrealistic') ,
			'comment_notes_after' => '',
			'label_submit' => __( 'Add Comment', 'modrealistic' ),			
			'comment_field' => '<div class="comment-form-comment mdl-textfield mdl-js-textfield"><textarea id="comment" class="mdl-textfield__input" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
			'fields' => apply_filters( 'comment_form_default_fields',
			array(
				'author' => '<div class="comment-form-author mdl-textfield mdl-js-textfield">'
				.'<label style="display:none" for="author">'. __( 'Name', 'modrealistic' ).'<span class="required"></span></label>'
				.( $req ? '' : '' ).'<input id="author" class="mdl-textfield__input" name="author" type="text" placeholder="'.__('Name','modrealistic').'" value="'.esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
				'email' => '<div class="comment-form-email mdl-textfield mdl-js-textfield"><label style="display:none" for="email">' . __( 'Email', 'modrealistic' ) . '<span class="required"></span></label>'
				.($req ? '' : '' ) . '<input id="email" class="mdl-textfield__input" name="email" type="text" placeholder="'.__('Email','modrealistic').'" value="' . esc_attr(  $commenter['comment_author_email'] ).'" size="30"'.$aria_req.' /></div>',
				'url' => '<div class="comment-form-url mdl-textfield mdl-js-textfield"><label style="display:none" for="url">' . __( 'Website', 'modrealistic' ).'</label>' . 
				'<input id="url" class="mdl-textfield__input" name="url" type="text" placeholder="'.__('Website','modrealistic').'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>'		
			) )
		); 
		comment_form($comments_args); ?>
</div>
<?php endif; ?>
