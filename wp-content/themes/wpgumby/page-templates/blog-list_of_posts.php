<div <?php post_class('article_background row'); ?>>
<article id="post-<?php the_ID(); ?>">

	<?php
        global $wpgumby_data;
		$thumb_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog-thumb');
		if ($thumb_image[0] != "") {				
			echo '<div class="four columns image circle mr20 mb20">';
			echo '<a class="read-more" href="' . esc_url(get_permalink(get_the_ID())) . '"><img class="img-responsive" src="' . $thumb_image[0] . '"></a>';
			echo '</div>';
		}
    	$title = get_the_title();
		if (!empty($title)) {
			echo '<h2 class="entry-title"><a class="read-more" href="' . esc_url(get_permalink( get_the_ID() )) . '">' . get_the_title() . '</a></h2>';
			echo '<div class="post-author"><strong>';
			the_author_posts_link();
			echo '</strong> &mdash; ' . get_the_date() . '</div>';
		} else {
			echo '<div class="post-author"><a class="read-more" href="' . esc_url(get_permalink( get_the_ID() )) . '"><strong>' . get_the_author() . '</strong> &mdash; ' . get_the_date() . '</a></div>';
		}
	?>
	<?php
	$read_more_button = '<div class="medium oval btn default columns"><a class="read-more" href="' . esc_url(get_permalink( get_the_ID() )) . '">' . __( 'Continue Reading', 'wpgumby' ) . '<i class="icon-right-open"></i></a></div>';
	if(isset($wpgumby_data['excerpt_or_readmore'])){
		switch($wpgumby_data['excerpt_or_readmore']){
			case 'excerpt':
				the_excerpt();
				echo $read_more_button;
				break;
			case 'readmore':
			default:
				the_content('');
				if( strpos( $post->post_content, '<!--more-->' ) ) {
					echo $read_more_button;
				}
				break;
		}
	}
	else
	{
		the_content('');
		if( strpos( $post->post_content, '<!--more-->' ) ) {
			echo $read_more_button;
		}
	}
	?>
</article>
</div>