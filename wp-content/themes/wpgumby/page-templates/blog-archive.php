<?php wpgumby_breadcrumbs(); ?>
<div class="row content-archive">
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
?>
<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
		
			if(get_post_type(get_the_ID()) == 'post') {
				get_template_part( 'page-templates/blog', 'list_of_posts' );
			}
			
		endwhile;
		get_template_part( 'page-templates/blog', 'navigation' );
		
	endif;
?>
<?php
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