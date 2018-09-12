<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://registration_magic.com
 * @since      1.0.0
 *
 * @package    Registraion_Magic
 * @subpackage Registraion_Magic/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Registraion_Magic
 * @subpackage Registraion_Magic/public
 * @author     CMSHelplive
 */
class RM_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $registraion_magic    The ID of this plugin.
     */
    private $plugin_name;
    public static $form_counter=0;
    public static $login_form_counter=0;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * The controller of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $controller    The main controller of this plugin.
     */
    private $controller;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    private static $editor_counter = 1;

    public function __construct($plugin_name, $version, $controller) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->controller = $controller;
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_version() {
        return $this->version;
    }

    public function get_controller() {
        return $this->controller;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     * 
     */
    public function enqueue_styles() {
        $settings = new RM_Options;
        $theme = $settings->get_value_of('theme');
        $layout = $settings->get_value_of('form_layout');

        switch ($theme) {
            case 'classic' :
                if ($layout == 'label_top')
                    wp_enqueue_style('rm_theme_classic_label_top', plugin_dir_url(__FILE__) . 'css/theme_rm_classic_label_top.css', array(), $this->version, 'all');
                elseif ($layout == 'two_columns')
                    wp_enqueue_style('rm_theme_classic_two_columns', plugin_dir_url(__FILE__) . 'css/theme_rm_classic_two_columns.css', array(), $this->version, 'all');
                else
                    wp_enqueue_style('rm_theme_classic', plugin_dir_url(__FILE__) . 'css/theme_rm_classic.css', array(), $this->version, 'all');
                break;

            /* case 'blue' :
              if ($layout == 'label_top')
              wp_enqueue_style('rm_theme_blue_label_top', plugin_dir_url(__FILE__) . 'css/theme_rm_blue_label_top.css', array(), $this->version, 'all');
              elseif ($layout == 'two_columns')
              wp_enqueue_style('rm_theme_blue_two_columns', plugin_dir_url(__FILE__) . 'css/theme_rm_blue_two_columns.css', array(), $this->version, 'all');
              else
              wp_enqueue_style('rm_theme_blue', plugin_dir_url(__FILE__) . 'css/theme_rm_blue.css', array(), $this->version, 'all');
              break; */

            default :
                if ($layout == 'label_top')
                    wp_enqueue_style('rm_theme_matchmytheme_label_top', plugin_dir_url(__FILE__) . 'css/theme_rm_matchmytheme_label_top.css', array(), $this->version, 'all');
                elseif ($layout == 'two_columns')
                     wp_enqueue_style('rm_theme_matchmytheme_two_columns', plugin_dir_url(__FILE__) . 'css/theme_rm_matchmytheme_two_columns.css', array(), $this->version, 'all');
                else
                    wp_enqueue_style('rm_theme_matchmytheme', plugin_dir_url(__FILE__) . 'css/theme_rm_matchmytheme.css', array(), $this->version, 'all');
                break;
        }
        //wp_enqueue_style('rm-jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css', false, $this->version, 'all');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/style_rm_front_end.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        $gopt= new RM_Options();
        $magic_pop= $gopt->get_value_of('display_floating_action_btn');
        wp_register_script('rm_front', plugin_dir_url(__FILE__) . 'js/script_rm_front.js', array('jquery', 'jquery-ui-core', 'jquery-ui-sortable', 'jquery-ui-tabs', 'jquery-ui-datepicker','jquery-effects-core','jquery-effects-slide'), $this->version, false);   
        $rm_ajax_data= array(
                        "url"=>admin_url('admin-ajax.php'),
                        "gmap_api"=>$gopt->get_value_of("google_map_key"),
                        'no_results'=>__('No Results Found','custom-registration-form-builder-with-submission-manager'),
                        'invalid_zip'=>__('Invalid Zip Code','custom-registration-form-builder-with-submission-manager'),
                        'request_processing'=>__('Please wait...','custom-registration-form-builder-with-submission-manager'),
                        'hours'=>__('Hours','custom-registration-form-builder-with-submission-manager'),
                        'minutes'=>__('Minutes','custom-registration-form-builder-with-submission-manager'),
                        'seconds'=>__('Seconds','custom-registration-form-builder-with-submission-manager'),
                        'days'=>__('Days','custom-registration-form-builder-with-submission-manager'),
                        'months'=>__('Months','custom-registration-form-builder-with-submission-manager'),
                        'years'=>__('Years','custom-registration-form-builder-with-submission-manager'));
        wp_localize_script( 'rm_front', 'rm_ajax',$rm_ajax_data);
        wp_enqueue_script('rm_front');
        
        wp_register_script('rm_front_form_script', RM_BASE_URL."public/js/rm_front_form.js",array('rm_front'), $this->version, false);
        //Register jQ validate scripts but don't actually enqueue it. Enqueue it from within the shortcode callback.
        wp_register_script('rm_jquery_validate', RM_BASE_URL."public/js/jquery.validate.min.js");
        wp_register_script('rm_jquery_validate_add', RM_BASE_URL."public/js/additional-methods.min.js");
        wp_register_script('rm_jquery_conditionalize', RM_BASE_URL."public/js/conditionize.jquery.js");
    }

    public function run_controller($attributes = null, $content = null, $shortcode = null) {
        return $this->controller->run();
    }

    public function rm_front_submissions() {
        /* Shows form preview */
        if(!empty($_GET['form_prev']) && !empty($_GET['form_id']) && is_super_admin())
        {  
            $form_id= $_GET['form_id'];
            $form_factory= new RM_Form_Factory();
            $form= $form_factory->create_form($form_id);
            $form->set_preview(true);
            echo '<script>jQuery(document).ready(function(){jQuery(".entry-header").remove();}); </script>';
            echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
            echo '<div class="rm_embedeed_form">' . $form->render() . '</div>';
            return;
        }
        
        if (RM_Utilities::fatal_errors()) {
            ob_start();
            include_once RM_ADMIN_DIR . 'views/template_rm_cant_continue.php';
            $html = ob_get_clean();
            return $html;
        }

        $xml_loader = RM_XML_Loader::getInstance(plugin_dir_path(__FILE__) . 'rm_config.xml');

        $request = new RM_Request($xml_loader);
        if(isset($_POST['rm_slug'])){
            $request->setReqSlug($_POST['rm_slug'], true);
        }
        else{
            $request->setReqSlug('rm_front_submissions', true);
        }

        $params = array('request' => $request, 'xml_loader' => $xml_loader);
        $this->controller = new RM_Main_Controller($params);
        return $this->controller->run();
    }

    public function rm_login($name) {
        self::$login_form_counter++;        
        $_REQUEST['login_popup_show']  = 0;
        if(!empty($_POST) && isset($_POST['rm_form_sub_id']) && $_POST['rm_form_sub_id']=='rm_login_form_'.self::$login_form_counter){
            $_REQUEST['login_popup_show']  = 1;
        }
        if(!empty($_POST) && isset($_POST['rm_form_sub_id'])){
            if($_POST['rm_form_sub_id']=='rm_login_form_'.self::$login_form_counter){
                echo '<style>#'.$_POST['rm_form_sub_id'].'{display:block;}</style>';
                echo '<style>#'.str_replace('rm_login_form_','rm_otp_form_',$_POST['rm_form_sub_id']).'{display:block;}</style>';
            }else{
                echo '<script>jQuery(document).ready(function(){jQuery("#rm_login_form_'.self::$login_form_counter.'").html("<div class=\'rm-login-attempted-notice\'>'.__('Note: You are already attempting login using a different login form on this page. To keep your logging experience simple and secure, this login form in no longer accessible. Please continue the login process using the form with which you attempted login before the page refresh.','custom-registration-form-builder-with-submission-manager').'</div>")});</script>';
            }
        }
        
        if (RM_Utilities::fatal_errors()) {
            ob_start();
            include_once RM_ADMIN_DIR . 'views/template_rm_cant_continue.php';
            $html = ob_get_clean();
            return $html;
        }

        $xml_loader = RM_XML_Loader::getInstance(plugin_dir_path(__FILE__) . 'rm_config.xml');

        $request = new RM_Request($xml_loader);
        $request->setReqSlug('rm_login_form', true);

        $params = array('request' => $request, 'xml_loader' => $xml_loader);
        $this->controller = new RM_Main_Controller($params);
        return $this->controller->run();
    }

    public function rm_user_form_render($attribute) {
        self::$form_counter++;
        $this->disable_cache();
        if (RM_Utilities::fatal_errors()) {
            ob_start();
            include_once RM_ADMIN_DIR . 'views/template_rm_cant_continue.php';
            $html = ob_get_clean();
            return $html;
        }
        $xml_loader = RM_XML_Loader::getInstance(plugin_dir_path(__FILE__) . 'rm_config.xml');

        $request = new RM_Request($xml_loader);
        $request->setReqSlug('rm_user_form_process', true);
        
        $params = array('request' => $request, 'xml_loader' => $xml_loader, 'form_id' => isset($attribute['id']) ? $attribute['id'] : null);
        
       // if(isset($attribute['force_enable_multiform']))
            $params['force_enable_multiform'] = true;
        
/*        if(isset($attribute['prefill_form']))
            $request->setReqSlug('rm_user_form_edit_sub', true);*/
        
        $this->controller = new RM_Main_Controller($params);
        return $this->controller->run();
    }
    
      // Disable cache 
    protected function disable_cache()
    { 
        //Diable caches
        if(!defined('DONOTCACHEPAGE'))
            define( 'DONOTCACHEPAGE', true );
    }
    
    public function register_otp_widget() {
        register_widget('RM_OTP_Widget');
    }
    
    public function register_login_btn_widget()
    {  
        register_widget('RM_Login_Btn_Widget');
    }
    
    public function register_form_widget()
    {
        register_widget('RM_Form_Widget');
    }
    
    /* function add_field_invites()
      {
      $screen = get_current_screen();

      if($screen->base=='registrations_page_rm_form_add')
      {   if(self::$editor_counter==3) {
      $xml_loader = RM_XML_Loader::getInstance(plugin_dir_path(__FILE__) . 'rm_config.xml');

      $request = new RM_Request($xml_loader);
      $request->setReqSlug('rm_editor_actions_add_email', true);

      $params = array('request' => $request, 'xml_loader' => $xml_loader);
      $this->controller = new RM_Main_Controller($params);
      $this->controller->run();
      }
      self::$editor_counter= self::$editor_counter +1;
      }

      } */

    function execute_login() {
        $xml_loader = RM_XML_Loader::getInstance(plugin_dir_path(__FILE__) . 'rm_config.xml');

        $request = new RM_Request($xml_loader);
        $request->setReqSlug('rm_login_form', true);

        $params = array('request' => $request, 'xml_loader' => $xml_loader);
        $this->controller = new RM_Main_Controller($params);
        return $this->controller->run();
    }

    public function cron() {
        RM_DBManager::delete_front_user(1, 'h');
    }


    public function do_shortcode($content, $ignore_html = false) {
        if (has_shortcode($content,'RM_Form') || has_shortcode($content,'CRF_Login') || has_shortcode($content,'CRF_Form') || has_shortcode($content,'CRF_Submissions') || has_shortcode($content,'RM_Users') || has_shortcode($content,'RM_Front_Submissions')){
            return do_shortcode($content, $ignore_html);
        }
        return $content;
    }

    public function floating_action() {
        $xml_loader = RM_XML_Loader::getInstance(plugin_dir_path(__FILE__) . 'rm_config.xml');

        $request = new RM_Request($xml_loader);
        $request->setReqSlug('rm_front_fab', true);

        $params = array('request' => $request, 'xml_loader' => $xml_loader);
        $this->controller = new RM_Main_Controller($params);
        return $this->controller->run();
        
    }
    
    public function render_embed() {
        die;
    }
    
    public function register_stat_ids() {
        $result = array();
        if(isset($_POST['form_ids'])) {            
            
            $form_ids = $_POST['form_ids'];
            
            if(is_array($form_ids) && count($form_ids) > 0) {
                $front_form_service = new RM_Front_Form_Service;            
                foreach($form_ids as $form_uid) {
                    $form_id = explode("_", $form_uid);
                    if(count($form_id) == 3) {
                        $form_id = intval($form_id[1]);                                                
                        $result[$form_uid] = $front_form_service->create_stat_entry(array('form_id' => $form_id));
                    }                
                }
            }
        }
        echo json_encode($result);
        wp_die();
    }
    
    public function request_non_cached_copy() {
        global $post;
        
        if( isset($_GET['rmcb']) || isset($request->req['rm_pproc']))
            return;
        
        if($post instanceof WP_Post && has_shortcode($post->post_content, 'RM_Form')) {
            $red_url = add_query_arg('rmcb', time());
            wp_redirect($red_url);
            exit();
        }
    }
    
    public function load_states(){
        if(empty($_POST['country']))
            die('Unknown country');
            
        $country= strtolower($_POST['country']);
       
        $states= array();
        if($country=="us"){
            $states= RM_Utilities::get_usa_states();
        } else if($country=="canada"){
             $states= RM_Utilities::get_canadian_provinces();
        }
        echo json_encode($states);
        
        die;
    }
    
    public function send_activation_link(){
        $user_id= absint($_POST['user_id']);
        $response= array('success'=>true);
        
        if(empty($user_id)){
            $response['success']= false;
            $response['msg']= __('No such user exists', 'custom-registration-form-builder-with-submission-manager');
            echo json_encode($response);
            exit;
        }
        $user_info = get_userdata($user_id); 
        if(empty($user_info)){
            $response['success']= false;
            $response['msg']= __('No such user exists', 'custom-registration-form-builder-with-submission-manager');
            echo json_encode($response);
            exit;
        }
        
        $activation_nonce= sanitize_text_field($_POST['activation_nonce']);
        if(wp_verify_nonce( $activation_nonce, 'rm_send_verification_nonce' )){
            RM_Email_Service::send_activation_link($user_id);
            
            $response['msg']= __('Verification link has been sent on your registered email account. Please check.', 'custom-registration-form-builder-with-submission-manager');
        }
        else{
             $response['msg']= __('Incorrect security token. Please try after some time.', 'custom-registration-form-builder-with-submission-manager');
        }
        echo json_encode($response);
        exit;
    }
    
    public function logs_retention(){
        $login_service= new RM_Login_Service();
        $log_options= $login_service->get_log_options();
        
    }
}
