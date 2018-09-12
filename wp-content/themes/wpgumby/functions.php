<?php

//Theme setup
function wpgumby_setup() {
	if (!isset($content_width)) { global $content_width; $content_width = 680; }
	load_theme_textdomain( 'wpgumby', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	
	register_nav_menu( 'primary', __( 'Primary Menu', 'wpgumby' ) );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 300, 300 );
	add_image_size( 'wpgumby-blog-thumb', 300, 300, true );
	add_image_size( 'wpgumby-portfolio-thumb', 460, 460, true );
	
}
add_action( 'after_setup_theme', 'wpgumby_setup' );

//Enqueue scripts and styles
function wpgumby_scripts_styles() {
	global $wp_styles, $wpgumby_data;
	wp_enqueue_script( 'wpgumby-modernizr', get_template_directory_uri() . '/js/modernizr-2.7.2.js', array(), '2.7.2', false );
	wp_enqueue_script( 'wpgumby-camera-fix', get_template_directory_uri() . '/js/camera-fix.js', array( 'jquery' ), '2.8.3', false );
	wp_enqueue_script( 'wpgumby-gumby', get_template_directory_uri() . '/js/gumby-2.6.0.js', array('jquery'), '2.6.0', true );
	wp_enqueue_script( 'wpgumby-gumbyui', get_template_directory_uri() . '/js/gumby.ui.plugins-2.6.0.js', array('jquery'), '2.6.0', true );
	wp_enqueue_script( 'wpgumby-plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.3.0', true );
	wp_enqueue_script( 'wpgumby-camera', get_template_directory_uri() . '/js/camera-1.3.4.js', array('jquery'), '1.3.4', false );
	wp_enqueue_script( 'wpgumby-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '0.0.1', true );
	wp_enqueue_style( 'wpgumby-fancyboxcss', get_template_directory_uri() . '/css/jquery.fancybox.css' );
	wp_enqueue_style( 'wpgumby-cameracss', get_template_directory_uri() . '/css/camera.css' );
	wp_enqueue_style( 'wpgumby-gumbycss', get_template_directory_uri() . '/css/gumby-2.6.0.css' );
	wp_enqueue_style( 'wpgumby-css', get_template_directory_uri() . '/style.css' );
	
	wp_localize_script('wpgumby-main', 'wpgumbyPathObject', array( 'templateurl' => get_template_directory_uri())); 
	
	if(isset($wpgumby_data['width_radio']) && $wpgumby_data['width_radio'] == 'full_width'){
		wp_enqueue_style( 'wpgumby-fullwidth', get_template_directory_uri() . '/css/wpgumby-fullwidth.css' );
	}
}

/**
 * A comment reply.
 */
function wpgumby_enqueue_comment_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'wpgumby_enqueue_comment_reply');

function wpgumby_wp_admin_style() {
	$currentScreen = get_current_screen();
	if ( $currentScreen->id === "appearance_page_sip-themes-extras"  ) 
	{
		wp_register_style( 'wpgumby_wp_admin_css', get_template_directory_uri() . '/css/wpgumby-wp-admin.css', false, '2.0.0' );
		wp_enqueue_style( 'wpgumby_wp_admin_css' );	 
	}

}
add_action( 'wp_enqueue_scripts', 'wpgumby_scripts_styles' );
add_action( 'admin_enqueue_scripts', 'wpgumby_wp_admin_style' );


