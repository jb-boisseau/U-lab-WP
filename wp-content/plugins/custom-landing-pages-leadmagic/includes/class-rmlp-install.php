<?php
/**
 * Installation related functions and actions
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Install Class.
 */
class RMLP_Install {

	/**
	 * Hook in tabs.
	 */
	public static function init() {
            
	}


	/**
	 * Install EM.
	 */
	public static function install() {
		global $wpdb;
		// Register post types
		RMLP_Post_types::register_post_types(); 
	} 
}

RMLP_Install::init();
