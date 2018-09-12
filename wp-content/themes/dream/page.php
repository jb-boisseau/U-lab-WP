<?php
/**
 * The template for displaying all pages
 *
 * @package dream
 */

get_header(); ?>

<div id="content" class="site-content">
  <div class="container">
    <div class="site-content-area">

<?php
$blog_layout = get_theme_mod('blog_layout', 'right_sidebar');

if ($blog_layout == 'right_sidebar') {
?>
      <div class="row">
        <div class="col-md-8 sidebar-right">
<?php
}
if ($blog_layout == 'left_sidebar') {
?>
      <div class="row">
        <div class="col-md-8 col-md-push-4 sidebar-left">
<?php
}
?>

          <div id="primary" class="content-area">
            <main id="main" class="site-main">

              <?php
              while ( have_posts() ) : the_post();

              ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php if (get_theme_mod('page_comments')){echo "style='border-bottom:none;'";}?>>
              <?php if (has_post_thumbnail()) {?> 
                <div class="post-media">
                  <?php the_post_thumbnail();?>
                </div>
              <?php }?>

                <div class="post-content">
                <header class="entry-header">
                  <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                    <?php
                    $show_comments_counter = get_theme_mod('blog_show_comments_counter', 1);
                    if ($show_comments_counter) {
                    ?>
                    <div class="entry-meta clearfix">
                    <?php
                    if (! post_password_required() ) {
                      if (comments_open()) {
                        echo '<span class="comments-link" style="float:none;"><i class="fa fa-comments"></i> <a href="'.get_the_permalink().'#comments">';
                        comments_number(esc_html__('No Comments', 'dream'), esc_html__('1 Comment', 'dream'), esc_html__('% Comments', 'dream'));
                        echo '</a></span>';
                      } else if (get_comments_number()) { 
                        echo '<span class="comments-link" style="float:none;"><i class="fa fa-comments"></i> <a href="'.get_the_permalink().'#comments">';
                        comments_number('', esc_html__('1 Comment', 'dream'), esc_html__('% Comments', 'dream'));
                        echo '</a></span>'; 
                      }
                    }
                    ?>
                    </div>
                    <?php
                    }
                    ?>
                  
                </header><!-- .entry-header -->

                <div class="entry-content clearfix">
                  <?php
                    the_content();

                    wp_link_pages( array(
                      'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dream' ),
                      'after'  => '</div>',
                    ) );
                  ?>
                </div><!-- .entry-content -->

                  </div>
              </article><!-- #post-<?php the_ID(); ?> -->

              <?php

                if (!get_theme_mod('page_comments')) :
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                  comments_template();
                endif;
                endif;

              endwhile; // End of the loop.
              ?>

            </main><!-- #main -->
          </div><!-- #primary -->

<?php
if ($blog_layout == 'right_sidebar') {
?>
        </div>
        <div class="col-md-4 sidebar-right">
          <?php get_sidebar();?>
        </div>
      </div>
<?php
}
if ($blog_layout == 'left_sidebar') {
?>
        </div>
        <div class="col-md-4 col-md-pull-8 sidebar-left">
          <?php get_sidebar();?>
        </div>
      </div>
<?php
}
?>

    </div>
  </div>
</div><!-- #content -->

<?php
get_footer();
