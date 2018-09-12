<?php
/**
 * Custom template comment for this theme
 *
 * @package dream
 */

function dream_list_comments($comment,$args,$depth){
	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) {
?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<article class="comment-body">
			<?php echo __( 'Pingback:', 'dream' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'dream' ), '<span class="edit-link">', '</span>' ); ?>
		</article>
<?php
	}else{
?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body clearfix">
            <div class="comment-author"><?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, 40); ?></div>
        
        	<div class="comment-info">
                <div class="comment-meta">
                    <span class="fn"><?php echo get_comment_author_link();?></span>
                    
                    <span class="comment-metadata"><time datetime="<?php comment_time( 'c' ); ?>"><?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'dream' ), get_comment_date(), get_comment_time() ); ?></time></span>
                    <?php edit_comment_link( __( 'Edit', 'dream' ), '<span class="comment-edit">', '</span>' ); ?>
    
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                    <span class="comment-awaiting-moderation"><?php echo __( 'Your comment is awaiting moderation.', 'dream' ); ?></span>
                    <?php endif; ?>
                    
                    <span class="reply"><?php comment_reply_link( array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
                </div>
                <div class="comment-content clearfix">
					<?php comment_text();?>
                </div>
            </div>
		</article>
<?php
	}
}

function dream_comment_form_default_fields( $fields ) {
  $commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );
  $fields['author'] = '<div class="form_item"><input id="author" type="text" aria-required="true" size="22" value="'.esc_attr($commenter['comment_author']).'" name="author" '.$aria_req.' placeholder="'.esc_attr__('Your Name','dream').' '.($req?'*':'').'" /></div>';
  $fields['email'] = '<div class="form_item"><input id="email" type="text" aria-required="true" size="22" value="'.esc_attr($commenter['comment_author_email']).'" name="email" '.$aria_req.' placeholder="'.esc_attr__('Your Email','dream').' '.($req?'*':'').'" /></div>';
  $fields['url'] = '<div class="form_item"><input id="url" type="text" aria-required="true" size="22" value="'.esc_url($commenter['comment_author_url']).'" name="url" placeholder="'.esc_attr__('Your Website','dream').'" /></div>';
  return $fields;
}
add_filter( 'comment_form_default_fields', 'dream_comment_form_default_fields' );

function dream_comment_form_field_comment( $comment_field ) {
  $req = get_option( 'require_name_email' );
  $comment_field = '<div class="form_item"><textarea id="comment" name="comment" placeholder="'.esc_attr__('Your comment','dream').' '.($req?'*':'').'" /></textarea></div>';
  return $comment_field;
}
add_filter( 'comment_form_field_comment', 'dream_comment_form_field_comment' );

function dream_comment_form_defaults($defaults){
  $defaults['comment_notes_before'] = '';
  $defaults['comment_notes_after'] = '';
  return $defaults;
}
add_filter( 'comment_form_defaults', 'dream_comment_form_defaults' );
