<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

  <header id="masthead" class="site-header">
    <div class="container">
      <div class="site-branding clearfix">
        <div class="site-branding-logo">
          <?php the_custom_logo();?>

          <?php if ( !get_theme_mod( 'header_title' )):?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          
            <?php
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : 
            ?>
              <p class="site-description"><?php echo $description;?></p>
            <?php endif;?>
          <?php endif;?>
        </div>

        <div class="site-social clearfix">
          <?php
          $social_url = array();
          $social_list = array('twitter', 'facebook', 'google-plus', 'pinterest', 'vk', 'flickr', 'instagram', '500px', 'youtube', 'vimeo', 'soundcloud', 'dribbble', 'behance', 'github', 'rss');
          foreach ($social_list as $social_list_value) {
            $social_url[$social_list_value] = get_theme_mod('social_'.$social_list_value);
          }
          foreach ($social_url as $social_url_key => $social_url_value) {
            if ($social_url_value) {
              echo '<a href="'.esc_url($social_url_value).'" target="_blank"><i class="fa fa-'.esc_attr($social_url_key).'"></i></a>';
            }
          }
          ?>
        </div>

        <button class="menu-toggle navbar-toggle" data-toggle="collapse" data-target="#main-navigation-collapse"><i class="fa fa-bars"></i></button>
      </div><!-- .site-branding -->

      <div id="site-navigation" class="main-navigation clearfix <?php if((is_home())or(is_single())or(is_search())or(is_archive())){echo 'mr';}?>">
        <?php
          if (has_nav_menu('menu-1')) {
            wp_nav_menu( array(
              'theme_location' => 'menu-1',
              'container' => 'nav',
              'menu_class' => 'menu hidden-sm hidden-xs clearfix',
            ) );
          }
        ?>
      </div>

      <div class="nav-content hidden-md hidden-lg">
        <div id="main-navigation-collapse" class="collapse navbar-collapse">
          <?php
            if (has_nav_menu('menu-1')) {
              wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'container' => 'nav',
                'menu_class' => 'nav navbar-nav responsive-nav hidden-md hidden-lg',
              ) );
            }
          ?>
        </div>
      </div>

    </div>
  </header><!-- #masthead -->

<?php
if(get_theme_mod('activate_slider',0)){
  if(is_front_page()){
?>
    <div class="site-slider">
      <div class="container">
        <?php dream_slider();?>
      </div>
    </div>
<?php
  }
}
?>
