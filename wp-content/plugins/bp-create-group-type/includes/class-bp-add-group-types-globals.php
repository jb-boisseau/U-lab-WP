<?php
/**
 * The file that defines the global variable of the plugin
 *
 * @link       https://wbcomdesigns.com/
 * @since      1.0.0
 *
 * @package    Bp_Add_Group_Types
 * @subpackage Bp_Add_Group_Types/includes
 * @author     Wbcom Designs <admin@wbcomdesigns.com>
 */

/**
 * The file that defines the global variable of the plugin
 *
 * @link       https://wbcomdesigns.com/
 * @since      1.0.0
 *
 * @package    Bp_Add_Group_Types
 * @subpackage Bp_Add_Group_Types/includes
 * @author     Wbcom Designs <admin@wbcomdesigns.com>
 */
class Bp_Add_Group_Types_Globals {
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Whether the group types appear as pre selected.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $group_types_pre_selected
	 */
	public $group_types_pre_selected;

	/**
	 * Enable the group type search functionality on front-end.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $group_type_search_enabled
	 */
	public $group_type_search_enabled;

	/**
	 * List of all the saved group types
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $group_types
	 */
	public $group_types;

	/**
	 * The change in the search template
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $group_type_search_template
	 */
	public $group_type_search_template;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'bp-add-group-types';
		$this->version     = '1.0.0';
		$this->setup_plugin_global();
	}

	/**
	 * Include the following files that make up the plugin:
	 *
	 * - Bp_Add_Group_Types_Globals.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function setup_plugin_global() {
		global $bp_grp_types;

		$bpgt_settings = get_site_option( 'bpgt_general_settings' );

		$this->group_types_pre_selected = 'no';
		if ( isset( $bpgt_settings['group_types_pre_selected'] ) ) {
			$this->group_types_pre_selected = $bpgt_settings['group_types_pre_selected'];
		}

		$this->group_type_search_enabled = 'no';
		if ( isset( $bpgt_settings['group_type_search_enabled'] ) ) {
			$this->group_type_search_enabled = $bpgt_settings['group_type_search_enabled'];
		}

		$this->group_types = array();
		$group_types       = get_site_option( 'bpgt_group_types' );
		if ( ! empty( $group_types ) ) {
			$this->group_types = $group_types;
		}

		$bpgt_search_settings             =get_site_option( 'bpgt_group_type_search_settings' );
		$this->group_type_search_template = 'both';
		if ( isset( $bpgt_search_settings['group_type_search_template'] ) ) {
			$this->group_type_search_template = $bpgt_search_settings['group_type_search_template'];
		}

		$bpgt_type_display_settings = get_site_option( 'bpgt_type_display_settings' );

		if ( ! is_array( $bpgt_type_display_settings ) && empty( $bpgt_type_display_settings ) ) {
			$dis_group_types      = $this->group_types;
			$display_default_type = array();
			$count                = 0;
			foreach ( $dis_group_types as $type ) {
				if ( $count < 2 ) {
					array_push( $display_default_type, $type['slug'] );
					$count++;
				}
			}
			if ( $count > 0 ) {
				update_site_option( 'bpgt_type_display_settings', $display_default_type );
			}
		}
	}
}
