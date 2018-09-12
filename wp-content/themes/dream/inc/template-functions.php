<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package dream
 */

if (!function_exists('dream_entry_content')) {
  function dream_entry_content() {
    $excerpt_type = get_theme_mod('blog_excerpt_type', 'excerpt');
    if ($excerpt_type == 'excerpt') {
      ?>

      <!-- excerpt -->
      <div class="entry-content clearfix">
        <?php the_excerpt(); ?>
      </div>
      <!-- end excerpt -->

      <?php
    } else {
      ?>

      <!-- excerpt (post content) -->
      <div class="entry-content clearfix">
        <?php
        the_content( sprintf(
          wp_kses(
            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dream' ),
            array(
              'span' => array(
                'class' => array(),
              ),
            )
          ),
          get_the_title()
        ) );
        ?>
      </div>
      <!-- end excerpt (post content) -->

      <?php
    }
  }
}

if (!function_exists('dream_slider')) {
  function dream_slider() {
?>
  <div class="slider-wrap">
    <div class="slider-cycle">
      <?php
      for( $i = 1; $i <= 4; $i++ ) {
        $dream_slider_title = get_theme_mod( 'slider_title'.$i , '' );
        $dream_slider_text  = get_theme_mod( 'slider_text'.$i  , '' );
        $dream_slider_image = get_theme_mod( 'slider_image'.$i , '' );
        $dream_slider_link  = get_theme_mod( 'slider_link'.$i  , '' );
        if( !empty( $dream_slider_image ) ) {
          ?>
          <section id="featured-slider">
            <div class="slider-image-wrap">
              <img alt="<?php echo esc_attr( $dream_slider_title ); ?>" src="<?php echo esc_url( $dream_slider_image ); ?>">
              </div>
              <?php if( !empty( $dream_slider_title ) || !empty( $dream_slider_text ) ) { ?>
                <article id="slider-text-box">
                  <div class="inner-wrap">
                    <div class="slider-text-wrap">
<?php if( !empty( $dream_slider_title )  ) { ?>
<span id="slider-title" class="clearfix">
<a title="<?php echo esc_attr( $dream_slider_title ); ?>" <?php if(!empty($dream_slider_link)){ ?> href="<?php echo esc_url( $dream_slider_link ); ?>"<?php }?>><?php echo esc_html( $dream_slider_title ); ?></a>
</span>
<?php } ?>
<?php if( !empty( $dream_slider_text )  ) { ?>
<span id="slider-content"><?php echo esc_html( $dream_slider_text ); ?></span>
<?php } ?>
                    </div>
                  </div>
              </article>
            <?php } ?>
          </section>
        <?php
        }
      }
      ?>
    </div>
    <nav id="controllers" class="clearfix">
    </nav>
  </div>
<?php
  }
}

if (!function_exists('dream_page_header')) {
  function dream_page_header(){
    // author page
    if (is_author()) {
?>
      <header class="page-header">
        <h1 class="page-title"><?php the_archive_title();?></h1>
        <?php if (get_the_author_meta('description')) { ?>
        <div class="archive-description"><?php the_author_meta('description'); ?></div>
        <?php }?>
      </header><!-- .page-header -->
<?php
    // category/tag page
    } else if (is_category() || is_tag()) {
?>
      <header class="page-header">
        <h1 class="page-title"><?php the_archive_title();?></h1>
        <?php if (get_the_archive_description()) { ?>
        <div class="archive-description"><?php the_archive_description();?></div>
        <?php }?>
      </header><!-- .page-header -->
<?php
    // search results page
    } else if (is_search()) { 
?>
      <header class="page-header">
        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'dream' ), '<span>' . get_search_query() . '</span>' );?></h1>
      </header><!-- .page-header -->
<?php
    // archive page
    } else if (is_archive()) {
?>
      <header class="page-header">
        <h1 class="page-title"><?php the_archive_title();?></h1>
      </header><!-- .page-header -->
<?php
    }
  }
}

if (!function_exists('dream_excerpt_length')) {
  function dream_excerpt_length($length) {
    $excerpt_length = get_theme_mod('blog_excerpt_length', 40);
    if ($excerpt_length) {
      $excerpt_length = intval($excerpt_length);
    } else {
      $excerpt_length = 40;
    }
    return $excerpt_length;
  }
}
add_filter('excerpt_length', 'dream_excerpt_length');

if (!function_exists('dream_editor_style')) {
  function dream_editor_style() {

    // add stylesheets
    add_editor_style(array(
      'assets/css/editor-style.css',
      'assets/font-awesome/css/font-awesome.min.css'
    ));

  }
}
add_action('init', 'dream_editor_style');
