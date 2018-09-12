<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wbcomdesigns.com/
 * @since             1.0.0
 * @package           Bp_Add_Group_Types
 *
 * @wordpress-plugin
 * Plugin Name:       BuddyPress Create Group Types
 * Plugin URI:        https://wbcomdesigns.com/
 * Description:       This plugin adds a new feature to BuddyPress, <strong>Group Types</strong>. This allows an easy <strong>categorization</strong> of <strong>BP Groups</strong>.
 * Version:           1.1.0
 * Author:            Wbcom Designs
 * Author URI:        https://wbcomdesigns.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bp-add-group-types
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define( 'BP_GROUP_TYPE_PLUGIN_BASENAME',  plugin_basename( __FILE__ ) );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bp-add-group-types-activator.php
 */
function activate_bp_add_group_types() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bp-add-group-types-activator.php';
	Bp_Add_Group_Types_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bp-add-group-types-deactivator.php
 */
function deactivate_bp_add_group_types() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bp-add-group-types-deactivator.php';
	Bp_Add_Group_Types_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bp_add_group_types' );
register_deactivation_hook( __FILE__, 'deactivate_bp_add_group_types' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bp-add-group-types.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bp_add_group_types() {

	$plugin = new Bp_Add_Group_Types();
	$plugin->run();

}

add_action( 'plugins_loaded', 'bpgt_plugin_init' );
/**
 * Check plugin requirement on plugins loaded
 * this plugin requires BuddyPress to be installed and active
 */
function bpgt_plugin_init() {
	if ( bp_group_type_check_config() ){
		run_bp_add_group_types();
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'bpgt_plugin_links' );
	}
}
function bp_group_type_check_config(){
	global $bp;
	
	$config = array(
		'blog_status'    => false, 
		'network_active' => false, 
		'network_status' => true 
	);
	if ( get_current_blog_id() == bp_get_root_blog_id() ) {
		$config['blog_status'] = true;
	}
	
	$network_plugins = get_site_option( 'active_sitewide_plugins', array() );

	// No Network plugins
	if ( empty( $network_plugins ) )

	// Looking for BuddyPress and bp-activity plugin
	$check[] = $bp->basename;
	$check[] = BP_GROUP_TYPE_PLUGIN_BASENAME;

	// Are they active on the network ?
	$network_active = array_diff( $check, array_keys( $network_plugins ) );
	
	// If result is 1, your plugin is network activated
	// and not BuddyPress or vice & versa. Config is not ok
	if ( count( $network_active ) == 1 )
		$config['network_status'] = false;

	// We need to know if the plugin is network activated to choose the right
	// notice ( admin or network_admin ) to display the warning message.
	$config['network_active'] = isset( $network_plugins[ BP_GROUP_TYPE_PLUGIN_BASENAME ] );

	// if BuddyPress config is different than bp-activity plugin
	if ( !$config['blog_status'] || !$config['network_status'] ) {

		$warnings = array();
		if ( !bp_core_do_network_admin() && !$config['blog_status'] ) {
			add_action( 'admin_notices', 'bpgt_same_blog' );
			$warnings[] = __( 'Buddypress Create Group Types requires to be activated on the blog where BuddyPress is activated.', 'bp-add-group-types' );
		}

		if ( bp_core_do_network_admin() && !$config['network_status'] ) {
			add_action( 'admin_notices', 'bpgt_same_network_config' );
			$warnings[] = __( 'BuddyPress Create Group Types and BuddyPress need to share the same network configuration.', 'bp-add-group-types' );
		}

		if ( ! empty( $warnings ) ) :
			return false;
		endif;
		$bpgs_active = in_array( 'buddypress-group-type-search/buddypress-groups-search.php', get_site_option( 'active_sitewide_plugins' ), true );
		if ( current_user_can( 'activate_plugins' ) && true === $bpgs_active ) {
			add_action( $config['network_active'] ? 'network_admin_notices' : 'admin_notices', 'bpgts_remove_plugin_admin_notice' );
		}
		if ( !bp_is_active( 'groups' ) ) {
			add_action( $config['network_active'] ? 'network_admin_notices' : 'admin_notices', 'bpgt_plugin_require_group_component_admin_notice' );
		}
		
		// Display a warning message in network admin or admin
	} 
	return true;
}

function bpgt_same_blog(){
	echo '<div class="error"><p>'
	. esc_html( __( 'BuddyPress Create Group Types requires to be activated on the blog where BuddyPress is activated.', 'bp-add-group-types' ) )
	. '</p></div>';
}

function bpgt_same_network_config(){
	echo '<div class="error"><p>'
	. esc_html( __( 'BuddyPress Create Group Types and BuddyPress need to share the same network configuration.', 'bp-add-group-types' ) )
	. '</p></div>';
}
/**
 * Function to through admin notice if BuddyPress Group Type Search is active.
 */
function bpgts_remove_plugin_admin_notice() {
	$bpgt_plugin  = 'BuddyPress Create Group Types';
	$bpgts_plugin = 'BuddyPress Group Type Search';

	echo '<div class="error"><p>'
	. sprintf( esc_html( __( '%1$s do not require %2$s to be installed and active as it contains functions of %3$s plugin.', 'bp-add-group-types' ) ), '<strong>' . esc_html( $bpgt_plugin ) . '</strong>', '<strong>' . esc_html( $bpgts_plugin ) . '</strong>', '<strong>' . esc_html( $bpgts_plugin ) . '</strong>' )
	. '</p></div>';
}

/**
 * Function to through admin notice if BuddyPress is not active.
 */
function bpgt_plugin_admin_notice() {
	$bpgt_plugin = 'BuddyPress Create Group Types';
	$bp_plugin   = 'BuddyPress';
	echo '<div class="error"><p>'
	. sprintf( esc_html( __( '%1$s is ineffective as it requires %2$s to be installed and active.', 'bp-add-group-types' ) ), '<strong>' . esc_html( $bpgt_plugin ) . '</strong>', '<strong>' . esc_html( $bp_plugin ) . '</strong>' )
	. '</p></div>';
	if ( null !== filter_input( INPUT_GET, 'activate' ) ) {
		$activate = filter_input( INPUT_GET, 'activate' );
			unset( $activate );
	}
}

/**
 * Function to through admin notice if BuddyPress group components is not active.
 */
function bpgt_plugin_require_group_component_admin_notice() {
	$bpgt_plugin  = 'BuddyPress Create Group Types';
	$bp_component = 'Groups Component';
		if( !bp_is_active( 'groups' ) ){
			echo '<div class="error"><p>'
		. sprintf( esc_html( __( '%1$s is ineffective now as it requires %2$s to be active.', 'bp-add-group-types' ) ), '<strong>' . esc_html( $bpgt_plugin ) . '</strong>', '<strong>' . esc_html( $bp_component ) . '</strong>' )
		. '</p></div>';
		if ( null !== filter_input( INPUT_GET, 'activate' ) ) {
			$activate = filter_input( INPUT_GET, 'activate' );
			unset( $activate );
		}
	}
}

/**
 * Function to set plugin action links.
 *
 * @param array $links Plugin settings links array.
 */
function bpgt_plugin_links( $links ) {
	$bpgt_links = array(
		'<a href="' . admin_url( 'admin.php?page=bp-add-group-types' ) . '">' . __( 'Settings', 'bp-add-group-types' ) . '</a>',
		'<a href="https://wbcomdesigns.com/contact/" target="_blank">' . __( 'Support', 'bp-add-group-types' ) . '</a>',
	);
	return array_merge( $links, $bpgt_links );
}
