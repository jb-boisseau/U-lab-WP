<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://registration_magic.com
 * @since      1.0.0
 *
 * @package    Registraion_Magic
 * @subpackage Registraion_Magic/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Registraion_Magic
 * @subpackage Registraion_Magic/admin
 * @author     CMSHelplive
 */
class RM_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $registraion_magic    The ID of this plugin.
     */
    private $plugin_name;

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
    private static $editor_counter = 1;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name   The name of this plugin.
     * @param      string    $version       The version of this plugin.
     */
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
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/style_rm_admin.css', array(), $this->version, 'all');
        wp_register_style('style_rm_formcard_menu', RM_BASE_URL . 'admin/css/style_rm_formcard_menu.css', array($this->plugin_name), $this->version, 'all');
        wp_enqueue_style('rm_google_font', 'https://fonts.googleapis.com/css?family=Titillium+Web:400,600', array(), $this->version, 'all');
        wp_enqueue_style('rm_rating_style', plugin_dir_url(__FILE__) . 'js/rating3/rateit.css', array(), $this->version, 'all');
        wp_enqueue_style('rm_font_awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all');
        //wp_enqueue_style('rm-jquery-ui','http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css',false,$this->version,'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script('rm-color', plugin_dir_url(__FILE__) . 'js/jscolor.min.js', array(), $this->version, false);
        
        wp_register_script('rm-utilities', plugin_dir_url(__FILE__) . 'js/script_rm_utilities.js', array(), $this->version, false);
        $utilities_vars= array(
                        'price_fixed'=>sprintf(__("For creating fixed price single product. <a target='_blank' class='rm-more' href='%s'>More</a>",'custom-registration-form-builder-with-submission-manager'),'https://registrationmagic.com/knowledgebase/add-product/#htprodpricetype'),
                        'price_multisel'=>sprintf(__("Allow user to pick multiple products with individual prices. Price will calculated as cumulative for the selection for products. <a target='_blank' class='rm-more' href='%s'>More</a>",'custom-registration-form-builder-with-submission-manager'),'https://registrationmagic.com/knowledgebase/add-product/#htprodpricetype'),
                        'dropdown'=>sprintf(__("Allows user to pick a single product from multiple products with individual prices. <a target='_blank' class='rm-more' href='%s'>More</a>",'custom-registration-form-builder-with-submission-manager'),'https://registrationmagic.com/knowledgebase/add-product/#htprodpricetype'),
                        'userdef'=>sprintf(__("Allows user to enter his/ her own price for product with the form. Useful for accepting donations etc. <a target='_blank' class='rm-more' href='%s'>More</a>",'custom-registration-form-builder-with-submission-manager'),'https://registrationmagic.com/knowledgebase/add-product/#htprodpricetype'),
                        'price_default'=>__("Define how the product will be priced.",'custom-registration-form-builder-with-submission-manager')
        );
        wp_localize_script('rm-utilities','utilities_vars',$utilities_vars);
        wp_enqueue_script('rm-utilities');
        
        wp_register_script('rm-formflow', plugin_dir_url(__FILE__) . 'js/script_rm_formflow.js', array(), $this->version, false);
        $formflow_vars= array(
                         'copied'=>__("Copied",'custom-registration-form-builder-with-submission-manager'),
                         'copy'=>__("Copy",'custom-registration-form-builder-with-submission-manager')
        );
        wp_localize_script('rm-formflow','formflow_vars',$formflow_vars);
        
        wp_register_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/script_rm_admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-sortable', 'jquery-ui-tabs', 'jquery-ui-datepicker'), $this->version, false);
        $rm_admin_vars= array(
                        'user_deletion_warning'=>__("Are you sure, you want to delete the selected Users?",'custom-registration-form-builder-with-submission-manager'),
        );
        wp_localize_script($this->plugin_name,'rm_admin_vars',$rm_admin_vars);
        wp_enqueue_script($this->plugin_name);
        
        wp_enqueue_script('google_charts', 'https://www.gstatic.com/charts/loader.js');
        wp_enqueue_script('rm-rating', plugin_dir_url(__FILE__) . 'js/rating3/jquery.rateit.js', array(), $this->version, false);
        wp_register_script('script_rm_formcard_menu', RM_BASE_URL . 'admin/js/script_rm_formcard_menu.js', array($this->plugin_name), $this->version, false);
        wp_register_script('script_rm_angular', RM_BASE_URL . 'admin/js/angular.min.js', array($this->plugin_name), $this->version, false);
    }

    /**
     * Registers menu pages and submenu pages at the admin area.
     *
     * @since    1.0.0
     */
    public function add_menu() {
        if (current_user_can('manage_options'))
        {
            global  $rm_env_requirements;
             $gopts = new RM_Options();
           $service = new RM_Setting_Service();
            if(!RM_Utilities::fatal_errors())
            {
                global $submenu;
                
                add_menu_page(RM_UI_Strings::get('ADMIN_MENU_REG'), RM_UI_Strings::get('ADMIN_MENU_REG'), "manage_options", "rm_form_manage", array($this->get_controller(), 'run'), plugins_url('../images/profile-icon2.png', __FILE__), 26);
                //add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_NEWFORM_PT'), RM_UI_Strings::get('ADMIN_MENU_NEWFORM'), "manage_options", "rm_form_add", array($this->get_controller(), 'run'));
                //add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_NEWFORM_PT'), RM_UI_Strings::get('ADMIN_MENU_NEWFORM_PT'), "manage_options", "rm_form_manage&create_new_form", "__return_null");
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_NEWFORM_PT'), RM_UI_Strings::get('ADMIN_MENU_NEWFORM_PT'), "manage_options", "rm_form_sett_general", array($this->get_controller(), 'run'));
                add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_SUBS'), RM_UI_Strings::get('ADMIN_MENU_SUBS'), "manage_options", "rm_submission_manage", array($this->get_controller(), 'run'));
                add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_ATTS'), RM_UI_Strings::get('ADMIN_MENU_ATTS'), "manage_options", "rm_attachment_manage", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_MNG_FIELDS_PT'), RM_UI_Strings::get('ADMIN_MENU_MNG_FIELDS_PT'), "manage_options", "rm_field_manage", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_ADD_FIELD_PT'), RM_UI_Strings::get('ADMIN_MENU_ADD_FIELD_PT'), "manage_options", "rm_field_add", array($this->get_controller(), 'run'));
                add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_FORM_STATS'), RM_UI_Strings::get('ADMIN_MENU_FORM_STATS'), "manage_options", "rm_analytics_show_form", array($this->get_controller(), 'run'));
                add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_FIELD_STATS'), RM_UI_Strings::get('ADMIN_MENU_FIELD_STATS'), "manage_options", "rm_analytics_show_field", array($this->get_controller(), 'run'));
                do_action("rm_admin_menu_after_field_stats");
                add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_INV'), RM_UI_Strings::get('ADMIN_MENU_INV'), "manage_options", "rm_invitations_manage", array($this->get_controller(), 'run'));
                
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_ADD_PP_FIELD_PT'), RM_UI_Strings::get('ADMIN_MENU_ADD_PP_FIELD_PT'), "manage_options", "rm_paypal_field_add", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_PP_PROC_PT'), "", "manage_options", "rm_paypal_proc", array($this->get_controller(), 'run'));                
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_ATT_DL_PT'), RM_UI_Strings::get('ADMIN_MENU_ATT_DL_PT'), "manage_options", "rm_attachment_download", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_VIEW_SUB_PT'), RM_UI_Strings::get('ADMIN_MENU_VIEW_SUB_PT'), "manage_options", "rm_submission_view", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_VIEW_SUB_RELATED'), RM_UI_Strings::get('ADMIN_MENU_VIEW_SUB_RELATED'), "manage_options", "rm_submission_related", array($this->get_controller(), 'run'));
                
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_SENT_MAILS'), RM_UI_Strings::get('ADMIN_MENU_SENT_MAILS'), "manage_options", "rm_sent_emails_manage", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_SENT_MAILS'), RM_UI_Strings::get('ADMIN_MENU_SENT_MAILS'), "manage_options", "rm_sent_emails_view", array($this->get_controller(), 'run'));

                //Sub menu for User role section 8th March 2016
                add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_USERS'), RM_UI_Strings::get('ADMIN_MENU_USERS'), "manage_options", "rm_user_manage", array($this->get_controller(), 'run'));
                add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_ROLES'), RM_UI_Strings::get('ADMIN_MENU_ROLES'), "manage_options", "rm_user_role_manage", array($this->get_controller(), 'run'));
                
                add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_PRICE'), RM_UI_Strings::get('ADMIN_MENU_PRICE'), "manage_options", "rm_paypal_field_manage", array($this->get_controller(), 'run'));
                /* Option menues */
                add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_SETTINGS'), RM_UI_Strings::get('ADMIN_MENU_SETTINGS'), "manage_options", "rm_options_manage", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_SETTING_GEN_PT'), RM_UI_Strings::get('ADMIN_MENU_SETTING_GEN_PT'), "manage_options", "rm_options_general", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_SETTING_FAB_PT'), RM_UI_Strings::get('ADMIN_MENU_SETTING_FAB_PT'), "manage_options", "rm_options_fab", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_SETTING_AS_PT'), RM_UI_Strings::get('ADMIN_MENU_SETTING_GEN_PT'), "manage_options", "rm_options_security", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_SETTING_UA_PT'), RM_UI_Strings::get('ADMIN_MENU_SETTING_UA_PT'), "manage_options", "rm_options_user", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_SETTING_AR_PT'), RM_UI_Strings::get('ADMIN_MENU_SETTING_TP_PT'), "manage_options", "rm_options_autoresponder", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_SETTING_TP_PT'), RM_UI_Strings::get('ADMIN_MENU_SETTING_TP_PT'), "manage_options", "rm_options_thirdparty", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_SETTING_PP_PT'), RM_UI_Strings::get('ADMIN_MENU_SETTING_PP_PT'), "manage_options", "rm_options_payment", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_SETTING_PP_PT'), RM_UI_Strings::get('ADMIN_MENU_SETTING_PP_PT'), "manage_options", "rm_options_default_pages", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_SETTING_SAVE_PT'), RM_UI_Strings::get('ADMIN_MENU_SETTING_SAVE_PT'), "manage_options", "rm_options_save", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_ADD_NOTE_PT'), RM_UI_Strings::get('ADMIN_MENU_ADD_NOTE_PT'), "manage_options", "rm_note_add", array($this->get_controller(), 'run'));

                /* End of settings */
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_IMPORT'), RM_UI_Strings::get('ADMIN_MENU_FS_IMPORT'), "manage_options", "rm_form_import", array($this->get_controller(), 'run'));
                
                //add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_FRONTEND'), RM_UI_Strings::get('ADMIN_MENU_FRONTEND'), "manage_options", "rm_support_frontend", array($this->get_controller(), 'run'));
                add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_SUPPORT'), RM_UI_Strings::get('ADMIN_MENU_SUPPORT'), "manage_options", "rm_support_forum", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_USER_ROLE_DEL_PT'), RM_UI_Strings::get('ADMIN_MENU_USER_ROLE_DEL_PT'), "manage_options", "rm_user_role_delete", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_REG_PT'), RM_UI_Strings::get('ADMIN_MENU_REG_PT'), "manage_options", "rm_user_view", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_CC_PT'), RM_UI_Strings::get('ADMIN_MENU_FS_CC_PT'), "manage_options", "rm_form_sett_ccontact", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_AW_PT'), RM_UI_Strings::get('ADMIN_MENU_FS_AW_PT'), "manage_options", "rm_form_sett_aweber", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_OV_PT'), RM_UI_Strings::get('ADMIN_MENU_FS_OV_PT'), "manage_options", "rm_form_sett_override", array($this->get_controller(), 'run'));
                
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_AR_PT'), RM_UI_Strings::get('ADMIN_MENU_FS_AR_PT'), "manage_options", "rm_form_sett_autoresponder", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_ET_PT'), RM_UI_Strings::get('ADMIN_MENU_FS_ET_PT'), "manage_options", "rm_form_sett_email_templates", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_LIM_PT'), RM_UI_Strings::get('ADMIN_MENU_FS_LIM_PT'), "manage_options", "rm_form_sett_limits", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_PST_SUB_PT'), RM_UI_Strings::get('ADMIN_MENU_FS_PST_SUB_PT'), "manage_options", "rm_form_sett_post_sub", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_ACC_PT'), RM_UI_Strings::get('ADMIN_MENU_FS_ACC_PT'), "manage_options", "rm_form_sett_accounts", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_VIEW_PT'), RM_UI_Strings::get('ADMIN_MENU_FS_VIEW_PT'), "manage_options", "rm_form_sett_view", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_MC_PT'), RM_UI_Strings::get('ADMIN_MENU_FS_MC_PT'), "manage_options", "rm_form_sett_mailchimp", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_PT'), RM_UI_Strings::get('ADMIN_MENU_FS_PT'), "manage_options", "rm_form_sett_manage", array($this->get_controller(), 'run'));
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_FS_ACTRL_PT'), RM_UI_Strings::get('ADMIN_MENU_FS_ACTRL_PT'), "manage_options", "rm_form_sett_access_control", array($this->get_controller(), 'run'));
                
                add_submenu_page("rm_form_manage", RM_UI_Strings::get('ADMIN_MENU_PREMIUM'), "<div style='color:#ff6c6c;'>".RM_UI_Strings::get('ADMIN_MENU_PREMIUM')."</div>", "manage_options", "rm_support_premium_page", array($this->get_controller(), 'run'));
               
