<?php
/**
 * Template part for displaying posts
 *
 * @package dream
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if (has_post_thumbnail()) {?> 
  <div class="post-media">
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_post_thumbnail();?></a>
  </div>
  <?php }?>

  <div class="post-content clearfix">
    <?php dream_entry_header(); ?>

  <div class="entry-content clearfix">
    <?php
      $content = apply_filters( 'the_content', get_the_content() );
      $audio = false;

      if ( false === strpos( $content, 'wp-playlist-script' ) ) {
        $audio = get_media_embedded_in_content( $content, array( 'audio' ) );
      }

      if ( ! empty( $audio ) ) {
        foreach ( $audio as $audio_html ) {
          echo '<div class="entry-audio">';
            echo $audio_html;
          echo '</div><!-- .entry-audio -->';
        }
      };

      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dream' ),
        'after'  => '</div>',
      ) );
    ?>
  </div><!-- .entry-content -->

  <?php dream_entry_footer(); ?>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->
