<?php get_template_part( 'page-templates/camera-slider', 'wpgumby_slider' ); ?>
<?php wpgumby_breadcrumbs(); ?>
<div class="row content-post">
<?php

	global $wpgumby_data, $post;
	if (get_post_meta($post->ID, 'wpgumby_p_sidebar', true) != '') {
		$custom_layout = get_post_meta($post->ID, 'wpgumby_p_sidebar', true);
		
	} else {
		if(isset($wpgumby_data['layout'])){
			$custom_layout = esc_html($wpgumby_data['layout']);
		}else{
			$custom_layout="";
		}
	}
	
	switch($custom_layout){
		case '2c-l':
			get_sidebar();
			echo '<div class="nine columns pl20">';
			break;
		case '2c-r':
			echo '<div class="nine columns pr20">';
			break;
		default:
			echo '<div class="twelve columns">';
	}

	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
		
			get_template_part( 'page-templates/post', 'single' );
			get_template_part( 'page-templates/post', 'navigation' );
			comments_template('', true);
		
		endwhile;
	endif;

	switch($custom_layout){
		case '2c-l':
			echo '</div>';
			break;
		case '2c-r':
			echo '</div>';
			get_sidebar();
			break;
		default:
			echo '</div>';
	}
?>
</div>