<?php
/**
 * Plugin Name: LeadMagic
 * Plugin URI: https://registrationmagic.com
 * Description: Give your forms a complete makeover! Display them in all their glory with additional headlines, pitch, background and featured image, and much more. While it is designed to work with RegistrationMagic Plugin, you are free to use any other form plugin that uses shortcodes – like Contact Form 7
 * Version: 1.2.6
 * Author:  RegistrationMagic
 * Author URI: https://registrationmagic.com
 * Requires at least: 4.1
 * Tested up to: 4.7
 * Text Domain: rmlp
 * Domain Path: /languages
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}




if ( ! class_exists( 'RM_LP' ) ) :

/**
 * Main  Class.
 *
 * @class Event_Magic
 * @version	1.2.6
 */
final class RM_LP {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	public $version = '1.2.6';

	/**
	 * The single instance of the class.
	 *
	 */
	protected static $_instance = null;
	/**
	 *
	 * Ensures only one instance of plugin is loaded or can be loaded.
	 *
	 * @static
	 * @return Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 */
	public function __clone() {
                    _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'event_magic' ), $this->version );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'event_magic' ), $this->version );
	}

	/** 
	 * Constructor.
	 */
	public function __construct() {            
		$this->define_constants();
		$this->includes();  
        	$this->init_hooks();
                $this->init();
		do_action( 'rm_lp_loaded' );
	}
        
      
	/**
	 * Hook into actions and filters.
	 */
	private function init_hooks() {
                    register_activation_hook( __FILE__, array( 'RMLP_Install', 'install' ) );   
             
	}

	/**
	 * Define  Constants.
	 */
	private function define_constants() {
		$upload_dir = wp_upload_dir();
                $this->define('RMLP_TEXT_DOMAIN','rmlp');
                $this->define('RMLP_POST_TYPE','rmlp');
                $this->define('RMLP_DB_VERSION','rmlp_db_version');
                $this->define('RMLP_PAGINATION_LIMIT',8);
                $this->define('RMLP_META_PREFIX','rmlp_');
                $this->define('RMLP_BASE_URL', plugin_dir_url(__FILE__));
                $this->define('RMLP_PUB_IMG_URL', plugin_dir_url(__FILE__).'includes/templates/css/images/');
                $this->define('RMLP_BASE_DIR', plugin_dir_path(__FILE__));
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param  string $name
	 * @param  string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * What type of request is this?
	 * string $type ajax, frontend or admin.
	 *
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'ajax' :
				return defined( 'DOING_AJAX' );
			case 'cron' :
				return defined( 'DOING_CRON' );
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {
                include_once('includes/class-rmlp-ui-strings.php');
                include_once('includes/class-rmlp-constants.php');
                include_once('includes/core/class-rmlp-utility.php');
                include_once('includes/admin/class-rm-form-manager.php');
                if($this->is_request('admin'))
                    include_once( 'includes/admin/class-rmlp-admin.php' );
                else
                    include_once('includes/class-rmlp-public.php');
                
		include_once( 'includes/class-rmlp-install.php' );  
                include_once( 'includes/class-rmlp-post-types.php' ); 
                include_once( 'includes/core/class-rmlp-validator.php' );
                include_once('includes/core/class-rmlp-i18.php');
	}

	/**
	 * Init when WordPress Initialises.
	 */
	public function init() {
		// Before init action.
            
		do_action( 'before_rmlp_init' );

		// Set up localisation.
		$this->load_plugin_textdomain();

		// Init action.
		do_action( 'rmlp_init' );
           
	}
        
        
	/**
	 * Load Localisation files.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/rm-events/rm-events-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/rm-events-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
            $rmlp_i18n = new RMLP_i18n();
          
            $rmlp_i18n->load_plugin_textdomain();
	}
}

endif;

/**
 * Main instance.
 */
function get_rm_lp_instance() {
	return RM_LP::instance();
}




function rm_installation() {
    $user_id = get_current_user_id();
  $all_plugins =get_plugins();
  $rm_basic = 'custom-registration-form-builder-with-submission-manager/registration_magic.php';
  $rm_premium = 'registrationmagic-gold/registration_magic.php';
  
  // echo'<pre>';  print_r($all_plugins); die;
    if(!get_user_meta( $user_id, 'dismiss_lm_notice' ) && 
            (!isset($all_plugins[$rm_basic]) &&
                    !isset($all_plugins[$rm_premium]))){
           
         $plugin_slug= 'custom-registration-form-builder-with-submission-manager';
    $installUrl = admin_url('update.php?action=install-plugin&plugin=' . $plugin_slug);
    $installUrl = wp_nonce_url($installUrl, 'install-plugin_' . $plugin_slug);
    ?>
<div class="notice ">
    <p>
        <?php _e( "LeadMagic provides integration with RegistrationMagic as well. You can install it  from <a href='".$installUrl."'>Here</a>.", '' ) ;
        ?>
        <a href="?my-plugin-dismissed">Dismiss</a>
    </p>
</div>
    <?php
    }
   
    else if ( !get_user_meta( $user_id, 'dismiss_lm_notice' ) && !class_exists('Registration_Magic') ) {
  ?>
    
        <div class="notice ">
    <p>
        <?php _e( "LeadMagic provides integration with RegistrationMagic as well. Activate it.", '' ) ;
        ?>
        <a href="?my-plugin-dismissed">Dismiss</a>
    </p>
</div>
        

    
    <?php
    }
  
    else{
        ?>

<?php
    }
   
 }

$GLOBALS['rmlp'] = get_rm_lp_instance();
add_action('admin_notices', 'rm_installation');

function lm_notice_dismissed() {
 
    $user_id = get_current_user_id();
    if ( isset( $_GET['my-plugin-dismissed'] ) ){
        $redirect = self_admin_url().'plugins.php?plugin_status=all&paged=1&s'; 
      //var_dump($_GET['my-plugin-dismissed']) ;die('n');
    add_user_meta( $user_id, 'dismiss_lm_notice', 'true', true );
    header("Location:". $redirect);
    
    }
}
add_action( 'admin_init', 'lm_notice_dismissed' );
