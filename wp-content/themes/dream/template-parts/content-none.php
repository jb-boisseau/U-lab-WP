<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package dream
 */
?>

<section class="no-results not-found">
  <header class="page-header">
    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'dream' ); ?></h1>
  </header><!-- .page-header -->

  <div class="post-content">
  <div class="page-content clearfix">
    <?php
    if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

      <p><?php
        printf(
          wp_kses(
            /* translators: 1: link to WP admin new post page. */
            __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'dream' ),
            array(
              'a' => array(
                'href' => array(),
              ),
            )
          ),
          esc_url( admin_url( 'post-new.php' ) )
        );
      ?></p>

    <?php elseif ( is_search() ) : ?>

      <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'dream' ); ?></p>
      <?php
        get_search_form();

    else : ?>

      <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'dream' ); ?></p>
      <?php
        get_search_form();

    endif; ?>
  </div><!-- .page-content -->
    </div>
</section><!-- .no-results -->
