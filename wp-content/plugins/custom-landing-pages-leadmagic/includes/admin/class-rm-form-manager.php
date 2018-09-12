<?php

class RMLP_Form_Manager
{
     public static function get_rm_forms() {
        $rm_forms = array();
        
        if(self::is_registration_magic_active()){
            $service = new RM_Services;
            $rm_forms = RM_Utilities::get_forms_dropdown($service);  
        }
        
            
        return $rm_forms;
    }
    
    static function is_registration_magic_active() {
    if (defined("REGMAGIC_GOLD") || defined("REGMAGIC_GOLD_i2") || defined("REGMAGIC_SILVER") || defined("REGMAGIC_BASIC"))
        return true;
    else
        return false;
    }

}
