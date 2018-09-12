<?php
/**
 * Template part for displaying posts
 *
 * @package dream
 */
?>
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
            if ( have_posts() ) :

              // archive page header
              dream_page_header();

              /* Start the Loop */
              while ( have_posts() ) : the_post();

                $format = get_post_format();
                if (false === $format) {
                  get_template_part('template-parts/content', 'standard');
                } else {
                  get_template_part('template-parts/content', $format);
                }

              endwhile;

              if (get_theme_mod('blog_pagination') == 'navigation') {
                dream_posts_navigation();
              } else {
                dream_posts_pagination();
              }

            else :

              get_template_part( 'template-parts/content', 'none' );

            endif; ?>

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
