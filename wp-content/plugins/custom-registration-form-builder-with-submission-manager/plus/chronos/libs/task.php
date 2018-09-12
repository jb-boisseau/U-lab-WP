<?php

class RM_Chronos_Task {
    
    public $task_id;
    public $name;
    public $desc;
    public $form_id;
    public $must_rules;
    public $any_rules;
    public $combiner;
    public $is_active;
    public $actions;
    public $meta;
    
    public function __construct(RM_Chronos_Task_Model $model) {
        
        foreach($model->props as $prop => $val) {
            if(property_exists($this, $prop))
                    $this->$prop = $val;
        }       
        
        $rule_factory = new RM_Chronos_Rule_Factory();
        
        $must_rules = array();
        foreach($model->must_rules as $rule_id) {
            $must_rules[] = $rule_factory->create_rule($rule_id);
        }
        $this->must_rules = $must_rules;

        $any_rules = array();
        foreach($model->any_rules as $rule_id) {
            $any_rules[] = $rule_factory->create_rule($rule_id);
        }
        $this->any_rules = $any_rules;
    }
    
    public function execute() {
        $context = array();
        $context['form_id'] = $this->form_id;
        $result = null;
        $users = null;
        $last_rule = null;
        $qb = new RM_Chronos_Query_Builder($this->form_id);
        foreach($this->must_rules as $rule) {
            $qb->build_query($rule, 'AND');
        }        
        $result_set = $qb->get_results();
        
        $data = new stdClass;
        $data->users = $result_set->wp_users;
        $data->subs = $result_set->subs;        
        $this->perform_actions($data);
    }
    
    protected function perform_actions($data) {
        foreach($this->actions as $action) {
            switch($action) {
                case RM_Chronos_Action_Interface::ACTION_TYPE_ACTIVATE_USER:
                    if(isset($data->users) && is_array($data->users)) {
                        $prev_proc_users = RM_Chronos_Toolkit::get_already_processed_subs($this->task_id, $action);
                        $prev_proc_users = $prev_proc_users->user_ids;
                        $new_proc_users = array();
                        foreach($data->users as $user) {
                            update_user_meta($user->ID, 'rm_user_status', '0');
                            $new_proc_users[] = $user->ID;
                        }
                        RM_Chronos_Toolkit::update_processed_subs($this->task_id, $action, $new_proc_users);
                    }
                    break;
                
                case RM_Chronos_Action_Interface::ACTION_TYPE_DEACTIVATE_USER:
                    if(isset($data->users) && is_array($data->users)) {
                        $prev_proc_users = RM_Chronos_Toolkit::get_already_processed_subs($this->task_id, $action);
                        $prev_proc_users = $prev_proc_users->user_ids;
                        $new_proc_users = array();
                        foreach($data->users as $user) {
                            update_user_meta($user->ID, 'rm_user_status', '1');
                            $new_proc_users[] = $user->ID;
                        }
                        RM_Chronos_Toolkit::update_processed_subs($this->task_id, $action, $new_proc_users);
                    }
                    break;
                    
                case RM_Chronos_Action_Interface::ACTION_TYPE_DELETE_USER:
                    if(isset($data->users) && is_array($data->users)) {
                        foreach($data->users as $user) {
                            wp_delete_user($user->ID);
                        }
                    }
                    break;
                    
                case RM_Chronos_Action_Interface::ACTION_TYPE_SEND_EMAIL:
                    if(isset($data->subs) && is_array($data->subs)) {
                            $this->action_send_emails($data->subs);
                        }
                    break;
            }
        }
    }
    
    public function action_send_emails($subs) {
        
    }
    
}