//Widget setup
function wpgumby_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'wpgumby' ),
		'id' => 'sidebar-1',
		'description' => __( 'Description of Sidebar comes here.', 'wpgumby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer widget area (first column)', 'wpgumby' ),
		'id' => 'sidebar-3',
		'description' => __( 'Description of first column of footer comes here.', 'wpgumby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer widget area (second column)', 'wpgumby' ),
		'id' => 'sidebar-4',
		'description' => __( 'Description of second column of footer comes here.', 'wpgumby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer widget area (third column)', 'wpgumby' ),
		'id' => 'sidebar-5',
		'description' => __( 'Description of third column of footer comes here.', 'wpgumby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer widget area (fourth column)', 'wpgumby' ),
		'id' => 'sidebar-6',
		'description' => __( 'Description of fourth column of footer comes here.', 'wpgumby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'wpgumby_widgets_init' );

//Custom Excerpt Length
function wpgumby_excerpt_length( $length ) { return 40; }
add_filter( 'excerpt_length', 'wpgumby_excerpt_length', 999 );

//Custom Post Meta
if ( ! function_exists( 'wpgumby_post_meta' ) ) :
function wpgumby_post_meta() {
	$categories_list = get_the_category_list( __( ', ', 'wpgumby' ) );
    $categories_list = str_replace('rel="category tag"', '', $categories_list);
	$tag_list = get_the_tag_list( '', __( ', ', 'wpgumby' ) );
	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	$author = sprintf( '<span><a href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'wpgumby' ), get_the_author() ) ),
		get_the_author()
	);
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span> by %4$s</span>.', 'wpgumby' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span> by %4$s</span>.', 'wpgumby' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span> by %4$s</span>.', 'wpgumby' );
	}
	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

//Admin -> Page Options
add_action( 'add_meta_boxes', 'wpgumby_options_box' );
function wpgumby_options_box() {
	add_meta_box(
	             'wpgumby_options_box',
				 __( 'Page Options', 'wpgumby' ),
				 'wpgumby_options_box_content',
				 'page',
				 'side',
				 'high'
				 );
	add_meta_box(
	             'wpgumby_options_box',
				 __( 'Page Options', 'wpgumby' ),
				 'wpgumby_options_box_content',
				 'post',
				 'side',
				 'high'
				 );
}
function wpgumby_options_box_content( $post ) {
	global $post;
	wp_nonce_field( plugin_basename( __FILE__ ), 'wpgumby_options_box_content_nonce' );
	$slider = get_post_meta( $post->ID, 'wpgumby_slider', true);
	// The value to compare with (the value of the checkbox below).
	$current = "show"; 
	// True by default, just here to make things clear.
	$echo = true;
	echo '<label for="model data">'.__('Show slider', 'wpgumby').':</label>';
	
	echo '  <input name="slidersh" type="checkbox" value="show" '. checked( $slider, 'show', false).'>';
	
	$sidebars = array('no_sidebar' => __('No Sidebar', 'wpgumby'),
					  '2c-l' => __('Left', 'wpgumby'),
					  '2c-r' => __('Right', 'wpgumby')
					  );
	$sidebar = get_post_meta( $post->ID, 'wpgumby_p_sidebar', true);
	echo '<p><label for="model data">'.__('Sidebar options', 'wpgumby').':</label>';
	$soptions = '<option value="">'.__('Default', 'wpgumby').'</option>';
	foreach ($sidebars as $key => $value){
		$soptions .= '<option value="'.$key.'" '.selected( $sidebar, $key, false).'>'.$value.'</option>';
	}
	echo '<select name="wpgumby_p_sidebar">'.$soptions.'</select>';
}
add_action( 'save_post', 'wpgumby_options_box_save' );
function wpgumby_options_box_save( $post_id ) {
	if (isset($_POST['post_type'])) { $current_post_type = $_POST['post_type']; } else { $current_post_type = ""; }
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if (isset($_POST['wpgumby_options_box_content_nonce'])) {
		if ( !wp_verify_nonce( $_POST['wpgumby_options_box_content_nonce'], plugin_basename( __FILE__ ) ) ) return;
	}
	if ( $current_post_type == 'page') {
		if ( !current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) ) return;
	}
	if (isset($_POST['slidersh'])) { $slider_status = $_POST['slidersh']; } else { $slider_status = ""; }
	if (isset($_POST['wpgumby_p_sidebar'])) { $sidebar_status = $_POST['wpgumby_p_sidebar']; } else { $sidebar_status = ""; }
	update_post_meta( $post_id, 'wpgumby_slider', $slider_status );
	update_post_meta( $post_id, 'wpgumby_p_sidebar', $sidebar_status );
}

//Custom Comments list
function wpgumby_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'div-comment';
	} else {
		$tag = 'li';
		$add_below = 'li-comment';
	}
	echo "<" . $tag . " class=\"comment row\" id=\"".$add_below."-" . get_comment_ID() . "\" >"; ?>
	<div class="comment-author-photo three columns"> <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $size = '140' ); ?> </div>
	<div class="comment-author-comment nine columns">
    	<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation warning alert"><?php _e('Your comment is awaiting moderation.', 'wpgumby') ?></em><br />
		<?php endif; ?>
        <div class="comment-author">
		<?php echo get_comment_author_link(); ?> on <a href="<?php echo esc_url(htmlspecialchars( get_comment_link( $comment->comment_ID )) ); ?>"><?php printf( __('%1$s at %2$s', 'wpgumby'), get_comment_date(),  get_comment_time()); ?></a> &nbsp; <?php edit_comment_link(__('<span class="default badge">Edit</span>', 'wpgumby'),'  ','' );?> &nbsp; 
		<?php
			$custom_reply_text = '<span class="light badge">' . __('Reply', 'wpgumby') . '</span>';
			comment_reply_link(array_merge( $args, array(
						'add_below'		=> $add_below,
						'reply_text'	=> $custom_reply_text,
						'depth'			=> $depth,
						'max_depth'		=> $args['max_depth']
					)
				)
			)
		?>
		</div>
        <div class="comment-text">
		<?php comment_text() ?>
        </div>
    </div>
