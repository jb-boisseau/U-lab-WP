<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
<div class="three columns widgets_sidebar">
    <?php
	global $wpgumby_data;
	
	if(isset($wpgumby_data['social_position']))
	{
		$spoz = esc_html($wpgumby_data['social_position']);
	}
	else
	{
		$spoz="";
	}
	
	if ($spoz == "sidebar") {
		
		if(isset($wpgumby_data['social_fp'])){
			$sfp = esc_url($wpgumby_data['social_fp']);
		}else{
			$sfp="";
		}
		
		if(isset($wpgumby_data['social_gp'])){
			$sgp = esc_url($wpgumby_data['social_gp']);
		}else{
			$sgp ="";
		}
		
		if(isset($wpgumby_data['social_tw'])){
			$stw = esc_url($wpgumby_data['social_tw']);
		}else{
			$stw = "";
		}
		
		if(isset($wpgumby_data['social_yt'])){
			$syt = esc_url($wpgumby_data['social_yt']);
		}else{
			$syt ="";
		}
		
		if(isset($wpgumby_data['social_pi'])){
			$spi = esc_url($wpgumby_data['social_pi']);
		}else{
			$spi ="";
		}
		
		if ($sfp != "" || $sgp != "" || $stw != "" || $syt != "" || $spi != "") { echo '<div class="social_icons">'; }
		if ($sfp != "") { echo '<a href="' . esc_url($sfp) . '" target="_blank"><i class="icon-facebook"></i></a>'; }
		if ($sgp != "") { echo '<a href="' . esc_url($sgp) . '" target="_blank"><i class="icon-gplus"></i></a>'; }
		if ($stw != "") { echo '<a href="' . esc_url($stw) . '" target="_blank"><i class="icon-twitter"></i></a>'; }
		if ($syt != "") { echo '<a href="' . esc_url($syt) . '" target="_blank"><i class="icon-video"></i></a>'; }
		if ($spi != "") { echo '<a href="' . esc_url($spi) . '" target="_blank"><i class="icon-pinterest"></i></a>'; }
		if ($sfp != "" || $sgp != "" || $stw != "" || $syt != "" || $spi != "") { echo '</div>'; }
	}
	?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>
<?php endif; ?>