//                add_submenu_page("","What's New!","What's New", "manage_options", "rm_whats_new", array($this, 'show_whatsnew'));
                $submenu['rm_form_manage'][0][0] = RM_UI_Strings::get('ADMIN_SUBMENU_REG');
                add_submenu_page("", RM_UI_Strings::get('ADMIN_MENU_ADD_FIELD_PT'), RM_UI_Strings::get('ADMIN_MENU_ADD_FIELD_PT'), "manage_options", "rm_field_add_widget", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Advance Options', 'Advance Options', "manage_options", "rm_options_advance", array($this->get_controller(), 'run'));
                
                add_submenu_page("", 'Login Fields', 'Login Fields', "manage_options", "rm_login_field_manage", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Login Fields', 'Login Fields', "manage_options", "rm_login_field_add", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Login Fields', 'Login Fields', "manage_options", "rm_login_field_view_sett", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Logged in View', 'Logged in View', "manage_options", "rm_login_view", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Login Dashboard', 'Login Dashboard', "manage_options", "rm_login_sett_manage", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Login Redirections', 'Login Redirections', "manage_options", "rm_login_sett_redirections", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Login Validation & Security', 'Login Validation & Security', "manage_options", "rm_login_val_sec", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Password Recovery', 'Password Recovery', "manage_options", "rm_login_recovery", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Email Templates', 'Email Templates', "manage_options", "rm_login_email_temp", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Two Factor Authentication', 'Two Factor Authentication', "manage_options", "rm_login_two_factor_auth", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Third Part Integrations', 'Third Part Integrations', "manage_options", "rm_login_integrations", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Login Analytics', 'Login Analytics', "manage_options", "rm_login_analytics", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Log Retention', 'Log Retention', "manage_options", "rm_login_retention", array($this->get_controller(), 'run'));
                add_submenu_page("", 'Advanced Log', 'Advanced Log', "manage_options", "rm_login_advanced", array($this->get_controller(), 'run'));
                
            }
            else
            {
                add_menu_page(RM_UI_Strings::get('ADMIN_MENU_REG'), RM_UI_Strings::get('ADMIN_MENU_REG'), "manage_options", "rm_form_manage", array($this, 'fatal_error_message_display'), plugins_url('../images/profile-icon2.png', __FILE__), 26);
            }
        }
    }
    
    //To disaply errors on menu page. Such as SimplXML extension not available or PHP version.
    public function fatal_error_message_display()
    {        
        include_once RM_ADMIN_DIR.'views/template_rm_cant_continue.php';
    }

    public function add_dashboard_widget()
    {
        //Dashboard widget is for admin users only.
        if (current_user_can('manage_options'))
        {
            wp_add_dashboard_widget(
                    'rm_dashboard_widget_display', // Widget slug.
                    RM_UI_Strings::get('TITLE_DASHBOARD_WIDGET'), // Title.
                    array($this, 'dashboard_widget_display_function')
            );
        }
    }

    public function dashboard_widget_display_function() {
        $xml_loader = RM_XML_Loader::getInstance(RM_INCLUDES_DIR . 'rm_config.xml');

        $request = new RM_Request($xml_loader);
        $request->setReqSlug('rm_dashboard_widget_display', true);

        $params = array('request' => $request, 'xml_loader' => $xml_loader);
        $this->controller = new RM_Main_Controller($params);
        $this->controller->run();
    }

    public function user_edit_page_widget($user) {
        $xml_loader = RM_XML_Loader::getInstance(RM_INCLUDES_DIR . 'rm_config.xml');

        $request = new RM_Request($xml_loader);
        $request->setReqSlug('rm_user_widget', true);

        $params = array('request' => $request, 'xml_loader' => $xml_loader, 'user' => $user);
        $this->controller = new RM_Main_Controller($params);
        $this->controller->run();
    }

    function add_new_form_editor_button() {
        if (is_admin()) {
            $screen = get_current_screen();
            if ($screen->base == 'post') {
                $xml_loader = RM_XML_Loader::getInstance(RM_INCLUDES_DIR . 'rm_config.xml');

                $request = new RM_Request($xml_loader);
                $request->setReqSlug('rm_editor_actions_add_form', true);

                $params = array('request' => $request, 'xml_loader' => $xml_loader);
                $this->controller = new RM_Main_Controller($params);
                $this->controller->run();
            }
        }
    }

    function add_field_autoresponder() {
        if (is_admin()) {
            $screen = get_current_screen();
            if ($screen->base == 'admin_page_rm_form_sett_autoresponder') {
                if (self::$editor_counter == 1) {
                    $xml_loader = RM_XML_Loader::getInstance(RM_INCLUDES_DIR . 'rm_config.xml');

                    $request = new RM_Request($xml_loader);
                    $request->setReqSlug('rm_editor_actions_add_email', true);

                    $params = array('request' => $request, 'xml_loader' => $xml_loader);
                    $this->controller = new RM_Main_Controller($params);
                    $this->controller->run();
                }

                self::$editor_counter = self::$editor_counter + 1;
            } elseif ($screen->base == 'registrationmagic_page_rm_invitations_manage') {
                $xml_loader = RM_XML_Loader::getInstance(RM_INCLUDES_DIR . 'rm_config.xml');

                $request = new RM_Request($xml_loader);
                $request->setReqSlug('rm_editor_actions_add_fields_dropdown_invites', true);

                $params = array('request' => $request, 'xml_loader' => $xml_loader);
                $this->controller = new RM_Main_Controller($params);
                $this->controller->run();
            }
        }
    }
    
    
    
    public function remove_queue()
    {
        $inv_service = new RM_Invitations_Service;
        $form_id= $_POST['form_id'];
        
        $inv_service->remove_queue($form_id);
        
        wp_die();
    }
    
    public function update_submit_field_config()
    {
        if(!current_user_can('manage_options'))
            wp_die;
        
        $service = new RM_Services;
        $form_id= $_POST['form_id'];
        $config = $_POST['data'];
        $service->update_submit_field_config($form_id, $config);
        
        wp_die();
    }
    
    public function update_login_button_config()
    {  
        if(!current_user_can('manage_options'))
            wp_die();
        
        $service = new RM_Login_Service();
        $config = $_POST['data'];
        $data= array();
        $data['register_btn']= sanitize_text_field($config['register_btn_label']);
        $data['login_btn']= sanitize_text_field($config['login_btn_label']);
        $data['align']= sanitize_text_field($config['btn_align']);
        $data['display_register']= absint($config['display_register']);
        $service->update_button_config($data);
        wp_die();
    }
    
    public function add_version_header() {      
        ?>
        <style>
          .rmagic::before {content:"v<?php echo RM_PLUGIN_VERSION; ?> Standard";}
          .rmagic.rm-hide-version-number::before { display:none}
        </style>
        <?php
    }
    
     public function feedback_dialog()
    {
        if(!is_admin())
            return;
        
        $screen = get_current_screen();
        
        if(!isset($screen->id))
            return;
        
        if (!in_array($screen->id, array('plugins', 'plugins-network' )))
            return;
       include_once RM_ADMIN_DIR.'views/template_rm_plugin_feedback_dialog.php';
    }
    
    
    public function show_whatsnew(){
        include RM_ADMIN_DIR.'views/template_rm_whats_new.php';
    }  
   
    
    public function post_feedback(){
        $msg= $_POST['msg'];
        $feedback= $_POST['feedback'];
        $body= '';
        switch($feedback)
        {
            case 'feature_not_available': $body='Feature not available: '; break;
            case 'feature_not_working': $body='Feature not working: '; break;
            case 'found_a_better_plugin': $body='Found a better plugin: '; break;
            case 'plugin_broke_site': $body='Plugin broke my site.'; break;
            case 'plugin_stopped_working': $body='Plugin stopped working'; break;
            case 'temporary_deactivation': return;
            case 'upgrade':  $body='Upgrading to premium '; break;   
            case 'other': $body='Other: '; break;
            default: return;
        }
        if(trim($feedback)!=''){
            $body .= '<p>'.$msg.'</p>';
            $body .= '<p>RegistrationMagic Standard - version '.RM_PLUGIN_VERSION.'</p>';
            RM_Utilities::quick_email('feedback@registrationmagic.com', 'RM Feedback', $body,RM_EMAIL_GENERIC,array('do_not_save'=>true));
        }   
        wp_die();
    }
    
    public function upload_template(){
       if($_FILES){
               $name=get_temp_dir().'RMagic.xml';
               if(is_array($_FILES['file']['tmp_name']))
               $status= move_uploaded_file ( $_FILES['file']['tmp_name']['0'] , $name );
               else
               $status= move_uploaded_file ( $_FILES['file']['tmp_name'], $name );    
               echo json_encode(array('success'=>$status));
        }
        else
        {
            echo json_encode(array('success'=>false));
        }
        wp_die();
    }
    
    public function fcm_update_form()
    {
        if(!current_user_can('manage_options'))
            wp_die();
        
        $service = new RM_Services;
        $form_id= $_POST['form_id'];
        $data = $_POST['data'];
        $service->fcm_update_form($form_id, $data);
        
        wp_die();
    }
    
    public function admin_notices(){ 
        /* Showing noticed for WooCommerce and EDD integration */
        $g_opts= new RM_Options();
        if(!empty($_GET['rm_disable_edd_notice'])){
            $g_opts->set_value_of('edd_notice', 0);
        }
        if(!empty($_GET['rm_disable_wc_notice'])){
            $g_opts->set_value_of('wc_notice', 0);
        }

        $edd_notice= $g_opts->get_value_of('edd_notice');
        $wc_notice= $g_opts->get_value_of('wc_notice');
        $query_string= $_SERVER['QUERY_STRING'];
        if(empty($query_string)){
            $query_string= '?';
        }
        else
        {
            $query_string= '?'.$query_string.'&';
        }

       ?>
        <?php if($edd_notice!=0 &&  class_exists( 'Easy_Digital_Downloads')): ?>
            <div class="rm_admin_notice rm-notice-banner notice notice-success is-dismissible">
                <p><?php printf(__( 'Using Easy Digital Downloads? <a target="__blank" href="%s">Learn how to</a> create intelligent support forms for your products using RegistrationMagic which display customer order history and details with the form submission.','custom-registration-form-builder-with-submission-manager'),'https://registrationmagic.com/create-super-intelligent-forms-wordpress/'); ?><a class="rm_dismiss" href="<?php echo $query_string.'rm_disable_edd_notice=1' ?>"><?php _e('Dismiss','custom-registration-form-builder-with-submission-manager'); ?></a></p>
            </div>
        <?php endif; ?>

        <?php if($wc_notice!=0 && class_exists( 'WooCommerce' )): ?>
            <div class="rm_admin_notice rm-notice-banner notice notice-success is-dismissible">
                <p><?php printf(__( 'Using WooCommerce? <a target="__blank" href="%s">Learn how to</a> create intelligent contact forms for your products using RegistrationMagic which display customer order history with the form submission.','custom-registration-form-builder-with-submission-manager'),'https://registrationmagic.com/create-super-intelligent-forms-wordpress/'); ?><a class="rm_dismiss" href="<?php echo $query_string.'rm_disable_wc_notice=1' ?>"><?php _e('Dismiss','custom-registration-form-builder-with-submission-manager'); ?></a></p>
            </div>
        <?php endif; ?>
       <?php   
            
    }
    
    public function disable_login_popup(){
        if (!current_user_can('manage_options')) {
            wp_send_json_error(array('msg'=>__('You are not allowed','registrationmagic-gold')));
        }
        
        $g_opt= new  RM_Options();
        $value= absint($_POST['value']);
        $g_opt->set_value_of('disable_login_popup', $value);
        delete_option('rm_option_upgraded');
        wp_send_json_success(array('msg'=>__('Option value updated.','registrationmagic-gold')));
    }
}