<?php echo "</" . $tag . ">";
}

//Custom Trackbacks/Pings list
function wpgumby_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'div-comment';
	} else {
		$tag = 'li';
		$add_below = 'li-comment';
	}
	echo "<" . $tag . " class=\"comment row\" id=\"".$add_below."-" . get_comment_ID() . "\" >"; ?>
	<div class="comment-author-comment twelve columns">
        <div class="ping-author">
		<?php echo get_comment_author_link(); ?> on <a href="<?php echo esc_url(htmlspecialchars( get_comment_link( $comment->comment_ID ) )); ?>"><?php printf( __('%1$s at %2$s', 'wpgumby'), get_comment_date(),  get_comment_time()); ?></a> &nbsp; <?php edit_comment_link(__('<span class="light badge">Edit</span>', 'wpgumby'),'  ','' );?> &nbsp; 
		</div>
        <div class="ping-text">
		<?php comment_text() ?>
        </div>
    </div>
<?php echo "</" . $tag . ">";
}

//Function to get tags related to category for Portfolio

function wpgumby_get_category_tags($args) {

	global $wpdb,$wpgumby_data,$pppp;
	if ($pppp == '') { $pppp = -1; }
	if (!is_numeric($pppp)) { $pppp = -1; }
	
	global $paged;
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$loop_args = array(
		'cat'	=> $args,
		'paged' => $paged,
		'posts_per_page' => $pppp,
	);

	$ptags=array();
	$portfolio_query = new WP_Query( $loop_args );
	if ( $portfolio_query->have_posts() ) {
			
		while( $portfolio_query->have_posts() ) {
		$portfolio_query->the_post();
		$tag_names = wp_get_post_tags( get_the_ID(), array( 'fields' => 'slugs' )  );
			foreach ($tag_names as $tagnames) { $ptags[] = $tagnames; } 
		}
		
		
	}	
	
	return $ptags;
}

//Include Redux
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/redux/framework.php' )) {
    require_once( dirname( __FILE__ ) . '/redux/framework.php' ); }
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/redux/config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/redux/config.php' ); }

//Utility functions
function wpgumby_add_filters($tags, $function) { foreach($tags as $tag) { add_filter($tag, $function); } }
function wpgumby_is_element_empty($element) { $element = trim($element); return empty($element) ? false : true; }

//Nav menu walker for wp_nav_menu()
class WPGumby_Nav_Walker extends Walker_Nav_Menu {
  function check_current($classes) { return preg_match('/(current[-_])|active|dropdown/', $classes); }
  function start_lvl(&$output, $depth = 0, $args = array()) { $output .= "\n<div class=\"dropdown\"><ul>\n"; }
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $item_html = '';
    parent::start_el($item_html, $item, $depth, $args);
    if ($item->is_dropdown && ($depth === 0)) {
      $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html);
      $item_html = str_replace('</a>', ' <b class="caret"></b></a>', $item_html);
    }
    elseif (stristr($item_html, 'li class="divider')) {
      $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
    }
    elseif (stristr($item_html, 'li class="dropdown-header')) {
      $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
    }
    $item_html = apply_filters('wpgumby_wp_nav_menu_item', $item_html);
    $output .= $item_html;
  }
  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));
    if ($element->is_dropdown) { $element->classes[] = 'dropdown'; }
    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}

//Return 'menu-slug' for nav menu classes.
function wpgumby_nav_menu_css_class($classes, $item) {
  $slug = sanitize_title($item->title);
  $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
  $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);
  $classes[] = 'menu-' . $slug;
  $classes = array_unique($classes);
  return array_filter($classes, 'wpgumby_is_element_empty');
}
add_filter('nav_menu_css_class', 'wpgumby_nav_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');

