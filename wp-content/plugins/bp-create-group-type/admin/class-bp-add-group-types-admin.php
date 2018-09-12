<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wbcomdesigns.com/
 * @since      1.0.0
 *
 * @package    Bp_Add_Group_Types
 * @subpackage Bp_Add_Group_Types/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bp_Add_Group_Types
 * @subpackage Bp_Add_Group_Types/admin
 * @author     Wbcom Designs <admin@wbcomdesigns.com>
 */
class Bp_Add_Group_Types_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->bpgt_save_general_settings();
		$this->bpgt_save_group_types();
		$this->bpgt_save_type_display_settings();
		$this->bpgt_save_group_type_search_settings();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bp_Add_Group_Types_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bp_Add_Group_Types_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ( strpos( filter_input( INPUT_SERVER, 'REQUEST_URI' ), 'bp-add-group-types' ) !== false ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bp-add-group-types-admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bp_Add_Group_Types_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bp_Add_Group_Types_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ( strpos( filter_input( INPUT_SERVER, 'REQUEST_URI' ), 'bp-add-group-types' ) !== false ) {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bp-add-group-types-admin.js', array( 'jquery' ), $this->version, false );
		}
	}

	/**
	 * Register a submenu to handle group types
	 *
	 * @since    1.0.0
	 */
	public function bpgt_add_submenu_page() {
		add_menu_page( __( 'Group Types Settings', 'bp-add-group-types' ), __( 'Group Types', 'bp-add-group-types' ), 'manage_options', $this->plugin_name, array( $this, 'bpgt_admin_settings_page' ), 'dashicons-groups', 59 );
	}
	/**
	 * Actions performed to create a submenu page content
	 */
	public function bpgt_admin_settings_page() {
		$tab = ( filter_input( INPUT_GET, 'tab' ) !== null ) ? filter_input( INPUT_GET, 'tab' ) : $this->plugin_name;
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'Group Types - BuddyPress', 'bp-add-group-types' ); ?></h2>
			<?php $this->bpgt_plugin_settings_tabs(); ?>
			<?php do_settings_sections( $tab ); ?>
		</div>
		<?php
	}

	/**
	 * Actions performed to create tabs on the sub menu page
	 */
	public function bpgt_plugin_settings_tabs() {
		$current_tab = ( filter_input( INPUT_GET, 'tab' ) !== null ) ? filter_input( INPUT_GET, 'tab' ) : $this->plugin_name;
		echo '<h2 class="nav-tab-wrapper">';
		foreach ( $this->plugin_settings_tabs as $tab_key => $tab_caption ) {
			$active = $current_tab === $tab_key ? 'nav-tab-active' : '';
			echo '<a class="nav-tab ' . esc_attr( $active ) . '" id="' . esc_attr( $tab_key ) . '-tab" href="?page=' . esc_attr( $this->plugin_name ) . '&tab=' . esc_attr( $tab_key ) . '">' . esc_attr( $tab_caption ) . '</a>';
		}
		echo '</h2>';
	}

	/**
	 * General Tab
	 */
	public function bpgt_register_general_settings() {
		$this->plugin_settings_tabs['bpgt-general'] = __( 'General', 'bp-add-group-types' );
		register_setting( 'bpgt-general', 'bpgt-general' );
		add_settings_section( 'bpgt-general-section', ' ', array( &$this, 'bpgt_general_settings_content' ), 'bpgt-general' );
	}

	/**
	 * General Tab Content
	 */
	public function bpgt_general_settings_content() {
		if ( file_exists( dirname( __FILE__ ) . '/settings/bpgt-general-settings.php' ) ) {
			require_once dirname( __FILE__ ) . '/settings/bpgt-general-settings.php';
		}
	}

	/**
	 * Group Types Listing Tab
	 */
	public function bpgt_register_group_types_listing_settings() {
		$this->plugin_settings_tabs['bp-add-group-types'] = __( 'Group Types', 'bp-add-group-types' );
		register_setting( 'bp-add-group-types', 'bp-add-group-types' );
		add_settings_section( 'bp-add-group-types-section', ' ', array( &$this, 'bpgt_group_types_listing_settings_content' ), 'bp-add-group-types' );
	}

	/**
	 * Group Types Listing Tab Content
	 */
	public function bpgt_group_types_listing_settings_content() {
		if ( file_exists( dirname( __FILE__ ) . '/settings/bpgt-group-types-listing-settings.php' ) ) {
			require_once dirname( __FILE__ ) . '/settings/bpgt-group-types-listing-settings.php';
		}
	}

	/**
	 * Group Types Search Tab
	 */
	public function bpgt_register_group_type_search_settings() {
		$this->plugin_settings_tabs['bpgt-search'] = __( 'Group Type Search', 'bp-add-group-types' );
		register_setting( 'bpgt-search', 'bpgt-search' );
		add_settings_section( 'bpgt-search-enabled-section', ' ', array( &$this, 'bpgt_group_type_search_settings_content' ), 'bpgt-search' );
	}

	/**
	 * Group Types Search Tab Content
	 */
	public function bpgt_group_type_search_settings_content() {
		if ( file_exists( dirname( __FILE__ ) . '/settings/bpgt-group-type-search-settings.php' ) ) {
			require_once dirname( __FILE__ ) . '/settings/bpgt-group-type-search-settings.php';
		}
	}

	/**
	 * Support Tab
	 */
	public function bpgt_register_support_settings() {
		$this->plugin_settings_tabs['bpgt-support'] = __( 'Support', 'bp-add-group-types' );
		register_setting( 'bpgt-support', 'bpgt-support' );
		add_settings_section( 'bpgt-support-section', ' ', array( &$this, 'bpgt_support_settings_content' ), 'bpgt-support' );
	}

	/**
	 * Support Tab Content
	 */
	public function bpgt_support_settings_content() {
		if ( file_exists( dirname( __FILE__ ) . '/settings/bpgt-support-settings.php' ) ) {
			require_once dirname( __FILE__ ) . '/settings/bpgt-support-settings.php';
		}
	}

	/**
	 * Group Type Display Setting Tab
	 */
	public function bpgt_register_type_display_settings() {
		$this->plugin_settings_tabs['bpgt-type-display'] = __( 'Display Group Types', 'bp-add-group-types' );
		register_setting( 'bpgt-type-display', 'bpgt-type-display' );
		add_settings_section( 'bpgt-type-display-section', ' ', array( &$this, 'bpgt_type_display_settings_content' ), 'bpgt-type-display' );
	}

	/**
	 * Group Type Display Setting Tab Content
	 */
	public function bpgt_type_display_settings_content() {
		if ( file_exists( dirname( __FILE__ ) . '/settings/bpgt-group-type-display-settings.php' ) ) {
			require_once dirname( __FILE__ ) . '/settings/bpgt-group-type-display-settings.php';
		}
	}

	/**
	 * Save Plugin General Settings
	 */
	public function bpgt_save_general_settings() {
		global $allowedposttags;
		if ( ( filter_input( INPUT_POST, 'bpgt_submit_general_settings' ) !== null ) && wp_verify_nonce( filter_input( INPUT_POST, 'bpgt-general-settings-nonce' ), 'bpgt' ) ) {

			$group_types_pre_selected = 'no';
			if ( null !== filter_input( INPUT_POST, 'bpgt-group-types-pre-selected' ) ) {
				$group_types_pre_selected = 'yes';
			}

			$group_type_search_enabled = 'no';
			if ( null !== filter_input( INPUT_POST, 'bpgt-group-types-search-enabled' ) ) {
				$group_type_search_enabled = 'yes';
			}

			$admin_settings = array(
				'group_types_pre_selected'  => $group_types_pre_selected,
				'group_type_search_enabled' => $group_type_search_enabled,
			);

			update_site_option( 'bpgt_general_settings', $admin_settings );
			$success_msg  = "<div class='notice updated is-dismissible' id='message'>";
			$success_msg .= '<p>' . __( 'Settings Saved.', 'bp-add-group-types' ) . '</p>';
			$success_msg .= '</div>';
			echo wp_kses( $success_msg, $allowedposttags );
		}
	}

	/**
	 * Save Plugin General Settings
	 */
	public function bpgt_save_type_display_settings() {
		global $allowedposttags;
		$type_arr = array();
		if ( null !== filter_input( INPUT_POST, 'bpgt_submit_group_type_display_settings' ) ) {
			if ( isset( $_POST['bpgt_group_type_display'] ) ) {
				$type_arr = array_map( 'sanitize_text_field', wp_unslash( $_POST['bpgt_group_type_display'] ) );
			}
			update_site_option( 'bpgt_type_display_settings', $type_arr );
			$success_msg  = "<div class='notice updated is-dismissible' id='message'>";
			$success_msg .= '<p>' . __( 'Settings Saved.', 'bp-add-group-types' ) . '</p>';
			$success_msg .= '</div>';
			echo wp_kses( $success_msg, $allowedposttags );
		}
	}

	/**
	 * Save Group Types that are added
	 */
	public function bpgt_save_group_types() {
		global $allowedposttags;
		if ( ( filter_input( INPUT_POST, 'bpgt-add-group-type' ) !== null ) && wp_verify_nonce( filter_input( INPUT_POST, 'bpgt-add-group-types-nonce' ), 'bpgt-group-types' ) ) {
			$group_type_name = sanitize_text_field( filter_input( INPUT_POST, 'group-type-name' ) );

			if ( filter_input( INPUT_POST, 'group-type-slug' ) !== null ) {
				$group_type_slug = sanitize_text_field( filter_input( INPUT_POST, 'group-type-slug' ) );
			} else {
				$group_type_slug = str_replace( ' ', '', strtolower( $group_type_name ) );
			}

			$group_type_desc = '';
			if ( filter_input( INPUT_POST, 'group-type-desc' ) !== null ) {
				$group_type_desc = sanitize_text_field( filter_input( INPUT_POST, 'group-type-desc' ) );
			}

			$group_types = get_site_option( 'bpgt_group_types' );
			if ( ! is_array( $group_types ) ) {
				$group_types = array();
			}

			$flag = 0;
			if ( ! empty( $group_types ) ) {
				foreach ( $group_types as $key => $group_type ) {
					if ( $group_type_slug === $group_type['slug'] ) {
						$flag = 1;
					}
				}
			}

			if ( 0 === $flag ) {
				$group_types[] = array(
					'name' => $group_type_name,
					'slug' => $group_type_slug,
					'desc' => $group_type_desc,
				);
				update_site_option( 'bpgt_group_types', $group_types );
				$success_msg  = "<div class='notice updated is-dismissible' id='message'>";
				$success_msg .= '<p>' . __( 'Group Type Added!', 'bp-add-group-types' ) . '</p>';
				$success_msg .= '</div>';
				echo wp_kses( $success_msg, $allowedposttags );
			} else {
				$error_msg  = "<div class='notice notice-error is-dismissible' id='message'>";
				$error_msg .= '<p>' . __( 'Group Type With This Name/Slug Already Exists!', 'bp-add-group-types' ) . '</p>';
				$error_msg .= '</div>';
				echo wp_kses( $error_msg, $allowedposttags );
			}
		}
	}

	/**
	 * Ajax served to delete the group type
	 */
	public function bpgt_delete_group_type() {
		if ( ( filter_input( INPUT_POST, 'action' ) !== null ) && 'bpgt_delete_group_type' === filter_input( INPUT_POST, 'action' ) ) {
			$slug = sanitize_text_field( filter_input( INPUT_POST, 'slug' ) );

			$group_types = get_site_option( 'bpgt_group_types' );
			foreach ( $group_types as $key => $group_type ) {
				if ( $slug === $group_type['slug'] ) {
					$key_to_unset = $key;
					break;
				}
			}
			unset( $group_types[ $key_to_unset ] );
			if ( empty( $group_types ) ) {
				delete_option( 'bpgt_group_types' );
			} else {
				update_site_option( 'bpgt_group_types', $group_types );
			}

			$response = array(
				'message' => __( 'Group Type Deleted.', 'bp-add-group-types' ),
			);
			wp_send_json_success( $response );
			die;
		}
	}

	/**
	 * Ajax served to update the group type
	 */
	public function bpgt_update_group_type() {
		if ( ( filter_input( INPUT_POST, 'action' ) !== null ) && 'bpgt_update_group_type' === filter_input( INPUT_POST, 'action' ) ) {
			$new_name = sanitize_text_field( filter_input( INPUT_POST, 'new_name' ) );
			$old_slug = sanitize_text_field( filter_input( INPUT_POST, 'old_slug' ) );

			$group_types = get_site_option( 'bpgt_group_types' );
			foreach ( $group_types as $key => $group_type ) {
				if ( $old_slug === $group_type['slug'] ) {
					$key_to_update = $key;
					break;
				}
			}

			$new_group_type = array(
				'name' => $new_name,
				'slug' => sanitize_text_field( filter_input( INPUT_POST, 'new_slug' ) ),
				'desc' => sanitize_text_field( filter_input( INPUT_POST, 'new_desc' ) ),
			);

			$group_types[ $key_to_update ] = $new_group_type;
			update_site_option( 'bpgt_group_types', $group_types );

			$response = array(
				'message' => __( 'Group Type Updated.', 'bp-add-group-types' ),
			);
			wp_send_json_success( $response );
			die;
		}
	}

	/**
	 * Register all saved group types
	 */
	public function bpgt_register_group_types() {
		global $bp_grp_types;
		$create_screen_checked = false;
		if ( isset( $bp_grp_types->group_types_pre_selected ) ) {
			if ( 'yes' === $bp_grp_types->group_types_pre_selected ) {
				$create_screen_checked = true;
			}
		}
		$saved_group_types = $bp_grp_types->group_types;
		$group_types       = bp_groups_get_group_types();
		if ( ! empty( $saved_group_types ) ) {
			foreach ( $saved_group_types as $key => $saved_group_type ) {
				$slug = $saved_group_type['slug'];
				$name = $saved_group_type['name'];
				$desc = $saved_group_type['desc'];
				if ( ! in_array( $slug, $group_types, true ) ) {
					$temp = array(
						'labels'                => array(
							'name'          => $name,
							'singular_name' => $name,
						),
						'has_directory'         => strtolower( $name ),
						'show_in_create_screen' => true,
						'show_in_list'          => true,
						'description'           => $desc,
						'create_screen_checked' => $create_screen_checked,
					);
					bp_groups_register_group_type( $name, $temp );
				}
			}
		}
	}

	/**
	 * Save Plugin Group Type Search Settings
	 */
	public function bpgt_save_group_type_search_settings() {
		global $allowedposttags;
		if ( ( filter_input( INPUT_POST, 'bpgt_submit_group_type_search_settings' ) !== null ) && wp_verify_nonce( filter_input( INPUT_POST, 'bpgt-group-type-search-settings-nonce' ), 'bpgt-search-settings' ) ) {
			$group_type_search_template = 'both';
			if ( null !== filter_input( INPUT_POST, 'bpgt-group-type-search-template' ) ) {
				$group_type_search_template = sanitize_text_field( filter_input( INPUT_POST, 'bpgt-group-type-search-template' ) );
			}

			$admin_settings = array(
				'group_type_search_template' => $group_type_search_template,
			);

			update_site_option( 'bpgt_group_type_search_settings', $admin_settings );
			$success_msg  = "<div class='notice updated is-dismissible' id='message'>";
			$success_msg .= '<p>' . __( 'Settings Saved.', 'bp-add-group-types' ) . '</p>';
			$success_msg .= '</div>';
			echo wp_kses( $success_msg, $allowedposttags );
		}
	}
}
