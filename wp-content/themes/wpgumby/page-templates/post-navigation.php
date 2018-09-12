<?php
	global $post;
	$previous_post = $next_post = '';
	$previous_post = get_previous_post();
	$next_post = get_next_post();
	
	if (!empty( $previous_post )) { $previous_post_url = get_permalink( $previous_post->ID ); }
	if (!empty( $next_post )) { $next_post_url = get_permalink( $next_post->ID ); }
	
	if (!empty( $previous_post_url ) || !empty( $next_post_url )){
		echo "<div class=\"entry-meta-nav\">";
		if (!empty( $next_post_url )):
			echo '<div class="medium btn pill-left secondary">';
			echo '<a href="' . esc_url( $next_post_url) . '"><i class="icon-left-open"></i> ' . __( 'Newer post', 'wpgumby' ) . '</a>';
			echo '</div> ';
		endif;
		if (!empty( $previous_post_url )):
			echo ' <div class="medium btn pill-right secondary">';
			echo '<a href="' . esc_url( $previous_post_url) . '">' . __( 'Older post', 'wpgumby' ) . ' <i class="icon-right-open"></i></a>';
			echo '</div>';
		endif;
		echo "</div>";
	}
?>