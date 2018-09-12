<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Handles all Front requests for the plugin
 */

class RMLP_Public {

    /**
     * Constructor.
     */
    public function __construct() { 
            add_action( 'init', array( $this, 'hooks' ) );
            add_action( 'init', array( $this, 'enqueue' ) );
            add_action( 'init', array( $this, 'includes' ) );         
           
    }

    /**
     * Include any classes we need within admin.
     */
    public function includes() {
        
    }
    
    /**
    * Load all the static resources (CSS and JS) related to admin
    */
    public function enqueue(){    
    }
    
    public function hooks(){
    }
    
     // Function to locate template for Single Post page    
    public static function locate_single_template( $single_template )
    {      
            $object = get_queried_object();
            if(empty($object))
                return $single_template;
            if(isset($object->post_type) && $object->post_type==RMLP_POST_TYPE){ 
                wp_enqueue_style('rmlp_public_style_css', RMLP_BASE_URL.'includes/templates/css/style.css');
                wp_enqueue_script('rmlp_public_js', RMLP_BASE_URL.'includes/templates/js/public.js',array('jquery'), false);
                $single_template = dirname( __FILE__ ) . "/templates/landing-page.php";  
            }

        return $single_template; 
    }
   
    

}

return new RMLP_Public();
