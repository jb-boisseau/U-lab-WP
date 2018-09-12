<?php
/**
 * Custom template tags for this theme
 *
 * @package dream
 */

if (!function_exists('dream_entry_header')) {
  function dream_entry_header() {
    $show_date = get_theme_mod('blog_show_date', 1);
    $show_comments_counter = get_theme_mod('blog_show_comments_counter', 1);

    echo '<header class="entry-header clearfix">';

    if ( is_singular() ) {
      the_title( '<h1 class="entry-title">', '</h1>' );
    } else {
      the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    }

    if ($show_date || $show_comments_counter) {
      if ( 'post' === get_post_type() ) {
        echo '<div class="entry-meta clearfix">';

        if ($show_date) {
          $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
          if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
          }
          $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
          );
          echo '<span class="posted-on"><i class="fa fa-calendar"></i> ' . $time_string . '</span>'; // WPCS: XSS OK.
        }

        if ($show_comments_counter) {
          if (! post_password_required() ) {
            if (comments_open()) {
              echo '<span class="comments-link"><i class="fa fa-comments"></i> <a href="'.get_the_permalink().'#comments">';
              comments_number(esc_html__('No Comments', 'dream'), esc_html__('1 Comment', 'dream'), esc_html__('% Comments', 'dream'));
              echo '</a></span>';
            } else if (get_comments_number()) { 
              echo '<span class="comments-link"><i class="fa fa-comments"></i> <a href="'.get_the_permalink().'#comments">';
              comments_number('', esc_html__('1 Comment', 'dream'), esc_html__('% Comments', 'dream'));
              echo '</a></span>'; 
            }
          }
        }

        echo '</div><!-- .entry-meta -->';
      }
    }

    echo '</header><!-- .entry-header -->';

  }
}

if (!function_exists('dream_entry_footer')) {
  function dream_entry_footer() {
    $show_sticky = is_sticky();
    $show_author = get_theme_mod('blog_show_author', 1);
    $show_categories = get_theme_mod('blog_show_categories', 1);
    $show_tags = get_theme_mod('blog_show_tags', 1);

    if ($show_sticky || $show_author || $show_categories || $show_tags) {
      if ( 'post' === get_post_type() ) {
        echo '<footer class="entry-footer clearfix">';
        
        if ($show_sticky) {
          printf( '<span class="sticky-post"><i class="fa fa-star"></i> %s</span>', __( 'Featured', 'dream' ) );
        }
        
        if ($show_author) {
          $byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
          echo '<span class="byline"><i class="fa fa-user"></i> ' . $byline . '</span>';
        }
        
        if ($show_categories) {
          $categories_list = get_the_category_list( esc_html__( ', ', 'dream' ) );
          if ( $categories_list ) {
            printf( '<span class="cat-links"><i class="fa fa-folder"></i> ' . '%1$s' . '</span>', $categories_list );
          }
        }

        if ($show_tags) {
          $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'dream' ) );
          if ( $tags_list ) {
            printf( '<span class="tags-links"><i class="fa fa-tags"></i> ' . '%1$s' . '</span>', $tags_list );
          }
        }

        echo '</footer><!-- .entry-footer -->';
      }
    }
  }
}

if (!function_exists('dream_posts_navigation')) {
  function dream_posts_navigation() {
    the_posts_navigation(array(
      'prev_text' => '<i class="fa fa-caret-left"></i> '.__('Older posts','dream'),
      'next_text'  => __('Newer posts','dream').' <i class="fa fa-caret-right"></i>'       
    ));
  }
}

if (!function_exists('dream_post_navigation')) {
  function dream_post_navigation(){
    the_post_navigation( array(
          'prev_text' => '<i class="fa fa-caret-left"></i> %title',
          'next_text' => '%title <i class="fa fa-caret-right"></i>'
    ) );
  }
}

if (!function_exists('dream_comments_navigation')) {
  function dream_comments_navigation(){
    the_comments_navigation(array(
      'prev_text' => '<i class="fa fa-caret-left"></i> '.__( 'Older comments' ,'dream'),
      'next_text' => __( 'Newer comments' ,'dream').' <i class="fa fa-caret-right"></i>'
    ));
  }
}

if (!function_exists('dream_posts_pagination')) {
  function dream_posts_pagination(){
    the_posts_pagination(array(
      'prev_text' => '<i class="fa fa-caret-left"></i>',
      'next_text' => '<i class="fa fa-caret-right"></i>'
    ));
  }
}

if (!function_exists('dream_about_the_author')) {
  function dream_about_the_author() {
    $author_ID = get_the_author_meta('ID');
    $author_email = get_the_author_meta('user_email');
    $author_display_name = get_the_author_meta('display_name');
    $author_posts_url = get_author_posts_url($author_ID);
    ?>
    <div class="about-author clearfix">
      <div class="about-author-avatar">
        <a href="<?php echo esc_url($author_posts_url); ?>">
          <?php echo get_avatar($author_email, '60', '', esc_attr($author_display_name)); ?>
        </a>
      </div>
      <div class="about-author-bio-wrap">
        <div class="about-author-name">
          <?php the_author_posts_link(); ?>
          <span>(<?php the_author_posts(); esc_html_e(' Posts', 'dream'); ?>)</span>
        </div>
        <div class="about-author-bio">
          <?php the_author_meta('description'); ?>
        </div>
        <a href="<?php echo esc_url($author_posts_url); ?>" class="about-author-link">
          <?php esc_html_e('View all author&rsquo;s posts', 'dream'); ?><i class="fa fa-caret-right"></i>
        </a>
      </div>
    </div>
    <?php
  }
}
