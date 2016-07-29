<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package zo
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php // You can start editing here -- including this comment! ?>
	<?php if ( have_comments() ) : ?>
        <div class="st-comments-wrap clearfix">
            <h4 class="comments-title">
                <span><?php comments_number(esc_html__('Comments','lucian'),esc_html__('1 Comments','lucian'),esc_html__('Comments (%)','lucian')); ?></span>
            </h4>
            <ol class="comment-list">
				<?php wp_list_comments( 'type=comment&callback=zo_comment' ); ?>
			</ol>
			<?php
				$post_trackbacks = get_comments(array('type' => 'trackback','post_id' => $post->ID));
				$post_pingbacks = get_comments(array('type' => 'pingback','post_id' => $post->ID));
			?>
			<?php if($post_trackbacks || $post_pingbacks) : ?>
			<h4 class="comments-title"><?php esc_html_e('Pingbacks And Trackbacks', 'lucian');?></h4>
			<ol>
			  <?php foreach ($comments as $comment) : ?>
			  <?php $comment_type = get_comment_type(); ?>
			  <?php if($comment_type != 'comment') { ?>
			  <li><?php comment_author_link() ?></li>
			  <?php } ?>
			  <?php endforeach; ?>
			</ol>
			<?php endif; ?>
			<?php zo_comment_nav(); ?>
        </div>
	<?php endif; // have_comments() ?>

	<?php
	$commenter = wp_get_current_commenter();
	$allowed_html = array(
		"span" => array(),
	);
	$req = get_option( 'require_name__mail' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$args = array(
        'id_form'           => 'commentform',
        'id_submit'         => 'submit',
        'title_reply'       => wp_kses(__( '<span>Reply Comment</span>','lucian'), $allowed_html),
        'title_reply_to'    => esc_html__( 'Post to Reply %s','lucian'),
        'cancel_reply_link' => esc_html__( 'Cancel Reply','lucian'),
        'label_submit'      => esc_html__( 'Post Comment','lucian'),
        'class_submit'  => 'btn btn-primary',
        'comment_notes_before' => '',
        'fields' => apply_filters( 'comment_form_default_fields', array(

                'author' =>
                    '<p class="comment-form-author">'.
                    '<label for="author">'.esc_html__('Your Name','lucian').' <span class="primary-color">*</span></label>'.
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                    '" size="30"' . esc_attr($aria_req) . ' placeholder="'.esc_html__('Name','lucian').'"/></p>',

                'email' =>
                    '<p class="comment-form-email">'.
                    '<label for="email">'.esc_html__('Your Email','lucian').' <span class="primary-color">*</span></label>'.
                    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                    '" size="30"' . esc_attr($aria_req) . ' placeholder="'.esc_html__('Email','lucian').'"/></p>',

                'url' =>
                    '<p class="comment-form-url">'.
                    '<label for="url">' . esc_html__( 'Website', 'lucian' ) . '</label>' .
                    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
                    '" size="30" /></p>',
            )
        ),
        'comment_field' =>  '<label for="url">' . esc_html__( 'Your Comment', 'lucian' ) . '</label><p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.esc_html__('Comment','lucian').'" aria-required="true"></textarea></p>',
	);
	comment_form($args);
	?>

</div><!-- #comments -->