//Nav menu container.
function wpgumby_nav_menu_args($args = '') {
  $wpgumby_nav_menu_args['container'] = false;
  if (!$args['items_wrap']) {
    $wpgumby_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
  }
  if (current_theme_supports('bootstrap-top-navbar')) {
    $wpgumby_nav_menu_args['depth'] = 2;
  }
  if (!$args['walker']) {
    $wpgumby_nav_menu_args['walker'] = new WPGumby_Nav_Walker();
  }
  return array_merge($args, $wpgumby_nav_menu_args);
}
if (has_nav_menu('primary')) {
  add_filter('wp_nav_menu_args', 'wpgumby_nav_menu_args');
}

//BreadCrumbs
function wpgumby_breadcrumbs() {
	global $post;
	if(function_exists('is_woocommerce'))
	{
		if(is_woocommerce() || is_shop() || is_cart() || is_checkout())
		{
			echo '<div class="row">';
				woocommerce_breadcrumb();
			echo '</div>';
		} else{
			wpgumby_display_breadcrumbs();
		}
	}else {
		wpgumby_display_breadcrumbs();
	}
}

//BreadCrumbs
function wpgumby_display_breadcrumbs() {
	global $post;
	
	$text['home'] = __( 'Home Page', 'wpgumby' );
	$text['category'] = __('Category: %s', 'wpgumby');
	$text['search'] = __( 'Search: %s', 'wpgumby' );
	$text['tag'] =  __( 'Tag: %s', 'wpgumby' );
	$text['author'] =  __( 'Author: %s', 'wpgumby' );
	$text['404'] =  __( 'Error 404', 'wpgumby' );
	$show_current = 1;
	$show_on_home = 0;
	$show_home_link = 1;
	$show_title = 1;
	$delimiter = ' <i class="icon-right-open"></i> ';
	$before = '<span class="current">'; //Current
	$after = '</span>'; //Current
	$home_link = esc_url(home_url('/'));
	$link_before = '';
	$link_after = '';
	$link_attr = '';
	$link = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	if(is_search() || is_404()) { 
		$parent_id = $parent_id_2 = 0; 
	} else { 
		$parent_id = $parent_id_2 = $post->post_parent; 
	}
	$frontpage_id = get_option('page_on_front');
	if (is_home() || is_front_page()) {
		if ($show_on_home == 1) echo '<div class="breadcrumbs row"><a href="' . esc_url( $home_link) . '">' . $text['home'] . '</a></div>';
	} else {
		echo '<div class="breadcrumbs row">';
		if ($show_home_link == 1) {
			echo '<a href="' . esc_url( $home_link) . '" >' . $text['home'] . '</a>';
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
		}
		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;
		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
				if ($show_current == 1) echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			if ($cat) {
				$cats = get_category_parents($cat, TRUE, $delimiter);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1) echo $before . get_the_title() . $after;
		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
				echo $before . get_the_title() . $after;
			}
		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;
		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		} elseif ( has_post_format() && !is_singular() ) {
			echo get_post_format_string( get_post_format() );
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo 'Page ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
		echo '</div><!-- .breadcrumbs -->';
	}
	
}

//Display ShopitPressThemes
require_once locate_template('/upsale/shopitpress.php');

