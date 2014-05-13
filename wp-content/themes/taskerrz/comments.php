<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to Taskerrz_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Taskerrz
 * @since Taskerrz 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>
<div id="comments" class="comments-area">
	<h3>Leave your comment</h3>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'twentytwelve' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'taskerrz_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'twentytwelve' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentytwelve' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentytwelve' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'twentytwelve' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php 
		$comments_args = array(
	        // change the title of send button 
	        'label_submit'=>'Post comment',
	        // change the title of the reply section
	        'title_reply'=>'',
	        // remove "Text or HTML to be displayed after the set of comment fields"
	        'comment_notes_after' => '',
	        // redefine your own textarea (the comment body)
	        'comment_field' => '
	        <div align="left">
	            <input type="text" class="txt" placeholder="Name" value="Name*"> 
	            <input type="text" class="txt" placeholder="Email" value="Email*">
	        </div>
	        <div align="left">
	           	<input type="text" class="txt" placeholder="Website" value="Website*"> 
	           	6 x&nbsp;<input type="text" class="txt1">&nbsp; = &nbsp; 18
			</div>
	        <div align="left">
	          	<textarea rows = "8" cols = "18" name ="details" placeholder="Add text"></textarea>
	        </div>',

	        
	       /* <div class="btn-post" align="center">
	           	<input type="submit" value="Post comment">
	        </div>*/
		);

		comment_form($comments_args); ?>

</div><!-- #comments .comments-area -->