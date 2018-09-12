<?php
	$previous_posts = get_previous_posts_link( '<i class="icon-left-open"></i> ' . __( 'Newer posts', 'wpgumby' ), 0 );
	$next_posts = get_next_posts_link( __( 'Older posts', 'wpgumby' ) . ' <i class="icon-right-open"></i>', 0 );
	
	if (!empty( $previous_posts ) || !empty( $next_posts )){
		echo "<div class=\"entry-meta-nav\">";
	
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
		
		echo "</div>";
	}
?>  
        