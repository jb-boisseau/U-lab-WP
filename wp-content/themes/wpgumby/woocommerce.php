<?php get_header(); ?>
<?php get_template_part( 'page-templates/camera-slider', 'wpgumby_slider' ); ?>
<div class="row content-page woocommerce">
<?php wpgumby_breadcrumbs(); ?>

<?php
	
	global $wpgumby_data, $post;
	$id = wc_get_page_id('shop');
	if (get_post_meta($id, 'wpgumby_p_sidebar', true) != '') {
		$custom_layout = get_post_meta($id, 'wpgumby_p_sidebar', true);
	} else {
		if(isset($wpgumby_data['layout'])){
			$custom_layout = esc_html($wpgumby_data['layout']);
		}else{
			$custom_layout ="";
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

	woocommerce_content();

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
<?php get_footer(); ?>