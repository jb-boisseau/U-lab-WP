<?php global $wpgumby_data; ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en" itemtype="http://schema.org/Product"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"  <?php language_attributes(); ?> itemtype="http://schema.org/Product"> <!--<![endif]-->
<head>
<meta charset="utf-8">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	if(isset($wpgumby_data['logotype']))
	{
		switch($wpgumby_data['logotype']){
			case 'image':
			if(isset($wpgumby_data['hidden_uploader']['url'])){
				$logot = '<img src="'.esc_url($wpgumby_data['hidden_uploader']['url']).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"/>';
				$logod = '';
			}else{
				$logot = '<img src="'.get_template_directory_uri() . '/images/wpgumby_mainlogo.png'.'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"/>'; ;
				$logod = '';
			}
				break;
			case 'site_title':
				$logot = '<h2>' . get_bloginfo( 'name' ) . '</h2>';
				$logod = '';
				break;
			case 'site_title_description':
				$logot = '<h2>' . get_bloginfo( 'name' ) . '</h2>';
				$logod = get_bloginfo( 'description');
				break;
			default:
				$logot = '<h2>' . get_bloginfo( 'name' ) . '</h2>'; 
				$logod = '';
				break;
		}		
	}
	else
	{
				$logot = '<h2>' . get_bloginfo( 'name' ) . '</h2>'; 
				$logod = '';
	}

?>
	<div class="navbar clearfix" id="nav">
		<div class="row valign">
			<a class="toggle" gumby-trigger=".menu_block>div>ul" href="#"><i class="icon-menu"></i></a>
            <div class="logo">
                <div class="logo_block"
                <?php
                    if ((isset($wpgumby_data['logo_margin']) && $wpgumby_data['logo_margin'] != "") || (isset($wpgumby_data['logo_padding']) && $wpgumby_data['logo_padding'] != "")) {
                        echo ' style="';
                        
                        if ($wpgumby_data['logo_margin'] != "") { echo 'margin:' . esc_html($wpgumby_data['logo_margin']) . ';'; }
                        if ($wpgumby_data['logo_padding'] != "") { echo 'padding:' . esc_html($wpgumby_data['logo_padding']) . ';'; }
                        
                        echo '"';
                    }
                
                ?>
                >
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo $logot; ?></a>
                    <?php if ($logod != "") { echo '<span>' . $logod . '</span>'; } ?>
                </div>
			</div>
            <div class="menu_block">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<?php wp_nav_menu(array(
						'theme_location'	=> 'primary',
						'menu_class'		  => '',
						'depth'           => 3,
						'walker'        => new WPGumby_Nav_Walker,
						)
					);
				?>
			<?php endif; ?>
            </div>
		</div>
	</div>