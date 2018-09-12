<?php  wpgumby_breadcrumbs();  ?>
<div class="row content-error">
<?php
	global $wpgumby_data;
	if(isset($wpgumby_data['layout'])){
		switch($wpgumby_data['layout']){
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
	}
	else
	{
		echo '<div class="twelve columns">';
	}

		echo "<h1 class=\"entry-title\">" . __( 'Not found', 'wpgumby' ) . "</h1>";
		echo "<div class=\"entry-content\">" . __( 'Sorry, but the page you requested cannot be found. ', 'wpgumby' ) . "</div>";
		
if(isset($wpgumby_data['layout'])){
	switch($wpgumby_data['layout']){
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
}
else
{
	echo '</div>';
}
?>
</div>