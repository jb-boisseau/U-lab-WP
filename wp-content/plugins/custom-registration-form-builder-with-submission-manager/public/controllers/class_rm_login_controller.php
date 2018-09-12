<?php

class RM_Login_Controller{

    public $mv_handler;
    function __construct(){
        $this->mv_handler= new RM_Model_View_Handler();
    }
    public function form($model,$service,$request,$params){ 
        if(RM_Public::$login_form_counter==0){// In case login attempt is coming from submissions page, Increase counter value from 0 to 1
            RM_Public::$login_form_counter++;
        }
        $login_service= new RM_Login_Service();
        $login_form_slug= "rm_login_form_".RM_Public::$login_form_counter;
        $otp_form_slug= "rm_otp_form_".RM_Public::$login_form_counter;
        $hide_forms= array();
  
        // handle twitter callback
        if(isset($request->req['rm_target']))
        {
            if($request->req['rm_target'] == 'fbcb')
            {
                $service->facebook_login_callback();
                
            }
        }
        
        //handle twitter callback
        $session_token=isset($_SESSION['token'])?$_SESSION['token']:null;
        $req_token=isset($request->req['oauth_token'])?$request->req['oauth_token']:null;
        if($session_token == $req_token && $req_token !=null) 
        {
            $data= new stdClass();
            $data->twitter= $service->get_twitter_keys();
            if($data->twitter['enable_twitter'] == 'yes')
                {
                    $view= $this->mv_handler->setView('login',true);
                    return $view->read($data);
                }
        }
        
        $data= new stdClass();
        $data->show_otp= false;  // For two factor authentication
        $data->otp_error= false;
        $v_options= $login_service->get_validations();
        
        
        /*
         * User login form authentication
         */
        if(isset($request->req['rm_slug']) && $request->req['rm_slug']=='rm_login_form' && isset($request->req['rm_form_sub_id']) && $login_form_slug!=$request->req['rm_form_sub_id']){
            array_push($hide_forms, $login_form_slug);
        }
        
        if ($this->mv_handler->validateForm($login_form_slug))
        {   
            // Prodeeding with normal username and password authentication die('in');
            $status= $login_service->check_login($request->req['username'],$request->req['pwd']);

            if(empty($status)){
                RM_PFBC_Form::resetErrors($login_form_slug);
                $user= $login_service->get_user($request->req['username']);

                if(empty($user)){
                    if(empty($_POST['rm_login_form_processed'])){
                        $_POST['rm_login_form_processed']=1;
                        $login_service->insert_login_log(array('email'=>$request->req['username'],'username_used'=>$request->req['username'],'ip'=> $_SERVER['REMOTE_ADDR'],'time'=> current_time('timestamp'),'status'=>0,'type'=>'normal','result'=>'failure','failure_reason'=>'incorrect_username'));
                    }

                    $error_message= $v_options['un_error_msg'];
                    if(!empty($v_options['en_recovery_link'])){
                        $error_message.=' <div class="rm_inline_forgot_pass"><a href="' . wp_lostpassword_url() . '" target="blank">' .__('Lost Your Password?','custom-registration-form-builder-with-submission-manager'). '</a></div>';
                    }
                    RM_PFBC_Form::setError($login_form_slug,$error_message);
                }
                else{
                    if(!empty($v_options['en_failed_user_notification'])){
                        RM_Email_Service::notify_failed_login_to_user($user);
                    }
                    if(!empty($v_options['en_failed_admin_notification'])){
                        RM_Email_Service::notify_failed_login_to_admin($user);
                    }
                    $error_message= $v_options['pass_error_msg'];

                    if(!empty($v_options['en_recovery_link'])){
                        $error_message.=' <div class="rm_inline_forgot_pass"><a href="' . wp_lostpassword_url() . '" target="blank">' .__('Lost Your Password?','custom-registration-form-builder-with-submission-manager'). '</a></div>';
                    }
                    RM_PFBC_Form::setError($login_form_slug,$error_message);
                    if(empty($_POST['rm_login_form_processed'])){
                        $_POST['rm_login_form_processed']=1;
                        $login_service->insert_login_log(array('email'=>$user->user_email,'username_used'=>$request->req['username'],'ip'=> $_SERVER['REMOTE_ADDR'],'time'=> current_time('timestamp'),'status'=>0,'type'=>'normal','result'=>'failure','failure_reason'=>'incorrect_password'));
                    }
                }
                //if(!empty($v_options['en_captcha'])){
                    do_action('wp_login_failed',$request->req['username']);
                //}

            }
            else {
                $user= $service->login($request);
                if (is_wp_error($user)) {
                    RM_PFBC_Form::setError($login_form_slug,$user->get_error_message());
                    //if(!empty($v_options['en_captcha'])){
                        do_action('wp_login_failed',$request->req['username']);
                    //}
                }
                else{
                    if(empty($_POST['rm_login_form_processed'])){
                        $_POST['rm_login_form_processed']=1;
                        $login_service->insert_login_log(array('email'=>$user->user_email,'username_used'=>$request->req['username'],'ip'=> $_SERVER['REMOTE_ADDR'],'time'=> current_time('timestamp'),'status'=>1,'type'=>'normal','result'=>'success'));
                    }
                    $redirect_to= RM_Utilities::after_login_redirect($user);
                    if(!$redirect_to)
                        $redirect_to = apply_filters( 'login_redirect', admin_url(), "", $user );
                    RM_Utilities::redirect($redirect_to);
                    die;
                }
            }
            
        }
        
        // External login integrations
        $data->facebook_html= $service->facebook_login_html();
        
        if(!is_user_logged_in()){
            if(!empty($v_options['en_captcha'])){
                $failed_count= $login_service->check_max_failed_login();
                $max_failed_attempt= $v_options['allowed_failed_attempts'];
                if(!empty($failed_count) && !empty($max_failed_attempt) && $failed_count==$max_failed_attempt){
                    $data->show_captcha= true;
                }
                
                if($max_failed_attempt==0){
                    $data->show_captcha= true;
                }
            }
        }
        
        $pass_options= $login_service->get_recovery_options();
        
        if(!empty($pass_options['en_pwd_recovery'])){
            $data->en_pwd_recovery=1;
            $data->recovery_link_text= $pass_options['recovery_link_text'];
        }
        
        
        $login_form= json_decode($login_service->get_form(),true);
        if(!empty($login_form)){
           $data->fields= $login_form['form_fields'];
        }
        
        
        $data->login_form_slug= $login_form_slug;
        $data->otp_form_slug= $otp_form_slug;
        $data->design= $login_service->get_form_design();
        $data->buttons= $login_service->get_button_config();
        $data->hidden_forms= $hide_forms;
        $view= $this->mv_handler->setView('login',true);
        return $view->read($data);
    }
}
