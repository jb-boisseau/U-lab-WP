<?php
/**
 * The template for displaying comments
 *
 * @package dream
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

  <?php
  // You can start editing here -- including this comment!
  if ( have_comments() ) : 
  ?>
    <div id="comments" class="comments-area">
    <h2 class="comments-title">
      <?php comments_number( __('No Comment', 'dream' ), __('One Comments', 'dream' ), __('% Comments','dream' ) );?>
    </h2><!-- .comments-title -->

    <ol class="comment-list">
      <?php
        wp_list_comments( array(
          'callback'      => 'dream_list_comments'
        ) );
      ?>
    </ol><!-- .comment-list -->

    <?php dream_comments_navigation();

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() ) : ?>
      <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'dream' ); ?></p>
    <?php
    endif;
  ?>
    </div>
  <?php
  endif; // Check for have_comments().
  ?>

<?php
comment_form();
