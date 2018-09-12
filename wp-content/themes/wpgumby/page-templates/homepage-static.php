<?php
	global $wpgumby_data, $post;
	get_template_part( 'page-templates/camera-slider', 'wpgumby_slider' );
?>

<?php if(wpgumby_blog_conditions_upper()){ ?>
<div class="row call_to_action">
	<div class="twelve columns cta">
	
	<?php if (isset($wpgumby_data['cta_text']) && $wpgumby_data['cta_text'] != "") { ?>
        <p class="welcome-site-txt"> <?php echo esc_html($wpgumby_data['cta_text']); ?> </p>
	<?php } else { echo ""; } ?>
    
    <?php if(isset($wpgumby_data['cta_button']) && $wpgumby_data['cta_button'] != ""){ ?>
        	  <div class="ctab"><div class="medium primary btn">
              <?php if ((isset($wpgumby_data['cta_link']) && $wpgumby_data['cta_link']) != ""){ ?>
              <a href="<?php echo esc_url($wpgumby_data['cta_link']); ?>"<?php if (isset($wpgumby_data['cta_open']) && $wpgumby_data['cta_open'] == 1) { echo ' target="_blank"'; } ?> ><?php echo esc_html($wpgumby_data['cta_button']); ?></a>
               <?php }else { ?>
               <?php echo esc_html($wpgumby_data['cta_button']); ?>
              <?php
				} ?> </div></div>
          <?php }else{ echo ""; } ?>
   
    </div>
</div>
	<?php } ?>
  
<?php if(wpgumby_blog_conditions_lower()){ ?>  
<div class="row lb_cb_rb">
	<div class="four columns lb">
		<?php
		if(isset($wpgumby_data['frontpage_lb_img']['url']) && $wpgumby_data['frontpage_lb_img']['url']!=''){
		if(isset($wpgumby_data['frontpage_lb_link']) && $wpgumby_data['frontpage_lb_link']!='' ){
					echo '<a href="'.esc_url($wpgumby_data['frontpage_lb_link']).'"><img src="'.esc_url($wpgumby_data['frontpage_lb_img']['url']).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"/></a>';
					
				}else {
					echo '<img src="'.esc_url($wpgumby_data['frontpage_lb_img']['url']).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"/>';
				}
			}else{
				echo  ' '; ;
				
			}
			?>
		<h4 class="home-h4">
		<?php if(isset($wpgumby_data['frontpage_lb_title']) && $wpgumby_data['frontpage_lb_title']!=""){ 
				if(isset($wpgumby_data['frontpage_lb_link']) && $wpgumby_data['frontpage_lb_link']!='' ){?>
					<a href="<?php echo esc_url($wpgumby_data['frontpage_lb_link']); ?>"  ><?php echo esc_html($wpgumby_data['frontpage_lb_title']);?></a>
		<?php } 
				else { echo esc_html($wpgumby_data['frontpage_lb_title']);
				} 
			 } else { echo ""; } ?>
		</h4>
		<p><?php echo isset($wpgumby_data['frontpage_lb_text']) ? esc_html($wpgumby_data['frontpage_lb_text']) : ''; ?></p>
	</div>
	
    <div class="four columns cb">
		<?php
		if(isset($wpgumby_data['frontpage_cb_img']['url']) && $wpgumby_data['frontpage_cb_img']['url']!=''){
			if(isset($wpgumby_data['frontpage_cb_link']) && $wpgumby_data['frontpage_cb_link']!='' ){
					echo '<a href="'.esc_url($wpgumby_data['frontpage_cb_link']).'"><img src="'.esc_url($wpgumby_data['frontpage_cb_img']['url']).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"/></a>';
				}else{
					echo '<img src="'.esc_url($wpgumby_data['frontpage_cb_img']['url']).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"/>';
					}
				}else{
					echo  ' '; ;
				}
			?>
		<h4 class="home-h4"><?php if(isset($wpgumby_data['frontpage_cb_title']) && $wpgumby_data['frontpage_cb_title']!=""){ 
				if(isset($wpgumby_data['frontpage_cb_link']) && $wpgumby_data['frontpage_cb_link']!='' ){?>
					<a href="<?php echo esc_url($wpgumby_data['frontpage_cb_link']); ?>" ><?php echo esc_html($wpgumby_data['frontpage_cb_title']);?></a>
		<?php } 
				else { echo esc_html($wpgumby_data['frontpage_cb_title']);
				} 
			 } else { echo ""; } ?>
</h4>
		<p><?php echo isset($wpgumby_data['frontpage_cb_text']) ? esc_html($wpgumby_data['frontpage_cb_text']) : ''; ?></p>
	</div>
	
	<div class="four columns rb">
		<?php
			if(isset($wpgumby_data['frontpage_rb_img']['url']) && $wpgumby_data['frontpage_rb_img']['url']!=''){
				if(isset($wpgumby_data['frontpage_rb_link']) && $wpgumby_data['frontpage_rb_link']!='' ){
						echo '<a href="'.esc_url($wpgumby_data['frontpage_rb_link']).'"><img src="'.esc_url($wpgumby_data['frontpage_rb_img']['url']).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"/></a>';
					}else{
						echo '<img src="'.esc_url($wpgumby_data['frontpage_rb_img']['url']).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"/>';
					}
						
				}else{
					echo  ' '; ;
						

					}

				?>
		<h4 class="home-h4"><?php if(isset($wpgumby_data['frontpage_rb_title']) && $wpgumby_data['frontpage_rb_title']!=""){ 
				if(isset($wpgumby_data['frontpage_rb_link']) && $wpgumby_data['frontpage_rb_link']!='' ){?>
					<a href="<?php echo esc_url($wpgumby_data['frontpage_rb_link']); ?>" ><?php echo esc_html($wpgumby_data['frontpage_rb_title']);?></a>
		<?php } 
				else { echo esc_html($wpgumby_data['frontpage_rb_title']);
				} 
			 } else { echo ""; } ?>
</h4>
		<p><?php echo isset($wpgumby_data['frontpage_rb_text']) ? esc_html($wpgumby_data['frontpage_rb_text']) : ''; ?></p>
	</div>
</div>
<?php } ?>

<div class="row content-home">
<?php

	if (get_post_meta($post->ID, 'wpgumby_p_sidebar', true) != '') {
		$custom_layout = get_post_meta($post->ID, 'wpgumby_p_sidebar', true);
	} else {
		if(isset($wpgumby_data['layout']))
		{
			$custom_layout = esc_html($wpgumby_data['layout']);
		}
		else
		{
			$custom_layout='';
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

	if ( have_posts() ) {
		while ( have_posts() ) {
		the_post();
		
			echo "<div class=\"entry-content\">";
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpgumby' ) );
			echo "</div>";
		
		} //endwhile
	} //endif

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
