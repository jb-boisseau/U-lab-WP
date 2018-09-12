<?php get_template_part( 'page-templates/camera-slider', 'wpgumby_slider' ); ?>

<?php wpgumby_breadcrumbs();  ?>
<div class="row content-page">
<?php
	global $wp_query, $wpgumby_data, $post;
	
	if (get_post_meta($post->ID, 'wpgumby_p_sidebar', true) != '') {
		$custom_layout = get_post_meta($post->ID, 'wpgumby_p_sidebar', true);
	} else {
		if(isset($wpgumby_data['layout'])){
			$custom_layout = esc_html($wpgumby_data['layout']);
		}else{
			$custom_layout = "";
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
?>
<?php
	
	$portfolio_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	if(isset($wpgumby_data['portfolio_on'])){
		$portfolio_on = esc_html($wpgumby_data['portfolio_on']);
	}else{
		$portfolio_on ="";
	}
	
	if(isset($wpgumby_data['portfolio_category'])){
		$portfolio_category = esc_html($wpgumby_data['portfolio_category']);
	}else{
		$portfolio_category ="";
	}
	
	if(isset($wpgumby_data['portfolio_page'])){
		$portfolio_page = esc_html($wpgumby_data['portfolio_page']);
	}else{
		$portfolio_page ="";
	}

	if(isset($wpgumby_data['portfolio_on']))
	{
		$portfolio_on = esc_html($wpgumby_data['portfolio_on']);
	}
	else
	{
		$portfolio_on = '';
	}
	
	if(!empty($portfolio_on) && !empty($portfolio_category) && !empty($portfolio_page) && $portfolio_on == 1){
		$show_portfolio = 1;
	} else {
		$show_portfolio = 0;
		return;
	}
	
	//Portfolio Filter
	echo "<div class=\"row\"><div class=\"twelve columns portfolio_filter\">";
	echo "<span class=\"portfolio_filter_title\">" . __('Filter:', 'wpgumby') . "</span>";
	echo "<ul id=\"portfolio_filter_options\">";
	echo "<li class=\"active\"><a href=\"#\" class=\"all\">" . __('All', 'wpgumby') . "</a></li>";
	
	$tags = wpgumby_get_category_tags($portfolio_category );
    if ( is_array($tags) && count($tags) > 0 ){

    $tags_arr = array_unique($tags); //REMOVES DUPLICATES

    foreach( $tags_arr as $tag ):
        $el = get_term_by('slug', $tag, 'post_tag');
	?>
	<li><a href="#" class="<?php echo esc_html($el->slug) ?>"><?php echo  esc_html($el->name); ?></a></li>
	<?php 
	endforeach; 
}

wp_reset_postdata();
	
	echo "</ul>";
	echo "</div></div>";
?>
<?php
	if(isset($wpgumby_data['p_layout'])){
		switch($wpgumby_data['p_layout']){
			case '2c-p':
				$portfolio_column_class = "six";
				break;
			case '3c-p': 
				$portfolio_column_class = "four";
				break;
			case '4c-p':
				$portfolio_column_class = "three";
				break;
			default:
				$portfolio_column_class = "four";
		}
	}
	else
	{
		$portfolio_column_class = "four";
	}
	
	//portfolio posts per page
	if(isset($wpgumby_data['portfolio_count'])){
		$pppp = esc_html($wpgumby_data['portfolio_count']);
	}else{
		$pppp ="";
	}
	
	if ($pppp == '') { $pppp = -1; }
	if (!is_numeric($pppp)) { $pppp = -1; }
	
	global $paged;
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$loop_args = array(
		'cat'	=> $portfolio_category,
		'paged' => $paged,
		'posts_per_page' => $pppp,
	);
	
	$portfolio_query = new WP_Query( $loop_args );
	if ( $portfolio_query->have_posts() ) {
		
	echo '<div class="row content-portfolio">';
	
	while( $portfolio_query->have_posts() ) {
		
		$portfolio_query->the_post();
		$ptags = false;
		$tag_names = wp_get_post_tags( get_the_ID(), array( 'fields' => 'slugs' ) );
		foreach ($tag_names as $tagnames) { $ptags .= $tagnames . ' '; }

?>
    	<div class="portfolio-grid-block <?php echo $portfolio_column_class; ?> columns <?php echo $ptags; ?>">
            <div class="caption">
            	<?php
					
					$portfolio_large_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
					$portfolio_thumb_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog-thumb');
					$blank_post_image = get_stylesheet_directory_uri() . '/images/blank_grey.gif';
					
					if ($portfolio_thumb_image[0] == '' || $portfolio_large_image[0] == ''){
						$resize_thumb_dimensions = ' width="300" height="300" ';
						echo '<div class="hover-icon"><i class="icon-camera big_white">&nbsp;</i></div>';
						$thumb_image = $blank_post_image;
					} else {
						$resize_thumb_dimensions = '';
						echo '<div class="hover-icon"><a class="fancybox" rel="gallery" title="" href="' . $portfolio_large_image[0] . '"><i class="icon-search">&nbsp;</i></a></div>';
						$thumb_image = $portfolio_thumb_image[0];
					}
					
				?>
                <p><a href="<?php echo esc_url( get_permalink( get_the_ID() )); ?>" class=""><?php the_title(); ?></a></p>
            </div>
            <?php
                echo '<img class="img-responsive" src="' . esc_url( $thumb_image) . '"' . $resize_thumb_dimensions . '>';
            ?>
		</div>

<?php

	} //endwhile
	
	echo '</div>'; //row content-portfolio
	
	
	$previous_posts = get_previous_posts_link( '<i class="icon-left-open"></i> ' . __( 'Newer posts', 'wpgumby' ), $portfolio_query->max_num_pages );
	$next_posts = get_next_posts_link( __( 'Older posts', 'wpgumby' ) . ' <i class="icon-right-open"></i>', $portfolio_query->max_num_pages );
	
	if (!empty( $previous_posts ) || !empty( $next_posts )){
		echo '<div class="row content-portfolio">';
		echo '<div class="entry-meta-nav">';
	
		if (!empty( $previous_posts )):
			echo '<div class="medium btn pill-left secondary">';
			echo $previous_posts;
			echo '</div> ';
		endif;
		
		if (!empty( $next_posts )):
			echo ' <div class="medium btn pill-right secondary">';
			echo $next_posts;
			echo '</div>';
		endif;
		
		echo '</div>';
		echo '</div>';
	}
	
	} //endif
	
	wp_reset_postdata();
?>
<?php
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