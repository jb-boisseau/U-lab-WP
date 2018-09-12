<?php
/**
 *
 * Registers post types.
 *
 * @class     RMLP_Post_types
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RMLP_Post_types {

	/**
	 * Hooks in method.
	 */
	public static function init() {
            add_action( 'init', array( __CLASS__, 'register_post_types' )); 
            
            // Single Page template
            add_filter( 'template_include', 'RMLP_Public::locate_single_template' );
	}

	/**
	 * Register core post types.
	 */
	public static function register_post_types() {
                global $wp_rewrite;
		if ( post_type_exists('rmlp') ) {
			return;
		}

		register_post_type( 'rmlp',
				array(
					'labels'              => array(
							'name'                  => RMLP_UI_Strings::get('LABEL_LP'),
							'singular_name'         => RMLP_UI_Strings::get('LABEL_LP'),
							'add_new'               => RMLP_UI_Strings::get('LABEL_ADD_NEW'),
							'add_new_item'          => RMLP_UI_Strings::get('LABEL_ADD_NEW'),
							'edit'                  => RMLP_UI_Strings::get('LABEL_EDIT'),
							'edit_item'             => RMLP_UI_Strings::get('LABEL_EDIT'),
							'new_item'              => RMLP_UI_Strings::get('LABEL_ADD_NEW'),
							'view'                  => RMLP_UI_Strings::get('LABEL_VIEW'),
							'view_item'             => RMLP_UI_Strings::get('LABEL_VIEW'),
							'not_found'             => RMLP_UI_Strings::get('LABEL_VIEW'),
							'not_found_in_trash'    => RMLP_UI_Strings::get('LABEL_VIEW'),
							'featured_image'        => RMLP_UI_Strings::get('LABEL_IMAGE'),
							'set_featured_image'    => RMLP_UI_Strings::get('LABEL_IMAGE')
						),
					'public'              => true,
					'show_ui'             => true,
                                        'has_archive'         => false, 
                                        'menu_icon'   => 'dashicons-media-document',
					'map_meta_cap'        => false,
                                        'capabilities' => array(
                                            'edit_post'          => 'update_core',
                                            'read_post'          => 'update_core',
                                            'delete_post'        => 'update_core',
                                            'edit_posts'         => 'update_core',
                                            'edit_others_posts'  => 'update_core',
                                            'delete_posts'       => 'update_core',
                                            'publish_posts'      => 'update_core',
                                            'read_private_posts' => 'update_core'
                                        ),
                                        'capability_type'     => 'rmlp',
					'publicly_queryable'  => true,
					'exclude_from_search' => true,
					'hierarchical'        => true,
					'query_var'           => true,
					'supports'            => array( 'title', 'publicize', 'wpcom-markdown' ),
					'show_in_nav_menus'   => true
				)
			);
                $wp_rewrite->flush_rules();
                
	}
        
       
        
}

RMLP_Post_types::init();
