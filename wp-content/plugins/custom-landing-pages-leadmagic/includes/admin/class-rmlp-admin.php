<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Handles all Admin requests for the plugin
 */
class RMLP_Admin {

    /**
    * Is meta boxes saved once?
    *
    * @var boolean
    */
    private static $saved_meta_boxes = false;
        
    /**
     * Constructor.
     */
    public function __construct() {
        add_action('init', array($this, 'hooks'));
        add_action('init', array($this, 'enqueue'));
        add_action('init', array($this, 'includes'));
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'), 30);
        add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1, 2 );
        add_action( 'rmlp_process_meta', 'RMLP_Metabox::save', 20, 2 );
    }

    /**
     * Include any classes we need within admin.
     */
    public function includes() {
        include('class-rmlp-metabox.php');
    }

    /**
     * Load all the static resources (CSS and JS) related to admin
     */
    public function enqueue() { 
        wp_enqueue_script('jquery-ui-draggable', false, array('jquery'), false, false);
        wp_enqueue_script('rmlp_admin_jscolor', plugin_dir_url(__DIR__) . 'admin/template/js/jscolor.js', false);
        wp_enqueue_style('rmlp_admin_css', plugin_dir_url(__DIR__) . 'admin/template/css/admin.css', false);
        wp_enqueue_script('rmlp_admin_js', plugin_dir_url(__DIR__) . 'admin/template/js/admin.js', false);
        wp_enqueue_script('rmlp_unsplash_js', plugin_dir_url(__DIR__) . 'admin/template/js/unsplash.js', false);
       
    }

    public function hooks() {
        
    }

    /*     * * Add  Meta boxes. */

    public function add_meta_boxes() {
        $screen = get_current_screen();
        $screen_id = $screen ? $screen->id : '';
        add_meta_box('rmlp_product_data', RMLP_UI_Strings::get("LABEL_LP_DATA"), 'RMLP_Metabox::output', 'rmlp', 'normal', 'high');
       
    }
    
    /**
    * Check if we're saving, the trigger an action based on the post type.
    *
    * @param  int $post_id
    * @param  object $post
    */
    public function save_meta_boxes( $post_id, $post ) {
            // $post_id and $post are required
        
        
        
        
        
            if ( empty( $post_id ) || empty( $post ) || self::$saved_meta_boxes ) {
                    return;
            }

            // Dont' save meta boxes for revisions or autosaves
            if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
                    return;
            }

            // Check the nonce
           /* if ( empty( $_POST['rmlp_meta_nonce'] ) || ! wp_verify_nonce( $_POST['rmlp_meta_nonce'], 'rmlp_save_data' ) ) {
                    return;
            }*/
                 
            // Check the post being saved == the $post_id to prevent triggering this call for other save_post events
            if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
                    return;
            }

            // Check user has permission to edit
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                    return;
            }

            // We need this save event to run once to avoid potential endless loops. This would have been perfect:
            // remove_action( current_filter(), __METHOD__ );
            // But cannot be used due to https://github.com/woocommerce/woocommerce/issues/6485
            // When that is patched in core we can use the above. For now:
            self::$saved_meta_boxes = true;

           // Check the post type
           if ($post->post_type==RMLP_POST_TYPE) {
                    do_action( 'rmlp_process_meta', $post_id, $post );
            } 
    }

}

return new RMLP_Admin();
