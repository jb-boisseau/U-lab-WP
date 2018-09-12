<?php
/**
 * Menu admin class.
 *
 * @since 1.0.0
 *
 * @package sip_woocommerce_social_proof
 * @author  ShopitPress
 * @subpackage sip_woocommerce_social_proof/admin
 */

class WPGhumby_Admin {

	/**
     * Primary class constructor.
     *
     * @since 1.0.0
     */
	public function __construct() {
		
        // Build the custom admin page for managing addons, themes and licenses.
        add_action( 'admin_menu',  array( $this, 'sip_sp_custom_admin_menu' ) );		
 	}
            

	/**
     * Registers the admin menu for managing the ShopitPress options.
     *
     * @since 1.0.0
     */
    public function sip_sp_custom_admin_menu() {
	  
       //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        $this->hook = add_theme_page('ShopitPress Extras', '<span style="color:#FF8080">'.__('ShopitPress Extras', 'wpgumby').'</span>', 'edit_theme_options', 'sip-themes-extras', array( $this, 'wpgumby_shopitpress_themes' ) );

	}
    
    /**
     * Outputs the main UI for handling and managing addons, themes and licenses.
     *
     * @since 1.0.0
     */
    public function wpgumby_shopitpress_themes() {

        $tabs = array( 
            'plugins'     => __( 'Plugins' , 'wpgumby'), 
            'themes'      => __( 'Themes' , 'wpgumby')
        );
        
        // Required for foreach
        if( !empty( $tabs ) && !is_array( $tabs ) ) { return; }
        
        // $_GET['page']
        $get_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );
        
        // $_GET['tab']
        $get_tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );
        
        // Set current tab
        $current = isset( $_GET['tab'] ) ? $get_tab : key( $tabs );
        

        // Build out the necessary HTML structure.
        // Tabs HTML structure
        $admin_tabs = '<div id="icon-edit-pages" class="icon32"><br /></div>';
        $admin_tabs .= '<h2 class="nav-tab-wrapper">';
        
        foreach( $tabs as $tab => $name ) {
            
            // Current tab class
            $class      = ( $tab == $current ) ? ' nav-tab-active' : '';
            
            // Tab links
            $admin_tabs .= '<a href="?page='. $get_page .'&tab='. $tab .'" class="nav-tab'. $class .'">'. $name .'</a>';
        }

        $admin_tabs .= '</h2><br />';
        
        //echo $admin_tabs; /** use for do_action */
        echo $admin_tabs; /** use for echo function() */
        
        if( isset($_GET['tab']) ) {
            if ($_GET['tab'] == "themes")
            	include("ui/themes.php");
            else 
                include("ui/plugin.php");
           } else 
                include("ui/plugin.php");
    } // END menu_ui()	
		
}

$wpghumby_admin = new WPGhumby_Admin;
