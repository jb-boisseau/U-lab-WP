<?php

class RMLP_Validator
{
    public function validate_page_meta($data=array(),$fields=array())
    {
        $errors= array();
        if(empty($data) || empty($fields))
            return false;
        
        foreach($fields as $key=>$info)
        {
            if(is_array($info) && isset($info['validation_rules']))
            {
                $errors= $this->check_for_requires($info['validation_rules'], $value, $errors);
            }
        }
        
        return $errors;
    }
    
    private function check_for_requires($rule,$value,$errors)
    {   
        $errors[$d_field]= array();
        foreach($rule as $rule_key=>$rule_value)
        {
            if($rule_key=="requires")
            {
                foreach($rule_value as $d_field)
                {
                    if(empty($d_field))
                    {
                      $errors[$d_field][]= RMLP_UI_Strings::get('VALIDATION_REQUIRED');  
                    }
                }
            }
        }
        
        if(empty($errors[$d_field]))
            unset($errors[$d_field]);
        return $errors[$d_field];
    }
    

}