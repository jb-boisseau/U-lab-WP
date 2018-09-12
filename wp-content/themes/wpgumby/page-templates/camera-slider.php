<?php

	global $wpgumby_data, $post;
	
	if(isset($wpgumby_data['slider_on']))
	{
		$slider_on = esc_html($wpgumby_data['slider_on']);
	}
	else
	{
		$slider_on = '';
	}
	
	if ( !is_front_page() && is_home() ){ $id = get_option( 'page_for_posts' );	} else { $id = $post->ID; }
	//http://docs.woothemes.com/document/useful-functions/
	if(get_post_type() == 'product'){ $id = wc_get_page_id('shop'); }
	if(!empty($slider_on) && $slider_on == 1){
		if(isset($wpgumby_data['camera_slider']) && is_array($wpgumby_data['camera_slider']) && (get_post_meta($id, 'wpgumby_slider', true) == 'show' || is_front_page()) ){		
	
			$wpgumby_slides = $wpgumby_data['camera_slider'];
			$slides=array_values(array_filter($wpgumby_slides, 'wpgumby_remove_blank'));
					
			
			if($slides[0]['image']!='' && isset($slides[0]['image'])){
			if( isset($wpgumby_data['slider_animation']) &&  !empty($wpgumby_data['slider_animation']) ) { 
				$css = esc_html($wpgumby_data['slider_animation']); 
			} else {
			   $css=''; 
			 }
			 ?>
			 <div class="row home-animation">
	
				<div class="twelve columns">
				<input class="hidden" hidden="hidden" id="slider_resize" value="<?php if(isset($wpgumby_data['slider_resize'])){ echo esc_html($wpgumby_data['slider_resize']); }?>" />
				<input class="hidden" hidden="hidden" id="slider_width" value="<?php echo $slides[0]['width']; ?>" />
				<input class="hidden" hidden="hidden" id="slider_height" value="<?php echo $slides[0]['height']; ?>" />
				<div id="camera_wrap">
			 <?php
			 	foreach ($slides as $slide)
			  {
			
				if(!empty($slide['image']) && trim($slide['image'])!=''){
						echo '<div data-src="' . $slide['image'] . '">';
						if( !empty($slide['title']) || !empty($slide['description']) ) {
							echo '<div class="camera_caption ' . $css . '">';
							if( !empty($slide['title']) ) { echo '<strong>' . $slide['title'] . '</strong>'; }
							if( !empty($slide['title']) && !empty($slide['description']) ) { echo ' &mdash; '; }
							if( !empty($slide['url']) ) { echo '<a href="' . esc_url($slide['url']) . '">'; }
							if( !empty($slide['description']) ) { echo $slide['description']; }
							if( !empty($slide['url']) ) { echo '</a>'; }
							echo '</div>';
						}
						echo '</div>';
						
				}
				
			  }
			
			
			
		
	?>      
	
	
		</div>
	</div>
	</div>
	<?php } } }//end if ?>