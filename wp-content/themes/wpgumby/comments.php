<?php
	if ( post_password_required() ) { return; }
	global $post;
	if ( have_comments() ) {
	if ( ! empty($comments_by_type['comment']) ) {
?>
<div id="comments" class="comments-area">
	<h2 class="comments-title"><?php printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'Comments Title', 'wpgumby' ), number_format_i18n( get_comments_number() )); ?></h2>
	
    <ul class="commentlist">
		<?php wp_list_comments( array( 'type' => 'comment', 'callback' => 'wpgumby_comment' ) ); ?>
	</ul><!-- .commentlist -->
    
	<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
    <div class="comments-meta-nav">
		<?php if (get_previous_comments_link()) : ?>
			<div class="medium btn pill-left default"><?php previous_comments_link(__('<i class="icon-left-open"></i> Older comments', 'wpgumby')); ?></div>
		<?php endif; ?>
		<?php if (get_next_comments_link()) : ?>
			<div class="medium btn pill-right default"><?php next_comments_link(__('Newer comments <i class="icon-right-open"></i>', 'wpgumby')); ?></div>
		<?php endif; ?>
    </div>
    <?php endif; ?>
    
	<?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="danger alert tcenter">
		<?php _e('Comments are closed', 'wpgumby'); ?>
    </div>
    <?php endif; ?>
    
</div><!-- #comments -->
<?php

	} // $comments_by_type['comment']
	if ( ! empty($comments_by_type['pings']) ) {
?>
<div id="pings" class="comments-area pings-area">
	<h2 class="comments-title"><?php echo __('Trackbacks & Pingbacks', 'wpgumby'); ?></h2>
    <ul class="commentlist">
		<?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'wpgumby_pings' ) ); ?>
	</ul><!-- .commentlist -->
	<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
    <div class="comments-meta-nav">
		<?php if (get_previous_comments_link()) : ?>
			<div class="medium btn pill-left default"><?php previous_comments_link(__('<i class="icon-left-open"></i> Older pings', 'wpgumby')); ?></div>
		<?php endif; ?>
		<?php if (get_next_comments_link()) : ?>
			<div class="medium btn pill-right default"><?php next_comments_link(__('Newer pings <i class="icon-right-open"></i>', 'wpgumby')); ?></div>
		<?php endif; ?>
    </div>
    <?php endif; ?>
    
</div><!-- #comments -->
<?php
	}
	} // have_comments()
?>
<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="danger alert tcenter">
		<?php _e('Comments are closed', 'wpgumby'); ?>
    </div>
<?php endif; ?>
<?php if (comments_open()) : ?>
<div id="respond">
	<h2><?php comment_form_title(__('Leave a Reply', 'wpgumby'), __('Leave a Reply to %s', 'wpgumby')); ?></h2>
        
        <?php echo get_cancel_comment_reply_link(); ?>
    
	<?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
		<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'wpgumby'), wp_login_url(get_permalink())); ?></p>
    <?php else : ?>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if (is_user_logged_in()) : ?>
			<p>
			<?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'wpgumby'), get_option('siteurl'), $user_identity); ?>
			&nbsp; <span class="danger badge"><a href="<?php echo esc_url(wp_logout_url(get_permalink())); ?>" title="<?php __('Log out of this account', 'wpgumby'); ?>" ><?php _e('Log out &raquo;', 'wpgumby'); ?></a></span>
			</p>
            <div class="row">
		<?php else : ?>
        	<p class="twelve columns"><?php _e('Your email address will not be published. Required fields are marked *', 'wpgumby'); ?></p>
            <div class="row">
            <ul class="six columns">
				<li class="field">
                	<input type="text" class="text input" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" <?php if ($req) echo 'aria-required="true"'; ?> placeholder="<?php _e('Name', 'wpgumby'); if ($req) _e(' *', 'wpgumby'); ?>">
                </li>
				<li class="field">
                	<input type="email" class="email input" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" <?php if ($req) echo 'aria-required="true"'; ?> placeholder="<?php _e('Email', 'wpgumby'); if ($req) _e(' *', 'wpgumby'); ?>">
                </li>
                <li class="field">
                	<input type="text" class="text input" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="<?php _e('Website', 'wpgumby'); ?>">
                </li>
			</ul>
        <?php endif; //is_user_logged_in() ?>
        	<ul class="<?php if (is_user_logged_in()) { echo "twelve"; } else { echo "six"; }  ?> columns">
				<li class="field">
                <textarea name="comment" id="comment" class="input textarea" rows="5" aria-required="true" placeholder="<?php _e('Comment', 'wpgumby'); ?>"></textarea>
                </li>
                <li>
                	<div class="medium default btn"><input name="submit" type="submit" id="submit" value="<?php _e('Submit Comment', 'wpgumby'); ?>"></div>
                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                </li>
			</ul> 
            </div><!-- /.row -->  
      </form>
    <?php endif; ?>
</div><!-- /#respond -->
 <?php comment_form(); ?>
<?php endif; ?>