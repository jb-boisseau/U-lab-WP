<?php

	echo "<h1 class=\"entry-title\">";
	the_title();
	echo "</h1>";

	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
	if ($large_image_url[0] != "") {
		echo "<div class=\"tcenter featured_image\">";
		echo "<img class=\"img-responsive\" src=\"" . esc_url($large_image_url[0]) . "\">";
		echo "</div>";
	}
	
	echo "<div class=\"entry-content\">";
	the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpgumby' ) );
	echo "</div>";
	
	wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wpgumby' ), 'after' => '</div>' ) );
	
	if(get_post_type(get_the_ID()) == 'post' && is_single()){
		echo "<div class=\"entry-meta\">";
		wpgumby_post_meta();
		echo "</div>";
	}

?>