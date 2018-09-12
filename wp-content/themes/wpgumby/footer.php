<?php global $wpgumby_data; ?>
<footer class="footer"> 
	<div class="row">
		<?php if ( is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) || is_active_sidebar( 'sidebar-5' ) || is_active_sidebar( 'sidebar-6' ) ) : ?>          
		<?php
			if(isset($wpgumby_data['columns_footer_radio']))
			{
				switch($wpgumby_data['columns_footer_radio']){
					case '1':
						echo '<section class="row">';
						echo '<div class="twelve columns">';
						dynamic_sidebar( 'sidebar-3' );
						echo '</div></section>';
						break;
					case '2':
						echo '<section class="row">';
						echo '<div class="six columns">';
						dynamic_sidebar( 'sidebar-3' );
						echo '</div>';
						echo '<div class="six columns">';
						dynamic_sidebar( 'sidebar-4' );
						echo '</div></section>';
						break;
					case '3':
						echo '<section class="row">';
						echo '<div class="four columns">';
						dynamic_sidebar( 'sidebar-3' );
						echo '</div>';
						echo '<div class="four columns">';
						dynamic_sidebar( 'sidebar-4' );
						echo '</div>';
						echo '<div class="four columns">';
						dynamic_sidebar( 'sidebar-5' );
						echo '</div></section>';
						break;
					case '4':
						echo '<section class="row">';
						echo '<div class="three columns">';
						dynamic_sidebar( 'sidebar-3' );
						echo '</div>';
						echo '<div class="three columns">';
						dynamic_sidebar( 'sidebar-4' );
						echo '</div>';
						echo '<div class="three columns">';
						dynamic_sidebar( 'sidebar-5' );
						echo '</div>';
						echo '<div class="three columns">';
						dynamic_sidebar( 'sidebar-6' );
						echo '</div></section>';
						break;
				}				
			}
 ?>
		<?php endif; ?>    
    </div>
    <?php
	if(isset($wpgumby_data['social_position']))
	{
		$spoz = esc_html($wpgumby_data['social_position']);
	}
	else
	{
		$spoz="";
	}
	
	if ($spoz == "footer") {
	
		if(isset($wpgumby_data['social_fp'])){
			$sfp = esc_url($wpgumby_data['social_fp']);
		}else{
			$sfp = "";
		}
		
		if(isset($wpgumby_data['social_gp'])){
			$sgp = esc_url($wpgumby_data['social_gp']);
		}else{
			$sgp = "";
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
			$spi = "";
		}
			
		if ($sfp != "" || $sgp != "" || $stw != "" || $syt != "" || $spi != "") { echo '<div class="social_icons">'; }
		if ($sfp != "") { echo '<a href="' . $sfp . '" target="_blank"><i class="icon-facebook"></i></a>'; }
		if ($sgp != "") { echo '<a href="' . $sgp . '" target="_blank"><i class="icon-gplus"></i></a>'; }
		if ($stw != "") { echo '<a href="' . $stw . '" target="_blank"><i class="icon-twitter"></i></a>'; }
		if ($syt != "") { echo '<a href="' . $syt . '" target="_blank"><i class="icon-video"></i></a>'; }
		if ($spi != "") { echo '<a href="' . $spi . '" target="_blank"><i class="icon-pinterest"></i></a>'; }
		if ($sfp != "" || $sgp != "" || $stw != "" || $syt != "" || $spi != "") { echo '</div>'; }
	}
	?>
    <div class="copy">
        <p>
        <?php _e('Powered by', 'wpgumby'); ?> <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'wpgumby' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'wpgumby' ); ?>"><?php esc_attr_e( 'WordPress', 'wpgumby' );?></a>. 
        <a href="<?php echo esc_url( __( 'https://shopitpress.com/themes/wpgumby/', 'wpgumby' ) ); ?>" target="_blank"><?php _e('WPGumby', 'wpgumby'); ?></a>  <?php esc_attr_e( 'Theme by', 'wpgumby' );?>
        <a href="<?php echo esc_url( __( 'https://shopitpress.com/', 'wpgumby' ) ); ?>" target="_blank"><?php _e('ShopitPress', 'wpgumby'); ?></a>
        </p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>