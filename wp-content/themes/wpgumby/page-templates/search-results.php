<?php wpgumby_breadcrumbs();  ?>
<div class="row content-search">
<?php
	global $wpgumby_data;
	if(isset($wpgumby_data['layout']))
	{
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
	get_search_form();
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			 get_template_part( 'page-templates/blog', 'list_of_posts' ); 
		endwhile;
		get_template_part( 'page-templates/blog', 'navigation' );
		
	else :
		echo "<h1 class=\"entry-title\">" . __( 'Nothing Found', 'wpgumby' ) . "</h1>";
		echo __( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'wpgumby' );
	endif;

?>
<?php
if(isset($wpgumby_data['layout']))
{
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