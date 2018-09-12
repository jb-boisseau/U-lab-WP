<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wbcomdesigns.com/
 * @since      1.0.0
 *
 * @package    Bp_Add_Group_Types
 * @subpackage Bp_Add_Group_Types/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bp_Add_Group_Types
 * @subpackage Bp_Add_Group_Types/public
 * @author     Wbcom Designs <admin@wbcomdesigns.com>
 */
class Bp_Add_Group_Types_Public {

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
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bp-add-group-types-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bp-add-group-types-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script(
			$this->plugin_name,
			'bpgt_front_js_object',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	/**
	 * Change the group search template.
	 *
	 * @param string $search_form_html The seach form html.
	 * @since    1.0.0
	 */
	public function bpgt_modified_group_search_form( $search_form_html ) {
		global $bp_grp_types;
		if ( isset( $bp_grp_types->group_type_search_template ) && 'textbox' === $bp_grp_types->group_type_search_template ) {
			$search_form_html = $search_form_html;
		} else {
			$group_types       = bp_groups_get_group_types( array(), 'objects' );
			$group_select_html = '';
			if ( ! empty( $group_types ) && is_array( $group_types ) ) {
				$group_select_html .= '<div class="bpgt-groups-search-group-type"><select class="bpgt-groups-search-group-type">';
				$group_select_html .= '<option value="">' . __( 'All Types', 'bp-add-group-types' ) . '</option>';
				foreach ( $group_types as $group_type_slug => $group_type ) {
					$group_select_html .= '<option value="' . $group_type_slug . '">' . $group_type->labels['name'] . '</option>';
				}
				$group_select_html .= '</select></div>';
			}

			if ( isset( $bp_grp_types->group_type_search_template ) && 'both' === $bp_grp_types->group_type_search_template ) {
				$search_html       = $search_form_html;
				$search_form_html  = '';
				$search_form_html .= $group_select_html;
				$search_form_html .= $search_html;
			} else {
				$search_form_html = $group_select_html;
			}
		}
		return $search_form_html;
	}

	/**
	 * Change the group search template.
	 *
	 * @param string $bp_ajax_querystring The seach form html.
	 * @param string $object The seach form html.
	 * @since    1.0.0
	 */
	public function bpgt_alter_bp_ajax_querystring( $bp_ajax_querystring, $object ) {
		global $bp;
		$object       = filter_input( INPUT_POST, 'object' );
		$query_extras = filter_input( INPUT_POST, 'extras' );
		$scope        = filter_input( INPUT_POST, 'scope' );
		if ( ( null !== $object ) && ( 'groups' === $object ) && ( null !== $query_extras ) && ! empty( $query_extras ) ) {
			parse_str( $query_extras, $extras );
			if ( ! empty( $extras ) && is_array( $extras ) ) {
				if ( ! empty( $extras['group_type'] ) ) {
					$bp_ajax_querystring = add_query_arg( 'group_type', $extras['group_type'], $bp_ajax_querystring );
					if ( ! empty( $scope ) && 'all' !== $scope ) {
						if ( 'all' !== $extras['group_type'] && ! empty( $extras['group_type'] ) ) {
							$allgroups = groups_get_groups();
							if ( ! empty( $allgroups ) && array_key_exists( 'groups', $allgroups ) ) {
								$include_groups = array();
								$exclude_groups = array();
								foreach ( $allgroups['groups'] as $group ) {
									$group_type = (array) bp_groups_get_group_type( $group->id, false );
									if ( ! empty( $group_type ) && is_array( $group_type ) ) {
										if ( in_array( $extras['group_type'], $group_type, true ) && in_array( $scope, $group_type, true ) ) {
											array_push( $include_groups, $group->id );
										}
									}
									array_push( $exclude_groups, $group->id );
								}

								if ( ! empty( $include_groups ) ) {
									$include_groups      = implode( ',', $include_groups );
									$bp_ajax_querystring = add_query_arg( 'include', $include_groups, $bp_ajax_querystring );
								} elseif ( ! empty( $exclude_groups ) ) {
									$exclude_groups      = implode( ',', $exclude_groups );
									$bp_ajax_querystring = add_query_arg( 'exclude', $exclude_groups, $bp_ajax_querystring );
								}
							}
						}
					}
				}
			}
		}
		return $bp_ajax_querystring;
	}


	/**
	 * Ajax served to search groups
	 */
	public function bpgt_search_groups() {
		if ( ( null !== filter_input( INPUT_POST, 'action' ) ) && 'bpgt_search_groups' === filter_input( INPUT_POST, 'action' ) ) {
			$_POST['object'] = 'groups';
			bp_legacy_theme_object_template_loader();
			die;
		}
	}

	/**
	 * Add group type tabs.
	 */
	public function bb_display_directory_tabs() {
		$display_group_types = get_site_option( 'bpgt_type_display_settings' );
		$group_types         = bp_groups_get_group_types( array(), 'objects' );
		// Loop in group types to build the tabs.
		if ( ! empty( $display_group_types ) && is_array( $display_group_types ) ) {
			foreach ( $group_types as $key => $group_type ) :
				if ( in_array( $key, $display_group_types, true ) ) {
					?>
			<li id="groups-<?php echo esc_attr( $group_type->name ); ?>" class="bpgt-type-tab">
				<a href="<?php bp_groups_directory_permalink(); ?>"><?php printf( '%s <span>%d</span>', esc_attr( $group_type->labels['name'] ), esc_attr( $this->bb_count_group_types( $group_type->name ) ) ); ?></a>
			</li>
				<?php
				}
			endforeach;
		}
	}

	/**
	 * Get group count of group type tabs groups.
	 *
	 * @param string $group_type The group type.
	 * @param string $taxonomy The group taxonomy.
	 */
	public function bb_count_group_types( $group_type = '', $taxonomy = 'bp_group_type' ) {
		global $wpdb;
		$group_types = bp_groups_get_group_types();
		if ( empty( $group_type ) || empty( $group_types[ $group_type ] ) ) {
			return false;
		}
		$count_types = wp_cache_get( 'bpex_count_group_types', 'using_gt_bp_group_type' );
		if ( ! $count_types ) {
			if ( ! bp_is_root_blog() ) {
				switch_to_blog( bp_get_root_blog_id() );
			}
			$sql         = array(
				'select' => "SELECT t.slug, tt.count FROM {$wpdb->term_taxonomy} tt LEFT JOIN {$wpdb->terms} t",
				'on'     => 'ON tt.term_id = t.term_id',
				'where'  => $wpdb->prepare( 'WHERE tt.taxonomy = %s', $taxonomy ),
			);
			$count_types = $wpdb->get_results( join( ' ', $sql ) );
			wp_cache_set( 'bpex_count_group_types', $count_types, 'using_gt_bp_group_type' );
			restore_current_blog();
		}
		$type_count = wp_filter_object_list( $count_types, array( 'slug' => $group_type ), 'and', 'count' );
		$type_count = array_values( $type_count );
		if ( empty( $type_count ) ) {
			return 0;
		}
		return (int) $type_count[0];
	}

	/**
	 * Get group type args.
	 *
	 * @param array $args The group type.
	 */
	public function bb_set_has_groups_type_arg( $args = array() ) {
		$display_group_types = get_site_option( 'bpgt_type_display_settings' );
		if ( ! empty( $display_group_types ) && is_array( $display_group_types ) ) {
			// Get group types to check scope.
			$group_types = bp_groups_get_group_types();
			// Set the group type arg if scope match one of the registered group type.
			if ( ! empty( $args['scope'] ) && ! empty( $group_types[ $args['scope'] ] ) ) {
				$args['group_type'] = $args['scope'];
			}
		}
		return $args;
	}

	/**
	 * Display group type.
	 *
	 * @param string $group_id The group id.
	 */
	public function bb_group_directory_show_group_type( $group_id = null ) {
		if ( empty( $group_id ) ) {
			$group_id = bp_get_group_id();
		}
		// Group directory.
		if ( bp_is_active( 'groups' ) && bp_is_groups_directory() ) {
			// Passing false means supporting multiple group types.
			$group_type = (array) bp_groups_get_group_type( $group_id, false );
			$sep        = '&ndash;';
			foreach ( $group_type as $type ) {
				$obj = bp_groups_get_group_type_object( $type );
				// Group type name/description.
				if ( ! empty( $obj->description ) ) {
					printf( '<div class="dir-desc-' . esc_attr( $obj->labels['singular_name'] ) . '"><span class="dir-desc-span-name">%1$s</span><span class="dir-desc-span-sep">%2$s</span><span class="dir-desc-span-desc">%3$s</span>.', esc_attr( $obj->labels['singular_name'] ), esc_attr( $sep ), esc_html( $obj->description ) . '</div>' );
				}
			}
		}
	}
}
