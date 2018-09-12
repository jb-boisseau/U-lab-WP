<?php

class RMLP_Metabox
{
    /**
    * Output the metabox.
    *
    * @param WP_Post $post
    */
    public static function output( $post ) {
            global $post, $thepostid;
            $thepostid      = $post->ID;
            $meta_data[]= array();
            foreach(RMLP_Constants::$lp_meta as $key=>$val)
            {   if(is_int($key))
                   $key= $val;
                $meta_data[$key]= RMLP_Utility::get_post_meta($thepostid, $key, true);
            }
            $loader_icons= RMLP_Constants::$loder_icons;
            $rm_forms= RMLP_Form_Manager::get_rm_forms();
            include( 'template/html-rmlp-data-panel.php' );
    }
    
    /**
     * Save meta box data.
     */
    public static function save($post_id, $post) {
        $request= $_POST;
       foreach(RMLP_Constants::$lp_meta as $key)
       {
           if(isset($request[$key]))
               RMLP_Utility::update_post_meta($post_id, $key, trim($request[$key]));
           else
               RMLP_Utility::update_post_meta($post_id, $key, '');
       }
       
    }
    
   

}