//WooCommerce
add_theme_support( 'woocommerce' );
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	//Remove WooCommerce default CSS
	function wpgumby_wc_dequeue_styles( $enqueue_styles ) {
		unset( $enqueue_styles['woocommerce-general'] );
		unset( $enqueue_styles['woocommerce-layout'] );
		unset( $enqueue_styles['woocommerce-smallscreen'] );
		return $enqueue_styles;
	}
	add_filter( 'woocommerce_enqueue_styles', 'wpgumby_wc_dequeue_styles' );
	
	//Add custom CSS
	function wpgumby_wc_css() {
		global $wp_styles;
		wp_enqueue_style( 'wpgumby-woocommerce-css', get_template_directory_uri() . '/css/woocommerce.css', array(), '2.1.2');
	}
	add_action( 'wp_enqueue_scripts', 'wpgumby_wc_css' );
	
	//disable WC prettyPhoto
	add_action( 'wp_enqueue_scripts', 'wpgumby_wc_remove_lightbox', 99 );
	function wpgumby_wc_remove_lightbox() {
		remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
	}
	
	//Change number or products per row to 3
	if (!function_exists('wpgumby_wc_loop_columns')) { function wpgumby_wc_loop_columns() { return 3; } }
	add_filter('loop_shop_columns', 'wpgumby_wc_loop_columns');
	
	//Custom Placeholder
	function wpgumby_wc_placeholder_thumbnail() {
	  add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');
		function custom_woocommerce_placeholder_img_src( $src ) {
		$upload_dir = wp_upload_dir();
		$uploads = untrailingslashit( $upload_dir['baseurl'] );
		$src = get_template_directory_uri() . '/images/default_image.png';
		return $src;
		}
	}
	add_action( 'init', 'wpgumby_wc_placeholder_thumbnail' );
	
	//Custom Gravatar
	function wpgumby_gravatar() {
		add_filter('woocommerce_review_gravatar_size', 'wpgumby_custom_woocommerce_gravatar_src');
		function wpgumby_custom_woocommerce_gravatar_src( $size ) { $size = 140; return $size; }
	}
	add_action( 'init', 'wpgumby_gravatar' );
		
	//Custom thumbnails for products loop
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
	if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
		function woocommerce_template_loop_product_thumbnail() { echo woocommerce_get_product_thumbnail(); } 
	}
	if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
		function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
			global $post, $woocommerce, $wpgumby_data;
	
			if ( ! $placeholder_width ) { $placeholder_width = wc_get_image_size( 'shop_catalog_image_width' ); }
			if ( ! $placeholder_height ) { $placeholder_height = wc_get_image_size( 'shop_catalog_image_height' ); }
			
			$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog-thumb');
			if ($thumb_image_url[0] == "") {
				$wc_post_image = woocommerce_placeholder_img_src();
				$wc_alt = __('Placeholder', 'wpgumby');
			} else {
				$wc_post_image = $thumb_image_url[0];
				$wc_alt = esc_attr( get_the_title( get_post_thumbnail_id($post->ID) ) );
			}
			$output  = '<div class="product-loop-image"><img class="img-responsive" src="';
			$output .= $wc_post_image;
			$output .= '" alt="' . $wc_alt . '"></div>';
	
		return $output;
		}
	}

} // end of WooCommerce exist


//By Usman
function wpgumby_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'wpgumby_slug_setup' );
//By Usman

function wpgumby_blog_post() {
if ( is_front_page() && is_home() ){
	return false;
} elseif ( is_front_page()){
	return false;
	//Static homepage
} elseif ( is_home()){
	$pagename = get_query_var('pagename');  
	if($pagename!='')
		return true;
	else
		return false;	
	//Blog page
} else {
	return false;
	//everything else
}
}

function wpgumby_blog_conditions_upper() {
global $wpgumby_data;

if(count($wpgumby_data)==0)
{
	return false;
}

if(isset($wpgumby_data['cta_text']) && $wpgumby_data['cta_text']!="")
{
	return true;
}
if(isset($wpgumby_data['cta_button']) && $wpgumby_data['cta_button']!="")
{
	return true;
}
return false;
}


function wpgumby_blog_conditions_lower() {
global $wpgumby_data;

if(count($wpgumby_data)==0)
{
	return false;
}

if(isset($wpgumby_data['frontpage_lb_img']['url']) && $wpgumby_data['frontpage_lb_img']['url']!='')
{
	return true;
}

if(isset($wpgumby_data['frontpage_lb_title']) && $wpgumby_data['frontpage_lb_title']!='')
{
	return true;
}
if(isset($wpgumby_data['frontpage_lb_text']) && $wpgumby_data['frontpage_lb_text']!='')
{
	return true;
}

if(isset($wpgumby_data['frontpage_cb_img']['url']) && $wpgumby_data['frontpage_cb_img']['url']!='')
{
	return true;
}

if(isset($wpgumby_data['frontpage_cb_title']) && $wpgumby_data['frontpage_cb_title']!='')
{
	return true;
}
if(isset($wpgumby_data['frontpage_cb_text']) && $wpgumby_data['frontpage_cb_text']!='')
{
	return true;
}

if(isset($wpgumby_data['frontpage_rb_img']['url']) && $wpgumby_data['frontpage_rb_img']['url']!='')
{
	return true;
}

if(isset($wpgumby_data['frontpage_rb_title']) && $wpgumby_data['frontpage_rb_title']!='')
{
	return true;
}
if(isset($wpgumby_data['frontpage_rb_text']) && $wpgumby_data['frontpage_rb_text']!='')
{
	return true;
}
return false;	
	
}

function wpgumby_remove_blank($slide_array)
{
	if(($slide_array['image'])!='')
	 return true;
	 
}